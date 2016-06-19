var ArtWork = Backbone.View.extend(
{       
    cols:14,
    rows:13,    
    butcher:"meet",       

    initialize: function(options) 
    {                
        // console.log(this.el);        

        if (options.cols) this.cols = options.cols;
        if (options.rows) this.rows = options.rows;
        if (options.butcher) this.butcher = options.butcher;

        this.snap = Snap(this.el);
        this.snap.attr('width',"100%");        
        this.snap.attr('viewBox',"0,0,"+(this.cols*100)+","+(this.rows*100));
        this.snap.attr('preserveAspectRatio',"xMidYMid "+this.butcher); 

        this.squares = new SquareGroup();

        this.addSquares();
    },          

    addSquares:function()
    {
        // create all the squares.
        for (var i = 0; i < this.cols; i++) 
        {
            for (var j = 0; j < this.rows; j++) 
            {    
                var square = new SquareModel({
                    snap:this.snap,
                    x:i,
                    y:j
                });
                // console.log(square.tris[0].attr({'fill':'#F00'}));
                this.squares.add(square);
            };
        };  
    },   
});