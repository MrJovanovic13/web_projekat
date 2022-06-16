<?php
require_once "../template/navbarLogged.php";
?>
<link rel="stylesheet" href="../../css/dashboard.css">

<body>
    <div class="shell">

        <div class="buttons-div">
            <?php
            require_once "../template/accountMenu.php";
            ?>

        </div><br>
        <div class="container" id="container">

            <h1>Delivery information:</h1>
            <br>
            <?= $orderUser->name ?> <br>
            <?= $orderUser->surname ?> <br>
            <?= $orderUser->email ?> <br>
            <?= $orderUser->address ?> <br>
            <?= $orderUser->location ?> <br>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cartProducts as $cartProduct) : ?>
                        <tr>
                            <td><?= $cartProduct->id ?></td>
                            <td><?= $cartProduct->name ?></td>
                            <td><?= $cartProduct->price ?>$</td>
                            <td><?= $cartProduct->quantity ?></td>
                            <td><?= $cartProduct->quantity *  $cartProduct->price ?>$</td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <h1>Order information:</h1>
            <br>
            Order:<?= $cartTotal ?>$
            <br>
            Shipping:10$
            <br>
            Order total:<?= $cartTotal + 10 ?>$
            <br>
            <h1>Order status history:</h1>
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($orderStatusHistory as $statusHistory) : ?>
                    <tr>
                        <td>
                            <?= $statusHistory->datetime ?>
                        </td>
                        <td>
                            <?= $statusHistory->name ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <h1>Order status: <?= $orderStatus ?></h1>
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
    </div>
</body>
<?php
require_once "../template/footer.php";
?>