<?php

class Spinner
{
    public static function show()
    {
        echo('
    <div class="spinner">
    <div class="rect1"></div>
    <div class="rect2"></div>
    <div class="rect3"></div>
    <div class="rect4"></div>
    <div class="rect5"></div>
    </div>
    ');
    }

    public static function getHtml(){
        return "\x3Cdiv class=\"spinner\"\x3E\x3Cdiv class=\"rect1\"\x3E\x3C\x2Fdiv\x3E\x3Cdiv class=\"rect2\"\x3E\x3C\x2Fdiv\x3E\x3Cdiv class=\"rect3\"\x3E\x3C\x2Fdiv\x3E\x3Cdiv class=\"rect4\"\x3E\x3C\x2Fdiv\x3E\x3Cdiv class=\"rect5\"\x3E\x3C\x2Fdiv\x3E\x3C\x2Fdiv\x3E";
    }
}


?>

