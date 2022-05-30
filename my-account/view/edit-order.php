<?php
require_once "../template/navbarLogged.php";
?>
<link rel="stylesheet" href="../../css/dashboard.css">

<body>
    <div class="buttons-div">
        <?php
        require_once "../template/accountMenu.php";
        ?>

    </div><br>
    <div class="container" id="container">
        Delivery information:


        <br>
        <?= $orderUser->name ?> <br>
        <?= $orderUser->surname ?> <br>
        <?= $orderUser->email ?> <br>
        <?= $orderUser->address ?> <br>
        <?= $orderUser->location ?> <br>
        <hr>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
            <?php foreach ($cartProducts as $cartProduct) : ?>
                <tr>
                    <td><?= $cartProduct->id ?></td>
                    <td><?= $cartProduct->name ?></td>
                    <td><?= $cartProduct->price ?>$</td>
                    <td><?= $cartProduct->quantity ?></td>
                    <td><?= $cartProduct->quantity *  $cartProduct->price ?>$</td>
                </tr>
            <?php endforeach ?>
        </table>
        Order:<?= $cartTotal ?>$
        <hr>
        Shipping:10$
        <hr>
        Order total:<?= $cartTotal + 10 ?>$
        <hr>
        Order status:<?= $status ?>
        <?php

        ?>
        <?php if ($userLevel != 0) : ?>
            <form action="../edit-order/controller.php" method="POST">
                <select id="orderStatus" name="orderStatus">
                <?php endif; ?>
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
                <input type="hidden" name="orderId" value="<?= $orderId ?>">
                <br>
                <button type="submit">Edit</button>
            </form>'
    </div>
</body>
<?php
require_once "../template/footer.php";
?>