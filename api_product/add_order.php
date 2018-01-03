<?
$data1 = array(
    'product_name' =>'Bộ sách Trung Nguyên1',
    'quantity'     =>1,
    'product_price' =>40000,
    'product_picture'=>'http:\/\/media.dixehoi.com\/product\/2017\/08\/18\/rmj1503073884.jpg',
    'seller_id'      =>5,
    'seller_email'   =>'trangle2268@gmail.com',
    'order_product_id'       =>'127'
);
$data = json_encode($data1);


require_once("../classes/database.php");
require_once("../classes/generate_form.php");
require_once("../functions/functions.php");
$secret_code  = "vgorder@2015";
$response  = new stdClass();
$response->code = 0;
$response->messages = "";

$checksum   = getValue("checksum", "str", "GET", "");
$checksum   = trim($checksum);
/*$data    = file_get_contents("php://input");*/



// Kiểm tra dữ liệu trước
if($data == ""){
    // nếu data vs check sum rỗng thì return luôn
    $response->messages = "Invalid Data";
    die(json_encode($response));

}

// Checksum
/*$test_checksum = md5($secret_code . $data);
if($checksum !== $test_checksum){
 // Nếu sai checksum
 $response->messages = "Checksum Fail";
 die(json_encode($response));
}*/

// Log lại thông tin post sang
$dataLog = "IP: " . @$_SERVER['REMOTE_ADDR'];
$dataLog .= " | POST DATA: [" . json_encode($data) . "]";

$arrData = json_decode($data, 1);


$oct_product_quantity  = (isset($arrData['quantity']) && intval($arrData['quantity']) > 0) ? intval($arrData['quantity'])  : 1;

$oct_product_name  = (isset($arrData['product_name']) && $arrData['product_name'] != "") ? trim($arrData['product_name'])  :  "";
$oct_product_price  = (isset($arrData['product_price']) && intval($arrData['product_price']) > 0) ? intval($arrData['product_price'])  : 0;
$oct_product_picture = (isset($arrData['product_picture']) && $arrData['product_picture'] != "") ? $arrData['product_picture']  :  "";
$oct_seller_id   = (isset($arrData['seller_id']) && intval($arrData['seller_id']) > 0) ? intval($arrData['seller_id'])  :  0;

$oct_product_id         = (isset($arrData['order_product_id']) && intval($arrData['order_product_id']) > 0) ? intval($arrData['order_product_id'])  :  0;
/*$oct_seller_email  = (isset($arrData['seller_email']) && $arrData['seller_email'] != "") ? trim($arrData['seller_email'])  :  "";*/

$fs_table    = "orders_c2c_temp";
$fs_errorMsg   = "";

$oct_date    = time();




// Call class generate_form() để kiểm tra dữ liệu và lưu vào database
$myform = new generate_form();

$myform->addTable($fs_table);
$myform->add("oct_product_name", "oct_product_name", 0, 1, " ", 1, "product_name is required", 0, "");
$myform->add("oct_product_quantity", "oct_product_quantity", 1, 1, 1, 1, "product_quantity is required", 0, "");
$myform->add("oct_product_price", "oct_product_price", 1, 1, 1, 1, "product_price is required", 0, "");
$myform->add("oct_price", "oct_product_picture", 0, 1, "", 0, "", 0, "");
$myform->add("oct_seller_id", "oct_seller_id", 1, 1, 1, 1, "oct_seller_id is required", 0, "");
$myform->add("oct_product_id", "oct_product_id", 1, 1, 1, 1, "oct_product_id is required", 0, "");
/*$myform->add("oct_seller_email", "oct_seller_email", 0, 1, " ", 1, "seller_email is required", 0, "");
*/$myform->add("oct_date","oct_date",1,1,0,0,"",0,"");
// Check form data
$fs_errorMsg .= $myform->checkdata();

if($fs_errorMsg == "" ){
    // Insert to database and get last ID
    $myform->removeHTML(1);



    $db_insert = new db_execute_return();
    $last_id  = $db_insert->db_execute($myform->generate_insert_SQL());
    unset($db_insert);

    // Nếu insert thành công
    if($last_id > 0){

        $response->code = 1;
        $response->messages = "Success";
        $response->ID = $last_id;

    }// End if($last_id > 0)
    else{

        $response->messages = 'Khong the tao don hang. Vui long thu lai sau!';

    }
}else{

    $fs_errorMsg = str_replace("&bull;", "",$fs_errorMsg);
    $fs_errorMsg = str_replace("<br />", ".",$fs_errorMsg);

    $response->messages = $fs_errorMsg;
}

// Ghi log
if($response->messages != ""){
    $dataLog .= " | ErrorMsg: " . $response->messages . "\n";
    dump_log($dataLog, "C2C_LOG");
}

echo json_encode($response);
?>