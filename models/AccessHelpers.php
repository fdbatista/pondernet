<?php
namespace app\models;

use yii;

class AccessHelpers
{

    public static function getAcceso($operacion)
    {
        if (Yii::$app->user->isGuest)
            return false;
        if (Yii::$app->user->identity->rol_id == 4)
            return true;
        $connection = Yii::$app->db;
        $sql = "SELECT 1 valor
                FROM user u
                JOIN rol r ON u.rol_id = r.id
                JOIN rol_operacion ro ON r.id = ro.rol_id
                JOIN operacion o ON ro.operacion_id = o.id
                WHERE o.ruta =:operacion
                AND u.rol_id =:rol_id";
        $command = Yii::$app->db->createCommand($sql);
        $command->bindValue(":operacion", $operacion);
        $command->bindValue(":rol_id", Yii::$app->user->identity->rol_id);
        $result = $command->queryOne();
        return ($result['valor'] != null);
    }
    
    public static function cursoPagado($cursoId)
    {
        if (Yii::$app->user->isGuest)
            return false;
        $connection = \Yii::$app->db;
        $sql = "select 1 valor from curso_abonado where id_usuario =:user_id and id_producto =:curso_id";
        $command = $connection->createCommand($sql);
        $command->bindValue(":user_id", Yii::$app->user->identity->id);
        $command->bindValue(":curso_id", $cursoId);
        $result = $command->queryOne();
        return ($result['valor'] != null);
    }
    
}