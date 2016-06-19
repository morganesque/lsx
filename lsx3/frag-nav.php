<nav>
    <?php // wp_page_menu( 'show_home=0' ); ?>
    <!-- <img src="/wp-content/themes/lsx/library/media/images/owl/blank-head.png" width="100%"/> -->
    <ul class="nav mod">
        <!-- <li class="filler"><div>&nbsp;</div></li> -->
        <?php
        $nav = array(
            ''=>'Home',
            'events'=>'Events',
            'videos'=>'Videos',
            'news'=>'News',
            'about'=>'About Us',        
            'contact'=>'Contact',        
        );
        
        foreach($nav as $key=>$val)
        {
            if ($key) $key = $key.'/';
            // echo '<li class="tk-tachyon bold" style="background-color:'.ColourUtils::string2hex($key).'"><a href="/'.$key.'">'.$val.'</a></li>';
            echo '<li class="tk-tachyon bold" style="background-color:'.ColourUtils::stringtorgba($key,0.22).'"><a href="/'.$key.'">'.$val.'</a></li>';
        }
        
        ?>                       
    </ul>
</nav>
