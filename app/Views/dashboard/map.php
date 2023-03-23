<?php

helper('color');
$mc=array();
$sum_mou=0;
foreach($mou as $m){
  $mc[$m->p]=$m->c;
  $sum_mou+=$m->c;
}
$max_mou=max($mc);
$qt=round($max_mou/4);
$half=round($max_mou/2);
$halfqt=$half+$qt;

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>Country Map Example</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="<?php print site_url('public/dashboard/mapdata');?>"></script>
    <script src="<?php print site_url();?>map/countrymap.js?d=<?php print date('Y-m-d'); ?>"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
<style>
				body{
					font-family: 'Kanit', sans-serif;
				}
				.row {
				display: flex;
				justify-content: space-between;
				}
				.row div { padding: 1em; }
			</style>
  </head>
  <body>
    <div id="map"></div>
    <mark style="background-color:#ffffff;">MOU 0 ฉบับ</mark>
    <mark style="background-color:<?php print mapPercentageToGreen($qt/$max_mou*100); ?>;">MOU <?php print $qt; ?> ฉบับ</mark>
    <mark style="background-color:<?php print mapPercentageToGreen($half/$max_mou*100); ?>;">MOU <?php print $half; ?> ฉบับ</mark>
    <mark style="background-color:<?php print mapPercentageToGreen($halfqt/$max_mou*100); ?>;">MOU <?php print $halfqt; ?> ฉบับ</mark>
    <mark style="background-color:<?php print mapPercentageToGreen(100); ?>">MOU <?php print $max_mou; ?> ฉบับ</mark>
    <br>
    <!-- มีการลงนาม MOU ที่ยังมีผลอยู่ทั้งสิ้น <?php print $sum_mou ?> ฉบับ -->
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
      
    

