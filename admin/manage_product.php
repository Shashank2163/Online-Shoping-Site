<?php include 'siderbar.php';
include('header.php');
?>
<!-- include('config.php'); -->



<?php
$limit = 3;
//$page=$_GET['page'];
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
if (isset($_GET['click'])) {
    if ($_GET['click'] == "next") {
        $page = $page + 1;
    }

    if ($_GET['click'] == "last") {
        //$page=$total_pages;

    }
}

$offset = ($page - 1) * $limit;

if (isset($_GET['sku'])) {
    $sku = $_GET['sku'];
    if ($_GET['action'] == 'delete') {
        //echo "yes delete button is pressed";
        $sql = "DELETE FROM addproduct WHERE ProductSKU=$sku";
        if (mysqli_query($conn, $sql)) {
            echo "record deleted successfully";
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }
    } elseif ($_GET['action'] == 'edit') {
        // header('location : add_product.php');
        // echo "edit button is pressed";
        // $sql="SELECT * FROM addproduct WHERE ProductSKU='$sku'";
        //          $result=mysqli_query($conn,$sql);
        //          echo "yes here it is";
        //          if(mysqli_num_rows($result)>0){
        //          	echo"row is greater then 0";
        //          	$row=mysqli_fetch_assoc($result);
        //          	print_r($row);
        //header('location : add_product.php');

    }
}
?>

<div id="main-content">
    <!-- Main Content Section with everything -->
    <h2>Welcome John</h2>



    <div class="content-box">
        <!-- Start Content Box -->

        <div class="content-box-header">

            <h3>Content box</h3>

            <ul class="content-box-tabs">
                <li><a href="#tab1" class="default-tab">Table</a></li> <!-- href must be unique and match the id of target div -->
                <li><a href="#tab2">Forms</a></li>
            </ul>

            <div class="clear"></div>

        </div> <!-- End .content-box-header -->

        <div class="content-box-content">

            <div class="tab-content default-tab" id="tab1">


                <div class="notification attention png_bg">
                    <a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                    <div>
                        This is a Content Box. You can put whatever you want in it. By the way, you can close this notification with the top-right cross.
                    </div>
                </div>

                <table>

                    <thead>
                        <tr>
                            <th><input class="check-all" type="checkbox" /></th>
                            <th>Product SKU</th>
                            <th>Name</th>
                            <th>Brand</th>
                            <th>Price</th>
                            <th>Quantity</th>

                            <th>Action</th>
                        </tr>

                    </thead>

                    <tfoot>
                        <tr>
                            <td colspan="6">
                                <div class="bulk-actions align-left">
                                    <select name="dropdown">
                                        <option value="option1">Choose an action...</option>
                                        <option value="option2">Edit</option>
                                        <option value="option3">Delete</option>
                                    </select>
                                    <a class="button" href="#">Apply to selected</a>
                                </div>

                                <div class="pagination">
                                    <?php
                                    $sql1 = "SELECT * FROM addproduct";
                                    $result1 = mysqli_query($conn, $sql1) or die("query failed");
                                    if (mysqli_num_rows($result1) > 0) {
                                        $total_records = mysqli_num_rows($result1);

                                        $total_pages = ceil($total_records / $limit);
                                        //echo($total_pages);
                                        echo '<a href="manage_product.php?page=' . (($total_pages - $total_pages) + 1) . '" title="First Page">&laquo; First</a>';
                                        if ($page > 1) {
                                            echo '<a href="manage_product.php?page=' . ($page - 1) . '" title="Previous Page">&laquo; Previous</a>';
                                        }
                                        if ($total_pages > $page) {
                                            echo '<a href="manage_product.php?click=next&page=' . $page . '"title="Next Page">Next &raquo;</a>';
                                        }


                                        for ($i = 1; $i <= $total_pages; $i++) {
                                            echo '<a href="manage_product.php?page=' . $i . '" class="number" title="1">' . $i . '</a>';
                                        }

                                        echo '<a href="manage_product.php?click=last&page=' . $total_pages . '" title="Last Page">Last &raquo;</a>';
                                    }
                                    ?>

                                </div> <!-- End .pagination -->
                                <div class="clear"></div>
                            </td>
                        </tr>
                    </tfoot>

                    <tbody>

                        <?php

                        $sql = "SELECT * FROM addproduct LIMIT $offset, $limit";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            //echo "yes here it is";
                            while ($row = mysqli_fetch_assoc($result)) {


                                echo '<tr>
									<td><input type="checkbox"/></td>
									<td>' . $row["ProductSKU"] . '</td>
									<td>' . $row["Name"] . '</td>
									<td>' . $row["Brand"] . '</td>
									<td>' . $row["Price"] . '</td>
									<td>' . $row["Quantity"] . '</td>				
									<td>
										<!-- Icons -->
										 <a href="add_product.php?sku=' . $row["ProductSKU"] . '&action=edit" title="Edit"><img src="resources/images/icons/pencil.png" alt="Edit" /></a>
										 <a href="manage_product.php?sku=' . $row["ProductSKU"] . '&action=delete" title="Delete"><img src="resources/images/icons/cross.png" alt="Delete" /></a> 
										
									</td>
								</tr>';
                            }
                        }

                        ?>
                    </tbody>
                </table>
            </div>
        </div>


        <!-- End #tab1 -->
        <?php include('footer.php'); ?>