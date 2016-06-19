<?php

$css = array();
array_push($css,'../../style');
array_push($css,'base');
array_push($css,'layout');
// array_push($css,'fonts-colours-sizes');
// array_push($css,'core');
// array_push($css,'index');
// array_push($css,'single');
// array_push($css,'about');
// array_push($css,'upcoming');
// array_push($css,'twitter');
array_push($css,'comments');
// array_push($css,'footer');
// array_push($css,'editbar');
// array_push($css,'top-bar');


if (SITE_STATUS == 'LIVE' || SITE_STATUS == 'TEST')
{
    echo '<link rel="stylesheet" media="screen" href="'.CSS.'/getCSS.php?files='.join('|',$css).'&v=1">'."\n";
} else {
    echo "\n";
    foreach($css as $c)
    {
        echo '    <link rel="stylesheet" media="screen" href="'.CSS.'/'.$c.'.css?v=1">'."\n";
    }
}

// echo '    <link rel="stylesheet" media="print" href="'.CSS.'/_print/main.css"/>'."\n";

/*
<link rel="stylesheet" href="/wp-includes/css/admin-bar.dev.css" />

/*-  Media Queries different sizes.
----------------------------------------------------------------------*/
/*
@import url('mq-1024.css') only screen and (min-width:1024px);
@import url('mq-768.css') only screen and (min-width:768px);
@import url('mq-480.css') only screen and (min-width:480px);
*/

?>