<?php require_once "../template/navbarLogged.php"; ?>
<div class="shell">
    <div class="buttons-div">
        <?php require_once "../template/accountMenu.php"; ?>
    </div>
    <br>
    <div class="container" id="container">
        <h1>Products</h1>
        <br>
        <div class="buttons-div-second">
            <form class="menuForm" action="../add-product/">
                <input class="menuButton" type="submit" value="Add product" />
            </form>
            <form class="menuForm" action="../categories/">
                <input class="menuButton" type="submit" value="Categories" />
            </form>
        </div>
        <br>
        <div>
            <form action="../products/" method="post">
                <?php while ($i <= $pageCounter) : ?>
                    <?php if ($currentPageUser == $i) : ?>
                        <button type="submit" class="page-current" name="page" value="<?= $i ?>"><?= $i ?></button>
                    <?php else : ?>
                        <button type="submit" class="page" name="page" value="<?= $i ?>"><?= $i ?></button>
                    <?php endif; ?>
                    </a>
                    <?php $i++ ?>
                <?php endwhile; ?>
            </form>
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
                <tbody>
                <?php if (empty(returnProductsFromPage($currentPageUser, $products))) : ?>
                    <h1>There are no products!</h1>
                <?php endif; ?>
                <?php foreach (returnProductsFromPage($currentPageUser, $products) as $product) : ?>
                    <tr>
                        <td><?= $product->id ?></td>
                        <td><?= $product->name ?></td>
                        <td><?= $product->category ?></td>
                        <td><?= $product->price ?>$</td>
                        <td><?= $product->inStock ?></td>
                        <td>
                            <a href='../products/?action=deleteProduct&productId=<?= $product->id ?>'><button class=iconButton>
                                    <img class='deleteIcon' src='../../images/deleteIcon.png' alt='deleteIcon'>
                                </button> </a>
                            <a href='../edit-product/?action=editProduct&productId=<?= $product->id ?>'><button class=iconButton>
                                    <img class='editIcon' src='../../images/editIcon.png' alt='editIcon'>
                                </button> </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
<?php require_once "../template/footer.php"; ?>