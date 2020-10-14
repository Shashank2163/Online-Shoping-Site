<?php include('config.php');
include('header.php'); ?>
<?php
$val = 0;
if (isset($_GET['sku'])) {
    $sku = $_GET['sku'];
    if ($_GET['action'] == 'delete') {
        $sql = "DELETE FROM users WHERE user_id=$sku";
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
        $sku = $_POST["SKU"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $email = $_POST["email"];
        $role = $_POST["role"];
        $sql = "UPDATE users SET `user_id`=$sku,`username`='$username',`password`='$password',`email`='$email',`role`='$role' WHERE `user_id`=$sku";
        $result = mysqli_query($conn, $sql);
        header('location:users.php');
    } else {
        if ($val == 0) {
            $sku = $_POST["SKU"];
            $username = $_POST["username"];
            $password = $_POST["password"];
            $email = $_POST["email"];
            $role = $_POST["role"];
            $sql = "INSERT INTO users VALUES($sku,'$username','$password','$email','$role')";
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
            <h3>USERS</h3>
            <ul class="content-box-tabs">
                <li><a href="#tab1" <?php if ($val == 0) : ?>class="default-tab" <?php
                                                                                endif ?>>Manage</a></li>
                <li><a href="#tab2" <?php if ($val == 1) : ?>class="default-tab" <?php
                                                                                endif ?>>Add</a></li>
            </ul>
            <div class="clear"></div>
        </div>
        <!-- End .content-box-header -->
        <div class="content-box-content">
            <div class='tab-content<?php if ($val == 0) : ?>default-tab<?php
                                                                    endif ?>' id="tab1">
                <!-- This is the target div. id must match the href of this div's tab -->
                <table>
                    <thead>
                        <tr>
                            <th><input class="check-all" type="checkbox" /></th>
                            <th>User_id</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Email</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        // $sql="SELECT * FROM addproduct LIMIT $offset, $limit";
                        $sql = "SELECT * FROM users";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            //echo "yes here it is";
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr>
									<td><input type="checkbox"/></td>
                                    <td>' . $row["user_id"] . '</td>
                                    <td>' . $row["username"] . '</td>
                                    <td>' . $row["password"] . '</td>
                                    <td>' . $row["email"] . '</td>
                                    <td>' . $row["role"] . '</td>
								
									<td>
										<!-- Icons -->
										 <a href="users.php?sku=' . $row["user_id"] . '&username=' . $row["username"] . '&email=' . $row["email"] . '&action=edit" title="Edit"><img src="resources/images/icons/pencil.png" alt="Edit" /></a>
										 <a id="subject" href="users.php?sku=' . $row["user_id"] . '&action=delete" title="Delete"><img src="resources/images/icons/cross.png" alt="Delete" /></a> 
										
									</td>
								</tr>';
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- End #tab1 -->
            <div class='tab-content<?php if ($val == 1) : ?>default-tab<?php
                                                                    endif ?>' id="tab2">
                <?php if (isset($_GET['sku'])) :
                    $sql = "SELECT * FROM users WHERE user_id='" . $_GET['sku'] . "'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                endif
                ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <p>
                            <label>User Id</label>
                            <input class="text-input small-input" type="text" id="small-input" name="SKU" value="<?php if ($val == 1) {
                                                                                                                        echo $_GET['sku'];
                                                                                                                    } ?>" /> <!-- Classes for input-notification: success, error, information, attention -->
                            <br /><small>A small description of the field</small>
                        </p>
                        <p>
                            <label>Username</label>
                            <input class="text-input small-input" type="text" id="small-input" name="username" value="<?php if ($val == 1) {
                                                                                                                            echo $_GET['username'];
                                                                                                                        } ?>" /> <!-- Classes for input-notification: success, error, information, attention -->
                            <br /><small>A small description of the field</small>
                        </p>
                        <p>
                            <label>Password</label>
                            <input class="text-input small-input" type="passwod" id="small-input" name="password" value="" /> <!-- Classes for input-notification: success, error, information, attention -->
                            <br /><small>A small description of the field</small>
                        </p>
                        <p>
                            <label>Email</label>
                            <input class="text-input small-input" type="email" id="small-input" name="email" value="<?php if ($val == 1) {
                                                                                                                        echo $_GET['email'];
                                                                                                                    } ?>" /> <!-- Classes for input-notification: success, error, information, attention -->
                            <br /><small>A small description of the field</small>
                        </p>
                        <label>Role</label>
                        <select name="role">
                            <option value="admin">User</option>
                            <option value="user">Admin</option>

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