<?php
  include('header.php');
?>

<form class="container mt-3" method="post" action="http://localhost/p_market/save_product.php" id="product-ajax-form">
  <div class="form-group">
    <label for="exampleFormControlInput1">Product Name</label>
    <input type="text" class="form-control"  name="p_name" id="exampleFormControlInput1" placeholder="Enter Product Name">
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Product Price</label>
    <input type="number" class="form-control" name="p_price" id="exampleFormControlInput1" placeholder="Enter Product Price">
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Product Code</label>
    <input type="text" class="form-control" name="p_code" id="exampleFormControlInput1" placeholder="Enter Product Code">
  </div>
  <div class="form-group">
    <label for="exampleFormControlFile1">Product Images</label>
    <input type="file" class="form-control-file" name="p_images[]" id="exampleFormControlFile1" multiple>
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Product Description</label>
    <textarea class="form-control" name="p_desc" id="exampleFormControlTextarea1" rows="3"></textarea>
  </div>
  <div id="_no_data"></div>
  <div id="_with_data"></div>
  <input type="hidden" name="form_type" value="addproduct">
  <?php echo csrf_formtoken('addproduct'); ?>
  <button type="submit" class="btn btn-primary">Submit</button>

</form>

<?php
  include('footer.php');
?>