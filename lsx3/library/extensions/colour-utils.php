<?php

class ColourUtils {
    
    public static $saturation = 1;
    public static $lightness = 0.42;
    public static $seed = 'j';
    
    function __construct()
    {

    }
    
    static function hex2hsl_array($hexcode)
    {
        if (substr($hexcode,0,1) == '#') $hexcode = substr($hexcode,1);
        
        // chop up string
        $redhex  = substr($hexcode,0,2);
        $greenhex = substr($hexcode,2,2);
        $bluehex = substr($hexcode,4,2);

        // $var_r, $var_g and $var_b are the three decimal fractions to be input to our RGB-to-HSL conversion routine
        $var_r = (hexdec($redhex)) / 255;
        $var_g = (hexdec($greenhex)) / 255;
        $var_b = (hexdec($bluehex)) / 255;

        // Input is $var_r, $var_g and $var_b from above
        // Output is HSL equivalent as $h, $s and $l — these are again expressed as fractions of 1, like the input values
        $var_min = min($var_r,$var_g,$var_b);
        $var_max = max($var_r,$var_g,$var_b);
        $del_max = $var_max - $var_min;

        $l = ($var_max + $var_min) / 2;

        if ($del_max == 0)
        {
                $h = 0;
                $s = 0;
        } else {
                if ($l < 0.5) $s = $del_max / ($var_max + $var_min);
                else $s = $del_max / (2 - $var_max - $var_min);

                $del_r = ((($var_max - $var_r) / 6) + ($del_max / 2)) / $del_max;
                $del_g = ((($var_max - $var_g) / 6) + ($del_max / 2)) / $del_max;
                $del_b = ((($var_max - $var_b) / 6) + ($del_max / 2)) / $del_max;

                if ($var_r == $var_max) $h = $del_b - $del_g;
                elseif ($var_g == $var_max) $h = (1 / 3) + $del_r - $del_b;
                elseif ($var_b == $var_max) $h = (2 / 3) + $del_g - $del_r;

                if ($h < 0) $h += 1;
                if ($h > 1)$h -= 1;
        };

        return array('hue'=>$h,'saturation'=>$s,'lightness'=>$l);
    }
    
    static function hsl2hex_html($h,$s,$l)
    {
        $o = self::hsl2hex_array($h,$s,$l);
        return '#'.join('',$o);
    }
    
    static function hsl2rgba_html($h,$s,$l,$a)
    {
        $rgb = self::hsl2rgb($h,$s,$l);
        $red = round($rgb['r']);
        $green = round($rgb['g']);
        $blue = round($rgb['b']);
        // PreDump(array($red,$green,$blue,$a));
        return 'rgba('.$red.','.$green.','.$blue.','.$a.')';
    }
    
    static function hsl2rgb($h,$s,$l)
    {
        if ($s == 0)
        {
                $r = $l * 255;
                $g = $l * 255;
                $b = $l * 255;
        } else {
                if ($l < 0.5) $var_2 = $l * (1 + $s);
                else $var_2 = ($l + $s) - ($s * $l);

                $var_1 = 2 * $l - $var_2;
                $r = 255 * self::hue_2_rgb($var_1,$var_2,$h + (1 / 3));
                $g = 255 * self::hue_2_rgb($var_1,$var_2,$h);
                $b = 255 * self::hue_2_rgb($var_1,$var_2,$h - (1 / 3));
        };
        return array(
             'r'=>$r
            ,'g'=>$g
            ,'b'=>$b
        );
    }
    
    // Input is HSL value of complementary colour, held in $h2, $s, $l as fractions of 1
    static function hsl2hex_array($h,$s,$l)
    {
        $rgb = self::hsl2rgb($h,$s,$l);

        $rhex = self::normalise($rgb['r']);
        $ghex = self::normalise($rgb['g']);
        $bhex = self::normalise($rgb['b']);
        
        return array('red'=>$rhex,'green'=>$ghex,'blue'=>$bhex);
    }

    function normalise($i)
    {
        $o = dechex($i);
        $o = strtoupper($o);
        if (strlen($o) == 1) $o = '0'.$o;
        return $o;
    }

    function hue_2_rgb($v1,$v2,$vh)
    {
            if ($vh < 0) $vh += 1; // make sure it's more than 0

            if ($vh > 1) $vh -= 1; // make sure it's less than 1

            if ((6 * $vh) < 1) return ($v1 + ($v2 - $v1) * 6 * $vh);

            if ((2 * $vh) < 1) return ($v2);

            if ((3 * $vh) < 2) return ($v1 + ($v2 - $v1) * ((2 / 3 - $vh) * 6));

            return ($v1);
    }
    
    static function string2hue($string)
    {
        $num = 0; $c=0; $s = 50;
        $string = strtolower($string);

        for ($i=0; $i < $s; $i++) 
        { 
            $l = $string[$c];

            if ($l < 1)
            {     
                $o = ord($l)-96;
                $num+=$o;
            }

            if ($c+1 < strlen($string)) $c++;
            else $c = 0;
        }

        $div = ($s*26/3);
        $hue = ($num - $s) / $div;
        return $hue;
    }
    
    static function string2hex($string)
    {
        $string = self::tidyString($string);
        $hue = self::string2hue($string.self::$seed);
        $col = self::hsl2hex_html($hue, self::$saturation, self::$lightness);
        return $col;
    }
    
    static function stringtorgba($string, $alpha=1)
    {
        $string = self::tidyString($string);
        $hue = self::string2hue($string.self::$seed);
        $col = self::hsl2rgba_html($hue, self::$saturation, self::$lightness, $alpha);
        return $col;
    }
    
    static function num2rgba($num, $max, $alpha=1)
    {
        $hue = $num/$max;
        $col = self::hsl2rgba_html($hue, self::$saturation, self::$lightness, $alpha);
        return $col;
    }
    
    static function tidyString($string)
    {
        /*
            Bit of a hack.
            If the static class isn't instatiated I need to 
            grab the $_GET vars at some point. This seemed a good place.
        */
        if (isset($_GET['sat'])) self::$saturation = $_GET['sat'];
        if (isset($_GET['lig'])) self::$lightness = $_GET['lig'];
        if (isset($_GET['seed'])) self::$seed = $_GET['seed'];
        
        $string = str_replace(' ','',$string);
        return $string;
    }
}