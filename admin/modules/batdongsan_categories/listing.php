<?
require_once("inc_security.php");

// thiết lập thành phần gán giá trị

$sqlWhere = '';
$search_id = getValue("search_id", "int", "GET", 0);
$search_keyword = getValue("search_keyword", "str", "GET", "", 1);
//$search_type = getValue("search_type","str","GET",1);
// Search theo ID
if ($search_id > 0) $sqlWhere .= " AND db_id = " . $search_id;

// Search từ khóa

if ($search_keyword != "") {
    $sqlWhere .= " AND db_name LIKE '%" . $search_keyword . "%'";
}

//// search theo type
//if ($search_type != ""){
//    $sqlWhere .= " AND db_type LIKE '%" . $search_type . "%'";
//}


// Search theo date
$str_create_date  = getValue("date_pha", "str", "GET", "dd/mm/yyyy", 1);
var_dump($str_create_date);
$create_date     = convertDateTime($str_create_date, "00:00:00");
var_dump($create_date);
if($create_date > 0 && $str_create_date != "" && $str_create_date != "dd/mm/yyyy"){
    $sqlWhere   .=  " AND db_date >= " . $create_date;
}
echo $sqlWhere;



// Phân trang
$page_size			= 5;
$page_prefix		= "Trang: ";
$normal_class		= "page";
$selected_class	= "page_current";
$previous			= '<img align="absmiddle" border="0" src="../../resource/images/grid/prev.gif">';
$next          	= '<img align="absmiddle" border="0" src="../../resource/images/grid/next.gif">';
$first				= '<img align="absmiddle" border="0" src="../../resource/images/grid/first.gif">';
$last          	= '<img align="absmiddle" border="0" src="../../resource/images/grid/last.gif">';
$break_type			= 1;
$url					= getURL(0,0,1,1,"page");
$total_quantity	= 0; // tổng sô lượng
$db_count			= new db_query("  SELECT count(*) AS count
												FROM " . $fs_table . "
												WHERE 1 " . $sqlWhere,
    __FILE__, "USE_SLAVE");


$listing_count		= mysql_fetch_array($db_count->result);
var_dump($listing_count);
$total_record		= $listing_count["count"];
$current_page		= getValue("page", "int", "GET", 1);
var_dump($total_record);
if($total_record % $page_size == 0) $num_of_page = $total_record / $page_size;
else $num_of_page = (int)($total_record / $page_size) + 1;
if($current_page > $num_of_page) $current_page = $num_of_page;
if($current_page < 1) $current_page = 1;
var_dump($num_of_page);
unset($db_count);
//End phân trang

$db_listing	= new db_query("	SELECT *
										FROM " . $fs_table ."
										WHERE 1 " . $sqlWhere ."
										LIMIT " . ($current_page-1) * $page_size . "," . $page_size,
    __FILE__, "USE_SLAVE");
