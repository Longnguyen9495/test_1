<?php
require_once("functions/mobile_device_detect.php");

$mobile  = mobile_device_detect(true,true,true,true,true,true,false,false,$device);
header( "HTTP/1.1 301 Moved Permanently" );
header( "Location: /home/");
// if($mobile == true) {
// 	header( "HTTP/1.1 301 Moved Permanently" );
//    header( "Location: http://m.cucre.vn/" );
// }else{
//    header( "HTTP/1.1 301 Moved Permanently" );
//    header( "Location: /home/");
// }
?>