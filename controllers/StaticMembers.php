<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers;
use Yii;

/**
 * Description of Static
 *
 * @author FD
 */
class StaticMembers
{
    public static function MostrarMensajes()
    {
        foreach (Yii::$app->session->getAllFlashes() as $key => $message)
        {
            echo '<div class="alert alert-' . $key . ' fade in">' . $message . '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>';
        }
    }
    
    public static function CargarNomenclador($nombre)
    {
        try
        {
            $elems = \Yii::$app->db->createCommand("select nombre from $nombre")->queryAll();
            $res = [];
            foreach ($elems as $elem)
            {
                $res[] = $elem['nombre'];
            }
            return json_encode($res);
        }
        catch (Exception $exc)
        {
            return json_encode([]);
        }
    }
    
    public static function EliminarMensajes()
    {
        Yii::$app->session->removeAllFlashes();
    }
}
