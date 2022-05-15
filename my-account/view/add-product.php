<?php
require_once "../template/navbarLogged.php";
require_once "../../connection/connection.php";

$name = isset($_POST['name']) ? $_POST['name'] : "";
$description = isset($_POST['description']) ? $_POST['description'] : "";
$price = isset($_POST['price']) ? $_POST['price'] : "";
$imgUrl = isset($_POST['imgUrl']) ? $_POST['imgUrl'] : "";
$category = isset($_POST['category']) ? $_POST['category'] : "";

?>
<link rel="stylesheet" href="../../css/add-product.css">

<div class="buttons-div">
<form action="../add-product/">
    <input type="submit" value="Add product" />
</form>
<form action="../add-category/">
    <input type="submit" value="Add category" />
</form>
<form action="../add-user/">
    <input type="submit" value="Add user" />
</form>
<form action="../orders/">
    <input type="submit" value="Orders" />
</form>

</div>

<div class="container" id="container">
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
            <input type="radio" id="yes" name="stock" value="1">
              <label for="yes">Yes</label>
             
            <input type="radio" id="no" name="stock" value="0">
              <label for="no">No</label>
            <?php if (isset($stockErr)) echo "<span style='color:red;'>" . $stockErr . "</span>"; ?>
        </p>

        <label for="category">Choose a category:</label>
        <select id="category" name="category" size="0">

            <?php
            $q = "SELECT `id`, `name` 
                FROM `category`";

            $result = $conn->query($q);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value=" . $row["id"] . ">" . $row["name"] . "</option>";
                }
            } else {
                $categoryErr = "No categories";
            }
            ?>

        </select>
        <?php if (isset($categoryErr)) echo "<span style='color:red;'>" . $categoryErr . "</span>"; ?>

        <p>
            <input id="button-helper" type="submit" value="Add product">

        </p>

    </form>
</div>

<?php
require_once "../template/footer.php";

?>