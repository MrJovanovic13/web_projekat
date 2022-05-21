<?php 
require_once "../../controller/user.php";
$user = unserialize($_SESSION['userObj']);


if ($user->user_level==2){
echo '
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
<form action="../users/">
    <input type="submit" value="Users" />
</form>';
}

if ($user->user_level==1){
    echo '
    <form action="../orders/">
        <input type="submit" value="Orders" />
    </form>
    <form action="../users/">
        <input type="submit" value="Users" />
    </form>';
}

if ($user->user_level==0){
echo '
<form action="../orders/">
    <input type="submit" value="Orders" />
</form>
<form action="../users/">
    <input type="submit" value="Account info" />
</form>';
}
?>