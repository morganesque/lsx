// remap jQuery to $
(function($){})(window.jQuery);

/* trigger when page is ready */
$(document).ready(function (){

    // $('.lsx-logo span').hide().delay(1000).show('drop');

    isHome = $('body').hasClass('home'); 
    // positions for where the tab should sit in different states.
    aboutTabOpen = '48px';
    aboutTabClose = '12px';
    // grab about tab.
    var aboutTab = $('.m-about-tab a');
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
        console.log('click');              
                  
        e.preventDefault();
        var link = $(this);
        
        if ($(this).hasClass('a-up'))
        {
            console.log('has a-up');
            aboutTab.removeClass('a-up').addClass('a-down');
            
            link.delay(1500)                    
                .animate({left:aboutTabOpen},500,'easeOutQuint');
                // .animate({top:'-1px'},500,'easeOutQuint');
                
            $('.m-about').hide('blind',{easing:'easeOutQuint'},1500);                    
            setTimeout(function()
            {
                if (isHome) $.cookie('about-closed', 'true');
                link.text(tabText);
            },1500);
        }
        else if ($(this).hasClass('a-down'))
        {
            console.log('has a-down');
            aboutTab.removeClass('a-down').addClass('a-up');
             
            link
                .attr('href','#up')                 
                .delay(1000)
                .animate({left:aboutTabClose},500,'easeOutQuint');
                // .animate({top:'-25px'},500,'easeOutQuint');                    
                
             $('.m-about').show('blind',{easing:'easeInOutQuint'},1000,function()
             {
                 link.text('hide');
             });
        }
    });
    
    var menu = $('nav');
    var menu_pos = menu.offset();
    var home_nav = $(menu.find('a')[0]);
    
    $(window).scroll(function()
    {        
		if($(this).scrollTop() > menu_pos.top + menu.height() && !menu.hasClass('fixed'))
		{
		    console.log('down');
			menu.fadeOut('fast', function()
			{
				$(this).addClass('fixed').fadeIn('slow');
				home_nav.text('LSx');
			});
			
		} else if ($(this).scrollTop() <= menu_pos.top && menu.hasClass('fixed')) {
			
			console.log('up');
			
			menu.removeClass('fixed');
			home_nav.text('home');
			
            // menu.fadeOut('fast', function()
            // {
            //  $(this).removeClass('fixed').fadeIn('fast');
            // });
		}
	});

});


/* optional triggers

$(window).load(function() {
	
});

$(window).resize(function() {
	
});

*/