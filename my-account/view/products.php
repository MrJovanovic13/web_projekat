<?php
require_once "../template/navbarLogged.php";

?>
<link rel="stylesheet" href="../../css/dashboard.css">
<div class="shell">

    <div class="buttons-div">
        <?php
        require_once "../template/accountMenu.php";
        ?>
    </div>
    <br>
    <div class="container" id="container">
        <div class="buttons-div-second">
            <form class="menuForm" action="../add-product/">
                <input class="menuButton" type="submit" value="Add product" />
            </form>
            <form class="menuForm" action="../categories/">
                <input class="menuButton" type="submit" value="Categories" />
            </form>
        </div>
        <br>

        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>In stock</th>
                <th>Action</th>
            </tr>
            </thead>
            <?php foreach ($products as $product) : ?>
                    <tr>
                    <td><?= $product->id ?></td>
                    <td><?= $product->name ?></td>
                    <td><?= $product->category ?></td>
                    <td><?= $product->price ?>$</td>
                    <td><?= $product->inStock ?></td>
                    <td>
                        <a href='../products?action=deleteProduct&productId=<?= $product->id ?>'><button class=iconButton>
                                <img class='deleteIcon' src='../../images/deleteIcon.png' alt='deleteIcon'>
                            </button> </a>
                        <a href='../edit-product?action=editProduct&productId=<?= $product->id ?>'><button class=iconButton>
                                <img class='editIcon' src='../../images/editIcon.png' alt='editIcon'>
                            </button> </a>
                    </td>
                    </tr>
                <?php endforeach; ?>
        </table>
    </div>
</div>
<?php
require_once "../template/footer.php";

?>