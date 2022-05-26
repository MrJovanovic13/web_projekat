<?php
require_once "../template/navbarLogged.php";
require_once "../../connection/connection.php";

?>
<link rel="stylesheet" href="../../css/dashboard.css">

<div class="buttons-div">
<?php
require_once "../template/accountMenu.php";
?>

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
            <input type="radio" id="yes" name="stock" value="1" <?php if(isset($stock)&&$stock) echo "checked='checked'"; ?>>
              <label for="yes">Yes</label>
             
            <input type="radio" id="no" name="stock" value="0" <?php if(isset($stock)&&!$stock) echo "checked='checked'"; ?>>
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
                $row = $result->fetch_assoc(); // called once to skip the first default category from showing
                if($switchUpdate != 'Edit product'){
                    echo "<option selected disabled hidden style='display: none' value=''></option>"; // makes default category blank IF we are not editing product
                }
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
            <input id="button-helper" type="submit" value="<?php echo $switchUpdate; ?>">
            <input type="hidden" name="updateType" value="<?php echo $switchUpdate; ?>">
            <input type="hidden" id="productId" name="productId" value="<?php if(isset($id)){echo $id;} ?>">
        </p>

    </form>
</div>

<?php
require_once "../template/footer.php";

?>