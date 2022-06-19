<?php require_once "../template/navbar.php"; ?>

<div class="shell">
    <div class="container" id="container">
        <div class="buttons-div-second">
            <form class="menuForm" action="../cart/">
                <input class="menuButton" type="submit" value="Review cart" />
            </form>
        </div>
        <h1>Delivery information:</h1>
        <?= $user->name ?>
        <br>
        <?= $user->surname ?>
        <br>
        <?= $user->email ?>
        <br>
        <?= $user->address ?>
        <br>
        <?= $user->location ?>
        <h1>Order details:</h1>
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
        <?= $cartTotal ?>$
        <br>
        Shipping: 10$
        <br>
        <h1>Total: <?= $cartTotal + 10 . "$" ?></h1>
        <br>
        <a href='../my-account/?action=checkout'>
            <p><button id="button-helper">Checkout</button></p>
        </a>
    </div>
</div>
</body>

<?php require_once "../template/footer.php"; ?>