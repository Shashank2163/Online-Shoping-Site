<form action="" method="post">

    <input type="hidden" name="item[1][id]" value="100" />
    <input type="text" name="item[1][qty]" value="1" />

    <input type="hidden" name="item[2][id]" value="200" />
    <input type="text" name="item[2][qty]" value="2" />

    <input type="submit" name="action" value="update" />

</form>
<?php

if (isset($_POST['action'])) {

    $items = $_POST['item'];
    print_r($items);

    foreach ($items as $item) {

        // list($id, $qty) = $item;

        print_r($item);
        echo "erhj" . $id;
        #UPDATE cart SET qty = $qty WHERE product_id = $id AND user_id = $_SESSION['user_id']

    }
} ?>