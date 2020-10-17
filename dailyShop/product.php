<?php
error_reporting(0);
?>
<?php include('../admin/config.php');

?>
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
          $sql = "UPDATE  cart SET quantity='$quantity' where id='$id' ";
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
      $sql = "INSERT INTO cart VALUES('$username','$filename','$id',$price,$quantity,'$name')";
      mysqli_query($conn, $sql);
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Daily Shop | Product</title>

  <!-- Font awesome -->
  <link href="css/font-awesome.css" rel="stylesheet">
  <!-- Bootstrap -->
  <link href="css/bootstrap.css" rel="stylesheet">
  <!-- SmartMenus jQuery Bootstrap Addon CSS -->
  <link href="css/jquery.smartmenus.bootstrap.css" rel="stylesheet">
  <!-- Product view slider -->
  <link rel="stylesheet" type="text/css" href="css/jquery.simpleLens.css">
  <!-- slick slider -->
  <link rel="stylesheet" type="text/css" href="css/slick.css">
  <!-- price picker slider -->
  <link rel="stylesheet" type="text/css" href="css/nouislider.css">
  <!-- Theme color -->
  <link id="switcher" href="css/theme-color/default-theme.css" rel="stylesheet">
  <!-- Top Slider CSS -->
  <link href="css/sequence-theme.modern-slide-in.css" rel="stylesheet" media="all">

  <!-- Main style sheet -->
  <link href="css/style.css" rel="stylesheet">

  <!-- Google Font -->
  <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>


  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<!-- !Important notice -->
<!-- Only for product page body tag have to added .productPage class -->

