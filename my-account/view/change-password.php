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
            <form class="menuForm" action="../account-info/">
                <input class="menuButton" type="submit" value="Return" />
            </form>
        </div>
        <br>
        <form action="../change-password/" method="post">
            <p>
                Current password:
                <input type="password" name="password">
                <span class="error"> <?= $errors['password'] ?? '' ?></span>
            </p>
            <p>
                New password: 
                <input type="password" name="newPassword">
                <span class="error"> <?= $errors['newPassword'] ?? '' ?></span>
            </p>
            <p>
                Retype new password: 
                <input type="password" name="retypePassword">
                <span class="error"> <?= $errors['retypePassword'] ?? '' ?></span>
            </p>
            <br>
            <p>
                <input id="button-helper" type="submit" name="submit" value="Change password">
                <input type="hidden" id="userId" name="userId" value="<?= $userId ?>">
            </p>
        </form>
    </div>
</div>

<?php
require_once "../template/footer.php";

?>