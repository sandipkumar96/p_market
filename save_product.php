<?php 

    include 'lib/function.php';

    $p_name = cleanInput($_POST['p_name']);
    $p_price = cleanInput($_POST['p_price']);
    $p_code = cleanInput($_POST['p_code']);
    // $p_images = $con->real_escape_string($_POST['p_images']);
    $p_desc = cleanInput($_POST['p_desc']);
    $error = array();

    $form_type = cleanInput($_POST['form_type']);
    $token = $_POST['csrf_formtoken'];
    $image = $_FILES['p_images'];


    if(empty($p_name)){
        $error[] = 'Product Name is missing' ;
    } if(empty($p_price)){
        $error[] = 'Product Price is missing';
    } if(empty($p_code)){
        $error[] =  'Product Code is missing' ;
    }
    if($image['tmp_name'][0] ==''){
        $error[] = 'Upload atleast one image.';
    }
    if(empty($p_desc)){
        $error[] =  'Product Description is missing' ;
    }


    if($error){
        $index = implode(' </br>', $error);    
        echo json_encode(array(
            'status' => false,
            'message' =>'<p class="alert alert-danger alert-dismissible" role="alert" auto-close="3000"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><b>'.$index.'</b></p>' , 
        ));

    }else{
            if ($_SESSION['csrf_formtoken_'.$form_type] == $token) {
                $file_array = array();
                $count = count($image['tmp_name']);
                for($i=0; $i < $count; $i++)
                {
                    $temp_path = $image['tmp_name'][$i];
                    $filename = time().'_'.$image['name'][$i];
                    move_uploaded_file($temp_path, './assets/uploads/'.$filename );
                    $file_array[] = $filename;

                }

                $files = implode(',',$file_array);
                $query = "INSERT INTO products (product_name, product_price, product_images, product_code, product_description)
                VALUES ('$p_name', '$p_price', '$files', '$p_code', '$p_desc')";

                if($con->execute($query)){
                    // if(mysqli_query($con, $query)){
                    unset($_SESSION['csrf_formtoken_'.$form_type]);
                    echo json_encode(array( 
                        'status' => true,
                        'redirect_url'=> '',
                        'message' => '<div class= "alert alert-success"><b>Product is Added.</b></div>' 
                    ));
                } else{
                    echo json_encode(array( 
                        'status' => false,
                        'message' => 'Some Error Occured!!'
                    ));
                }
            }else{
                echo json_encode(array( 
                    'status' => false,
                    'message' => 'Something Went Wrong!!'
                ));
            }
    }
?>