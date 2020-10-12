<?php include 'siderbar.php';
// include 'config.php'; 
include 'header.php';
?>

<div id="main-content">
    <!-- Main Content Section with everything -->
    <h2>Welcome John</h2>
    <div class="content-box-header">
        <h3>Add Product</h3>
        <div class="clear"></div>
    </div> <!-- End .content-box-header -->
    <div class="content-box-header">
        <h3>Content box</h3>
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab">Manage</a></li>
            <!-- href must be unique and match the id of target div -->
            <li><a href="#tab2">Add</a></li>
        </ul>
        <div class="clear"></div>
    </div>

    <div class="content-box-content">
        <div class="tab-content" id="tab2">
            <?php if (isset($_GET['sku'])) :
                $sql = "SELECT * FROM `addproduct` WHERE ProductSKU=" . $_GET['sku'] . "";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
            endif
            //print_r($row) ;
            ?>
            <form action="" method="post">

                <fieldset>
                    <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->

                    <p>
                        <label>Product SKU</label>
                        <input class="text-input small-input" type="text" id="small-input" name="SKU" value="<?php if (isset($_GET['sku'])) : echo $row['ProductSKU'];
                                                                                                                endif; ?>" /> <span class="input-notification success png_bg">Successful message</span> <!-- Classes for input-notification: success, error, information, attention -->
                        <br /><small>A small description of the field</small>
                    </p>

                    <p>
                        <label>Name</label>
                        <input class="text-input small-input" type="text" id="small-input" name="name" value="<?php if (isset($_GET['sku'])) : echo $row['Name'];
                                                                                                                endif ?>" /> <span class="input-notification success png_bg">Successful message</span> <!-- Classes for input-notification: success, error, information, attention -->
                        <br /><small>A small description of the field</small>

                    </p>

                    <p>
                        <label>Brand</label>
                        <input class="text-input small-input" type="text" id="small-input" name="brand" value="<?php if (isset($_GET['sku'])) : echo $row['Brand'];
                                                                                                                endif ?>" /> <span class="input-notification success png_bg">Successful message</span> <!-- Classes for input-notification: success, error, information, attention -->
                        <br /><small>A small description of the field</small>

                    </p>

                    <p>
                        <label>Price</label>
                        <input class="text-input small-input" type="text" id="small-input" name="price" value="<?php if (isset($_GET['sku'])) : echo $row['Price'];
                                                                                                                endif ?>" /> <span class="input-notification success png_bg">Successful message</span> <!-- Classes for input-notification: success, error, information, attention -->
                        <br /><small>A small description of the field</small>
                    </p>

                    <p>
                        <label>Quantity</label>
                        <input class="text-input small-input" type="text" id="small-input" name="quantity" value="<?php if (isset($_GET['sku'])) : echo $row['Quantity'];
                                                                                                                    endif ?>" /> <span class="input-notification success png_bg">Successful message</span> <!-- Classes for input-notification: success, error, information, attention -->
                        <br /><small>A small description of the field</small>

                    </p>
                    <p>
                        <input class="button" type="submit" value="Submit" name="submit" />
                    </p>

                </fieldset>

                <div class="clear"></div><!-- End .clear -->

            </form>

            <?php
            if (isset($_GET['sku']))
            //$skuu=$_GET['sku']
            {
                if (isset($_POST['submit'])) {
                    //echo "yes here it is";
                    $sku = $_POST["SKU"];
                    $name = $_POST["name"];
                    $brand = $_POST["brand"];
                    $price = $_POST["price"];
                    $quantity = $_POST["quantity"];

                    echo $sku;
                    echo $name;
                    echo $brand;
                    echo $price;
                    echo $quantity;

                    $sql = "UPDATE addproduct SET Name='$name',Brand='$brand',Price=$price,Quantity=$quantity WHERE ProductSKU=$sku";
                    if (mysqli_query($conn, $sql)) {
                        echo "updated successfully";
                    } else {

                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }
                }
            } else {
                if (isset($_POST['submit'])) {
                    $sku = $_POST["SKU"];
                    $name = $_POST["name"];
                    $brand = $_POST["brand"];
                    $price = $_POST["price"];
                    $quantity = $_POST["quantity"];
                    $sql = "INSERT INTO addproduct (ProductSKU,Name,Brand,Price,Quantity) VALUES($sku,'$name','$brand',$price,$quantity)";

                    if (mysqli_query($conn, $sql)) {
                        echo "row inserted successfully";
                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }
                }
            }
            ?>

        </div> <!-- End #tab2 -->

    </div> <!-- End .content-box-content -->
    <?php include('footer.php'); ?>
</div> <!-- End .content-box -->