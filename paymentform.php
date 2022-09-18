<?php
	include 'lib/dbconfig.php';
    $con = new DBConfig();
	
    $id = $_GET['id'];
    
    $query = "SELECT * from products where id = $id";
    $get_data = $con->queryAll($query);
    $price = $get_data[0]['product_price'];
    $productInfo = $get_data[0]['id'];

	$MERCHANT_KEY 	= "i9dgjH6p";
	$SALT 			= "BkrT60Lw0f";
	$PAYU_BASE_URL 	= "https://sandboxsecure.payu.in";

    $posted = array();
    if (!empty($_POST)) {
        foreach ($_POST as $key => $value) {
            $posted[$key] = $value;
        }
    }
    $action = '';
    $formError = 0;
    if(empty($posted['txnid']))
    {
        $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
    } else {
        $txnid = $posted['txnid'];
    }
    $hash 			= '';
    $hashSequence 	= "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
   

        if(empty($posted['hash']) && sizeof($posted) > 0)
        {
            if (empty($posted['key']) || empty($posted['txnid']) || empty($posted['amount']) || empty($posted['firstname']) || empty($posted['email']) || empty($posted['phone']) || empty($posted['productinfo']) || empty($posted['surl']) || empty($posted['furl']) || empty($posted['service_provider'])) {
                $formError = 'Fields are empty';
            }
            else
            {
                $hashVarsSeq = explode('|', $hashSequence);
                $hash_string = '';
                foreach ($hashVarsSeq as $hash_var) {
                    $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
                    $hash_string .= '|';
                }
                $hash_string .= $SALT;
                $hash 	= strtolower(hash('sha512', $hash_string));
                $action = $PAYU_BASE_URL . '/_payment';
            }
        } 
        elseif (!empty($posted['hash'])) {
            $hash 	= $posted['hash'];
            $action = $PAYU_BASE_URL . '/_payment';
        }
        
    ?>
    <center><h1>Please do not refresh this page...</h1></center>
    <form action="<?php echo $action ; ?>" method="post" name="payuForm" class="proceed1">
    <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY; ?>" />
    <input type="hidden" name="hash" value="<?php echo $hash; ?>"/>
    <input type="hidden" name="txnid" value="<?php echo $txnid;?>" />
    <input type="hidden" name="productinfo" value="<?php echo $productInfo; ?>" />
    <input type="hidden" name="amount" id="txtTxnAmount" value="<?php echo $price; ?>" />
    <input type="hidden" name="phone" value="8847808867" />                          
    <input type="hidden" name="firstname" value="Sandip Sethy" />
    <input type="hidden" name="email" id="email" value="sandip96.official@gmail.com" />
    <input type="hidden" name="surl" value="http://localhost/p_market/paymentresponse.php"/>
    <input type="hidden" name="furl" value="http://localhost/p_market/paymentfailure.php"  />
    <input type="hidden" name="service_provider" value="payu_paisa" />
    <input type="hidden" name="disamount" id="disamount" value="0" />
    </form>
    <script>
        function submitPayuForm() {
            var payuForm = document.forms.payuForm;
            payuForm.submit();
        }
        submitPayuForm();
    </script>