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
            <form class="menuForm" action="../tickets/">
                <input class="menuButton" type="submit" value="Return" />
            </form>
        </div>
        <br>
        <form action="../open-ticket/" method="post">
            <p>
                Title:
                <input type="text" name="title" value="<?php if (isset($title)) : ?> <?= $title ?> <?php endif ?>">
                <?php if (isset($titleErr)) : ?><span class="error"><?= $titleErr ?> <?php endif ?></span>
            </p>
            <textarea name="messageContent" placeholder="Write your message here." rows="7" cols="100"></textarea>
            <input type="hidden" name="userId" value="<?= $user->id ?>">
            <?php if (isset($messageErr)) : ?><span class="error"><?= $messageErr ?> <?php endif ?></span>
            <br>
            <input id="button-helper" type="submit" value="Submit ticket">
            </p>
        </form>
    </div>
</div>

<?php
require_once "../template/footer.php";
?>