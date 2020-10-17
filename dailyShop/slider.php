<!DOCTYPE html>
<html lang="en">

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

<body>
    <div id="main">
        <div id="header">
            <h1>Search with Range Slider <br>using PHP & Ajax</h1>
        </div>
        <div id="slider-wrap">
            <div>
                <label>Age Between:</label>
                <span id="age"></span>
            </div>
            <div id="slider-range"></div>
        </div>

    </div>
    <div class="aa-product-catg-body">
        <ul class="aa-product-catg">
            <div id="final">
                <a class="aa-product-img" href="product-detail.php?&img=<?php echo $row["image"]; ?>"></a>
                <td>
                <td>
                    </a>
            </div>
        </ul>
    </div>
    <script>
        $(document).ready(function() {

            var v1 = 15;
            var v2 = 2500;

            $("#slider-range").slider({
                range: true,
                min: 13,
                max: 300000,
                values: [v1, v2],
                slide: function(event, ui) {
                    $("#age").html(ui.values[0] + " - " + ui.values[1]);
                    v1 = ui.values[0];
                    v2 = ui.values[1];
                    loadTable(v1, v2);

                }
            });
            $("#age").html($("#slider-range").slider("values", 0) +
                " - " + $("#slider-range").slider("values", 1));

            function loadTable(range1, range2) {
                $.ajax({
                    url: "get-data.php",
                    type: "POST",
                    data: {
                        range1: range1,
                        range2: range2
                    },
                    success: function(data) {
                        // echo $data;

                        $("#final .aa-product-img").html(data);

                    }
                });
            }

            loadTable(v1, v2);
        });
    </script>
</body>

</html>