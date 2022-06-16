<?php
require_once "../template/navbar.php";
?>

<link rel="stylesheet" href="../css/dashboard.css">
<div class="shell">
    <div class="container" id="container">
        <div class="buttons-div-second">
            <form class="menuForm" action="../cart/">
                <input class="menuButton" type="submit" value="Review cart" />
            </form>
        </div>
        <br>
        Delivery information:
        <hr>
        <?= $user->name ?>
        <br>
        <?= $user->surname ?>
        <br>
        <?= $user->email ?>
        <br>
        <?= $user->address ?>
        <br>
        <?= $user->location ?>
        <hr>
        Order details:
        <hr>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cartProducts as $cartProduct) : ?>
                    <tr>
                        <td>
                            <?= $cartProduct->name ?>
                        </td>
                        <td>
                            <?= $cartProduct->price ?>$
                        </td>
                        <td>
                            <?= $cartProduct->quantity ?>
                        </td>
                    </tr>

                <?php endforeach; ?>
            </tbody>
        </table>
        VAT:
        <?= $cartTotal ?>
        <br>
        Shipping: 10$
        <br>
        Total: <?= $cartTotal + 10 . "$" ?>
        <br>
        <br>
        <a href='../my-account/?action=checkout'>
            <p><button id="button-helper">Checkout</button></p>
        </a>
    </div>
</div>

<?php
require_once "../template/footer.php";
?>