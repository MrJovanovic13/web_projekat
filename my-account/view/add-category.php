<?php
require_once "../template/navbarLogged.php";
?>
<link rel="stylesheet" href="../../css/dashboard.css">

<div class="buttons-div">
    <?php
    require_once "../template/accountMenu.php";
    ?>

</div>
<br>
<div class="container" id="container">
    <div class="buttons-div-second">
        <form class="menuForm" action="../categories/">
            <input class="menuButton" type="submit" value="Categories" />
        </form>
    </div>
    <br>
    <form action="../add-category/" method="post">
        <p>
            Name:
            <input type="text" name="name" value="<?php if (isset($name)): ?> <?=$name?> <?php endif ?>">
            <span class="error"> <?php if (isset($nameErr)): ?><span><?=$nameErr?> <?php endif ?>></span>
        </p>
        <br>
        <input id="button-helper" type="submit" value="Add category">
        </p>
    </form>
</div>

<?php
require_once "../template/footer.php";

?>