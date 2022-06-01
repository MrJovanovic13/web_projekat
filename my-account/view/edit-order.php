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
        Order status:<?= $orderStatus ?>
        <?php

        ?>
        <?php if ($userLevel != 0) : ?>
            <form action="../edit-order/controller.php" method="POST">
                <select id="orderStatus" name="orderStatus">
                <?php foreach ($orderStatusList as $status) : ?>

                    <?php if ($status->name == $orderStatus) : ?>
                        <option selected value=<?= $status->id ?>><?= $status->name ?></option>
                    <?php else : ?>
                        <option value=<?= $status->id ?>><?= $status->name ?></option>
                    <?php endif; ?>

                <?php endforeach; ?>
                </select>
                <input type="hidden" name="orderId" value="<?= $orderId ?>">
                <br>
                <br>
                <button id="button-helper" type="submit">Submit edit</button>
            </form>
        <?php endif; ?>
    </div>
</body>
<?php
require_once "../template/footer.php";
?>