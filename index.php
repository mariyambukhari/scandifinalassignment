 <?php
    //include 'includes/autoloader.inc.php';
    //include 'classes/connectDbh.class.php';
    include 'classes/productList.class.php';
    ?>

 <head>
     <title>Product</title>
     <link rel="stylesheet" href="style.css">
 </head>

 <body>

     <?php

        $productListObj = new ProductList();
        ?>
     <nav class="navbar">
         <div class="navbar-container">
             <div class="navbar-brand">

             </div>
             <ul class="navbar-nav-left">
                 <?php include 'templates/header.php'; ?>

             </ul>
             <?php
                echo $productListObj->getProduct();
                ?>



 </body>
 <?php include 'templates/footer.php'; ?>

 </html>