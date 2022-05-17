<?php


namespace App\Models;


class DataHandle
{
    public function cleanData($data){
        return htmlspecialchars(htmlentities(htmlspecialchars(strip_tags(trim($data)))));
    }

    public function cleanText($data){
        return strip_tags(trim($data));
    }
}