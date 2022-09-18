<?php

include 'lib/dbconfig.php';
$con = new DBConfig();

$id = $_GET['id'];


$query = "SELECT * from products where id = $id";
$get_data = $con->queryAll($query);

$sql = $con->queryAll("SELECT count(*) as checkstatus from payment_details where product_id = $id and status = 'success'");

$check = $sql[0]['checkstatus'];

if(!empty($get_data))
{
    $name = $get_data[0]['product_name'];
    $price = $get_data[0]['product_price'];
    $code = $get_data[0]['product_code'];
    $description = $get_data[0]['product_description'];
    $images = explode(',',$get_data[0]['product_images']);
    $return_html = '';
    $image_url = 'http://localhost/p_market/assets/uploads/';

    $return_html .= '
        <div >
            <p ><b>Name : </b>'.$name.'</p>
            <p><b>Code : </b>'.$code.'</p>
            <p ><b>Price : </b>'.$price.'</p>
            <p ><b>Description : </b>'.$description.'</p>';
    foreach($images as $index){
        $return_html .=   '<img src="'.$image_url.$index.'" height="150px" width="150px">';
    }
    $return_html .=   '</div>
    <input type="hidden" id="product_id" value="'.$get_data[0]['id'].'">
    <input type="hidden" id="check_paid" value="'.$check.'">';
}
else
{
    $return_html = 'No Data Found !';
}

echo $return_html; 
?>