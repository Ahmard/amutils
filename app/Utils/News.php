<?php
namespace App\Utils;

use App\Utils\News\{
    BBCHausa,
    RFIHausa,
    DWHausa,
    VOAHausa
};

class News
{
    protected static array $methods = [
        'bbchausa' => BBCHausa::class, 
        'rfihausa' => RFIHausa::class, 
        'dwhausa' => DWHausa::class,
        'voahausa' => VOAHausa::class
    ];
    
    
    public static function __callStatic($method, $arguments)
    {
        if(array_key_exists($method, static::$methods)){
            return new static::$methods[$method];
        }
    }
}