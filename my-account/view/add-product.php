<?php require_once "../template/navbarLogged.php"; ?>

<div class="shell">
    <div class="buttons-div">
        <?php require_once "../template/accountMenu.php"; ?>
    </div><br>
    <div class="container" id="container">
        <h1>Add product</h1>
        <br>
        <div class="buttons-div-second">
            <form class="menuForm" action="../products/">
                <input class="menuButton" type="submit" value="Return" />
            </form>
        </div>
        <br>

        <form action="../add-product/" method="post">

            <p>
                Name:
                <input type="text" name="name" value="<?= $addProduct->name ?>">
                <span class="error"> <?php if (isset($nameErr)) : ?><span><?= $nameErr ?> <?php endif ?></span>
            </p>
            <p>
                Description:
                <input type="text" name="description" value="<?= $addProduct->description ?>">
                <span class="error"> <?php if (isset($descriptionErr)) : ?><span><?= $descriptionErr ?> <?php endif ?></span>
            </p>
            <p>
                Price:
                <input type="number" name="price" value="<?= $addProduct->price ?>">
                <span class="error"> <?php if (isset($priceErr)) : ?><span><?= $priceErr ?> <?php endif ?></span>
            </p>
            <p>
                Image filename: (assumes that image is in the images folder)
                <input type="text" name="imgUrl" value="<?= $addProduct->imgUrl ?>">
                <span class="error"> <?php if (isset($imgUrlErr)) : ?><span><?= $imgUrlErr ?> <?php endif ?></span>
            </p>

            <p>
                Product in stock?
            </p>
            <p>
                <input type="radio" id="yes" name="stock" value="1" <?php if ($addProduct->inStock) : ?> checked <?php endif ?>>
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="stock" value="0" <?php if (!$addProduct->inStock) : ?> checked <?php endif ?>>
                <label for="no">No</label>
                <span class="error"> <?php if (isset($stockErr)) : ?><span><?= $stockErr ?> <?php endif ?> </span>
            </p>

            <label for="category">Choose a category:</label>
            <select id="category" name="category" size="0">
                <?php foreach ($categories as $category) : ?>
                    <?php if ($category->selected) : ?>
                        <option value=<?= $category->id ?> selected><?= $category->name ?></option>
                    <?php else : ?>
                        <option value=<?= $category->id ?>><?= $category->name ?></option>
                    <?php endif ?>
                <?php endforeach; ?>
            </select>
            <?php if (isset($categoryErr)) : ?><span><?= $categoryErr ?> <?php endif ?>
                <br>
                <br>
                <!--First br does nothing for some reason, so i put another one. -->
                <p>
                    <input id="button-helper" type="submit" value="Add product">
                </p>

        </form>
    </div>
</div>
</body>

<?php require_once "../template/footer.php"; ?>