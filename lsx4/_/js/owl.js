$(function()
{
    var IMG_SRC = '/wp-content/themes/lsx4/_/images/owl/owl-fly.png';
    
    if (!Modernizr.canvas) 
    {
        log('no canvas');
        return;
    }
    
    var canvas, context, i, angle = 0, timer;
    
    $('header').prepend('<canvas id="canvas" style="position:absolute; top:0px; left:0px; z-index:-1; opacity:0.21"/>');

    canvas = $("#canvas")[0];
    
    context = canvas.getContext("2d");
    
    // resize the canvas appropriately.
    onResize()
	
    // $(canvas).hide();
	
	var stage = new Stage(canvas);
    stage.enableMouseOver();
    
    var owl = {};
    owl.x = 20 + canvas.width/2;
    owl.y = -35 + canvas.height/2;
    // owl.y = 80 + canvas.height/2;
    owl.speed = 0;
    owl.vx = owl.speed;
    owl.vy = owl.speed;
    owl.ax = 0;
    owl.ay = 0;
    owl.angle = 0;
    owl.anchor = {x:63.5, y:72}; //{x:127/2, y:144/2};
    owl.dist = 0;
    owl.damp = 10;
    owl.status = 'loading';
    owl.loaded = false;
    owl.targetangle = 0;
    owl.onClick = function()
    {
        owl.status = 'stopping';
        target.x = canvas.width/2;
        target.y = -60 + canvas.height/2;
    };            
    
    var img = new Image();
    img.onload = function()
    {        
        // log('loaded')
        
        owl.loaded = true;
        owl.status = 'waiting';
        owl.img = new Bitmap(img);
        stage.addChild(owl.img);                
              
        owl.img.onClick = owl.onClick;
        owl.img.regX = owl.anchor.x;
        owl.img.regY = owl.anchor.y;
        owl.img.mouseEnabled = true;
        owl.img.onMouseOver = function(){$(canvas).css({cursor:'pointer'});};
        owl.img.onMouseOut = function(){$(canvas).css({cursor:'auto'});};
        owl.img.x = owl.x
        owl.img.y = owl.y
        owl.img.rotation = 180;
        
        stage.update();          
    };     
    img.src = IMG_SRC;        	

    var target = {};
    target.x = canvas.width/2;
    target.y = -60 + canvas.height/2;
    target.angle = 0;
    target.dist = 200;
    target.shape = new Shape();
    target.shape.graphics.beginFill('#000000');
    target.shape.graphics.drawCircle(0,0,5);
    target.shape.x = target.x;
    target.shape.y = target.y;
    target.shape.alpha = 1;
    //stage.addChild(target.shape); 
    stage.update(); 

    var o = {
        dx:0,
        dy:0,
        tick:function()
        {                        
            if (!owl.loaded) return;
            if (owl.status == 'waiting') return;

            dx = (target.x - owl.x);
            dy = (target.y - owl.y);

            owl.ax = dx/200;
            owl.ay = dy/200;

            owl.vx += owl.ax;
            owl.vy += owl.ay;

            owl.vy *= 0.96;
            owl.vx *= 0.96;

            owl.x += owl.vx;
            owl.y += owl.vy;

            owl.dist = Math.sqrt((dx*dx)+(dy*dy));
            
            if (owl.dist > 5)
            {
                owl.targetangle = Math.atan2(dx,dy);
                // owl.damp = 10; 
            } else {
                if (owl.status == 'leaving')
                {
                    // $(canvas).hide(); 
                    // owl.status = 'waiting';
                }
                owl.targetangle = 2 * Math.PI;
                // owl.damp = 10;
            }

            if (owl.targetangle > owl.angle) owl.targetangle -= 2 * Math.PI;

            var da = owl.angle - owl.targetangle;

            // trying to make the angle the shortest one.
            if (da >= Math.PI) da -= 2 * Math.PI;
            if (da < -Math.PI) da += 2 * Math.PI;

            owl.angle -= da/owl.damp;

            if (owl.angle < 0) owl.angle += 2*Math.PI;
            if (owl.angle > 2*Math.PI) owl.angle -= 2*Math.PI;
            
            owl.img.x = owl.x;
            owl.img.y = owl.y;
            owl.img.rotation = 180 + 180 * owl.angle/Math.PI;
            
            stage.update();
        }
    };
    
    Ticker.setInterval(50);  // 1000 / 50 ms = 20 fps (You could also call Ticker.setFPS(20))
    Ticker.addListener(o); 
	 
	var changeTarget = function()
    {                
        console.log('changing');
        
        if (owl.status != 'playing') return;

        target.x = canvas.width/2 + (Math.sin(target.angle) * target.dist*4);
        target.y = canvas.height/2 + (Math.cos(target.angle) * target.dist);

        target.angle += 137.5 * Math.PI/180; /* Math.PI/180 = 1 degree */
                     
        // update the visible position of the target (DEBUGGING)   
        target.shape.x = target.x;
        target.shape.y = target.y;
        stage.update();

        /*
        target.x = Math.random()*canvas.width;
        target.y = Math.random()*canvas.height;
        */

        var t = this;
        setTimeout(changeTarget, 1000 + Math.random()*3000);
    };
    
    function resetTimer()
    {            
        console.log('resetTimer');
        // log('resetTimer');
            
        if (timer) clearTimeout(timer);
        timer = setTimeout(function()
        {
            owl.status = 'playing';
            // owl.x = -200;
            
			$(canvas).attr("width", $('header').width());
			$(canvas).attr("height", $('header').height());
			
			target.dist = canvas.height/4;
			
            // $(canvas).show();
            changeTarget();

        },3*1000);
    }
    
    $('.lsx-logo').click(function()
    {        
        if (owl.status == 'waiting')
        {
            owl.status = 'playing';        
            onResize()		
    		target.dist = canvas.height/4;
            changeTarget();

            // var e = jQuery.Event("mouseleave");
            // jQuery("div#top-bar").trigger( e );
                        
        } else {
            
            target.x = 20 + canvas.width/2;
            target.y = -35 + canvas.height/2;
            owl.status = 'leaving';
        }
        
        console.log(owl.status);
    }).data('fly',true);
    
    // $(document).mousemove(onMouseMove);
    $(window).resize(onResize);
    
    function onResize()
    {
        /* 
        take the window.width from the header.width (to leave a negative) 
        then divide by two to get how far left your should push the canvas
        */
        var offsetX = ( $('header').width() - $(window).width() ) /2;    
        $(canvas).attr("width", $(window).width());
    	$(canvas).attr("height", $('header').height()+12);
    	$(canvas).css("left",offsetX);
    	
    	if (owl)
    	if (owl.status == 'waiting')
    	{
    	    owl.x = 20 + canvas.width/2;
            owl.y = -35 + canvas.height/2;
            
            // owl.x = canvas.width/2;
            // owl.y = -40 + canvas.height/2;
            
            owl.img.x = owl.x
            owl.img.y = owl.y
    	}
    	
    	if (stage) stage.update();
    }
    
    function onMouseMove()
    {
        console.log(owl.status);
        
        if (owl.status == 'playing')
        {         
            owl.status = 'leaving';
            
            if (owl.x > canvas.width/2) target.x = canvas.width + 200;
            else target.x = -200;            
            target.y = owl.y-50;
            
            // $(document).unbind('mousemove');    
            
            resetTimer();   
        } else {
            resetTimer();
        }
    }
});