var SquareGroup = Backbone.Collection.extend({

    colorCol:function(col,hue)
    {
        var list = this.where({x:col});
        _.each(list, function(square)
        {
            square.shadeOfHue(hue); 
        });
    },

    colorRow:function(row,hue)
    {
        var list = this.where({y:row});
        _.each(list, function(a)
        {
            a.shadeOfHue(hue); 
        });
    },

    colorOneTriangle:function(colour, triangle)
    {
        this.each(function(square)
        {
            square.changeTriangleColour(triangle,colour);
        });
    },

    colorScheme:function(colors)
    {
        for (var i = 0; i < 6; i++) 
        {
            var j = i;
            if (j >= colors.length) j -= colors.length; // loop if there's not enough colours.

            var col = colors[j]; // grab the right colour.

            if (col.indexOf('#') !== 0) col = '#'+col; // check it's a proper hex value.

            this.colorOneTriangle(col,i); // colour one triangle per square.
        };
    },

    changeAllAngles:function()
    {
        // console.log("changeAllAngles");        
        this.each(function(square)
        {
            square.changeAngle();
        });
    },  
});