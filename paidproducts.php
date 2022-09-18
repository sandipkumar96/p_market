<?php

include 'lib/dbconfig.php';
$con = new DBConfig();


$query = "SELECT * from products a join payment_details b on a.id = b.product_id where  b.status = 'success'";
$get_data = $con->queryAll($query);
$return_html = '';
$image_url = 'http://localhost/p_market/assets/uploads/';
if(!empty($get_data))
{
    foreach($get_data as $index)
    {
        $name = $index['product_name'];
        $price = $index['product_price'];
        $code = $index['product_code'];
        $description = $index['product_description'];
        $txnid = $index['txnid'];
        $status = $index['status'];
        $images = explode(',',$index['product_images']);

        $return_html .= '
        <div >
            <p ><b>Name : </b>'.$name.'</p>
            <p><b>Code : </b>'.$code.'</p>
            <p ><b>Price : </b>'.$price.'</p>
            <p ><b>Description : </b>'.$description.'</p>
            <p ><b>Transaction ID : </b>'.$txnid.'</p>
            <p ><b>Status : </b>'.$status.'</p>';
            foreach($images as $data){
                $return_html .=   '<img src="'.$image_url.$data.'" height="150px" width="150px">';
            }
        $return_html .=   '</div><hr>';
    }
    
   
}
else
{
    $return_html = 'No Data Found !';
}

echo $return_html; 
?>