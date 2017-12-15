<?
require_once("inc_security.php");
$query = new db_query("SELECT * FROM batdongsan");

// thiết lập thành phần gán giá trị

$sqlWhere   = '';
$iCat             = getValue("iCat");
$search_id = getValue("search_id","int","GET",0);
$search_keyword = getValue("search_keyword","str","GET",0);
$search_active = getValue("search_active","str","GET",0);

// Search theo ID
if($search_id > 0) $sqlWhere	.= " AND id = " . $search_id;

// Search từ khóa

if($search_keyword != ""){
    $sqlWhere .= " AND name LIKE '%" . $search_keyword . "%'";
}
?>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, Tahoma, Geneva, sans-serif;
            font-size: 11px;
        }
        .form-control-search{
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
        .btn-search{
            font-size: 12px;
            padding: 2px 8px;
        }
        body .search{
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
    </style>
</head>
<body>
<div class="search">
    <form action="" method="get">
        <table>
            <tbody>
                <tr>
                    <td class="form-label-sm">Name :</td>
                    <td><input type="text" class="form-control form-control-search form-control-sm" placeholder="Name..."></td>
                    <td class="form-label-sm">ID :</td>
                    <td><input type="text" class="form-control form-control-search form-control-sm" placeholder="Link..."></td>
                    <td class="form-label-sm">Type :</td>
                    <td>
                    <select class="form-control form-control-search form-control-sm" id="sel1">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                    </select>
                    </td>
                    <td class="form-label-sm">Date :</td>
                    <td><input type="date" class="form-control form-control-search form-control-sm" placeholder="Date..."></td>
                    <td><button class="btn btn-info btn-search">Tìm Kiếm</button></td>
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
    while ($row = mysql_fetch_assoc($query->result)) {
        ?>
        <tr>
            <td><?= $row['db_id']?></td>
            <td><?= $row['db_name'] ?></td>
            <td align="center">
                <a href="" border="0" target="_blank">
                    <img src="<?= $fs_filepath . $row['db_image'] ?>" width="100" height="20" style="max-width: 100%"/>
                </a>
            </td>
            <td><?= $row['db_link'] ?></td>
            <td><?= $row['db_description'] ?></td>
            <td><input type="checkbox" class="select_update_product" name="" id="" value="<?=$row['db_active']?>"></td>
            <td><?= $arrType[$row['db_type']] ?></td>
            <td><?=date("d/m/Y", $row['db_date'])?></td>
            <td>
                <a style="font-size: 14px;" href="edit.php?record_id=<?=$row['db_id']?>&url=<?=base64_encode($_SERVER['REQUEST_URI'])?>"><img src="../../resource/images/grid/edit.png" border="0"></a>
            </td>
            <td>
                <a style="font-size: 14px;" href="delete.php?record_id=<?=$row['db_id']?>&url=<?=base64_encode($_SERVER['REQUEST_URI'])?>"><img src="../../resource/images/grid/delete.gif" border="0"></a>
            </td>
        </tr>
    <? } ?>

    </tbody>
</table>
</body>
</html>