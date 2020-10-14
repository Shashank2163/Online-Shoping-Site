<?php include('config.php');
include('header.php'); ?>
<?php
$val = 0;
if (isset($_GET['sku'])) {
    $sku = $_GET['sku'];
    if ($_GET['action'] == 'delete') {
        $sql = "DELETE FROM colors WHERE product_id=$sku";
        if (mysqli_query($conn, $sql)) {
            echo "record deleted successfully";
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }
    } else {
        if ($_GET['action'] == 'edit') {
            $val = 1;
        }
    }
}
?>
<?php

if (isset($_POST['submit'])) {
    if ($val == 1) {
        echo "hi i am update";
        $sku = $_POST["SKU"];
        $quantity = $_POST["quantity"];
        $colour = $_POST["colour"];
        $sql = "UPDATE colors SET colors='$colour',quantity=$quantity WHERE product_id=$sku";
        $result = mysqli_query($conn, $sql);
        header('location:colours.php');
    } else {
        if ($val == 0) {
            $sku = $_POST["SKU"];
            $quantity = $_POST["quantity"];
            $colour = $_POST["colour"];
            $sql = "INSERT INTO colors (product_id,colors,quantity) VALUES($sku,'$colour',$quantity)";
            if (mysqli_query($conn, $sql)) {
                // echo "row inserted successfully";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    }
}

?>
<!-- Wrapper for the radial gradient background -->
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
            <h3>MANAGE COLORS </h3>
            <ul class="content-box-tabs">
                <li><a href="#tab1" <?php if ($val == 0) : ?>class="default-tab" <?php endif ?>>Manage</a></li>
                <li><a href="#tab2" <?php if ($val == 1) : ?>class="default-tab" <?php endif ?>>Add</a></li>
            </ul>
            <div class="clear"></div>
        </div>
        <!-- End .content-box-header -->
        <div class="content-box-content">
            <div class='tab-content<?php if ($val == 0) : ?>default-tab<?php endif ?>' id="tab1">
                <!-- This is the target div. id must match the href of this div's tab -->
                <table>
                    <thead>
                        <tr>
                            <th><input class="check-all" type="checkbox" /></th>
                            <th>Product_id</th>
                            <th>Quantity</th>
                            <th>Colour</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php

                        // $sql="SELECT * FROM addproduct LIMIT $offset, $limit";
                        $sql = "SELECT * FROM colors";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            //echo "yes here it is";
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr>
									<td><input type="checkbox"/></td>
									<td>' . $row["product_id"] . '</td>
									
									<td>' . $row["quantity"] . '</td>
								
									<td>' . $row["colors"] . '</td>
									
									
									<td>
										<!-- Icons -->
										 <a href="colours.php?sku=' . $row["product_id"] . '&quantity=' . $row["quantity"] . '&action=edit" title="Edit"><img src="resources/images/icons/pencil.png" alt="Edit" /></a>
										 <a id="subject" href="colours.php?sku=' . $row["product_id"] . '&action=delete" title="Delete"><img src="resources/images/icons/cross.png" alt="Delete" /></a> 
										
									</td>
								</tr>';
                            }
                        }
                        ?> </tbody>
                </table>
            </div> <!-- End #tab1 -->
            <div class='tab-content<?php if ($val == 1) : ?>default-tab<?php endif ?>' id="tab2">
                <?php if (isset($_GET['sku'])) :
                    $sql = "SELECT * FROM colors WHERE product_id='" . $_GET['sku'] . "'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                endif
                ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <p>
                            <label>Product SKU</label>
                            <input class="text-input small-input" type="text" id="small-input" name="SKU" value="<?php if ($val == 1) {
                                                                                                                        echo $_GET['sku'];
                                                                                                                    } ?>">
                            <!-- Classes for input-notification: success, error, information, attention -->
                            <br /><small>A small description of the field</small>
                        </p>


                        <p>
                            <label>Quantity</label>
                            <input class="text-input small-input" type="text" id="small-input" name="quantity" value="<?php if ($val == 1) {
                                                                                                                            echo $_GET['quantity'];
                                                                                                                        } ?>" /> <!-- Classes for input-notification: success, error, information, attention -->
                            <br /><small>A small description of the field</small>
                        </p>

                        <label>Colour</label>
                        <select name="colour">
                            <option value="Black" <?php if (isset($row['Colour']) && $row['Colour'] == "Black") { ?> selected="selected" <?php } ?>>Black</option>
                            <option value="Blue" <?php if (isset($row['Colour']) && $row['Colour'] == "Blue") { ?> selected="selected" <?php } ?>>Blue</option>
                            <option value="Red" <?php if (isset($row['Colour']) && $row['Colour'] == "Red") { ?> selected="selected" <?php } ?>>Red</option>
                            <option value="Violet" <?php if (isset($row['Colour']) && $row['Colour'] == "Violet") { ?> selected="selected" <?php } ?>>Violet</option>
                            <option value="Yellow" <?php if (isset($row['Colour']) && $row['Colour'] == "Yellow") { ?> selected="selected" <?php } ?>>Yellow</option>
                            <option value="Green" <?php if (isset($row['Colour']) && $row['Colour'] == "Green") { ?> selected="selected" <?php } ?>>Green</option>
                        </select>

                        <p>
                            <input class="button" type="submit" value="Submit" name="submit" />
                        </p>

                    </fieldset>

                    <div class="clear"></div><!-- End .clear -->

                </form>

            </div> <!-- End #tab2 -->
        </div> <!-- End .content-box-content -->
    </div>
    <?php include('footer.php'); ?>