<?php

class LSXTwitter {
    
    public $cache_file; 
    public $type;
    public $force;
    
    public function __construct($type='',$force=false) 
    {
        $this->type = $type;
        $this->force = $force;
        $this->cache_file = THEMEMORE.'cache/twitter-search'.$type.'.txt';
    }
    
    public function getParsedResults()
    {
        $o = $this->checkCache();
        $j = $o[1];
        $j['label'] = $o[0];
        return $j;
    }
    
    public function checkCache()
    {        
        $file = $this->cache_file;
        if (file_exists($file))
        {
            $m = filemtime($file); 
            $d = (time() - $m)/3600;
            if ($d < 3 && !$this->force)
            {
                var_dump('cache');
                return array('cache',unserialize(trim(file_get_contents($file))));
            } else {
                var_dump('new');
                return $this->getNewData();
            }
        } else {
            var_dump('new');
            return $this->getNewData();
        }
    }
    
    public function getNewData()
    {
        $tmp = $this->doTwitterSearch();
        
        if (!isset($tmp['results'])) $new['results'] = $tmp;
        else $new = $tmp;
        
        if (is_array($new['results']))
        foreach($new['results'] as $k=>$t)
        {   
            $text = $t['text'];                 
            $text = preg_replace("#(^|[\n ])@([^ \"\t\n\r<]*)#ise", "'\\1<a href=\"http://www.twitter.com/\\2\" >@\\2</a>'", $text);
            $text = preg_replace("#(^|[\n ])([\w]+?://[\w]+[^ \"\n\r\t<]*)#ise", "'\\1<a href=\"\\2\" >\\2</a>'", $text);
            $text = preg_replace("#(^|[\n ])((www|ftp)\.[^ \"\t\n\r<]*)#ise", "'\\1<a href=\"http://\\2\" >\\2</a>'", $text);
            $new['results'][$k]['text'] = $text;
        }
        
        $h = fopen($this->cache_file,'w');
        fwrite($h,serialize($new));
        fclose($h);
        return array('new',$new);
    }
    
    public function doTwitterSearch()
    {
        $url = $this->getSearchURL();
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        $output = curl_exec($ch);
        return json_decode($output,true);
    }
    
    public function getSearchURL()
    {
        switch($this->type)
        {
            // case '': return 'http://search.twitter.com/search.json?q=lsx'; break;
            case '': return 'http://search.twitter.com/search.json?q=%23lsx'; break;
            case 'user': return 'http://twitter.com/statuses/user_timeline/lsx.json?count=12'; break;
        }
    }
}

// $LSXTwit = new LSXTwitter();

?>