<link rel="stylesheet" href="../../css/account-menu.css">

<?php
require_once "../../controller/user.php";
$user = unserialize($_SESSION['userObj']);
$userLevel = $user->userLevel;
?>
<?php if ($userLevel == 2) : ?>
    <form class="menuForm" action="../account-info/">
        <input class="menuButton" type="submit" value="Account info" />
    </form>
    <form class="menuForm" action="../orders/">
        <input class="menuButton" type="submit" value="Orders" />
    </form>
    <form class="menuForm" action="../users/">
        <input class="menuButton" type="submit" value="Users" />
    </form>
    <form class="menuForm" action="../reports/">
        <input class="menuButton" type="submit" value="Reports" />
    </form>
    <form class="menuForm" action="../products/">
        <input class="menuButton" type="submit" value="Products" />
    </form>
    <form class="menuForm" action="../tickets/">
        <input class="menuButton" type="submit" value="Tickets" />
    </form>
<?php elseif ($userLevel == 1) : ?>
    <form class="menuForm" action="../account-info/">
        <input class="menuButton" type="submit" value="Account info" />
    </form>
    <form class="menuForm" action="../orders/">
        <input class="menuButton" type="submit" value="Orders" />
    </form>
    <form class="menuForm" action="../users/">
        <input class="menuButton" type="submit" value="Users" />
    </form>
    <form class="menuForm" action="../tickets/">
        <input class="menuButton" type="submit" value="Tickets" />
    </form>
<?php else : ?>
    <form class="menuForm" action="../orders/">
        <input class="menuButton" type="submit" value="Orders" />
    </form>
    <form class="menuForm" action="../account-info/">
        <input class="menuButton" type="submit" value="Account info" />
    </form>
    <form class="menuForm" action="../tickets/">
        <input class="menuButton" type="submit" value="Tickets" />
    </form>
<?php endif; ?>