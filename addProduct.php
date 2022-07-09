<?php
//include 'includes/autoloader.inc.php';
// include 'classes/connectDbh.class.php';
include 'classes/productList.class.php';
$prod = new ProductList();
$prodprod = new ConnectDbh();

$sql = "SELECT * from product_tables";
$stmt = $prodprod->connect()->query($sql);
$row = $stmt->fetch();

if (isset($_POST['submit'])) {
    if (!empty($_POST['name']) && !empty($_POST['sku']) && !empty($_POST['price']) && ($_POST['productType'] != 'Select')) {
        if ($_POST['sku'] === $row['sku']) {
            echo "please enter a unique sku.";
        }
        if ($_POST['name'] >= 255 || !preg_match("/^[a-zA-Z-'\s]+$/", $_POST['name'])) {
            $name = $_POST['name'];
        } else {
            echo "Please enter a valid name</br>";
        }
        $p_name = $_POST['name'];
        $sku = $_POST['sku'];
        $price = $_POST['price'];
        $productType = $_POST['productType'];
        $height = $_POST['height'];
        $size = $_POST['size'];
        $height = $_POST['height'];
        $width = $_POST['width'];
        $p_weight = $_POST['weight'];
        $p_length = $_POST['length'];

        $prod->setProduct($p_name, $sku, $price, $productType, $height, $size, $width, $p_weight, $p_length);
    }
}

?>

<head>
    <title>Add Product</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<style type="text/css">
    .brand {
        background: #cbb09c !important;
    }

    .brand-text {
        color: #cbb09c !important;

    }

    form {
        max-width: 460px;
        margin: 20px auto;
        padding: 20px;
    }

    .prodcontainer {
        display: none
    }
</style>
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="style.css">
<div class="container">
    <form action="addProduct.php" method="post" class="white" id="product_form">
        <section class="container grey-text">

            <div class="container grey-text">
                <nav class="white z-depth-0">

                    <div class="container">
                        <a href="#" class="left brand-logo brand-text">Product Add</a>

                        <ul id="nav-mobile" class="right hide-on-small-and-down">

                            <li><input type="submit" name="submit" value="save" class="btn btn-dark-outline"></input></li>
                        </ul>
                        <ul id="nav-mobile" class="right hide-on-small-and-down">
                            <li><a href="index.php" class="btn btn-dark-outline">Cancel</a></li>
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="container">
                <div class="box box-a bg-primary text-center py-md ">
                    <section class="container grey-text">
                        <label> SKU: </label></br>
                        <input type="text" name="sku" id="sku"></br>
                        <label> Name: </label></br>
                        <input type="text" name="name" id="name"></br>
                        <label> Price($): </label></br>
                        <input type="text" name="price" id="price"></br>
                        <label> Type Switcher: </label></br>

                        <select id="productType" name="productType">
                            <option value="Select">Select</option>

                        </select>

                        <div class="furniture prodcontainer" id="Furniture">
                            <label> Height (CM): </label></br>
                            <input type=" text" name="height" id="height"></br>
                            <label> Width (CM): </label></br>
                            <input type="text" name="width" id="width"></br>
                            <label> Length (CM): </label></br>
                            <input type="text" name="length" id="length"></br>
                        </div>
                        <div class="dvd prodcontainer" id="DVD">
                            <label> Size (MB): </label></br>
                            <input type="text" name="size" id="size"></br>

                        </div>
                        <div class="book prodcontainer" id="Book">
                            <label> Weight (KG): </label></br>
                            <input type="text" name="weight" id="weight"></br>

                        </div>

                    </section>
                </div>
            </div>
    </form>

    <script type="text/javascript">
        $(document).ready(function() {
            function loadData(productT, pId) {
                $.ajax({
                    url: "load-ds.php",
                    type: "POST",


                    success: function(data) {
                        $("#productType").append(data);
                    }
                });
            }
            loadData();

            $(document).ready(function() {
                $("#productType").on("change", function() {

                    $(this).find("option:selected").each(function() {
                        var productValue = $(this).html();
                        console.log(productValue);
                        if (productValue) {
                            $(".prodcontainer").not("." + productValue).hide();

                            $("." + productValue).show();
                        } else {
                            $(".prodcontainer").hide();
                        }


                    });

                }).change();

            });
        });
    </script>



    <?php include 'templates/footer.php'; ?>


</html>