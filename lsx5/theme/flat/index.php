<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <link rel="stylesheet" href="css/main.css">
        <!-- <script src="js/vendor/modernizr-2.6.2.min.js"></script>-->
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <div class="container">
            <div class="row header">
                <div class="small-4 columns">
                    <div class="box">
                        <h1 class="logo">LSx</h1>
                    </div>
                </div>
                <div class="small-8 columns">
                    <nav class="nav-top">
                    <ul class="sub-nav right">
                        <li><a href="#">about</a></li>
                        <li><a href="#">events</a></li>
                        <li><a href="#">talks</a></li>
                        <li><a href="#">people</a></li>
                        <li><a href="#">places</a></li>
                        <li><a href="#">contact</a></li>
                    </ul>
                    </nav>
                </div>
            </div>
        </div>

        <div class="container hero" id="hero">
            <svg></svg>
        </div>

        <script src="js/all.min.js"></script>
        <script type="text/javascript">
        $(document).on('ready',function()
        {
            var cols = [];
            var hue = Math.random()*360;

            var c = pusher.color('orange');

            for (var i = 0; i < 6; i++)
            {
                var c = pusher.color('hsl',hue,100,50);
                var t = 0.15*i;
                cols.push(c.tint(t).hex6());
            };

            var width   = 16;
            var height  = 5;
            var artbox  = $('#hero');
            var ratio   = 100*(height/width);

            artbox.css({
                height:0,
                paddingTop:ratio+"%",
            });

            var art = new ArtWork({
                cols:width,
                rows:height,
                butcher:'slice',
                el:artbox.find('svg'),
            })

            // art.squares.colorScheme(["D9EBCC", "BCDEA2", "8BCF86", "5BB579", "4A3F39"]);
            art.squares.colorScheme(cols);
        });
        </script>

        <?php /*<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <!-- <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X');ga('send','pageview');
        </script>-->*/?>
    <script src="http://localhost:35729/livereload.js"></script>
    <script type="text/javascript">
    $(window).on('load',function()
    {
        $('head').append("<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,900,700,700italic,400italic' rel='stylesheet' type='text/css'>");
    });
    </script>
    </body>
</html>
