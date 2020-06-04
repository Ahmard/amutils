<?php
namespace App;

class Intents
{
    public static function call($method, $data)
    {
        if(method_exists(Intents::class, $method)){
            return Intents::$method($data);
        }
        
        echo "\n Your chosen intent does not exists.\n";
    }
    
    
    public static function makeUrlReady($url)
    {
        return str_replace(['(', ')'], ['%28', '%29'], $url);
    }
    
    
    public static function exec($intent, $data)
    {
        exec("am start --user 0 -n {$intent} {$data}");
    }
    
    
    public static function IDM($url)
    {
        $url = self::makeUrlReady($url);
        return self::exec('idm.internet.download.manager.plus/idm.internet.download.manager.UrlHandlerDownloader', $url);
    }
    
    
    public static function Opera($url)
    {
        $url = self::makeUrlReady($url);
        return self::exec('com.opera.browser/com.opera.Opera', $url);
    }
}