/* Declare a namespace for the site */
var Site = window.Site || {};

var isHome = true;

/* Create a closure to maintain scope of the '$'
   and remain compatible with other frameworks.  */
(function($) {
	
	//same as $(document).ready();
	$(function() {
	    
	    /*
            Controlling the About Tab
            - - - - - - - - - - - - -
        */	    
        // is this the home page
	    isHome = $('body').hasClass('home'); 
	    // positions for where the tab should sit in different states.
	    aboutTabOpen = '48px';
	    aboutTabClose = '12px';
        // grab about tab.
        var aboutTab = $('div#about-tab a');
        var tabText = aboutTab.text();
            
        // if (!isHome || $.cookie('about-closed') == 'true') 
        // {
        //     $('div#about-content').hide();
        //     aboutTab.css({left:aboutTabOpen});
        // } else {
        //     aboutTab.css({left:aboutTabClose});
        //     aboutTab.text('hide');
        //     aboutTab.removeClass('a-down').addClass('a-up');
        // }
        
        
        /*
            Hiding and Showing the About Content
            - - - - - - - - - - - - - - - - - - - - - - - - - -
        */        
        // $('div#about-content').hide();
        aboutTab.css({left:aboutTabOpen});
        
        aboutTab.click(function(e)
        {                           
            e.preventDefault();
            var link = $(this);
            
            if ($(this).hasClass('a-up'))
            {
                aboutTab.removeClass('a-up').addClass('a-down');
                
                link.delay(1500)                    
                    .animate({left:aboutTabOpen},500,'easeOutQuint');
                    // .animate({top:'-1px'},500,'easeOutQuint');
                    
                $('div#about-content').hide('blind',{easing:'easeOutQuint'},1500);                    
                setTimeout(function()
                {
                    if (isHome) $.cookie('about-closed', 'true');
                    link.text(tabText);
                },1500);
            }
            else if ($(this).hasClass('a-down'))
            {
                aboutTab.removeClass('a-down').addClass('a-up');
                 
                link
                    .attr('href','#up')                 
                    .delay(1000)
                    .animate({left:aboutTabClose},500,'easeOutQuint');
                    // .animate({top:'-25px'},500,'easeOutQuint');                    
                    
                 $('div#about-content').show('blind',{easing:'easeInOutQuint'},1000,function()
                 {
                     link.text('hide');
                 });
            }
        });
        
        
        /*
            hiding the top bar ready for showing it
            - - - - - - - - - - - - - - - - - - - -
        */
        $('div#top-bar p').hide();
        
        var timer=0, open=false, count_timer, c=1;
        var counter = $(this).find('div.counter');
        
        $(document).mouseout(function()
        {
           clearInterval(count_timer);
           clearTimeout(timer);
           counter.hide();
        });
        
        /*
            showing the topbar content after a timed hover
            - - - - - - - - - - - - - - - - - - - - - - - -
        */
        $('div#top-bar').hover(function()
        {
            // if the flying owl and canvas aren't there don't bother.
            if(!$(this).find('a').data('fly')) return;
            
            c=1;
            counter.text(c);
            counter.show();            
            
            count_timer = setInterval(function(){
                c++;
                counter.text(c);
            }, 1000/3);
            
            // log('over');
            timer = setTimeout(function()
            {
                var a = 24 * 2;
                $('div#top-bar').animate({height:a},1000, 'easeOutQuint');
                $('body').animate({'margin-top':(a-12)},1000,'easeInOutQuint');                
                $('div#top-bar p').show('blind',200);
                open = true;
                counter.text('Go!');
                clearInterval(count_timer);
                setTimeout(function(){counter.hide();},500);
                    
            },1000);
            
        },function() 
        {
            clearInterval(count_timer);
            counter.hide();
            
            clearTimeout(timer);
            if (open)
            {
                var a = 12;
                $('div#top-bar p').hide('blind',1200);
                $('div#top-bar').animate({height:a},1000, 'easeOutQuint');
                $('body').animate({'margin-top':(a-12)},1000,'easeOutQuint');
                open = false;
            }
        });
        
        /*
            fading the site-nav in and out on hover
            - - - - - - - - - - - - - - - - - - - -
        */
        // var navhover = false; // to stop fading if mouse starts over nav.        
        // $('div#left').hover(function()
        // {
        //     $('nav ul.nav').stop().animate({opacity:1},1000);
        //     navhover = true;
        // }, function() {
        //     if (navhover) $('nav ul.nav').stop().animate({opacity:0},1000);
        // });

        /*
            fading site nav on scroll
            - - - - - - - - - - - - -
        */
        // function t_onScroll()
        // {
        //     $('nav ul.nav').stop().animate({opacity:0},1000);   
        //     $(window).unbind('scroll',t_onScroll); // remove the listener immediately.
        // }        
        // $(window).scroll(t_onScroll);        
        
        /*
            resizsing the video iframe responsively
            - - - - - - - - - - - - - - - - - - - -
        */
        var video_test = $('iframe').length; // check whether a video iframe exists.
        if (video_test)
        {
            var video_rat = $('iframe.video').attr('data-ratio');            
            function resizeVideo()
            {
                var video_wid = $('iframe.video').width();
                $('iframe.video').attr('height',(video_wid*video_rat));                
            }
            $(window).resize(resizeVideo);            
            resizeVideo();
        }
        
        /*
            fading the date and type icons up and down (index) 
            - - - - - - - - - - - - - - - - - - - - - - - - - -
        */
        // $('section#index div.index-item').hover(function()
        // {
        //     $(this).find('div.icons').stop().animate({opacity:0.3},500);
        // },function()
        // {
        //     $(this).find('div.icons').stop().animate({opacity:1},1000);
        //     
        // });

        /*
            Updating the monitor of page width (DEBUG)
            - - - - - - - - - - - - - - - - - - - - - -
        */        
        // $(window).resize(function()
        // {
        //     $('a#width-monitor').text($(this).width());
        // })
        
        /*
            fading the feed icons up and down.
            - - - - - - - - - - - - - - - - - - - - - -
        */        
        // $('div#feeds a').css('opacity',0.5).hover(function()
        // {
        //     $(this).stop().animate({opacity:1},500);
        // },function()
        // {
        //     $(this).stop().animate({opacity:0.5},1000);
        //     
        // });
        
        
        /*
            Takes the window scroll to the top when it's nearly there.
            - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
            (makes the LSx line up with the heading)
        */

        // $(window).bind('scrollstop', function(e)
        // {
        //     var sc = $('html,body').scrollTop();                        
        //     if (sc > 0 && sc < 96) $('html,body').animate({'scrollTop':0},500);            
        //     $('a#scroll-monitor').text(sc);
        // });
        
        /*
            Old version of top scrolling thing.

        var homeoraway = false;        
        $(window).scroll(function()
        {
            var sc = $('html,body').scrollTop();
            
            if (sc > 95) homeoraway = true;
            
            if (homeoraway && sc > 0 && sc < 96) 
            {
                $('html,body').animate({'scrollTop':0},500);
                homeoraway = false;
            }
            
            $('a#scroll-monitor').text(sc);
        })
        */

	});
	
})(jQuery);