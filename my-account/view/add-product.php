<?php
require_once "../template/navbarLogged.php";
require_once "../../connection/connection.php";

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
            <input type="text" name="name" value="<?php if (isset($name)) echo $name; ?>">
            <span class="error"> <?php if (isset($nameErr)) echo "<span style='color:red;'>" . $nameErr . "</span>"; ?></span>
        </p>
        <p>
            Description:
            <input type="text" name="description" value="<?php if (isset($description)) echo $description; ?>">
            <span class="error"> <?php if (isset($descriptionErr)) echo "<span style='color:red;'>" . $descriptionErr . "</span>"; ?></span>
        </p>
        <p>
            Price:
            <input type="number" name="price" value="<?php if (isset($price)) echo $price; ?>">
            <span class="error"> <?php if (isset($priceErr)) echo "<span style='color:red;'>" . $priceErr . "</span>";  ?></span>
        </p>
        <p>
            Image filename: (assumes that image is in the images folder)
            <input type="text" name="imgUrl" value="<?php if (isset($imgUrl)) echo $imgUrl; ?>">
            <span class="error"> <?php if (isset($imgUrlErr)) echo "<span style='color:red;'>" . $imgUrlErr . "</span>"; ?></span>
        </p>

        <p>
            Product in stock?
        </p>
        <p>
            <input type="radio" id="yes" name="stock" value="1" <?php if (isset($stock) && $stock) echo "checked='checked'"; ?>>
            <label for="yes">Yes</label>

            <input type="radio" id="no" name="stock" value="0" <?php if (isset($stock) && !$stock) echo "checked='checked'"; ?>>
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
        <?php if (isset($categoryErr)): ?><span><?=$categoryErr?> <?php endif ?>
        <br>
        <br>
        <!--First br does nothing for some reason, so i put another one. -->
        <p>
            <input id="button-helper" type="submit" value="Add product">
            <input type="hidden" name="updateType" value="Add product">
        </p>

    </form>
</div>

<?php
require_once "../template/footer.php";

?>