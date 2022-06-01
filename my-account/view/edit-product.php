<?php
require_once "../template/navbarLogged.php";

?>
<link rel="stylesheet" href="../../css/dashboard.css">

<div class="buttons-div">
    <?php
    require_once "../template/accountMenu.php";
    ?>
</div><br>

<div class="container" id="container">

    <div class="buttons-div-second">
        <form class="menuForm" action="../products/">
            <input class="menuButton" type="submit" value="Products" />
        </form>
    </div>
    <br>

    <form action="../add-product/" method="post">

        <p>
            Name:
            <input type="text" name="name" value="<?= $editProduct->name?>">
            <span class="error"> <?php if (isset($nameErr)) echo "<span style='color:red;'>" . $nameErr . "</span>"; ?></span>
        </p>
        <p>
            Description:
            <input type="text" name="description" value="<?= $editProduct->description?>">
            <span class="error"> <?php if (isset($descriptionErr)) echo "<span style='color:red;'>" . $descriptionErr . "</span>"; ?></span>
        </p>
        <p>
            Price:
            <input type="number" name="price" value="<?= $editProduct->price?>">
            <span class="error"> <?php if (isset($priceErr)) echo "<span style='color:red;'>" . $priceErr . "</span>";  ?></span>
        </p>
        <p>
            Image filename: (assumes that image is in the images folder)
            <input type="text" name="imgUrl" value="<?= $editProduct->imgUrl?>">
            <span class="error"> <?php if (isset($imgUrlErr)) echo "<span style='color:red;'>" . $imgUrlErr . "</span>"; ?></span>
        </p>

        <p>
            Product in stock?
        </p>
        <p>
            <input type="radio" id="yes" name="stock" value="1" <?php if($editProduct->inStock):?> checked='checked' <?php endif ?>>
            <label for="yes">Yes</label>
            <input type="radio" id="no" name="stock" value="0" <?php if(!$editProduct->inStock):?> checked='checked' <?php endif ?>>
            <label for="no">No</label>
            <?php if (isset($stockErr)) echo "<span style='color:red;'>" . $stockErr . "</span>"; ?>
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
        <?php if (isset($categoryErr)) echo "<span style='color:red;'>" . $categoryErr . "</span>"; ?>
        <br>
        <br>
        <!--First br does nothing for some reason, so i put another one. -->
        <p>
            <input id="button-helper" type="submit" value="Edit product">
            <input type="hidden" name="updateType" value="Edit product">
            <input type="hidden" id="productId" name="productId" value="<?php if (isset($id)) { echo $id; } ?>">
        </p>

    </form>
</div>

<?php
require_once "../template/footer.php";

?>