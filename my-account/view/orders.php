<?php
require_once "../template/navbarLogged.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/dashboard.css">
    <title>test</title>
</head>

<body>
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
    </div>
    <div class="container" id="container">
    </div>
</body>

</html>
<?php
require_once "../template/footer.php";
?>