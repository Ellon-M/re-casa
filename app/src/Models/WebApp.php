<?php


namespace App\Models;


class WebApp
{
    static function isSecure()
    {
        return (
            (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443
            || (
                (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')
                || (!empty($_SERVER['HTTP_X_FORWARDED_SSL'])   && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on')
            )
        );
    }

    static function getURL()
    {
        $url = filter_input(INPUT_SERVER, 'REQUEST_URI');

        if ($_SERVER['HTTP_HOST'] == "localhost"){
            $url = substr($url,11);
        }

        $position = strpos($url, '?');

        if ($position > 0)
        { $url = substr($url, 0, $position); }

        if ($url == '/' || substr($url, -1) != '/')
        { return $url; }

        return substr($url, 0, -1);
    }
}