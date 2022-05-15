<?php
require_once "../template/navbarLogged.php";
?>
<link rel="stylesheet" href="../../css/dashboard.css">

<body>
    <div class="buttons-div">
        <form action="../add-product/">
            <input type="submit" value="Add product" />
        </form>
        <form action="../add-category/">
            <input type="submit" value="Add category" />
        </form>
        <form action="../add-user/">
            <input type="submit" value="Add user" />
        </form>
        <form action="../orders/">
            <input type="submit" value="Orders" />
        </form>

    </div>
    <div class="container" id="container">
        Delivery information:
        <?php

        $user = unserialize($_SESSION['orderUser']);
        echo "<br>";
        echo $user->name . "<br>";
        echo $user->surname . "<br>";
        echo $user->email . "<br>";
        echo $user->address . "<br>";
        echo $user->location . "<br>";
        echo "<hr>";
        echo "<table>";
        echo "
        <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Total</th>
        </tr>";
        $cart_total = 0;
        $orderCart = unserialize($_SESSION['orderCart']);
        for ($i = 0; $i < count($orderCart); $i++) {
            if (isset($_SESSION['orderCart'][$i])) {
                $cart_item_id = $orderCart[$i]->id;
                $q = "SELECT `id`, `name`, `price`
                    FROM `products`
                    WHERE `id`=$cart_item_id";
                $result = $conn->query($q);
                $row = $result->fetch_assoc();

                $cart_total += $row['price'] * $orderCart[$i]->quantity;

                echo "
                <tr>
                <td>" . $row['id'] . "</td>
                <td>" . $row['name'] . "</td>
                <td>" . $row['price'] . "$</td>
                <td>" . $orderCart[$i]->quantity . "</td>
                <td>" . $row['price'] * $orderCart[$i]->quantity . "</td>
                </tr>";
            }
        }
        echo "</table>";
        echo "Order:".$cart_total . "$";
        echo "<hr>";
        echo "Shipping:10$";
        echo "<hr>";
        echo "Order total:".$cart_total+10 . "$";
        echo "<hr>";
        echo "Order status:";
        $q3 = "SELECT `status`.`name` FROM `order_status` 
                INNER JOIN `status` ON `order_status`.`status_id` = `status`.`id`
                WHERE `order_status`.`order_id`=" . $order_id;
                $result3 = $conn->query($q3);
                $row3 = $result3->fetch_assoc();
        echo $row3['name'];

        ?>
    </div>

    <?php
    require_once "../template/footer.php";
    ?>