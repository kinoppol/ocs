<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>Country Map Example</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="<?php print site_url();?>map/mapdata.js"></script>
    <script src="<?php print site_url();?>map/countrymap.js"></script>
  </head>
  <body>
    <div id="map"></div>
    <style type="text/css">
.legend{color: black; width: 100%px; font-family: arial; font-size: 14px;}    
.legend_color {display: table; width: 100%; background: white; list-style: none; margin: 0px; padding: 0px; }
.legend_color li{width: 20%;  height: 20px; display: table-cell;}
.legend_label {display: table; width: 100%;  padding: 0px; padding-left: 10%; padding-right: 10%; list-style: none; margin: 0px; box-sizing: border-box;}
.legend_label li{width: 25%;  height: 20px; display: table-cell; text-align: center;}

</style>    
<script>

  $(function(){
    function hide_wm(){
    $('a').text('');
    $('a').attr('href', '#');
   };
   window.setTimeout( hide_wm, 20 );

   setInterval( hide_wm,50);

  });
  </script>
	</body>
</html>
      
    

