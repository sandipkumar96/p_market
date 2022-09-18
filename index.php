<?php
	include("header.php");
	
    $queryCondition = "";
    $value = '';
	if(!empty($_POST["search"])) {
        $value = $_POST["search"];
        $queryCondition .= "where product_name LIKE '" . $value . "%' OR product_code LIKE '" . $value . "%' OR product_price LIKE '" . $value . "%'";
	}
	$orderby = " ORDER BY id desc"; 
	$sql = "SELECT * FROM products " . $queryCondition;			
		
	$perPage = 2; 
	$page = 1;
	if(isset($_POST['page'])){
		$page = $_POST['page'];
	}
	$start = ($page-1)*$perPage;
	if($start < 0) $start = 0;
		
	$query =  $sql . $orderby .  " limit " . $start . "," . $perPage; 
	$result = $con->queryAll($query);
	
	if(!empty($result)) {
		$result["perpage"] = showperpage($sql, $perPage);
	}
?>

    <div id="toys-grid">      
			<form name="frmSearch" method="post" action="" class="container">
			<div class="search-box float-right" >
			<p><input type="text" placeholder="Name" name="search" class="demoInputBox" value="<?php echo $value; ?>"	/><input type="submit" name="go" class="btnSearch" value="Search"><input type="reset" class="btnSearch" value="Reset" onclick="window.location='index.php'"></p>
			</div>
			
			<table cellpadding="10" cellspacing="1" class="table table-bordered table-hover">
        <thead class="thead-dark">
					<tr>
          <th><strong>Sl. No.</strong></th>
          <th><strong>Product</strong></th>
          <th><strong>Name</strong></th>
          <th><strong>Price</strong></th>    
          <th><strong>Details</strong></th>
          <th><strong>Status</strong></th>
					
					</tr>
				</thead>
				<tbody>
					<?php
					if(!empty($result)) {
						foreach($result as $k=>$v) {
						  if(is_numeric($k)) {
                              $image = explode(',', $result[$k]['product_images']);
					?>
          <tr>
					<td><?php echo $k+1; ?></td>
					<td><img src="http://localhost/p_market/assets/uploads/<?php echo $image[0]; ?> " height="100px" width="100px"></td>
                    <td><?php echo $result[$k]["product_name"]; ?></td>
					<td><?php echo $result[$k]["product_price"]; ?></td>
					<td>
                    <button type="button" class="btn btn-primary openmodal" data-toggle="modal" data-target="#details" data-value="<?php echo $result[$k]['id'];?>" >
                        View Details
                    </button>
					<!-- <a class="btnEditAction" href="edit.php?id=<?php //echo $result[$k]["id"]; ?>">View Details</a>  -->
					</td>
					<td>
						<?php $check = productstatus($result[$k]["id"]); 
						if($check){
							echo '<b style="color:green;">Already Paid</b>';
						}else{
							echo '<b style="color:red;">Not Paid</b>';
						}
						?>
					</td>
					</tr>
					<?php
						  }
					   }
                    }
					if(isset($result["perpage"])) {
					?>
					<tr>
					<td colspan="6" align=right> <?php echo $result["perpage"]; ?></td>
					</tr>
					<?php } ?>
				<tbody>
			</table>
			</form>	
        </div>
        
<?php include('footer.php'); ?>