<?php

abstract class Driver{

    private static $db;

    /**
     * Get the value of db
     */ 
    private static function getDb()
    {
        if(self::$db === null){
            try{
                self::$db = new PDO('mysql:host=localhost; dbname=fragrances','root','');
                self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8'");
                //echo 'ok ...';
            }catch(PDOException $e){
                die($e->getMessage());
            }
        }
        return self::$db;
    }

    protected function getRequest($sql, $params = null){

        $result = self::getDb()->prepare($sql);
        $result->execute($params);

        return $result;
    }
}