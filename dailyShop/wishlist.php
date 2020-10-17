<?php include('header.php') ?>
<?php
if (isset($_GET['id'])) {
  if ($_GET['action'] == 'remove') {
    $id = $_GET['id'];
    $sql = "DELETE FROM wishlist WHERE id='$id' and username='$username'";
    $result = mysqli_query($conn, $sql);
  }
}
?>
<?php
$msg = "";
if (isset($_GET['id'])) {
  if ($_GET['action'] == 'addtocart') {
    $sql = "SELECT * FROM cart";
    $result = mysqli_query($conn, $sql);
    $x = true;
    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        if ($_GET['id'] == $row['id'] && $username == $row['username']) {
          $id = $_GET['id'];
          $price = $_GET['price'];
          $filename = $_GET['img'];
          $quantity = $row['quantity'];
          $quantity++;
          $x = false;
          $sql = "UPDATE  cart SET quantity='$quantity' where id='$id' and username='$username'";
          mysqli_query($conn, $sql);
        }
      }
    }
    if ($x == true) {
      $id = $_GET['id'];
      $price = $_GET['price'];
      $filename = $_GET['img'];
      $name = $_GET['name'];
      $quantity = 1;
      $sql = "INSERT INTO wishlist VALUES('$username','$filename','$id',$price,$quantity,'$name')";
      mysqli_query($conn, $sql);
    }
  }
}
?>

<!-- catg header banner section -->
<section id="aa-catg-head-banner">
  <img src="img/fashion/fashion-header-bg-8.jpg" alt="fashion img">
  <div class="aa-catg-head-banner-area">
    <div class="container">
      <div class="aa-catg-head-banner-content">
        <h2>Wishlist Page</h2>
        <ol class="breadcrumb">
          <li><a href="index.php">Home</a></li>
          <li class="active">Wishlist</li>
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
          <div class="cart-view-table aa-wishlist-table">
            <form action="">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th></th>
                      <th></th>
                      <th>Product</th>
                      <th>Price</th>
                      <th>Stock Status</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php include('config.php');
                    $sql = "SELECT * FROM wishlist";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                      while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                          <td><a class="remove" href="wishlist.php?id=<?php echo $row['id']; ?>&name=<?php echo $row['username']; ?>&action=remove">
                              <fa class="fa fa-close"></fa>
                            </a></td>
                          <td><a href="#"><img src="../admin/upload/<?php echo $row['image']; ?>" alt="img"></td>
                          <td><a class="aa-cart-title" href="#"></a><?php echo $row['name']; ?></td>
                          <td><?php echo $row['price']; ?></td>
                          <td>In Stock</td>
                          <td><a href="cart.php?id=<?php echo $row['product_id']; ?>&price=<?php echo $row['price']; ?>&img=<?php echo $row['image']; ?>&name=<?php echo $row['name']; ?>&action=addtocart" class="aa-add-to-cart-btn">Add To Cart</a></td>
                        </tr>
                    <?php }
                    } ?>


                  </tbody>
                </table>
              </div>
            </form>
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
<?php include('footer.php') ?>