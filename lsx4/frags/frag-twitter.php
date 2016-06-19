<div class="m-twitter r-mod">
<?php
    $col = ColourUtils::stringtorgba('twitter', 0.42);
?>
<h3 class='tk-tachyon' style="background-color:<?php echo $col; ?>">twitter<img src="<?php echo IMAGES;?>/twoo.png"></h3>
<?php

$LSXTwit = new LSXTwitter('user');
$o = $LSXTwit->getParsedResults();

if (is_array($o['results']))

for ($i=0; $i < 5; $i++) { 
    $t = $o['results'][$i];
    echo '<div class="item">';
    
    echo '<p>';
    echo $t['text'];
    
    $time = strtotime($t['created_at']);
    echo '<br /><span class="date">'.date("g:ia jS M Y",$time).'</span>';
    echo '</p>';
    echo '</div>';
}
?>
</div>