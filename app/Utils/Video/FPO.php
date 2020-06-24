<?php
namespace App\Utils\Video;

class FPO
{
    public function get() 
    {    
        $html = file_get_contents('/sdcard/www/temp/fpo.html');
        $pattern = "#0/https://[^\s]+mp4#";
        preg_match_all($pattern, $html, $output);
        
        $downloadLinks = array_map(function($link){
            return str_replace('0/', '', $link);
        }, $output);
        
        return $downloadLinks;
    }
}
