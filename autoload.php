<?php

function controllers_autoload($classname){
    require_once "controller/$classname.php";
}

spl_autoload_register('controllers_autoload');

?>