<?php
ob_start("ob_gzhandler");

header('Content-type: text/css');

if (isset($_GET['files'])) $files = explode('|',$_GET['files']);   

if (is_array($files))
foreach($files as $css)
{
    if (SITE_STATUS == 'LIVE')
    {
        include('./min/'.$css.'.min.css');
    } else {
        include('./'.$css.'.css');
    }
}
?>