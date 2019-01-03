<?php

namespace app\models;

use app\controllers\SiteController;

/**
 * This is the model class for table "categoria".
 *
 * @property string $id
 * @property integer $id_padre
 * @property string $nombre
 * @property string $descripcion
 * @property string $idioma
 */
class Categoria extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categoria';
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_padre'], 'integer'],
            [['nombre'], 'required', 'message' => SiteController::translate('This field is mandatory')],
            [['descripcion'], 'string'],
            [['nombre'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_padre' => SiteController::translate('Belongs to'),
            'nombre' => SiteController::translate('Name'),
            'descripcion' => SiteController::translate('Description'),
        ];
    }
    
    public function getPadre()
    {
        return $this->hasOne(Categoria::className(), ['id' => 'id_padre']);
    }
    
    public function getProductos()
    {
        return $this->hasMany(Producto::className(), ['id_categoria' => 'id']);
    }
    
}
