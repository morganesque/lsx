<?php

class ImageCache {
    
    // public static $saturation = 1;
    // public static $lightness = 0.42;
    // public static $seed = 'j';

    public static $cacheDir = '.';

    function __construct()
    {

    }

    static function setCacheDir($dir)
    {
        self::$cacheDir = $dir;
    }
    
    static function getCache($url,$force=false)
    {
        $file = self::$cacheDir.md5($url);
        if (file_exists($file))
        {
            $m = filemtime($file); 
            $d = (time() - $m)/604800; /* 60*60*24*7 = 1 week */
            if ($d < 1 && !$force)
            {
                // var_dump('cache');
                return file_get_contents($file);
            } else {
                // var_dump('new');
                return self::get($url);
            }
        } else {
            // var_dump('new');
            return self::get($url);
        }
    }

    static function get($url)
    {
        $image_url = $url;

        $ch = curl_init(); 
        $timeout = 0; 
        curl_setopt ($ch, CURLOPT_URL, $image_url); 
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout); 

        // Getting binary data 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1); 

        $image = curl_exec($ch); 
        curl_close($ch); 
        
        // write it to a cache file.
        $file = self::$cacheDir.md5($url);
        $h = fopen($file,'w');
        fwrite($h,$image);
        fclose($h);

        // output to browser 
        return $image;
    }

}