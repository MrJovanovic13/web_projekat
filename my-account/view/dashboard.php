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
        <form action="../dashboard/" method="post">


        </form>
    </div>
</div>


<?php
require_once "../template/footer.php";

?>