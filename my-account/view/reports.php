<?php
require_once "../template/navbarLogged.php";
?>
<link rel="stylesheet" href="../../css/dashboard.css">
<div class="buttons-div">
<?php require_once "../template/accountMenu.php";?>
</div>

<div class="container" id="container">
    <form action="../reports/" method="post">
        <p>
            <label for="dateStart">Starting date: </label>
            <input type="date" name="dateStart" value="">
        </p>
        <p>
            <label for="dateEnd">End date: </label>
            <input type="date" name="dateEnd" value="">
        </p>
        <p>
        <select name="reportType">
            <option value="1">New user registration</option>
            <option value="2">Orders placed</option>
            <option value="3">Product stats</option>
        </select>
        </p>

        <p>
        <select name="reportFormat">
            <option value="1">PDF</option>
            <option value="2">Excel</option>
        </select>
        </p>

        <p>
            <input id="button-helper" type="submit" value="Download">
        </p>

    </form>
</div>


<?php
require_once "../template/footer.php";
?>