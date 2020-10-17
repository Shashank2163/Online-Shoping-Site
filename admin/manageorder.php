<?php include('config.php');
include('header.php'); ?>
<?php
if (isset($_GET['sku'])) {
    $sku = $_GET['sku'];
    if ($_GET['action'] == 'delete') {
        $sql = "DELETE FROM cart WHERE id=$sku";
        if (mysqli_query($conn, $sql)) {
            echo "record deleted successfully";
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
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
            <h3>CART</h3>
            <ul class="content-box-tabs">
                <li><a href="#tab1" class="default-tab">Manage</a></li>
                <!-- <li><a href="#tab2">Add</a></li> -->
            </ul>
            <div class="clear"></div>
        </div>
        <!-- End .content-box-header -->
        <div class="content-box-content">
            <div class="tab-content default-tab" id="tab1">
                <!-- This is the target div. id must match the href of this div's tab -->

                <table>
                    <thead>
                        <tr>
                            <th><input class="check-all" type="checkbox" /></th>
                            <th>Product Id </th>
                            <th>Username</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Quantitity </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>

                    </tfoot>
                    <tbody>
                        <?php
                        include('config.php');
                        $limit = 3;
                        if (isset($_GET['page'])) {
                            $page = $_GET['page'];
                        } else {
                            $page = 1;
                        }
                        $offset = ($page - 1) * $limit;
                        $sql = "SELECT * FROM cart limit {$offset},{$limit}";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            //echo "yes here it is";
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr>
									<td><input type="checkbox"/></td>
									<td>' . $row["id"] . '</td>
									<td>' . $row["username"] . '</td>
									<td>' . $row["price"] . '</td>
									<td><img src="upload/' . $row["image"] . '"  width="100" height="100"></td>	
                                    <td>' . $row["name"] . '</td>
                                    <td>' . $row["quantity"] . '</td>
									
									<td>
										<!-- Icons -->
										 <a href="updateorder.php?sku=' . $row["username"] . '&name=' . $row["name"] . '&price=' . $row["price"] . '&image=' . $row["image"] . '&quantity=' . $row["quantity"] . '&action=edit" title="Edit"><img src="resources/images/icons/pencil.png" alt="Edit" /></a>
										 <a id="subject" href="manageorder.php?sku=' . $row["id"] . '&action=delete" title="Delete"><img src="resources/images/icons/cross.png" alt="Delete" /></a> 
										
									</td>
								</tr>';
                            }
                        }
                        ?>
                    </tbody>
            </div>
            </table>
            <?php
            $sql1 = "Select * from cart";
            $result1 = mysqli_query($conn, $sql1) or die("error");
            if (mysqli_num_rows($result1) > 0) {
                $total_records = mysqli_num_rows($result1);

                $total_page = ceil($total_records / $limit);
                echo '<div class="pagination">';
                if ($page > 1) {
                    echo '<a href="manageorder.php.php?page=' . ($page - 1) . '" title="First Page">Previous>></a>';
                }
                for ($i = 1; $i <= $total_page; $i++) {
                    if ($i == $page) {
                        $active = "current";
                    } else {
                        $active = "";
                    }
                    echo '<a  class="' . $active . '" href="products.php?page=' . $i . '" class="number" title="1">' . $i . '</a>';
                }
                if ($total_page > $page) {
                    echo '<a href="manageorder.php?page=' . ($page + 1) . '" title="Next Page">Next>></a>';
                }
                echo '</div>';
            }
            ?>
            <!-- <div class="pagination"> -->
        </div> <!-- End .pagination -->
        <!-- End #tab1 -->

        <div class="tab-content" id="tab2">
            <?php if (isset($_GET['sku'])) :
                $sql = "SELECT * FROM `cart` WHERE ProductSKU='" . $_GET['sku'] . "'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
            endif
            ?>
            <form action="" method="post" enctype="multipart/form-data">
                <fieldset>
                    <p>
                        <label>Name</label>
                        <input class="text-input small-input" type="text" id="small-input" name="name" value="" /> <!-- Classes for input-notification: success, error, information, attention -->
                        <br /><small>A small description of the field</small>
                    </p>
                    <p>
                        <label>Price</label>
                        <input class="text-input small-input" type="text" id="small-input" name="price" value="" />
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
                        <label>Description</label>
                        <textarea name="short_description" rows="4" cols="50">
                            </textarea>
                    </p>
                    <p>
                        <input class="button" type="submit" value="Submit" name="submit" />
                    </p>
                </fieldset>

                <div class="clear"></div>
                <!-- End .clear -->
            </form>
        </div> <!-- End #tab2 -->
    </div> <!-- End .content-box-content -->
</div>
<?php include('footer.php'); ?>