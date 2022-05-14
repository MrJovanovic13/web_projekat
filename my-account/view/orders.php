<?php
require_once "../../connection/connection.php";
require_once "../template/navbarLogged.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/dashboard.css">
    <title>test</title>
</head>

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
        <table>
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Price</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php
            $q = "SELECT `id`, `date`
            FROM `orders`";

            $result = $conn->query($q);
            $order_total = 0;
            echo "<tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['date'] . "</td>";

                $q1 = "SELECT `product_id`, `amount`
                FROM `items`
                WHERE `order_id`=".$row['id'];
                $result1 = $conn->query($q1);
                while ($row1 = $result1->fetch_assoc()){
                    $q2 = "SELECT `price` 
                    FROM `products`
                    WHERE `products`.`id`=".$row1['product_id'];
                    $result2 = $conn->query($q2);
                    while ($row2 = $result2->fetch_assoc()){
                        $order_total += $row2['price'] * $row1['amount'];
                    }
                }
                echo "<td>" . $order_total . "$</td>";
                $order_total = 0;
                echo "<td>" . "test" . "</td>";
                echo "<td>" . "test" . "</td>";
                echo "</tr>";
            }
            echo "</tr>";
            ?>
        </table>

    </div>
</body>

</html>
<?php
require_once "../template/footer.php";
?>