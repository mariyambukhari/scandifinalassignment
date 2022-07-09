<?php

//include_once 'includes/autoloader.inc.php';
include 'classes/connectDbh.class.php';


class ProductList extends ConnectDbh
{

    public $productTypeID, $productFormID = null;
    public $p_name, $sku, $price, $productType, $height = 0, $size = 0, $width = 0, $p_weight = 0, $p_length = 0;


    public function setProduct($p_name, $sku, $price, $productType, $height, $size, $width, $p_weight, $p_length)

    {

        if ($productType === "dvd") {
            $productTypeID = 1;
        } elseif ($productType === "book") {
            $productTypeID = 2;
        } elseif ($productType === "furniture") {
            $productTypeID = 3;
        }


        echo ('name' . $p_name . ' sku' . $sku . ' price' . $price . ' product type' . $productType . ' id = ' . $productTypeID . ' height ' . $height . ' length ' . $p_length . ' width ' . $width . ' weight ' . $p_weight . ' size ' . $size);


        $stmt = $this->connect()->prepare("INSERT INTO product_tables (sku, p_name, price, product_type, product_type_id,height, p_length, width, size, p_weight) 
        VALUES(:sku,:p_name,:price,:product_type,:product_type_id,:height,:p_length, :width, :size, :p_weight)");


        // $stmt->bindParam(':sku', $sku, PDO::PARAM_STR);
        // $stmt->bindParam(':p_name', $p_name, PDO::PARAM_STR);
        // $stmt->bindParam(':price', $price, PDO::PARAM_STR);
        // $stmt->bindParam(':product_type', $productType, PDO::PARAM_STR);
        // $stmt->bindParam(':product_type_id', $productTypeID, PDO::PARAM_STR);

        // $stmt->bindParam(':height', $height, PDO::PARAM_STR);
        // $stmt->bindParam(':p_length', $p_length, PDO::PARAM_STR);
        // $stmt->bindParam(':width', $width, PDO::PARAM_STR);
        // $stmt->bindParam(':size', $size, PDO::PARAM_STR);
        // $stmt->bindParam(':p_weight', $p_weight, PDO::PARAM_STR);

        // //$stmt1->execute(array(':sku' => $sku, ':p_name' => $p_name, ':price' => $price, ':product_type' => $productType, ':product_type_id' => $productTypeID, ':height' => $height, ':p_length' => $p_length, ':width' => $width, ':size' => $size, ':p_weight' => $p_weight));
        if ($productType === "dvd") {
            $height = null;
            $width = null;
            $p_length = null;
            $p_weight = null;
        } elseif ($productType === "book") {
            $height = null;
            $width = null;
            $p_length = null;
            $size = null;
        } elseif ($productType === "furniture") {
            $p_weight = null;
            $size = null;
        }
        $productFormID = null;
        $stmt->execute([':sku' => $sku, ':p_name' => $p_name, ':price' => $price, ':p_name' => $p_name, ':product_type' => $productType, ':product_type_id' => $productTypeID, ':height' => $height, ':p_length' => $p_length, ':width' => $width, ':size' => $size, ':p_weight' => $p_weight]);
        header("location:index.php");
    }

    public function getProduct()
    {

        $sql = "SELECT * from product_tables";
        $stmt = $this->connect()->query($sql); ?>
        <html>
        <title>Product</title>
        <link rel="stylesheet" href="style.css">

        <body>
            <form method="POST" action="delete.php">

                <div class="navbar-brand">
                    <ul class="navbar-nav-right">

                        <li><button class="btn btn-dark-outline" type="submit" name="delete-product-btn">MASS DELETE</button></li>
                        <li><a href="addProduct.php" class="btn btn-dark-outline">ADD</a></li>
                    </ul>
                </div>
                </div>
                </nav>

                <?php
                while ($row = $stmt->fetch()) { ?>

                    <div id=container1>
                        <div>
                            <div class="box box-a bg-primary text-center py-md ">
                                <div class="left">

                                    <p>
                                        <label>
                                            <input type="checkbox" name="delete-checkbox[]" value="<?php echo $row['product_form_id']; ?>" />
                                            <span></span>
                                        </label>
                                    </p>

                                    <div class="card grey darken-1">
                                        <div class="center card-content white-text">

                                            <?php echo $row['sku'] . '<br>';
                                            echo $row['p_name'] . '<br>';
                                            echo '$' . $row['price'] . '<br>';
                                            echo $row['product_type'] . '<br>';


                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



        <?php
                }
            }
        } ?>
            </form>
        </body>

        </html>