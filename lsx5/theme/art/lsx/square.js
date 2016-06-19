var SquareModel = Backbone.Model.extend(
{    
    mid:50,
    mod:50,

    initialize:function(options)
    {        
        var s = this.get('snap'),
            group = s.g(),
            tris = [];

        tris[0] = s.polyline([0,0,this.mid,this.mod,0,100]);        // west
        tris[1] = s.polyline([0,0,this.mid,this.mod,this.mid,0]);        // north 1
        tris[2] = s.polyline([100,0,this.mid,this.mod,this.mid,0]);      // north 2
        tris[3] = s.polyline([100,100,this.mid,this.mod,0,100]);    // south
        tris[4] = s.polyline([100,100,this.mid,this.mod,100,this.mod]);  // east 1
        tris[5] = s.polyline([100,0,this.mid,this.mod,100,this.mod]);    // east 2  

        group.add(tris[0]);
        group.add(tris[1]);
        group.add(tris[2]);
        group.add(tris[3]);
        group.add(tris[4]);
        group.add(tris[5]);

        this.group = group;

        var tx = this.get('x') * 100;
        var ty = this.get('y') * 100;    

        this.matrix = new Snap.Matrix();
        this.matrix.translate(tx,ty);        
        group.transform(this.matrix);

        this.assignRandomAngle();
    },

    assignRandomAngle:function()
    {            
        var deg = [0,90,180,270];
        
        var r = deg[Math.floor(Math.random()*deg.length)];
        this.matrix.rotate(r,50,50);

        this.group.transform(this.matrix);
    },

    changeAngle:function()
    {    
        var r = this.getRandomAngle();
        this.matrix.rotate(r,50,50);

        // this.group.animate({transform:m},100);
        this.group.transform(this.matrix);
    },

    changeTriangleColour:function(n,col)
    {      
        this.group[n].animate({"fill":col},1000);
    },

    shadeOfHue:function(hue)
    {
        // console.log("shadeOfHue");        
        for (var i = 0; i < 6; i++) 
        {
            var h = hue,
                b = 1 - (0.06*i),
                s = 0.62;
            this.changeTriangleColour(i,Snap.hsb(h,s,b));
        }
    },            

    hide:function()
    {
        _.each(this.group,function(a,b,c)
        {
            a.attr("opacity",0);        
        });
    },
});