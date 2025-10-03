<?php

spl_autoload_register(function($className) {
//  echo $className;
	$className = str_replace("\\", DIRECTORY_SEPARATOR, $className);
	include_once $_SERVER['DOCUMENT_ROOT'] . '/phsrc_online/'.$className.'.php';
//    echo $_SERVER['DOCUMENT_ROOT'] . '/core/'.$className.'.php';

});

?>


