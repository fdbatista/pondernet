<?php

namespace app\models;

use app\controllers\SiteController;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadFile extends Model
{
    /**
     * @var UploadedFile
     */
    public $someFile;

    public function rules()
    {
        return [
            [['someFile'], 'file',
                'skipOnEmpty' => true,
                //'uploadRequired' => SiteController::translate('You must specify a filename'),
                'maxSize' => 512000000, //500 MB
                'tooBig' => SiteController::translate('Maximum allowed filesize is ') . '{maxSize}',
                'minSize' => 10, //10 Bytes
                'tooSmall' => SiteController::translate('Minimum allowed filesize is ') . '{minSize}',
                //'extensions' => 'jpg, jpeg, png, gif, bmp, txt, pdf, doc, docx, excel, excelx, avi, mpg, mpeg, wmv, mkv, mp3, wav, ogg, wma, sql, sdf, mdf, db',
                'wrongExtension' => SiteController::translate('File extension is not allowed ') . '({extensions})',
                'maxFiles' => 1,
                'tooMany' => SiteController::translate('Maximum file count is ') . '{maxFiles}',
            ],
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'someFile' => \app\controllers\SiteController::translate(''),
        ];
    }
    
    public function uploadFile($ruta)
    {
        if ($this->validate()) {
            $this->someFile->saveAs($ruta . $this->someFile->name);
            return true;
        } else {
            return false;
        }
    }
}