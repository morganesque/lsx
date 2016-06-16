var Logo = function(s,cols,rows)
{
    var x,y,colour = "#000";

    logo = s.g();

    x = (Math.floor(cols/2)*100)-250;
    y = (Math.floor(rows/2)*100)+50;        

    var eB = s.polyline([
            x,y,
            (x+250),(y+250),
            (x+500),(y),
            (x+250),(y-250),
            ]);
    eB.attr("fill","#FFF");
    eB.attr("opacity",0.75);
    logo.add(eB);

    x = (Math.floor(cols/2)*100)-200;
    y = Math.floor(rows/2)*100;        

    var eL = s.polyline([
            x,y,
            (x+50),y,
            (x+50),(y+50),
            (x+100),(y+50),
            (x+100),(y+100),
            (x),(y+100),
            ]);
    eL.attr("fill",colour);
    logo.add(eL);

    x = (Math.floor(cols/2)*100);
    y = (Math.floor(rows/2)*100)-100;

    var eS = s.polyline([
            x,y,
            (x-100),(y+100),
            (x),(y+200),
            (x-50),(y+250),
            (x),(y+300),
            (x+100),(y+200),
            (x),(y+100),
            (x+50),(y+50),
            ]);
    eS.attr("fill",colour);
    logo.add(eS);

    x = -1 + (Math.floor(cols/2)*100)+100;
    y = -1 + Math.floor(rows/2)*100;

    var eXa = s.polyline([
            x,y,
            (x+102),(y+102),
            ]);
    eXa.attr("stroke",colour);
    eXa.attr("stroke-width",'3');
    logo.add(eXa);

    var eXb = s.polyline([
            x+100,y,
            (x),(y+100),
            ]);
    eXb.attr("stroke",colour);
    eXb.attr("stroke-width",'3');
    logo.add(eXb);

    logo.attr({"opacity":0});

    return logo;
};

