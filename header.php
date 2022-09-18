<?php include 'lib/function.php'; ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="http://localhost/p_market/assets/css/bootstrap.min.css" >

    <title>Hello, world!</title>
  </head>
  <body>
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"  ></script> -->
    
    <script src="http://localhost/p_market/assets/js/jquery.js"  ></script>  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" ></script>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">P Market</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="addproduct.php">Add Product</a>
          </li>
          <button type="button" class="btn btn-primary paidproducts btn-lg float-right" data-toggle="modal" data-target="#paid_products"  >
              Paid Products Details
          </button>
        </ul>
      </div>
    </nav>