?>
<html>
<head>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
    <script>
        function check_active_ajax()
        {

        }
    </script>
    <style>
        body {
            font-family: Arial, Tahoma, Geneva, sans-serif;
            font-size: 11px;
        }

        .form-control-search {
            font-family: arial;
            font-size: 12px;
            height: 23px;
            padding: 2px 5px;
            display: inline-block;
            width: auto;
        }

        form {
            margin-bottom: 0;
        }

        .btn-search {
            font-size: 12px;
            padding: 2px 8px;
        }

        body .search {
            background: #F7F7F9;
            padding: 5px;
            box-shadow: 0px 1px 2px #999999;
            border: 1px #DDDDDD solid;
        }

        table td {
            font-size: 11px;
            text-align: center;
        }

        table th {
            padding: 3px;
            background-image: linear-gradient(to bottom, #FFFFFF, #E6E6E6);
            border-bottom: 1px solid #BBBBBB;
            border-left: none;
            font-size: 12px;
            font-weight: bold;
            text-align: center;
        }

        img {
            vertical-align: middle;
        }
        .search .form-control{
            margin: 0 5px;
        }
    </style>
</head>
<body>
<div class="search">
    <form action="" method="get">
        <table>
            <tbody>
            <tr>
                <td class="form-label-sm">Name :</td>
                <td><input type="text" class="form-control form-control-search form-control-sm" placeholder="Name..."
                           name="search_keyword" id="search_keyword" value="<?= $search_keyword ?>"></td>
                <td class="form-label-sm">ID :</td>
                <td><input type="text" class="form-control form-control-search form-control-sm" placeholder="Link..."
                           name="search_id" value="<?= $search_id ?>"></td>
                <td class="form-label-sm">Type :</td>
                <td>
                    <select class="form-control form-control-search form-control-sm" id="sel1" style="height: 25px">
                        <option value="">Chọn Lĩnh vực</option>
                        <?php foreach ($arrType as $key => $value) { ?>
                            <option><? echo $value ?></option>
                        <? } ?>
                    </select>
                </td>
                <td class="form-label-sm">Date :</td>
                <td>
                    <input type="date" class="form-control form-control-search form-control-sm date" placeholder="Date..." name="date_pha" value="<?=$str_create_date?>"</td>
                <td>
                    <button class="btn btn-info btn-search">Tìm Kiếm</button>
                </td>
            </tr>
            </tbody>
        </table>
    </form>
</div>
<table class="table table-condensed table-hover table-bordered">
    <legend>Danh Sách Bất Động Sản</legend>

    <thead>
    <tr>
        <th>STT</th>
        <th width="100px">Tên bất động sản</th>
        <th>Hình ảnh</th>
        <th>Link</th>
        <th>Mô tả chi tiết</th>
        <th>Active</th>
        <th>Hình thức</th>
        <th>Thời gian</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    <?
    $No	= ($current_page - 1) * $page_size;
    while ($row = mysql_fetch_assoc($db_listing->result)) {
        ?>
        <tr>
            <td><?=$row['db_id']?></td>
            <td><?= $row['db_name'] ?></td>
            <td align="center">
                <a href="" border="0" target="_blank">
                    <img src="<?= $fs_filepath . $row['db_image'] ?>" width="100" height="20" style="max-width: 100%"/>
                </a>
            </td>
            <td><?= $row['db_link'] ?></td>
            <td><?= $row['db_description'] ?></td>
            <td>
                <a onclick="update_check_ajax('<?= $value["db_active"] ?>', <?= $row['db_id'] ?>);"
                   id="<?= $value["db_active"] ?>_<?= $row['db_id'] ?>">
                    <? if ($row['db_id'] == 1) {
                        echo '<img border="0" src=" ../../resource/images/grid/check_1.gif" />';
                    } else {
                        echo '<img border="0" src=" ../../resource/images/grid/check_0.gif" />';
                    } ?>
                </a>
            </td>
            <td><?= $arrType[$row['db_type']] ?></td>
            <td><?= date("d/m/Y", $row['db_date']) ?></td>
            <td>
                <a style="font-size: 14px;"
                   href="edit.php?record_id=<?= $row['db_id'] ?>&url=<?= base64_encode($_SERVER['REQUEST_URI']) ?>"><img
                            src="../../resource/images/grid/edit.png" border="0"></a>
            </td>
            <td>
                <a style="font-size: 14px;"
                   href="delete.php?record_id=<?= $row['db_id'] ?>&url=<?= base64_encode($_SERVER['REQUEST_URI']) ?>"><img
                            src="../../resource/images/grid/delete.gif" border="0"></a>
            </td>
        </tr>
    <? } ?>

    </tbody>
</table>
<table width="100%" class="page_break">
    <tr>
        <td style="color: #15428B; font-weight: bold;text-align: left">Tổng số bản ghi: <span style="color: #333333;"><?=$total_record?></span></td>
        <td width="150"></td>
        <td></td>
        <? if($total_record > $page_size){ ?>
            <td><?=generatePageBar($page_prefix, $current_page, $page_size, $total_record, $url, $normal_class, $selected_class, $previous, $next, $first, $last, $break_type)?></td>
        <? } ?>
        <td align="right" style="text-align: right"><a title="Go to top" accesskey="T" class="top" href="#" style="font-weight: bold;">Lên trên<img align="absmiddle" border="0" hspace="5" src="<?=$fs_imagepath?>top.png" /></a></td>
    </tr>
</table>
</body>
</html>

