<link rel="stylesheet" href="../../css/account-menu.css">

<?php 
require_once "../../controller/user.php";
$user = unserialize($_SESSION['userObj']);
$userLevel = $user->userLevel;    

if ($userLevel==2){
echo '
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
';
}

if ($userLevel==1){
    echo '
    <form class="menuForm" action="../orders/">
        <input class="menuButton" type="submit" value="Orders" />
    </form>
    <form class="menuForm" action="../users/">
        <input class="menuButton" type="submit" value="Users" />
    </form>';
}

if ($userLevel==0){
echo '
<form class="menuForm" action="../orders/">
    <input class="menuButton" type="submit" value="Orders" />
</form>
<form class="menuForm" action="../users/">
    <input class="menuButton" type="submit" value="Account info" />
</form>';
}
?>
