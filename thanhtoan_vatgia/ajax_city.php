<?php
require_once("config.php");


$iCit           = getValue("iCit");

$iDistCurrent   = getValue("iDist");

$htmlReturn     = '<option value="0">Quận/Huyện</option>';

if ($iCit > 0) {
    $arrDistrict = arrDistrict($iCit);


    foreach ($arrDistrict as $iDist => $nDist) {

        $selected = ($iDist == $iDistCurrent) ? ' selected="selected"' : '';
        $htmlReturn .= '<option value="' . $iDist . '"' . $selected . '>' . $nDist . '</option>';
    }
}

echo $htmlReturn;


?>