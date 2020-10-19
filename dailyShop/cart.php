<?php include('../admin/config.php');
error_reporting(0); ?>
<?php
if (isset($_GET['id'])) {
  if ($_GET['action'] == 'remove') {
    $id = $_GET['id'];
    $sql = "DELETE FROM cart WHERE id='$id' and username='$username'";
    $result = mysqli_query($conn, $sql);
  }
}
?>
<?php

if (isset($_GET['submit'])) {
  $sql = "SELECT * FROM cart";
  $result = mysqli_query($conn, $sql);
  $quant = $_GET['quant'];
  foreach ($quant as $key => $val) {
    $id = $key;
    $quantity = $val;
    $sql = "UPDATE cart SET quantity =$quantity WHERE id = $id;";
    $result = $conn->query($sql);
  }
}


?>
<?php
$msg = "";
$x = true;
if (isset($_GET['id'])) {
  if ($_GET['action'] == 'addtocart') {
    $sql = "SELECT * FROM cart";
    $result = mysqli_query($conn, $sql);
    $x = true;
    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        $x = false;
      }
    }
  }

  if ($x == true) {
    $id = $_GET['id'];
    $price = $_GET['price'];
    $filename = $_GET['img'];
    $name = $_GET['name'];
    $quantity = 1;
    $sql = "INSERT INTO cart VALUES('$username','$filename','$id',$price,$quantity,'$name')";
    mysqli_query($conn, $sql);
  }
}
?>
<?php include('header.php'); ?>

<!-- catg header banner section -->
<section id="aa-catg-head-banner">
  <img src="img/fashion/fashion-header-bg-8.jpg" alt="fashion img">
  <div class="aa-catg-head-banner-area">
    <div class="container">
      <div class="aa-catg-head-banner-content">
        <h2>Cart Page</h2>
        <ol class="breadcrumb">
          <li><a href="index.php">Home</a></li>
          <li class="active">Cart</li>
        </ol>
      </div>
    </div>
  </div>
</section>
<!-- / catg header banner section -->

<!-- Cart view section -->
<section id="cart-view">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="cart-view-area">
          <div class="cart-view-table">
            <form action="cart.php" method="GET">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th></th>
                      <th></th>
                      <th>Product</th>
                      <th>Price</th>
                      <th>Quantity</th>
                      <th>Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php include('config.php');
                    $sql = "SELECT * FROM cart";
                    $s = 0;

                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                      while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                          <td><a class="remove" href="cart.php?id=<?php echo $row['id']; ?>&name=<?php echo $row['username']; ?>&action=remove">
                              <fa class="fa fa-close"></fa>
                            </a></td>
                          <td><a href="#"><img src="../admin/upload/<?php echo $row['image']; ?>" alt="img"></a></td>
                          <td><a class="aa-cart-title" href="#"><?php echo $row['name']; ?></a></td>
                          <td> <?php echo $row['price']; ?></td>
                          <td><input class="aa-cart-quantity" type="number" name="quant[<?php echo $row['id']; ?>]" value="<?php echo $row['quantity']; ?>"></td>
                          <td><?php echo $row['price'] * $row['quantity']; ?></td>
                          <?php $s += $row['price'] * $row['quantity']; ?>
                        </tr>
                    <?php }
                    } ?>
                    <tr>
                      <td colspan="6" class="aa-cart-view-bottom">
                        <div class="aa-cart-coupon">
                          <input class="aa-coupon-code" type="text" placeholder="Coupon">
                          <input class="aa-cart-view-btn" type="submit" value="Apply Coupon">
                        </div>
                        <input class="aa-cart-view-btn" type="submit" name="submit" value="Update Cart">
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </form>

            <!-- Cart Total view -->
            <div class="cart-view-total">
              <h4>Cart Totals</h4>
              <table class="aa-totals-table">
                <tbody>
                  <tr>
                    <th>Subtotal</th>
                    <td><?php echo $s; ?></td>
                  </tr>
                  <tr>
                    <th>Total</th>
                    <td><?php echo $s; ?></td>
                  </tr>
                </tbody>
              </table>
              <a href="checkout.php" class="aa-cart-view-btn">Proced to Checkout</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- / Cart view section -->


<!-- Subscribe section -->
<section id="aa-subscribe">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="aa-subscribe-area">
          <h3>Subscribe our newsletter </h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex, velit!</p>
          <form action="" class="aa-subscribe-form">
            <input type="email" name="" id="" placeholder="Enter your Email">
            <input type="submit" value="Subscribe">
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- / Subscribe section -->
<?php include('footer.php'); ?>