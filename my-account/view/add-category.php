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
            <form class="menuForm" action="../categories/">
                <input class="menuButton" type="submit" value="Categories" />
            </form>
        </div>
        <br>
        <form action="../add-category/" method="post">
            <p>
                Name:
                <input type="text" name="name" value="<?php if (isset($name)) : ?> <?= $name ?> <?php endif ?>">
                <?php if (isset($nameErr)) : ?><span class="error"><?= $nameErr ?> <?php endif ?></span>
            </p>
            <br>
            <input id="button-helper" type="submit" value="Add category">
            </p>
        </form>
    </div>
</div>

<?php
require_once "../template/footer.php";
?>