<?php include('config.php');
include('header.php'); ?>
<!-- Wrapper for the radial gradient background -->

<?php
if (isset($_GET['sku'])) {
    if (isset($_POST['submit'])) {
        if (isset($_POST['q1'])) {
            $q1 = implode(',', $_POST['q1']);
        }
        $sku = $_GET['sku'];
        $name = $_POST["name"];
        $username = $_POST["username"];
        $price = $_POST["price"];
        $image = $_FILES["image"]["name"];
        $quantity = $_POST["quantity"];
        // echo $image;
        if ($image == NULL) {
            $image = $_GET['image'];
        }
        $tempname = $_FILES["image"]["name"];
        $folder = "upload/" . $image;
        $sql = "UPDATE cart SET username='$username',name='$name',price=$price,`image`='$image',`quantity`=$quantity WHERE username='$sku'";

        if (mysqli_query($conn, $sql)) {
            header('location:manageorder.php');
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
                $sql = "SELECT * FROM `cart` WHERE username='" . $_GET['sku'] . "'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
            endif
            ?>
            <form action="" method="post" enctype="multipart/form-data">
                <fieldset>
                    <p>
                        <label>Username</label>
                        <input class="text-input small-input" type="text" id="small-input" name="username" value="<?php echo $_GET['sku'] ?>" /> <!-- Classes for input-notification: success, error, information, attention -->
                        <br /><small>A small description of the field</small>
                    </p>
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
                        <label>Quantity</label>
                        <input class="text-input small-input" type="text" id="small-input" name="quantity" value="<?php echo $_GET['quantity'] ?>" />
                        <!-- Classes for input-notification: success, error, information, attention -->
                        <br /><small>A small description of the field</small>
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