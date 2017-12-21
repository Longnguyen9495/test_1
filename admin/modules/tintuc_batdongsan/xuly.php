<?
require_once("inc_security.php");
$db_name = getValue("db_name", "str", "POST", "", 1);
$query = new db_query("SELECT db_name FROM batdongsan WHERE db_name ='" . $db_name . "' ");
if ($row = mysql_fetch_assoc($query->result)){
    echo $row['db_name'];
}
$query->close();
unset($query);
?>