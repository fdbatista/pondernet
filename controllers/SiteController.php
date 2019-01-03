<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Producto;
use app\models\SignupForm;
use app\models\User;
use app\models\PasswordResetRequestForm;
use app\models\Invitacion;
use app\models\CursoAbonado;
use app\models\Pagos;
use app\models\AccessHelpers;
use app\models\auditoria\ContAudit;
use app\models\auditoria\UserAudit;
use app\models\ChangePasswordForm;
use app\models\ActivateUserForm;

class SiteController extends Controller
{
    public function beforeAction($action)
    {
        StaticMembers::EliminarMensajes();
        if (!isset(Yii::$app->session['language']))
            Yii::$app->session->set('language', 'es-ES');
        
        if (!parent::beforeAction($action)) {
            return false;
        }
 
        $operacion = Yii::$app->controller->route;
        if (in_array($operacion, ['site/invitar', 'site/update-profile', 'site/my-profile', 'site/retirar-fondos', 'site/captcha', 'site/activate-user', 'site/logout', 'site/oficina', 'site/change-language', 'site/request-password-reset', 'site/reset-password', 'site/index', 'site/error', 'site/signup', 'site/about', 'site/contact', 'site/login', 'site/activate-user', 'site/usuario'])) {
            return true;
        }

        if (!AccessHelpers::getAcceso($operacion)) {
            //throw new BadRequestHttpException(self::translate('You are not allowed to perform this action.'));
            echo $this->render('/site/error', ['name' => 'Error', 'message' => 'You are not allowed to perform this action.']);
        }
        return true;
    }
    
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['request-password-reset', 'login', 'signup'],
                        'allow' => false,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['index', 'about', 'contact', 'logout', 'error', 'change-language', 'change-password', 'my-profile', 'update-profile', 'oficina', 'afiliado', 'invitar', 'retirar-fondos', 'captcha', 'activate-user', 'cobrar-bono', 'usuario', 'cobrar-comisiones'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['index', 'about', 'contact', 'login', 'signup', 'error', 'request-password-reset', 'activate-user', 'reset-password', 'change-language', 'captcha'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'id' => 'captcha',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $cursos = [];
        try
        {
            $cursos = Producto::findBySql('select * from producto order by id desc limit 6')->all();
        }
        catch (\Exception $exc)
        {
            Yii::$app->session->setFlash('danger', $exc->getMessage());
        }
        finally
        {
            return $this->render('index', ['cursos' => $cursos]);    
        }
    }
    
    public static function getCategorias() 
    {
        return Yii::$app->db->createCommand('select * from categorias_populares')->queryAll();
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->actionIndex();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()))
        {
            if ($model->login())
            {
                return $this->actionChangeLanguage(Yii::$app->user->identity->idioma, Yii::$app->homeUrl);
            }
            $usuario = \app\models\User::findOne(['username' => $model->attributes['username']]);
            
            if ($usuario)
            {
                if ($usuario->intentos_cnx_fallidos > 2)
                    Yii::$app->session->setFlash ('warning', self::translate('Your user account has been blocked for security reasons. Contact the site administrator to unlock it.'));
                else
                {
                    if ($usuario->rol_id != 4)
                    {
                        $usuario->intentos_cnx_fallidos++;
                        $usuario->save(false);
                    }
                }
            }
            return $this->render('login', ['model' => $model,]);
        }
        else
        {
            return $this->render('login', ['model' => $model,]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        $idioma = Yii::$app->session->get('language');
        Yii::$app->user->logout();
        $idioma = Yii::$app->session->set('language', $idioma);
        return $this->actionIndex();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        try
        {
            if ($model->load(Yii::$app->request->post()) && $model->validate())
            {
                if ($model->sendEmail(Yii::$app->params['adminEmail']))
                {
                    Yii::$app->session->setFlash('success', SiteController::translate('Thank you for contacting us. We will reply as soon as possible.'));
                }
                else
                {
                    Yii::$app->session->setFlash('danger', SiteController::translate('There was an error sending email.'));
                }
            }
            return $this->render('contact', ['model' => $model,]);
        }
        catch (\Exception $exc)
        {
            Yii::$app->session->setFlash('danger', $exc->getMessage());
            return $this->render('contact', ['model' => $model,]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    
    public function validarCompraSimulada($id)
    {
        $payment_status = "Completed";
        $res = "VERIFIED";
        if (strcmp(trim($res), "VERIFIED") == 0)
        {
            if ($payment_status == "Completed")
            {
                $model = \app\models\Producto::find($id)->one();
                $modelAbonado = new \app\models\CursoAbonado(['user_id' => Yii::$app->user->id, 'producto_id' => $id, 'id_afiliado' => Yii::$app->user->identity->referido_por, 'comision' => round((($model->rebaja) ? $model->rebaja : $model->precio) / 2) ]);
                $modelAbonado->save();
                return true;
            }
            else
            {
                Yii::$app->session->setFlash('danger', self::translate('Payment process has not been completed. Try again later.'));
            }
        }
        return false;
    }
    
    public function actionGraciasTest($id)
    {
        return $this->render('gracias', ['model' => \app\models\Producto::find($id)->one()]);
    }
    
    public function actionSignup($referente = null, $id_curso = null)
    {
        $model = new SignupForm();
        $referido_por = null;
        $curso = null;
        $parametros = ['model' => $model];
        $params_validos = true;
        
        try
        {
            if ($referente)
            {
                $referido_por = User::findOne(['username' => "$referente"]);
                if ($referido_por)
                    $parametros['referente'] = [$referido_por['id'] => $referido_por['email']];
                else
                    $params_validos = false;
            }
            if ($id_curso)
            {
                $curso = Producto::findOne(['id' => "$id_curso"]);
                if ($curso)
                    $parametros['curso'] = [$curso['id'] => $curso['nombre']];
                else
                    $params_validos = false;
            }
            if (!$params_validos)
            {
                return $this->render('error', ['message' => 'Solicitud incorrecta']);
            }
            else if ($model->load(Yii::$app->request->post()))
            {
                if (!$model->referido_por)
                {
                    $model->referido_por = $referido_por ? $referido_por->id : null;
                }
                if ($user = $model->signup($id_curso))
                {
                    if (isset($id_curso))
                    {
                        if (Yii::$app->getUser()->login($user))
                        {
                            if ($this->confirmarCompra($id_curso))
                            {
                                return $this->actionGraciasTest($id_curso);
                            }
                            else
                                $user->delete();
                        }
                    }
                    if ($model->sendEmail($user, $model->password, $id_curso))
                    {
                        Yii::$app->session->setFlash('success', self::translate('An email has been sent to your address with further instructions.'));
                        return $this->render('mensaje');
                    }
                    else
                    {
                        Yii::$app->session->setFlash('danger', self::translate('Sorry, we are unable to send the instructions to your email address.'));
                    }
                    return $this->redirect(['index']);
                }
            }
            
            return $this->render('signup', $parametros);
        }
        catch (\Exception $exc)
        {
            Yii::$app->session->setFlash('danger', $exc->getMessage());
            return $this->render('signup', $parametros);
        }
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        try
        {
            $model = new PasswordResetRequestForm();
            if ($model->load(Yii::$app->request->post()) && $model->validate())
            {
                if ($model->sendEmail())
                {
                    Yii::$app->session->setFlash('success', self::translate('An email has been sent to your address with further instructions.'));
                    return $this->goHome();
                }
                else
                {
                    Yii::$app->session->setFlash('danger', self::translate('Sorry, we are unable to send the instructions to your email address.'));
                }
            }
            return $this->render('requestPasswordResetToken', ['model' => $model,]);
        }
        catch (\Exception $exc)
        {
            Yii::$app->session->setFlash('danger', $exc->getMessage());
            return $this->render('requestPasswordResetToken', ['model' => $model,]);
        }
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try
        {
            $model = new ResetPasswordForm($token);
        }
        catch (InvalidParamException $e)
        {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword())
        {
            Yii::$app->session->setFlash('success', self::translate('Your password has been updated.'));
            return $this->goHome();
        }
        return $this->render('resetPassword', ['model' => $model,]);
    }
    
    public function actionActivateUser($token)
    {
        if (Yii::$app->user->isGuest)
        {
            try
            {
                $model = new ActivateUserForm($token);
            }
            catch (\Exception $exc)
            {
                return $this->actionLogin();
                //Yii::$app->session->setFlash('warning', $exc->getMessage());
            }

            if ($model->validate() && $model->activateAccount())
                Yii::$app->session->setFlash('success', self::translate('Your account has been activated. Now you may logon to continue.'));
            else
                Yii::$app->session->setFlash('danger', self::translate('Your account has not been activated.'));
            return $this->actionLogin();
        }
        return $this->goHome();
    }
    
    public function actionChangeLanguage($language, $url)
    {
        Yii::$app->language = $language;
        Yii::$app->session->set('language', $language);
        if (!Yii::$app->user->isGuest)
        {
            $model = $this->findModel(Yii::$app->user->id);
            if ($model)
            {
                $model->idioma = $language;
                $model->save(false);
            }
        }
        return $this->redirect($url);
    }
    
    public static function translate($message)
    {
        return LanguageController::translate($message);
    }
    
    public static function getLanguage()
    {
        return self::$language;
    }
    
    public function actionMyProfile()
    {
        return $this->render('my-profile', ['model' => $this->findModel(Yii::$app->user->id)]);
    }
    
    public function actionUpdateProfile()
    {
        $id = Yii::$app->user->id;
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            $objAudit = new ContAudit(Yii::$app->controller->route, null, new UserAudit($model));
            AuditoriaController::generarTraza($objAudit);
            Yii::$app->session->setFlash('success', SiteController::translate('Your profile has been updated'));
            return $this->render('my-profile', ['model' => $this->findModel(Yii::$app->user->id)]);
        }
        else
        {
            return $this->render('update-profile', ['model' => $model]);
        }
    }
    
    public function actionChangePassword()
    {
        $model = new ChangePasswordForm();
        if ($model->load(Yii::$app->request->post()) && !Yii::$app->user->isGuest)
        {
            $post = Yii::$app->request->post();
            $id = Yii::$app->user->identity->id;
            $user = $this->findModel($id);
            $newPassword = $post['ChangePasswordForm']['new_password'];
            if ($user->validatePassword($post['ChangePasswordForm']['old_password'], $user->password_hash))
            {
                $user->setPassword($newPassword);
                if ($user->save(false))
                {
                    Yii::$app->session->setFlash('success', self::translate('Your password has been changed.'));
                    return $this->render('change-password', ['model' => new ChangePasswordForm()]);
                }
                else
                    Yii::$app->session->setFlash('danger', self::translate('Unable to save data.'));
            }
            else
                Yii::$app->session->setFlash('danger', self::translate('Current password is incorrect.'));
            return $this->render('change-password', ['model' => $model,]);
        }
        return $this->render('change-password', ['model' => $model,]);
        
    }
    
    protected function findModel($id)
    {
        if (($model = \app\models\User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('This element does not exist');
        }
    }
    
    public function arbolCategorias($parent, $level, &$result)
    {
        $categorias = \app\models\Categoria::findAll(['id_padre' => $parent]);
        foreach ($categorias as $categ)
        {
            $result.= '<li><a href = "' . \yii\helpers\Url::toRoute(['categoria/view', 'id' => $categ->attributes['id']]) .'">'. $categ->attributes['nombre'] . '</a>';
            $result.= '<ul>';
            $this->arbolCategorias($categ->attributes['id'], $level + 1, $result);
            $result.= '</ul></li>';
        }
    }
    
    public function actionInvitar()
    {
        $post = Yii::$app->request->post();
        $modelInvitar = new Invitacion();
        
        try
        {
            if ($modelInvitar->load($post) && $modelInvitar->validate())
            {
                $curso = null;
                if ($modelInvitar->id_curso != '')
                    $curso = \app\models\Producto::find()->where(['id' => $modelInvitar->id_curso])->one();

                $res = Yii::$app->mailer->compose(['html' => 'invitar-html', 'text' => 'invitar-text'], ['curso' => $curso])
                    ->setFrom([\Yii::$app->user->identity->email => \Yii::$app->name . ' robot'])
                    ->setTo($modelInvitar->destinatario)
                    ->setSubject(SiteController::translate('Invitation for ') . Yii::$app->name)
                    ->send();
                if ($res == '1')
                {
                    Yii::$app->session->setFlash('success', SiteController::translate('The message has been sent.'));
                    //return $this->actionOficina();
                }
            }
        }
        catch (\Exception $exc)
        {
            Yii::$app->session->setFlash('danger', $exc->getMessage());
        }
        finally
        {
            return $this->actionOficina($modelInvitar);
        }
    }
    
    private function puedeRetirarFondos()
    {
        $enCaja = \app\models\Caja5::findOne(Yii::$app->user->id);
        return (isset($enCaja));
    }
    
    public function actionOficina($model = null)
    {
        $miId = Yii::$app->user->id;
        $ventas = CursoAbonado::find()->where(['referido_por' => $miId]);
        $ventasDataProvider = new \yii\data\ActiveDataProvider([
            'query' => $ventas,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'id_usuario' => SORT_ASC,
                ]
            ],
        ]);
        
        $compras = CursoAbonado::find()->where(['id_usuario' => $miId]);
        $comprasDataProvider = new \yii\data\ActiveDataProvider([
            'query' => $compras,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'id_usuario' => SORT_ASC,
                ]
            ],
        ]);
        
        $pagos = Pagos::find()->where(['id_usuario' => $miId])->orderBy('fecha_solic');
        $pagosDataProvider = new \yii\data\ActiveDataProvider([
            'query' => $pagos,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'id_usuario' => SORT_ASC,
                ]
            ],
        ]);
        
        $comisiones = Yii::$app->db->createCommand("select * from usuarios_pagos where id_usuario = $miId")->queryAll();
        if (!$comisiones)
        {
            $comisiones = [
            [
                'id_usuario' => $miId,
                'pend_venta_directa' => 0,
                'pend_circuito' => 0,
                'efect_venta_directa' => 0,
                'efect_circuito' => 0,
                'solicitables_venta_directa' => 0,
                'solicitables_circuito' => 0,
            ]
            ];
        }
        
        if (isset($model))
            $modelInvitar = $model;
        else
            $modelInvitar = new \app\models\Invitacion();
        
        $cajas = [
            $array = Yii::$app->db->createCommand("select * from usuario_invitados_caja_1 where id_usuario = $miId order by fecha limit 4")->queryAll(),
            $array = Yii::$app->db->createCommand("select * from usuario_invitados_caja_2 where id_usuario = $miId limit 4")->queryAll(),
            $array = Yii::$app->db->createCommand("select * from usuario_invitados_caja_3 where id_usuario = $miId limit 4")->queryAll(),
            $array = Yii::$app->db->createCommand("select * from usuario_invitados_caja_4 where id_usuario = $miId limit 4")->queryAll(),
        ];
        
        return $this->render('oficina', ['ventasDataProvider' => $ventasDataProvider, 'comprasDataProvider' => $comprasDataProvider, 'pagosDataProvider' => $pagosDataProvider, 'modelInvitar' => $modelInvitar, 'cajas' => $cajas, 'pagos' => $pagos, 'comisiones' => $comisiones[0] /*'puedeRetirarFondos' => $this->puedeRetirarFondos(), 'comisionesPorCobrar' => $comisionesPorCobrar*/]);
    }
    
    public function actionRetirarFondos($seguir)
    {
        if ($this->puedeRetirarFondos())
        {
            $post = Yii::$app->request->post();
            if (isset($seguir))
            {
                $res = 0;
                $id = Yii::$app->user->id;
                $comando = Yii::$app->db->createCommand("call proc_cobrar_circuito($id, $seguir, @res)");
                $comando->execute();
                $res = Yii::$app->db->createCommand("select @res as result;")->queryScalar();
                
                if (!isset($res) || $res == 0)
                    Yii::$app->session->setFlash ('error', SiteController::translate('An error occured while attempting to retire your funds. Please, try again.'));
                elseif ($res == -1)
                    Yii::$app->session->setFlash ('error', SiteController::translate('You are not allowed to retire your funds yet.'));
                else
                {
                    if ($seguir == 1)
                    {
                        Yii::$app->session->setFlash('success', SiteController::translate('Thanks for staying with us! Your account has been reinserted into the circuit.'));
                        return $this->actionOficina();
                    }
                    else
                    {
                        Yii::$app->session->setFlash('success', SiteController::translate('Thanks for your support. Your account has been removed from our system.'));
                        return $this->actionLogout();
                    }
                }
            }
            Yii::$app->session->setFlash ('error', SiteController::translate('When retiring funds, you must specify whether you want to stay in the system or not.'));
        }
        return $this->actionOficina();
    }
    
    public function actionCobrarComisiones()
    {
        try
        {
            $miId = Yii::$app->user->id;
            $comando = Yii::$app->db->createCommand("call proc_cobrar_comisiones($miId)");
            $comando->execute();
            Yii::$app->session->setFlash('success', SiteController::translate('Operation completed.'));
        }
        catch (\Exception $exc)
        {
            Yii::$app->session->setFlash('danger', $exc->getMessage());
        }
        finally
        {
            return $this->actionOficina();
        }
    }
    
    public function confirmarCompra($id)
    {
        try
        {
            $post = Yii::$app->request->post();
            if ($post)
            {
                $paypal_account = $post['business'];
                $paypal_currency = 'USD';

                $solic = 'cmd=_notify-validate';
                foreach ($post as $key => $value)
                {
                    $value = urlencode(stripslashes($value));
                    $solic .= "&$key=$value";
                }
                $test = true;
                if($test)
                {
                    $url = "https://www.sandbox.paypal.com/cgi-bin/webscr";
                }
                else
                {
                    $url = "https://www.paypal.com/cgi-bin/webscr";
                }

                $item_name = $post['item_name']; //El nombre de nuestro artículo o producto.
                $order_id = $post['item_number']; //El numero o ID de nuestro producto o invoice.
                $payment_status = $post['payment_status']; //El estado del pago
                $amount = $post['mc_gross']; //El monto total pagado
                $payment_currency = $post['mc_currency']; //La moneda con que se ha hecho el pago
                $transaction_id = $post['txn_id']; //EL ID o Código de transacción.
                $receiver_email = $post['receiver_email']; //La cuenta que ha recibido el pago.
                $customer_email = $post['payer_email']; //La cuenta que ha enviado el pago.

                if($paypal_account != $receiver_email)
                {
                   exit;
                }
                $res = file_get_contents($url . "?" . $solic);
                if (strcmp (trim($res), "VERIFIED") == 0)
                {
                    if($payment_currency != $paypal_currency)
                    {
                        exit;
                    }
                    if ($payment_status == "Completed")
                    {
                        $model = $this->findModel($id);
                        $modelAbonado = new \app\models\CursoAbonado(['user_id' => Yii::$app->user->id, 'producto_id' => $id, 'comision' => round((($model->rebaja) ? $model->rebaja : $model->precio) / 2) ]);
                        $modelAbonado->save(false);
                        return true;
                    }
                    else
                    {
                        Yii::$app->session->setFlash('danger', SiteController::translate('Payment process has not been completed. Try again later.'));
                    }
                }
            }
            return $this->render(['/producto/confirmar-compra'], ['id' => $id]);
        }
        catch (\Exception $exc)
        {
            Yii::$app->session->setFlash('danger', $exc->getMessage());
            return $this->render(['/producto/confirmar-compra'], ['id' => $id]);
        }
    }
    
    public function actionUsuario($id)
    {
        return $this->render('usuario', ['model' => \app\models\User::find()->where(['id' => $id])->orWhere(['username' => $id])->one()]);
    }
    
    public function actionUsuarioHover($id)
    {
        return $this->render('usuario-hover', ['model' => \app\models\User::find()->where(['id' => $id])->orWhere(['username' => $id])->one()]);
    }
    
    private function actualizarIntentosFallidos($usuario, $resetear = false)
    {
        $model = User::findByUsername($usuario);
        if ($model)
        {
            if ($resetear)
                $model->intentos_cnx_fallidos = 0;
            else
                $model->intentos_cnx_fallidos++;
            $model->save(false);
        }
    }

}
