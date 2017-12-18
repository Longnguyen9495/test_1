<?
require_once("../../resource/security/security.php");

$query = new db_query("SELECT * FROM batdongsan");
//while($row = mysql_fetch_assoc($query->result)){
//    var_dump($row);
//
//}

?>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">

</head>
<body>
<table class="table table-condensed table-hover">
    <thead>
    <tr>
        <th>Tên bất động sản</th>
        <th>Hình ảnh</th>
        <th>Link</th>
        <th>Mô tả chi tiết</th>
        <th>Kích hoạt</th>
        <th>Mở ra</th>
        <th>Vị trí</th>
        <th>Hình thức</th>
        <th>Date</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <?
        while ($row = mysql_fetch_assoc($query->result)){

        ?>
            <td><?=$row['db_name']?></td>
            <td><?=$row['db_image']?></td>
            <td><?=$row['db_']?></td>
            <td><?=$row['db_image']?></td>
            <td><?=$row['db_image']?></td>
            <td><?=$row['db_image']?></td>

        <? } ?>
    </tr>
    </tbody>
</table>
</body>
</html>