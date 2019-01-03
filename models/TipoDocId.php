<?php

namespace app\models;

use app\controllers\SiteController;

/**
 * This is the model class for table "tipo_doc_id".
 *
 * @property string $id
 * @property string $nombre
 *
 * @property User[] $users
 */
class TipoDocId extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipo_doc_id';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'required', 'message' => SiteController::translate('This field is mandatory')],
            [['nombre'], 'string', 'max' => 25]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => SiteController::translate('ID'),
            'nombre' => SiteController::translate('Nombre'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id_tipo_doc_id' => 'id']);
    }
}
