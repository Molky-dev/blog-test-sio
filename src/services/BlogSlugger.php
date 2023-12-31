<?php

namespace App\services;

class BlogSlugger
{



    public static function slugify(?string $text): string
    {

        if (empty($text)) {
            return 'n-a';
        }

        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, '-');
        $text = preg_replace('~-+~', '-', $text);
        $text = strtolower($text);



        return $text;
    }


}