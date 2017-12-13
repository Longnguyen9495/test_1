<?php
    require_once ("../../resource/security/security.php");

    $modul_id = 23;
    // check user login
    checklogged();
    // Check acccess module
    if (checkAccessModule($modul_id) != 1) redirect($fs_denypath);

    $fs_table                   = "category";
    $id_field                   = "category_id";
    $name_field                 = "category_name";
    $fs_filedupload             = "category_picture";
    $fs_filepparh               = "../../../date/banner";
    $fs_extension			    = "gif,jpg,jpe,jpeg,png,swf";
    $fs_filesize			    = 600;
    $width_small_image	        = 200;
    $height_small_image	        = 300;
    $width_normal_image	        = 300;
    $height_normal_image	    = 300;
    $fs_insert_logo		        = 0;
    $break_page	= "{---break---}";
    //Array variable
    $arrTarger                  = array(
                                "blank" => "Trang mới",
                                "_self" => "Hiện hành"
    );
    $arrayType                  = array(
                                1 => "Tên sản phẩm",
                                2 => "Hình ảnh",
                                3 => "Chi tiết sản phẩm"
    );
    $arrPositon				    = array(
                                1 => "Banner top",
                                2 => "Banner category left",
                                3 => "Banner right",
                                4 => "Banner bottom",
                                5 => "Banner category center",
                                6 => "Banner home product",
                                7 => "Banner Tin tức - R1",
                                8 => "Banner Tin tức - R2",
                                9 => "Banner mobile Top"
    );
    ?>
