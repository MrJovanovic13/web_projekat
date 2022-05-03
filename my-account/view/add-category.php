<?php
require_once "../template/navbarLogged.php";

$name = isset($_POST['name'])?$_POST['name']:"";


?>
<link rel="stylesheet" href="../../css/dashboard.css">

<div class="container" id="container">
    <form action="../add-category/" method="post">

        <p>
            Name:
            <input type="text" name="name" value="<?php if (isset($name)) echo $name; ?>">
            <span class="error"> <?php if(isset($nameErr)) echo $nameErr; ?></span>
        </p>
        <input id="button-helper" type="submit" value="Add category">
        </p>
    </form>
</div>

<?php
require_once "../template/footer.php";

?>