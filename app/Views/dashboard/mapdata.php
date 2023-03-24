<?php
//print_r($mou);
helper('color');
$mc=array();
$province_code=array();
foreach($mou as $m){
  $mc[$m->p]=$m->c;
  $province_code[$m->p]=$m->province_code;
}
$max_mou=max($mc);


$province_str='';
foreach($provinces as $p){
    if(!empty($province_str))$province_str.=",\n";
    $province_str.=$p->mapcode.': {
        color: "'.mapPercentageToGreen($mc[$p->mapcode]/$max_mou*100).'",
        name: "'.$p->province_name.'",
        description: "มี MOU '.$mc[$p->mapcode].' ฉบับ",
        url: "'.site_url('public/dashboard/mou/?province='.$province_code[$p->mapcode]).'"
      }';
}

print 'var simplemaps_countrymap_mapdata={
    main_settings: {
     //General settings
      width: "700", //\'700\' or \'responsive\'
      background_color: "#FFFFFF",
      background_transparent: "yes",
      border_color: "#000000",
      
      //State defaults
      state_description: "รายละเอียด",
      state_color: "#88A4BC",
      state_hover_color: "#3B729F",
      state_url: "",
      border_size: 1.5,
      all_states_inactive: "no",
      all_states_zoomable: "yes",
      
      //Location defaults
      location_description: "รายละเอียด",
      location_url: "",
      location_color: "#0000ff",
      location_opacity: 0.8,
      location_hover_opacity: 1,
      location_size: 10,
      location_type: "square",
      location_image_source: "'.site_url('images/mou.png').'",
      location_border_color: "#FFFFFF",
      location_border: 2,
      location_hover_border: 2.5,
      all_locations_inactive: "no",
      all_locations_hidden: "no",
      
      //Label defaults
      label_color: "#d5ddec",
      label_hover_color: "#d5ddec",
      label_size: 22,
      label_font: "Arial",
      hide_labels: "no",
      hide_eastern_labels: "no",
     
      //Zoom settings
      zoom: "yes",
      manual_zoom: "yes",
      back_image: "no",
      initial_back: "no",
      initial_zoom: "-1",
      initial_zoom_solo: "no",
      region_opacity: 1,
      region_hover_opacity: 0.6,
      zoom_out_incrementally: "yes",
      zoom_percentage: 0.99,
      zoom_time: 0.5,
      
      //Popup settings
      popup_color: "white",
      popup_opacity: 0.9,
      popup_shadow: 1,
      popup_corners: 5,
      popup_font: "12px/1.5 Verdana, Arial, Helvetica, sans-serif",
      popup_nocss: "no",
      
      //Advanced settings
      div: "map",
      auto_load: "yes",
      url_new_tab: "no",
      images_directory: "default",
      fade_time: 0.1,
      link_text: "View Website",
      popups: "detect",
      state_image_url: "",
      state_image_position: "",
      location_image_url: ""
    },
    state_specific: {
      THA374: {
        color: "#990000",
        name: "แม่ฮ่องสอน",
        hover_color: "#000099",
        description: "MOU 51 ฉบับ",
        url: "http://google.com",
        image_url: "http://localhost/ocs/images/mou.png",
      },
      '.$province_str.'
    },
    locations: {
      "0": {
        lat: "13.753979",
        lng: "100.501444",
        name: "กรุงเทพ"
      }
    },
    labels: {},
    legend: {
      entries: []
    },
    regions: {},
    data: {
      data: {
        THA374: "5",
        THA375: "5",
        THA377: "5",
        THA379: "7",
        THA376: "7",
        THA382: "15"
      }
    }
  };
  ';
  ?>
