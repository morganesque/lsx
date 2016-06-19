$(function()
{
    window.gOverride = {
        gColor: '#FF0000',
        pColor: '#0000FF',
        gOpacity: 0.10,
        pOpacity: 0.10,
        pHeight: 16,
        pOffset: 0,
        gWidth: 10,
        gColomns: 16,
        gEnabled: false,
        // pEnabled: false,
        pHeight: 24
    }
    // document.body.appendChild(document.createElement('script')).src='http://gridder.andreehansson.se/releases/latest/960.gridder.js';
    
    $(document).keypress(function(e)
    {
        if (e.charCode == 108)
        {   
            if ($('#g-grid').length)
            {
                $('#g-grid').toggle();
            } else {
                document.body.appendChild(document.createElement('script')).src='http://gridder.andreehansson.se/releases/latest/960.gridder.js';
            }
        }
       
    });
});
