<?php

use app\models\phptextClass;

session_start();


/*create class object*/
$phptextObj = new phptextClass();	
/*phptext function to genrate image with text*/
$phptextObj->phpcaptcha('#162453','#fff',120,40,10,25);	
 ?>