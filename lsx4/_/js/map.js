$(function()
{
    var mapcanvas = $('div#map_canvas');
    
    var lat = mapcanvas.attr('data-lat');    
    var lon = mapcanvas.attr('data-long');
    
    var contentString = $('div#map_info').parent().html();
    
    var latlng;
    if (lat && lon) latlng = new google.maps.LatLng(lat,lon);
    else latlng = new google.maps.LatLng(53.79964,-1.54912); // if none are set.
    
    if (lat && lon) // don't bother if there's no lat long to use.
    {
        var myOptions = {
            zoom: 12,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        var map = new google.maps.Map(document.getElementById("map_canvas"),myOptions);
        
        var marker = new google.maps.Marker({
              map:map,
              draggable:false,
              animation: google.maps.Animation.DROP,
              position: latlng,
              title: 'Waahoo!!'
        });
        
        function resizeMap()
        {
            var w = mapcanvas.width();
            $('div#map_canvas').css('height',(w*0.62));
        }

        $(window).resize(resizeMap);
        resizeMap();
    }

    if (marker) // if no marker then there's no map.
    {
        var infowindow = new google.maps.InfoWindow({content: contentString});
    
        infowindow.open(map,marker);
    
        google.maps.event.addListener(marker, 'click', function()
        {
            infowindow.open(map,marker);
        });
    }
});