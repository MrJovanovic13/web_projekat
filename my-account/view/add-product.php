<?php
require_once "../template/navbarLogged.php";
require_once "../../connection/connection.php";

$name = isset($_POST['name']) ? $_POST['name'] : "";
$nameErr = isset($_POST['nameErr']) ? $_POST['nameErr'] : "";
$description = isset($_POST['description']) ? $_POST['description'] : "";
$descriptionErr = isset($_POST['descriptionErr']) ? $_POST['descriptionErr'] : "";
$price = isset($_POST['price']) ? $_POST['price'] : "";
$priceErr = isset($_POST['priceErr']) ? $_POST['priceErr'] : "";
$imgUrl = isset($_POST['imgUrl']) ? $_POST['imgUrl'] : "";
$imgUrlErr = isset($_POST['imgUrlERr']) ? $_POST['imgUrlErr'] : "";
$category = isset($_POST['category']) ? $_POST['category'] : "";
$categoryErr = isset($_POST['categoryErr']) ? $_POST['categoryErr'] : "";

?>
<link rel="stylesheet" href="../../css/add-product.css">

<div class="container" id="container">
    <form action="../add-category/" method="post">

        <p>
            Name:
            <input type="text" name="name" value="<?php if (isset($name)) echo $name; ?>">
            <span class="error"> <?php echo $nameErr; ?></span>
        </p>
        <p>
            Description:
            <input type="text" name="description" value="<?php if (isset($description)) echo $description; ?>">
            <span class="error"> <?php echo $descriptionErr; ?></span>
        </p>
        <p>
            Price:
            <input type="text" name="price" value="<?php if (isset($price)) echo $price; ?>">
            <span class="error"> <?php echo $priceErr; ?></span>
        </p>
        <p>
            Image url:
            <input type="text" name="imgUrl" value="<?php if (isset($imgUrl)) echo $imgUrl; ?>">
            <span class="error"> <?php echo $imgUrlErr; ?></span>
        </p>

        <p>
            Product in stock?
        </p>
        <p>
            <input type="radio" id="yes" name="stock" value="1">
              <label for="yes">Yes</label>
             
            <input type="radio" id="no" name="stock" value="0">
              <label for="no">No</label>
        </p>

        <label for="category">Choose a category:</label>
        <select id="category" name="category" size="0">

            <?php
            $q = "SELECT `name` 
                FROM `category`";

            $result = $conn->query($q);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value=" . $row["name"] . ">" . $row["name"] . "</option>";
                }
            } else {
                $categoryErr = "No categories";
            }
            ?>

        </select>

        <p>
            <input id="button-helper" type="submit" value="Add product">

        </p>

    </form>
</div>

<?php
require_once "../template/footer.php";

?>