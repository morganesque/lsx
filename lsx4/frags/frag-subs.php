<div class="m-subs r-mod clearfix">
    <h3 class="tk-tachyon greyback">including</h3>
    <ul>
        <?php

        $args = array(
             // 'exclude' => '149,146,94,2,39'
             'exclude' => '123,129,2,93,39,116'
            ,'echo' => 0
            ,'title_li' => ''
            ,'link_before' => ''
            ,'link_after' => ''
        );
        $pages = get_pages( $args );
        foreach($pages as $p)
        {
            $back = doBack($p->post_title, 0.42);            
            echo '<li style="'.$back.'"><a href="'.get_permalink($p->ID).'">'.$p->post_title.'</a></li>';
        }
        ?>
    </ul>
</div>