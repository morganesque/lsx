<nav>
    <?php // wp_page_menu( 'show_home=0' ); ?>
    <!-- <img src="/wp-content/themes/lsx/library/media/images/owl/blank-head.png" width="100%"/> -->
    <ul class="nav mod">
        <!-- <li class="filler"><div>&nbsp;</div></li> -->
        <?php
        $nav = array(
            ''=>'home',
            'events'=>'events',
            'videos'=>'videos',
            'articles'=>'articles',
            'about'=>'about',        
            'contact'=>'contact',        
        );
        
        foreach($nav as $key=>$val)
        {
            $class = $key; if (!$class) $class = 'home';
            
            if ($key) $key = $key.'/';
            
            
            // echo '<li class="tk-tachyon bold" style="background-color:'.ColourUtils::string2hex($key).'"><a href="/'.$key.'">'.$val.'</a></li>';
            echo '<li class="tk-tachyon bold"><a href="/'.$key.'">'.$val.'</a></li>';
        }
        
        ?>                       
    </ul>
</nav>
