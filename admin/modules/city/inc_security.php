<?
require_once("../../resource/security/security.php");

$module_id = 23;
//Check user login...
checkLogged();
//Check access module...
if (checkAccessModule($module_id) != 1) redirect($fs_denypath);

$fs_table = "db_city";
$id_field = "db_id";
$name_field = "db_name";
$break_page = "{---break---}";
// set avarible
$arrayTransport= array(
    1 => "Thanh toán online",
    2 => "Thanh toán trực tiếp",
);
function Menu($parentid = 0, $space = "", $trees = array())
{
    if (!$trees) {
        $trees = array();
    }
    $db_query = new db_query("SELECT * FROM db_city WHERE db_parent_id = $parentid");
    while ($row = mysql_fetch_assoc($db_query->result)) {
        $trees[] = array('db_id'        => $row['db_id'],
                         'db_name'      => $space . $row['db_name'],
                         'db_price'     => $row['db_price'],
                         'db_price_id'  => $row['db_price_id'],
        );
        $trees = Menu($row['db_id'], $space . '&nbsp;&nbsp;&nbsp;--&nbsp;&nbsp;', $trees);
    }
    return $trees;
}
?>

