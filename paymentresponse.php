<?php
include 'lib/dbconfig.php';
$con = new DBConfig();
$status=$_POST["status"];
$firstname=$_POST["firstname"];
$amount=$_POST["amount"];
$txnid=$_POST["txnid"];
$posted_hash=$_POST["hash"];
$key=$_POST["key"];
$productinfo=$_POST["productinfo"];
$email=$_POST["email"];
$salt="BkrT60Lw0f";


If (isset($_POST["additionalCharges"])) {
       $additionalCharges=$_POST["additionalCharges"];
        $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
} else {
    $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
        }
        $hash = hash("sha512", $retHashSeq);
    if ($hash != $posted_hash) {
        echo "Invalid Transaction. Please try again";
    } else {

        $product_code = $con->queryAll("SELECT product_code from products where id = $productinfo");
        $query = "INSERT into payment_Details (txnid, product_id, product_code, status, product_price) 
        values('".$txnid."', '".$productinfo."', '".$product_code[0]['product_code']."', '".$status."', '".$amount."')";

        $con->execute($query);
        echo "<h3>Thank You. Your order status is ". $status .".</h3>";
        echo "<h4>Your Transaction ID for this transaction is ".$txnid.".</h4>";
        echo "<h4>We have received a payment of Rs. " . $amount . ". Your order will soon be shipped.</h4>";

        

    }
    header( "refresh:2;url=index.php" );
?>	
