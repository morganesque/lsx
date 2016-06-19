var Palettes = Backbone.Model.extend({

    palettes: [2732639, 1980110, 129859, 2941952, 2357510, 1806294, 518489, 1951376, 1824733, 406859, 334281, 2205225, 1204835, 2500034, 1365536, 961725, 2987670, 2070748],

    getPaletteByNum:function(num)
    {
        this.getPaletteByID(this.palettes[num]);
    },

    getPaletteByID:function(id)
    {
        $.ajax({
            dataType: "jsonp",
            crossDomain: true,
            data: {
                format:'json',
            },
            url: "http://www.colourlovers.com/api/palette/"+id,
            jsonp: "jsonCallback",
            jsonpCallback: "palettes.gotColourScheme",
        });
    },                

    getNewPalette:function()
    {
        $.ajax({
            dataType: "jsonp",
            crossDomain: true,
            data: {
                format:'json',
            },
            url: "http://www.colourlovers.com/api/palettes/random",
            jsonp: "jsonCallback",
            jsonpCallback: "palettes.gotColourScheme"
        });
    },

    gotColourScheme:function(json)
    {
        this.current = json[0];
        console.log(this.current.colors);        
        this.trigger('palette');        
    },
});