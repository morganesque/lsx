var TimeLoop = Backbone.Model.extend(
{
    defaults:{
        delay:100,
        loop:false,
        length:0,
        animator:undefined,
        args:[],
    },
    initialize:function(options)
    {
        $.extend(this.defaults,options);
        // console.log(this.defaults);        

        this.delay       = this.defaults.delay;
        this.loop       = this.defaults.loop;
        this.length        = this.defaults.length;
        this.animator   = this.defaults.animator;
        this.args       = this.defaults.args;

        if (this.length == 0) alert("TimeLoop.js - must pass a length");
    },
    c:0,
    l:0,
    do:function()
    {     
        var repeater = function()
        {
            // call the animator function (with the index & args).
            this.animator.call(this,this.c,this.args);
            this.c++;
            this.do();
        };

        // console.log([this.loop,this.c,this.length]);        

        if (this.loop == false && this.c == this.length) 
        {     
            this.trigger('done'); // reached the end.

        } else if (this.loop == true && this.c == this.length) {

            this.trigger('loop');
            this.c = 0; // start again.
            this.timer = setTimeout(repeater.bind(this),this.delay);

        } else {

            // carry on.
            this.timer = setTimeout(repeater.bind(this),this.delay);                    
        }
        
    },
});