<?php
session_start();
// include('config.php');
require_once("dbconfig.php");
$con = new DBConfig();

if( !function_exists( 'csrf_formtoken' )) {
	function csrf_formtoken($form_type) {
        $length = 32;
        if(!isset($_SESSION['csrf_formtoken_'.$form_type])){
            $_SESSION['csrf_formtoken_'.$form_type] = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $length);
        }   
        $token =  $_SESSION['csrf_formtoken_'.$form_type];
		return '<input type="hidden" class="csrf_formtoken" name="csrf_formtoken" value="'.$token.'"/>';
	}
}


if (!function_exists('cleanInput')) {
    function cleanInput($input)
    {
        return strip_tags(addslashes($input));
    }
}

if (!function_exists('validateattachment')) {
    function validateattachment( $inputfile ) {
        $return = false;
        $allowed = array("image/jpeg", "image/gif","image/png","image/PNG","image/jpg");
        // $allowed = array("application/pdf");
        if(!in_array($inputfile['type'], $allowed)) {
            $return = 'File Format not supported';
        } else if ($inputfile['size'] > 2097152  ){
            $return = 'File Size must be less than 2 MB';
        }
        return $return;
    }
    
}

if (!function_exists('uploadattachement')) {
    function uploadattachement( $inputfile ) {
        $filename =  $inputfile['name'].'_'.time();
        move_uploaded_file($inputfile['tmp_name'],$_SERVER['DOCUMENT_ROOT'].'/assets/uploads/'.$filename );
        return $filename;
    }
}



function perpage($count, $per_page = '10') {
    $output = '';
    $paging_id = "link_perpage_box";
    if(!isset($_POST["page"])) $_POST["page"] = 1;
    if($per_page != 0)
    $pages  = ceil($count/$per_page);
    if($pages>1) {
        
        if(($_POST["page"]-3)>0) {
            if($_POST["page"] == 1)
                $output = $output . '<span id=1 class="current-page">1</span>';
            else				
                $output = $output . '<input type="submit" name="page" class="perpage-link" value="1" />';
        }
        if(($_POST["page"]-3)>1) {
                $output = $output . '...';
        }
        
        for($i=($_POST["page"]-2); $i<=($_POST["page"]+2); $i++)	{
            if($i<1) continue;
            if($i>$pages) break;
            if($_POST["page"] == $i)
                $output = $output . '<span id='.$i.' class="current-page" >'.$i.'</span>';
            else				
                $output = $output . '<input type="submit" name="page" class="perpage-link" value="' . $i . '" />';
        }
        
        if(($pages-($_POST["page"]+2))>1) {
            $output = $output . '...';
        }
        if(($pages-($_POST["page"]+2))>0) {
            if($_POST["page"] == $pages)
                $output = $output . '<span id=' . ($pages) .' class="current-page">' . ($pages) .'</span>';
            else				
                $output = $output . '<input type="submit" name="page" class="perpage-link" value="' . $pages . '" />';
        }
        
    }
    return $output;
}

function showperpage($sql, $per_page = 2) {
    require_once("dbconfig.php");
    $con = new DBConfig();
    $count   = $con->numRows($sql);
    $perpage = perpage($count, $per_page);
    return $perpage;
}

function productstatus($id)
{
    $return = false;
    require_once("dbconfig.php");
    $con = new DBConfig();
    $query = $con->queryAll("SELECT count(*) as checkstatus from payment_details where product_id = $id and status = 'success'");

    $check = $query[0]['checkstatus'];
    if($check > 0){
        $return = true;
    }
    return $return;
}


?>