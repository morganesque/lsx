<div id="lsx-twitter">
<div class="preh3"></div><h3 class='tk-tachyon'>twitter<img src="<?php echo IMAGES;?>/twoo.png"></h3>
<?php

$LSXTwit = new LSXTwitter('user');
$o = $LSXTwit->getParsedResults();

if (is_array($o['results']))
foreach($o['results'] as $t)
{
    echo '<div class="twit">';
    
    echo '<p>';
    echo $t['text'];
    
    $time = strtotime($t['created_at']);
    echo '<br /><b>'.date("g:ia jS M Y",$time).'</b>';
    echo '</p>';
    echo '</div>';
}
?>
</div>