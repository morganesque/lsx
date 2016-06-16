var LSxApp = Backbone.View.extend(
{
    scheme:undefined,

    initialize: function(options)
    {
        this.snap = options.artwork.snap;
        this.cols = options.artwork.cols;
        this.rows = options.artwork.rows;
        this.squares = options.artwork.squares;
        this.palettes = options.palettes;

        $('#save').hide();
        $('#skip').hide();
        $('#full').hide();

        this.chosen = [];
    },

    addLogo:function()
    {
        this.logo = Logo(this.snap,this.cols,this.rows);
        this.logo.animate({opacity:1},10000);
    },

    gotColourScheme:function(json)
    {
        if (json.id) this.scheme = json;
        else this.scheme = json[0];

        this.scheme.colors.push("FFFFFF");
        this.squares.colorScheme(scheme.colors);
        this.squares.changeAllAngles();
    },

    render: function()
    {

    },

    events:{
        "click #save": "onSaveClick",
        "click #skip": "onSkipClick",
        "click #full": "onFullClick",
    },

    onSaveClick:function(e)
    {
        e.preventDefault();
        this.chosen.push(this.scheme.id);
        this.console.log(chosen);
    },

    onSkipClick:function(e)
    {
        e.preventDefault();
        this.palettes.getNewPalette();
    },

    onFullClick:function(e)
    {
        e.preventDefault();
        if ($("body").hasClass('full'))
        {
            $("body").removeClass('full');
            this.snap.attr('preserveAspectRatio',"xMidYMid meet");
            $('#full').text('full');
        } else {
            $("body").addClass('full');
            this.snap.attr('preserveAspectRatio',"xMidYMid slice");
            $('#full').text('X');
        }
    },
});
