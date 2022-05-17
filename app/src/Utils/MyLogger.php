<?php


namespace App\Utils;


use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class MyLogger
{
    public function logger(){
        $log = new Logger("Sharing Papers");
        // $filePath = "/opt/lampp/htdocs/realestate/app/";
        $filePath = "/home/casaveni/public_html/app/";

        $errorStreamHandler = new StreamHandler($filePath."runtime/logs/error.log",Logger::ERROR);
        $infoStreamHandler = new StreamHandler($filePath."runtime/logs/info.log",Logger::INFO);
        $debugStreamHandler = new StreamHandler($filePath."runtime/logs/debug.log",Logger::DEBUG);

        $log->pushHandler($errorStreamHandler);
        $log->pushHandler($infoStreamHandler);
        $log->pushHandler($debugStreamHandler);

        return $log;
    }
}