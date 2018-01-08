<?php
require_once("config.php");


$iCit = getValue("iCit");

$iDistCurrent = getValue("iDist");

$htmlReturn = '<option value="0">Quận/Huyện</option>';

if ($iCit > 0) {
    $arrDistrict = arrDistrict($iCit);


    foreach ($arrDistrict as $iDist => $nDist) {

        $selected = ($iDist == $iDistCurrent) ? ' selected="selected"' : '';
        $htmlReturn .= '<option value="' . $iDist . '"' . $selected . '>' . $nDist . '</option>';
    }
}

echo $htmlReturn;
function arrDistrict($iCit = 0)
{

    $arrReturn = array();

    $sqlWhere = "";
    if ($iCit > 0) $sqlWhere .= " AND cit_parent_id = " . intval($iCit);

    $db_query = new db_query("SELECT cit_id,cit_name
FROM city
WHERE cit_parent_id = " . $iCit,
        "USE_SLAVE");


    while ($row = mysql_fetch_assoc($db_query->result)) {

        $arrReturn[$row["cit_id"]] = $row["cit_name"];
    }
    $db_query->close();
    unset($db_query);

    $arr_temp = $arrReturn;

    foreach ($arr_temp as $key => $value) {
        $arr_temp[$key] = removeAccent($value);
    }
    asort($arr_temp);

    foreach ($arr_temp as $key => $value) {
        $arr_temp[$key] = $arrReturn[$key];
    }

    return $arr_temp;
}

?>