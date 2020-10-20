<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Range Slider</title>
        <!-- jquery ui css -->

        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <link href="css/style.css" rel="stylesheet">
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
        <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    </head>
</head>

<body>
    <?php

    include('config.php');
    // echo $_POST['range1'];
    // echo $_POST['cat'];
    if (isset($_POST['range1']) && isset($_POST['range2'])) {
        $min = $_POST['range1'];
        $max = $_POST['range2'];
        if (isset($_GET['cat'])) {
            $category = $_GET['cat'];
            $sql = "SELECT * FROM productsnew   where category='$category' and price BETWEEN {$min} AND {$max}";
        } else if (isset($_GET['val'])) {
            $tags = $_GET['val'];
            $sql = "SELECT * FROM productsnew   where tags LIKE '%{$tags}%' and price BETWEEN {$min} AND {$max}";
        } else if (isset($_GET['color'])) {
            $color = $_GET['color'];
            $sql = "SELECT * FROM productsnew   where color  LIKE '%{$color}%' and price BETWEEN {$min} AND {$max}";
        } else {
            $sql = "SELECT * FROM productsnew WHERE price BETWEEN {$min} AND {$max}";
        }
    } else {
        $min = '';
        $max = '';
        $sql = "SELECT * FROM  productsnew  ORDER BY product_id asc";
    }

    $result = mysqli_query($conn, $sql) or die("Query Unsuccessful.");
    $output = array();

    $statement = $conn->prepare($sql);

    $statement->execute();

    // $result = $statement->mysqli_fetch_all();

    $total_row = mysqli_num_rows($result);

    $output = '
    <h4 align="center">Total Item - ' . $total_row . '</h4>
    <div class="row">
    ';

    if ($total_row > 0) {
        foreach ($result as $row) {
            $output .= '
            <li>
            <figure>
          <a href="product-detail.php?id=' . $row['product_id'] . '&price=
          ' . $row['price'] . '&img= ' . $row['image'] . '&name= ' . $row['name'] . '">  <img src="../admin/upload/' . $row["image"] . '" class="aa-product-img" /></a>
              <a class="aa-add-card-btn" href="product.php?id=' . $row["product_id"] . '&price=
                  ' . $row["price"] . ' &img=' . $row["image"] . ' &name =' . $row["name"] . '&action=addtocart"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
              <figcaption>
                <h4 class="aa-product-title">' . $row['name'] . '</h4>
                <span class="aa-product-price">' . $row["price"] . '</span><span class="aa-product-price"><del>$65.50</del></span>
             
              </figcaption>
            </figure>
            <div class="aa-product-hvr-content">
              <a href="wishlist.php?id=' . $row["product_id"] . '&price=
            ' . $row["price"] . '&img=' . $row["image"] . '&name= ' . $row["name"] . '&action=addtocart" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
              <a href="product-detail.php?id=  ' . $row["product_id"] . ' &price=
                  ' . $row["price"] . '&img=' . $row["image"] . '&name=  ' . $row["name"] . '"><span class="fa fa-search"></span></a>
            </div>
            <!-- product badge -->
            <span class="aa-badge aa-sale" href="#">SALE!</span>
          </li>
            ';
        }
    } else {
        $output .= '
            <h3 align="center">No Product Found</h3>
        ';
    }

    $output .= '
    </div>
    ';

    echo $output;

    ?>