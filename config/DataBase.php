<?php

class DataBase{

    public static function connect(){

        $connect = new mysqli('localhost','root','','tienda_master');
        $connect->query("SET NAMES 'utf8'");

        return $connect;
    }

}

?>