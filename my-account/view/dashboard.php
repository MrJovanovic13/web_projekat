<?php
require_once "../template/navbarLogged.php";
?>

<link rel="stylesheet" href="../../css/dashboard.css">
<div class="buttons-div">
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
</form>

</div>


<div class="container" id="container">
    <form action="../dashboard/" method="post">

        
    </form>
</div>



<?php
require_once "../template/footer.php";

?>