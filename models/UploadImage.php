<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;
use app\controllers\SiteController;

class UploadImage extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file',
                'skipOnEmpty' => true,
                'maxSize' => 1024*1024, //1 MB
                'extensions' => 'jpg, jpeg, png, gif, bmp',
                'maxFiles' => 1,
                //'uploadRequired' => SiteController::translate('You must specify a filename'),
                'tooBig' => SiteController::translate('Maximum allowed filesize is ') . '{maxSize}',
                'minSize' => 10, //10 Bytes
                'tooSmall' => SiteController::translate('Minimum allowed filesize is ') . '{minSize}',
                'wrongExtension' => SiteController::translate('File extension is not allowed ') . '({extensions})',
                'maxFiles' => 1,
                'tooMany' => SiteController::translate('Maximum file count is ') . '{maxFiles}',
            ],
        ];
    }
    
    public function uploadImage($ruta)
    {
        if ($this->validate())
        {
            $extensiones = ['jpg', 'jpeg', 'png', 'gif', 'bmp'];
            foreach ($extensiones as $ext)
            {
                $posibleRuta = $ruta . '.' . $ext;
                if (file_exists($posibleRuta))
                {
                    unlink($posibleRuta);
                }
            }
            $this->imageFile->saveAs($ruta . '.' . $this->imageFile->extension);
            return true;
        }
        else
        {
            return false;
        }
    }
}