<?php include('config.php');
include('header.php'); ?>
<!-- Wrapper for the radial gradient background -->

<?php
if (isset($_GET['sku'])) {
    if (isset($_POST['submit'])) {
        if (isset($_POST['q1'])) {
            $q1 = implode(',', $_POST['q1']);
        }
        if (isset($_POST['q2'])) {
            $q2 = implode(',', $_POST['q2']);
        }

        $sku = $_GET['sku'];
        $name = $_POST["name"];
        $price = $_POST["price"];
        $image = $_FILES["image"]["name"];
        $categories = $_POST["categories"];
        $description = $_POST["short_description"];

        // echo $image;
        if ($image == NULL) {
            $image = $_GET['image'];
        }
        $tempname = $_FILES["image"]["name"];
        $folder = "upload/" . $image;
        $sql = "UPDATE productsnew SET name='$name',price=$price,`image`='$image',tags='$q1',category='$categories',`description`='$description' ,color='$q2' WHERE product_id=$sku";

        if (mysqli_query($conn, $sql)) {
            header('location:products.php');
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    // header('location:products.php');

}

?>
<?php include('siderbar.php'); ?>
<div id="main-content">
    <!-- Main Content Section with everything -->

    <noscript>
        <!-- Show a notification if the user has disabled javascript -->
        <div class="notification error png_bg">
            <div>
                Javascript is disabled or is not supported by your browser. Please <a href="http://browsehappy.com/" title="Upgrade to a better browser">upgrade</a> your browser or <a href="http://www.google.com/support/bin/answer.py?answer=23852" title="Enable Javascript in your browser">enable</a> Javascript to navigate the interface properly.
            </div>
        </div>
    </noscript>

    <!-- Page Head -->
    <h2>Welcome John</h2>
    <p id="page-intro">What would you like to do?</p>
    <div class="content-box">
        <div class="content-box-header">
            <h3>Content box</h3>
            <ul class="content-box-tabs">
                <li><a href="products.php" class="default-tab">Manage</a></li>
            </ul>
            <div class="clear"></div>
        </div>
        <!-- End .content-box-header -->

        <div class="tab-content default-tab" id="tab2">
            <?php if (isset($_GET['sku'])) :
                $sql = "SELECT * FROM `addproduct1` WHERE ProductSKU='" . $_GET['sku'] . "'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
            endif
            ?>
            <form action="" method="post" enctype="multipart/form-data">
                <fieldset>
                    <p>
                        <label>Name</label>
                        <input class="text-input small-input" type="text" id="small-input" name="name" value="<?php echo $_GET['name'] ?>" /> <!-- Classes for input-notification: success, error, information, attention -->
                        <br /><small>A small description of the field</small>
                    </p>
                    <p>
                        <label>Price</label>
                        <input class="text-input small-input" type="number" id="small-input" name="price" value="<?php echo $_GET['price'] ?>" />
                        <!-- Classes for input-notification: success, error, information, attention -->
                        <br /><small>A small description of the field</small>
                    </p>
                    <p>
                        <div>
                            <?php if (isset($row['Image'])) {
                                echo '<img src="upload/' . $row["Image"] . '">';
                            } ?>
                        </div>
                        <label>Image</label>
                        <input class="text-input small-input" type="file" id="small-input" name="image" value="" /> <!-- Classes for input-notification: success, error, information, attention -->
                        <br /><small>A small description of the field</small>
                    </p>
                    <p>
                        <label>Categories</label>
                        <select name="categories" class="small-input">
                            <option value="Men" <?php if (isset($row['Categories']) && $row['Categories'] == "Men") { ?> selected="selected" <?php
                                                                                                                                            } ?>>Men</option>
                            <option value="Women" <?php if (isset($row['Categories']) && $row['Categories'] == "Women") { ?> selected="selected" <?php
                                                                                                                                                } ?>>Women</option>
                            <option value="Kids" <?php if (isset($row['Categories']) && $row['Categories'] == "Kids") { ?> selected="selected" <?php
                                                                                                                                            } ?>>Kids</option>
                            <option value="Electronis" <?php if (isset($row['Categories']) && $row['Categories'] == "Electronis") { ?> selected="selected" <?php
                                                                                                                                                        } ?>>Electronis</option>
                            <option value="Sports" <?php if (isset($row['Categories']) && $row['Categories'] == "Sports") { ?> selected="selected" <?php
                                                                                                                                                } ?>>Sports</option>
                        </select>
                    </p>
                    <p>
                        <label>Tags </label>
                        <input name="q1[]" type="checkbox" value="fashion">Fashion
                        <input name="q1[]" type="checkbox" value="ecommerce">Ecommerce
                        <input name="q1[]" type="checkbox" value="shop">Shop
                        <input name="q1[]" type="checkbox" value="handbag">Handbag
                        <input name="q1[]" type="checkbox" value="laptop">Laptop
                        <input name="q1[]" type="checkbox" value="headphone">Headphone
                    </p>
                    <p>
                        <label>Colors </label>
                        <input name="q2[]" type="checkbox" value="green">Green
                        <input name="q2[]" type="checkbox" value="black">Black
                        <input name="q2[]" type="checkbox" value="white">White
                        <input name="q2[]" type="checkbox" value="cyan">Cyan
                        <input name="q2[]" type="checkbox" value="olive">Olive
                        <input name="q2[]" type="checkbox" value="orchid">Orchid
                    </p>
                    <p>
                        <label>Description</label>
                        <textarea name="short_description" rows="4" cols="50">
                            </textarea>
                    </p>
                    <p>
                        <input class="button" type="submit" value="UPDATE" name="submit" />
                    </p>
                </fieldset>
                <div class="clear"></div>
                <!-- End .clear -->
            </form>

        </div> <!-- End #tab2 -->
    </div> <!-- End .content-box-content -->
</div>