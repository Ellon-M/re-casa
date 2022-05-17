<?php

namespace App\Processors;
use App\Utils\DBConfig;
use App\Utils\MyLogger;

class DBConnect
{
    public function dbConnection(){
        $myLogger = new MyLogger();
        if ($conn = mysqli_connect(DBConfig::DB_HOST,DBConfig::DB_USER,DBConfig::DB_PASSWORD,DBConfig::DB_NAME)){
            return $conn;
        }else{
            $myLogger->logger()->error("Failed creating connection ".mysqli_connect_error());
            return false;
        }
    }
}