<?php
require_once "../template/navbarLogged.php";
?>
<link rel="stylesheet" href="../../css/dashboard.css">

<body>
    <div class="buttons-div">
    <?php
require_once "../template/accountMenu.php";
?>

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
        echo "Order:" . $cart_total . "$";
        echo "<hr>";
        echo "Shipping:10$";
        echo "<hr>";
        echo "Order total:" . $cart_total + 10 . "$";
        echo "<hr>";
        echo "Order status:";
        $q3 = "SELECT `status`.`id`,`date`,`time`, `status`.`name` FROM `order_status` 
                INNER JOIN `status` ON `order_status`.`status_id` = `status`.`id`
                WHERE `order_status`.`order_id`=" . $order_id . "
                ORDER BY `date` DESC, `time` DESC";
        $result3 = $conn->query($q3);
        $row3 = $result3->fetch_assoc();
        echo $row3['name'];
        ?>

        <form action="../edit-order/controller.php" method="POST">
            <select id="orderStatus" name="orderStatus">

                <?php
                $q = "SELECT `id`, `name` 
                FROM `status`";

                $result = $conn->query($q);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        if ($row["id"] == $row3["id"]) {
                            echo "<option selected value=" . $row["id"] . ">" . $row["name"] . "</option>";
                            continue;
                        }
                        echo "<option value=" . $row["id"] . ">" . $row["name"] . "</option>";
                    }
                }
                ?>
            </select>
            <input type="hidden" name="orderId" value="<?= $order_id ?>">
            <button type="submit">Edit</button>
        </form>

    </div>

    <?php
    require_once "../template/footer.php";
    ?>