<?php

namespace App\Libraries;

class Backgroud
{

    public static function filter($kyniem_content)
    {

        $pattern = '/(\[background=(.+?)\])(.+)(\[.+\])/';
        preg_match($pattern, $kyniem_content, $march);
        if ($march) {
            return '<div class="background ' . $march[2] . '">' . $march[3] . '</div>';
        }

        return $kyniem_content;
    }
}