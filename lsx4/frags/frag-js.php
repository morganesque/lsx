<?php

$js = array();
array_push($js,'jquery.cookie');
array_push($js,'jquery.validate');
// array_push($js,'plugins');
// array_push($js,'scroll-startstop.events.jquery');
array_push($js,'functions');
array_push($js,'comments');
// array_push($js,'video-index');
// array_push($js,'grid');
array_push($js,'map');

if (is_404() || false ) 
{
    array_push($js,'easel');
    array_push($js,'owl');
}

if (SITE_STATUS == 'LIVE' || SITE_STATUS == 'TEST')
{
    echo '<script src="'.JS.'/getJS.php?files='.join('|',$js).'" type="text/javascript"></script>'."\n";
} else {
    foreach($js as $j)
    {
        echo '<script src="'.JS.'/'.$j.'.js" type="text/javascript"></script>'."\n";
    }
}

?>