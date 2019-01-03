<?php

namespace app\models;

use app\controllers\SiteController;

/**
 * This is the model class for table "producto".
 *
 * @property string $id
 * @property string $id_categoria
 * @property string $nombre
 * @property string $descripcion
 * @property string $ruta_imagen
 * @property double $precio
 * @property double $rebaja
 *
 * @property CursoAbonado[] $cursoAbonados
  */

class Producto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    
    public static function tableName()
    {
        return 'producto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_categoria'], 'integer'],
            [['nombre', 'descripcion', 'precio'], 'required', 'message' => SiteController::translate('This field is mandatory')],
            [['nombre', 'ruta_imagen'], 'string', 'max' => 100],
            [['descripcion'], 'string', 'max' => 250],
            [['ruta_imagen'], 'file',
                'skipOnEmpty' => true,
                //'uploadRequired' => 'No has seleccionado ningún archivo',
                'maxSize' => 512000,
                'tooBig' => SiteController::translate('Maximum allowed filesize is ') . '{maxSize}',
                'minSize' => 10, //10 Bytes
                'tooSmall' => SiteController::translate('Minimum allowed filesize is ') . '{minSize}',
                'extensions' => 'jpg, jpeg, png, gif, bmp',
                'wrongExtension' => SiteController::translate('File extension is not allowed ') . '({extensions})', //Error
                'maxFiles' => 1,
                'tooMany' => SiteController::translate('Maximum file count is ') . '{maxFiles}', //Error
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => SiteController::translate('ID'),
            'id_categoria' => SiteController::translate('Category'),
            'nombre' => SiteController::translate('Name'),
            'descripcion' => SiteController::translate('Description'),
            'categoria' => SiteController::translate('Category'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(Categoria::className(), ['id' => 'id_categoria']);
    }
    
    public function getCursoAbonados()
    {
        return $this->hasMany(CursoAbonado::className(), ['producto_id' => 'id']);
    }
}
