<?php
function resize($image_name,$new_width,$new_height,$new_thumb_loc,$outputExt=false)
{
    $path = $image_name;

    $mime = getimagesize($path);

    if($mime['mime']=='image/png') { 
        $src_img = imagecreatefrompng($path);
    }else if($mime['mime']=='image/jpg' || $mime['mime']=='image/jpeg' || $mime['mime']=='image/pjpeg') {
        $src_img = imagecreatefromjpeg($path);
    }else{
        return 'noimg';
    }   

    $old_x          =   imageSX($src_img);
    $old_y          =   imageSY($src_img);

    $dif_x          =   $old_x/$new_height;
    $dif_y          =   $old_y/$new_width;

    if($dif_x > $dif_y) 
    {
        $thumb_w    =   $old_x/$dif_x;
        $thumb_h    =   $old_y/$dif_x;
    }

    if($dif_x < $dif_y) 
    {
        $thumb_w    =   $old_x/$dif_y;
        $thumb_h    =   $old_y/$dif_y;
    }

    if($dif_x == $dif_y) 
    {
        $thumb_w    =   $old_x/$dif_x;
        $thumb_h    =   $old_y/$dif_y;
    }

    $dst_img        =   ImageCreateTrueColor($thumb_w,$thumb_h);

    imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y); 


    if($mime['mime']=='image/png'&&!$outputExt||$outputExt=='png') {
        $result = imagepng($dst_img,$new_thumb_loc,8);
    }
    if($mime['mime']=='image/jpg' || $mime['mime']=='image/jpeg' || $mime['mime']=='image/pjpeg'||$outputExt=='jpg') {
        $result = imagejpeg($dst_img,$new_thumb_loc,80);
    }

    imagedestroy($dst_img); 
    imagedestroy($src_img);

    return $result;
}