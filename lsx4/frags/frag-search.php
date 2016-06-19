<?php
$dat = 0 + date('Hi'); 
$col = ColourUtils::num2rgba($dat, 2459, 0.76);
?>
<form class="search clearfix" style="background-color:<?php echo $col ?>" >
    <input type="text" value="" placeholder="search" />
    <input type="submit" value="go" class="submit"/>
</form>