<body class="productPage">
  <!-- wpf loader Two -->
  <div id="wpf-loader-two">
    <div class="wpf-loader-two-inner">
      <span>Loading</span>
    </div>
  </div>
  <!-- / wpf loader Two -->
  <!-- SCROLL TOP BUTTON -->
  <a class="scrollToTop" href="#"><i class="fa fa-chevron-up"></i></a>
  <!-- END SCROLL TOP BUTTON -->


  <!-- Start header section -->
  <header id="aa-header">
    <!-- start header top  -->
    <div class="aa-header-top">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="aa-header-top-area">
              <!-- start header top left -->
              <div class="aa-header-top-left">
                <!-- start language -->
                <div class="aa-language">
                  <div class="dropdown">
                    <a class="btn dropdown-toggle" href="#" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                      <img src="img/flag/english.jpg" alt="english flag">ENGLISH
                      <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                      <li><a href="#"><img src="img/flag/french.jpg" alt="">FRENCH</a></li>
                      <li><a href="#"><img src="img/flag/english.jpg" alt="">ENGLISH</a></li>
                    </ul>
                  </div>
                </div>
                <!-- / language -->

                <!-- start currency -->
                <div class="aa-currency">
                  <div class="dropdown">
                    <a class="btn dropdown-toggle" href="#" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                      <i class="fa fa-usd"></i>USD
                      <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                      <li><a href="#"><i class="fa fa-euro"></i>EURO</a></li>
                      <li><a href="#"><i class="fa fa-jpy"></i>YEN</a></li>
                    </ul>
                  </div>
                </div>
                <!-- / currency -->
                <!-- start cellphone -->
                <div class="cellphone hidden-xs">
                  <p><span class="fa fa-phone"></span>00-62-658-658</p>
                </div>
                <!-- / cellphone -->
              </div>
              <!-- / header top left -->
              <div class="aa-header-top-right">
                <ul class="aa-head-top-nav-right">
                  <li><a href="account.php">My Account</a></li>
                  <li class="hidden-xs"><a href="wishlist.php">Wishlist</a></li>
                  <li class="hidden-xs"><a href="cart.php">My Cart</a></li>
                  <li class="hidden-xs"><a href="checkout.php">Checkout</a></li>
                  <li><a href="" data-toggle="modal" data-target="#login-modal">Login</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- / header top  -->

    <!-- start header bottom  -->
    <div class="aa-header-bottom">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="aa-header-bottom-area">
              <!-- logo  -->
              <div class="aa-logo">
                <!-- Text based logo -->
                <a href="index.php">
                  <span class="fa fa-shopping-cart"></span>
                  <p>daily<strong>Shop</strong> <span>Your Shopping Partner</span></p>
                </a>
                <!-- img based logo -->
                <!-- <a href="index.html"><img src="img/logo.jpg" alt="logo img"></a> -->
              </div>
              <!-- / logo  -->
              <!-- cart box -->

              <div class="aa-cartbox">
                <a class="aa-cart-link" href="#">
                  <span class="fa fa-shopping-basket"></span>
                  <span class="aa-cart-title">SHOPPING CART</span>
                  <?php include('config.php');
                  $sql = "SELECT * FROM cart";
                  $result = mysqli_query($conn, $sql);
                  $val = mysqli_num_rows($result) ?>
                  <?php echo "<span class='aa-cart-notify'>$val</span>"; ?>
                </a>
                <div class="aa-cartbox-summary">
                  <?php include('config.php');
                  $sql = "SELECT * FROM cart";
                  $s = 0;
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                      <ul>
                        <li>
                          <a class="aa-cartbox-img" href="#"><img src="../admin/upload/<?php echo $row['image']; ?>" alt="img"></a>
                          <div class="aa-cartbox-info">
                            <h4><a href="#"><?php echo $row['name'] ?></a></h4>
                            <p><?php echo $row['quantity'] . "x" . $row['price'] ?></p>
                          </div>
                          <a class="aa-remove-product" href="product.php?id=<?php echo $row['id']; ?>&name=<?php echo $row['username']; ?>&action=remove"><span class="fa fa-times"></span></a>
                        </li>
                        <?php $s = $row['quantity'] * $row['price'] ?>
                        <li>
                          <span class="aa-cartbox-total-title">
                            Total
                          </span>
                          <span class="aa-cartbox-total-price">
                            <?php echo $s ?>
                          </span>
                        </li>
                      </ul>
                    <?php } ?>
                  <?php } ?>
                  <a class="aa-cartbox-checkout aa-primary-btn" href="cart.php">Checkout</a>
                </div>
              </div>
              <!-- / cart box -->
              <!-- search box -->
              <div class="aa-search-box">
                <form action="">
                  <input type="text" name="" id="" placeholder="Search here ex. 'man' ">
                  <button type="submit"><span class="fa fa-search"></span></button>
                </form>
              </div>
              <!-- / search box -->
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- / header bottom  -->
  </header>
  <!-- / header section -->
  <!-- menu -->
  <section id="menu">
    <div class="container">
      <div class="menu-area">
        <!-- Navbar -->
        <div class="navbar navbar-default" role="navigation">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>
          <div class="navbar-collapse collapse">
            <!-- Left nav -->
            <ul class="nav navbar-nav">
              <li><a href="index.php">Home</a></li>
              <li><a href="#">Men <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Casual</a></li>
                  <li><a href="#">Sports</a></li>
                  <li><a href="#">Formal</a></li>
                  <li><a href="#">Standard</a></li>
                  <li><a href="#">T-Shirts</a></li>
                  <li><a href="#">Shirts</a></li>
                  <li><a href="#">Jeans</a></li>
                  <li><a href="#">Trousers</a></li>
                  <li><a href="#">And more.. <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a href="#">Sleep Wear</a></li>
                      <li><a href="#">Sandals</a></li>
                      <li><a href="#">Loafers</a></li>
                    </ul>
                  </li>
                </ul>
              </li>
              <li><a href="#">Women <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Kurta & Kurti</a></li>
                  <li><a href="#">Trousers</a></li>
                  <li><a href="#">Casual</a></li>
                  <li><a href="#">Sports</a></li>
                  <li><a href="#">Formal</a></li>
                  <li><a href="#">Sarees</a></li>
                  <li><a href="#">Shoes</a></li>
                  <li><a href="#">And more.. <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a href="#">Sleep Wear</a></li>
                      <li><a href="#">Sandals</a></li>
                      <li><a href="#">Loafers</a></li>
                      <li><a href="#">And more.. <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li><a href="#">Rings</a></li>
                          <li><a href="#">Earrings</a></li>
                          <li><a href="#">Jewellery Sets</a></li>
                          <li><a href="#">Lockets</a></li>
                          <li class="disabled"><a class="disabled" href="#">Disabled item</a></li>
                          <li><a href="#">Jeans</a></li>
                          <li><a href="#">Polo T-Shirts</a></li>
                          <li><a href="#">SKirts</a></li>
                          <li><a href="#">Jackets</a></li>
                          <li><a href="#">Tops</a></li>
                          <li><a href="#">Make Up</a></li>
                          <li><a href="#">Hair Care</a></li>
                          <li><a href="#">Perfumes</a></li>
                          <li><a href="#">Skin Care</a></li>
                          <li><a href="#">Hand Bags</a></li>
                          <li><a href="#">Single Bags</a></li>
                          <li><a href="#">Travel Bags</a></li>
                          <li><a href="#">Wallets & Belts</a></li>
                          <li><a href="#">Sunglases</a></li>
                          <li><a href="#">Nail</a></li>
                        </ul>
                      </li>
                    </ul>
                  </li>
                </ul>
              </li>
              <li><a href="#">Kids <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Casual</a></li>
                  <li><a href="#">Sports</a></li>
                  <li><a href="#">Formal</a></li>
                  <li><a href="#">Standard</a></li>
                  <li><a href="#">T-Shirts</a></li>
                  <li><a href="#">Shirts</a></li>
                  <li><a href="#">Jeans</a></li>
                  <li><a href="#">Trousers</a></li>
                  <li><a href="#">And more.. <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a href="#">Sleep Wear</a></li>
                      <li><a href="#">Sandals</a></li>
                      <li><a href="#">Loafers</a></li>
                    </ul>
                  </li>
                </ul>
              </li>
              <li><a href="#">Sports</a></li>
              <li><a href="#">Digital <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Camera</a></li>
                  <li><a href="#">Mobile</a></li>
                  <li><a href="#">Tablet</a></li>
                  <li><a href="#">Laptop</a></li>
                  <li><a href="#">Accesories</a></li>
                </ul>
              </li>
              <li><a href="#">Furniture</a></li>
              <li><a href="blog-archive.php">Blog <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="blog-archive.php">Blog Style 1</a></li>
                  <li><a href="blog-archive-2.php">Blog Style 2</a></li>
                  <li><a href="blog-single.php">Blog Single</a></li>
                </ul>
              </li>
              <li><a href="contact.php">Contact</a></li>
              <li><a href="#">Pages <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="product.php">Shop Page</a></li>
                  <li><a href="product-detail.php">Shop Single</a></li>
                  <li><a href="404.html">404 Page</a></li>
                </ul>
              </li>
            </ul>
          </div>
          <!--/.nav-collapse -->
        </div>
      </div>
    </div>
    </div>
  </section>
  <!-- / menu -->

  <!-- catg header banner section -->
  <section id="aa-catg-head-banner">
    <img src="img/fashion/fashion-header-bg-8.jpg" alt="fashion img">
    <div class="aa-catg-head-banner-area">
      <div class="container">
        <div class="aa-catg-head-banner-content">
          <h2>Fashion</h2>
          <ol class="breadcrumb">
            <li><a href="index.php">Home</a></li>
            <li class="active">Women</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <!-- / catg header banner section -->

  <!-- product category -->
  <section id="aa-product-category">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-8 col-md-push-3">
          <div class="aa-product-catg-content">
            <div class="aa-product-catg-head">
              <div class="aa-product-catg-head-left">
                <form action="" class="aa-sort-form">
                  <label for="">Sort by</label>
                  <select name="">
                    <option value="1" selected="Default">Default</option>
                    <option value="2">Name</option>
                    <option value="3">Price</option>
                    <option value="4">Date</option>
                  </select>
                </form>
                <form action="" class="aa-show-form">
                  <label for="">Show</label>
                  <select name="">
                    <option value="1" selected="12">12</option>
                    <option value="2">24</option>
                    <option value="3">36</option>
                  </select>
                </form>
              </div>
              <div class="aa-product-catg-head-right">
                <a id="grid-catg" href="#"><span class="fa fa-th"></span></a>
                <a id="list-catg" href="#"><span class="fa fa-list"></span></a>
              </div>
            </div>

            <div class="aa-product-catg-body">
              <ul class="aa-product-catg">
                <!-- start single product item -->
                <?php
                error_reporting(0);
                include('config.php');
                $limit = 9;
                if (isset($_GET['page'])) {
                  $page = $_GET['page'];
                } else {
                  $page = 1;
                }
                $offset = ($page - 1) * $limit;
                // $sql = "SELECT * FROM productsnew limit {$offset},{$limit}";
                if ('men' == $_GET['id']) {
                  $sql = "SELECT * FROM productsnew  where category='Men' ";
                } else if ('women' == $_GET['id']) {
                  $sql = "SELECT * FROM productsnew where category='Women'";
                } else if ('kids' == $_GET['id']) {

                  $sql = "SELECT * FROM productsnew where category='Kids'";
                } else if ('electronics' == $_GET['id']) {

                  $sql = "SELECT * FROM productsnew where category='Electronis'";
                } else if ('sports' == $_GET['id']) {

                  $sql = "SELECT * FROM productsnew where category='Sports'";
                } else if ('fashion' == $_GET['val']) {
                  $sql = "SELECT * FROM productsnew where tags='fashion' ";
                } else if ('ecommerce' == $_GET['val']) {
                  $sql = "SELECT * FROM productsnew where tags='ecommerce'";
                } else if ('shop' == $_GET['id']) {

                  $sql = "SELECT * FROM productsnew where tags='shop'";
                } else if ('handbag' == $_GET['val']) {

                  $sql = "SELECT * FROM productsnew where tags='handbag'";
                } else if ('laptop' == $_GET['val']) {

                  $sql = "SELECT * FROM productsnew where tags='laptop'";
                } else if ('headpone' == $_GET['val']) {

                  $sql = "SELECT * FROM productsnew where tags='headphone'";
                } else {
                  $sql = "SELECT * FROM productsnew limit {$offset},{$limit}";
                }
                // $sql = "SELECT * FROM productsnew"; 
                ?>
                <?php $result = mysqli_query($conn, $sql); ?>
                <?php $result = mysqli_query($conn, $sql); ?>
                <?php if (mysqli_num_rows($result) > 0) { ?>
                  <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <li>
                      <figure>
                        <a class="aa-product-img" href="product-detail.php?id=<?php echo $row['product_id']; ?>&price=
                            <?php echo $row['price']; ?>&img=<?php echo $row['image']; ?>&name=<?php echo $row['name']; ?>"><img src="../admin/upload/<?php echo $row['image']; ?>" alt="polo shirt img"></a>
                        <a class="aa-add-card-btn" href="product.php?id=<?php echo $row['product_id']; ?>&price=
                            <?php echo $row['price']; ?>&img=<?php echo $row['image']; ?>&name=<?php echo $row['name']; ?>&action=addtocart"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                        <figcaption>
                          <h4 class="aa-product-title"><a href="#"><?php echo $row['name']; ?></a></h4>
                          <span class="aa-product-price"><?php echo $row['price']; ?></span><span class="aa-product-price"><del>$65.50</del></span>
                          <p class="aa-product-descrip"><?php echo $row['description']; ?></p>
                        </figcaption>
                      </figure>
                      <div class="aa-product-hvr-content">
                        <a href="wishlist.php?id=<?php echo $row['product_id']; ?>&price=
                            <?php echo $row['price']; ?>&img=<?php echo $row['image']; ?>&name=<?php echo $row['name']; ?>&action=addtocart" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                        <a href="product-detail.php?id=<?php echo $row['product_id']; ?>&price=
                            <?php echo $row['price']; ?>&img=<?php echo $row['image']; ?>&name=<?php echo $row['name']; ?>"><span class="fa fa-search"></span></a>
                      </div>
                      <!-- product badge -->
                      <span class="aa-badge aa-sale" href="#">SALE!</span>
                    </li>
                  <?php   } ?>
                <?php } ?>

                <!---END SINGLE ITEM
                -->
                <!-- quick view modal -->
                <div class="modal fade" id="quick-view-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <div class="row">
                          <!-- Modal view slider -->
                          <div class="col-md-5 col-sm-5 col-xs-12">
                            <div class="aa-product-view-slider">
                              <div id="demo-1" class="simpleLens-gallery-container">
                                <div class="simpleLens-container">
                                  <div class="simpleLens-big-image-container"><a data-lens-image="../admin/upload/<?php echo $image; ?>" class="simpleLens-lens-image"><img src="../admin/upload/<?php echo $image; ?>" class="simpleLens-big-image"></a></div>
                                </div>
                                <div class="simpleLens-thumbnails-container">

                                  <a data-big-image="../admin/upload/<?php echo $image; ?>" data-lens-image="../admin/upload/<?php echo $image; ?>" class="simpleLens-thumbnail-wrapper" href="#">
                                    <img src="../admin/upload/<?php echo $image; ?>" height="100" width="100">
                                  </a>
                                  <a data-big-image="../admin/upload/<?php echo $image; ?>" data-lens-image="../admin/upload/<?php echo $image; ?>" class="simpleLens-thumbnail-wrapper" href="#">
                                    <img src="../admin/upload/<?php echo $image; ?>" height="100" width="100">
                                  </a>
                                  <a data-big-image="../admin/upload/<?php echo $image; ?>" data-lens-image="../admin/upload/<?php echo $image; ?>" class="simpleLens-thumbnail-wrapper" href="#">
                                    <img src="../admin/upload/<?php echo $image; ?>" height="100" width="100">
                                  </a>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- Modal view content -->
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="aa-product-view-content">
                              <h3><?php echo $name; ?></h3>
                              <div class="aa-price-block">
                                <span class="aa-product-view-price"><?php echo $price; ?></span>
                                <p class="aa-product-avilability">Avilability: <span>In stock</span></p>
                              </div>
                              <h4>Size</h4>
                              <div class="aa-prod-view-size">
                                <a href="#">S</a>
                                <a href="#">M</a>
                                <a href="#">L</a>
                                <a href="#">XL</a>
                              </div>
                              <div class="aa-prod-quantity">
                                <form action="">
                                  <select name="" id="">
                                    <option value="0" selected="1">1</option>
                                    <option value="1">2</option>
                                    <option value="2">3</option>
                                    <option value="3">4</option>
                                    <option value="4">5</option>
                                    <option value="5">6</option>
                                  </select>
                                </form>
                                <p class="aa-prod-category">
                                  Category: <a href="#"><?php echo $name; ?></a>
                                </p>
                              </div>
                              <div class="aa-prod-view-bottom">
                                <a href="#" class="aa-add-to-cart-btn"><span class="fa fa-shopping-cart"></span>Add To
                                  Cart</a>
                                <a href="product-detail.php?id=<?php echo $row['product_id']; ?>&price=
                            <?php echo $row['price']; ?>&img=<?php echo $row['image']; ?>&name=<?php echo $row['name']; ?>" class="aa-add-to-cart-btn">View Details</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div>
                <!-- / quick view modal -->
            </div>
            <div class="aa-product-catg-pagination">
              <nav>
                <?php
                $sql1 = "Select * from productsnew";
                $result1 = mysqli_query($conn, $sql1) or die("error");
                if (mysqli_num_rows($result1) > 0) {
                  $total_records = mysqli_num_rows($result1);
                  $total_page = ceil($total_records / $limit); ?>
                  <div class="pagination">

                  <?php if ($page > 1) {
                    echo '<a href="product.php?page=' . ($page - 1) . '" title="First Page">|Previous|</a>';
                  }
                  for ($i = 1; $i <= $total_page; $i++) {
                    if ($i == $page) {
                      $active = "current";
                    } else {
                      $active = "";
                    }
                    echo '<a  class="' . $active . '" href="product.php?page=' . $i . '" class="number" title="1">|' . $i . '|</a></li>';
                  }
                  if ($total_page > $page) {
                    echo '<a href="product.php?page=' . ($page + 1) . '" title="Next Page">Next>></a>';
                  }
                }
                  ?>
                  </div>
              </nav>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-4 col-md-pull-9">
          <aside class="aa-sidebar">
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Category</h3>
              <ul class="aa-catg-nav">
                <li><a href="product.php?id=men">Men</a></li>
                <li><a href="product.php?id=women">Women</a></li>
                <li><a href="product.php?id=kids">Kids</a></li>
                <li><a href="product.php?id=electronics">Electornics</a></li>
                <li><a href="product.php?id=sports">Sports</a></li>
              </ul>
            </div>
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Tags</h3>
              <div class="tag-cloud">
                <a href="product.php?val=fashion">Fashion</a>
                <a href=" product.php?val=ecommerce">Ecommerce</a>
                <a href="product.php?val=shop">Shop</a>
                <a href=" product.php?val=handbag">Hand Bag</a>
                <a href="product.php?val=laptop">Laptop</a>
                <a href=" product.php?val=headphone">Head Phone</a>
              </div>
            </div>
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Shop By Price</h3>
              <!-- price range -->
              <div class="aa-sidebar-price-range">
                <form action="product.php?id=skip-value-lower">
                  <div id="skipstep" class="noUi-target noUi-ltr noUi-horizontal noUi-background">
                  </div>
                  <span id="skip-value-lower" class="example-val"></span>
                  <span id="skip-value-upper" class="example-val"></span>
                  <button class="aa-filter-btn" type="submit">Filter</button>
                </form>
              </div>
            </div>
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Shop By Color</h3>
              <div class="aa-color-tag">
                <a class="aa-color-green" href="#"></a>
                <a class="aa-color-yellow" href="#"></a>
                <a class="aa-color-pink" href="#"></a>
                <a class="aa-color-purple" href="#"></a>
                <a class="aa-color-blue" href="#"></a>
                <a class="aa-color-orange" href="#"></a>
                <a class="aa-color-gray" href="#"></a>
                <a class="aa-color-black" href="#"></a>
                <a class="aa-color-white" href="#"></a>
                <a class="aa-color-cyan" href="#"></a>
                <a class="aa-color-olive" href="#"></a>
                <a class="aa-color-orchid" href="#"></a>
              </div>
            </div>
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Recently Views</h3>
              <div class="aa-recently-views">
                <ul>
                  <li>
                    <a href="#" class="aa-cartbox-img"><img alt="img" src="img/banner-1.jpg"></a>
                    <div class="aa-cartbox-info">
                      <h4><a href="#">Product Name</a></h4>
                      <p>1 x $250</p>
                    </div>
                  </li>
                  <li>
                    <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-1.jpg"></a>
                    <div class="aa-cartbox-info">
                      <h4><a href="#">Product Name</a></h4>
                      <p>1 x $250</p>
                    </div>
                  </li>
                  <li>
                    <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-2.jpg"></a>
                    <div class="aa-cartbox-info">
                      <h4><a href="#">Product Name</a></h4>
                      <p>1 x $250</p>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Top Rated Products</h3>
              <div class="aa-recently-views">
                <ul>
                  <li>
                    <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-2.jpg"></a>
                    <div class="aa-cartbox-info">
                      <h4><a href="#">Product Name</a></h4>
                      <p>1 x $250</p>
                    </div>
                  </li>
                  <li>
                    <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-1.jpg"></a>
                    <div class="aa-cartbox-info">
                      <h4><a href="#">Product Name</a></h4>
                      <p>1 x $250</p>
                    </div>
                  </li>
                  <li>
                    <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-2.jpg"></a>
                    <div class="aa-cartbox-info">
                      <h4><a href="#">Product Name</a></h4>
                      <p>1 x $250</p>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </aside>
        </div>

      </div>
    </div>
  </section>
  <!-- / product category -->


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