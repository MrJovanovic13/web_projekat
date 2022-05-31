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
    <form action="../edit-category/" method="post">
        <p>
            Name:
            <input type="text" name="name" value="<?php if (isset($name)) echo $name; ?>">
            <span class="error"> <?php if (isset($nameErr)) echo "<span style='color:red;'>" . $nameErr . "</span>"; ?></span>
        </p>
        <p>
            <input type="hidden" name="categoryId" value="<?php echo $categoryId; ?>">
        </p>
        <br>
        <input id="button-helper" type="submit" value="Edit product">
        </p>
    </form>
</div>

<?php
require_once "../template/footer.php";

?>