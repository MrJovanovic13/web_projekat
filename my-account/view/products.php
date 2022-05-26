<?php
require_once "../template/navbarLogged.php";
require_once "../../connection/connection.php";

?>
<link rel="stylesheet" href="../../css/dashboard.css">

<div class="buttons-div">
    <?php
    require_once "../template/accountMenu.php";
    ?>
</div>
<br>
<div class="container" id="container">
    <div class="buttons-div-second">
        <form class="menuForm" action="../add-product/">
            <input class="menuButton" type="submit" value="Add product" />
        </form>
        <form class="menuForm" action="../add-category/">
            <input class="menuButton" type="submit" value="Add category" />
        </form>
    </div>
    <br>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>In stock</th>
            <th>Action</th>
        </tr>
        <?php

        $q = "SELECT `id`, `name`, `category_id`, `price`, `in_stock`
                FROM `products`";

        $counter = 0;
        echo "<tr>";
        $result = $conn->query($q);
        while ($row = $result->fetch_assoc()) {
            $stock;
            if ($row['in_stock']) {
                $stock = 'yes';
            } else {
                $stock = 'no';
            }

            if ($counter != 0 && $counter % 2 == 1) {
                echo '</tr>';
                echo '<tr class="highlighted">';
            } else {
                echo '</tr>';
                echo '<tr>';
            }
            $counter++;

            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";

            $q1 = "SELECT `name` FROM `category` WHERE `id`=" . $row['category_id'];
            $result1 = $conn->query($q1);
            $row1 = $result1->fetch_assoc();
            echo "<td>" . $row1['name'] . "</td>";
            echo "<td>" . $row['price'] . "</td>";
            echo "<td>" . $stock . "</td>";
            echo "<td>" .
                "<a href='../products?action=deleteProduct&productId=" . $row['id'] . "'><p><button class='iconButton'>
                <img class='deleteIcon' src='../../images/deleteIcon.png' alt='deleteIcon'>
                </button></p> </a>
                <a href='../edit-product?action=editProduct&productId=" . $row['id'] . "'><p><button class='iconButton'>
                <img class='editIcon' src='../../images/editIcon.png' alt='editIcon'>
                </button></p> </a>"
                . "</td>";
        }
        echo "</tr>";
        ?>
    </table>
</div>

<?php
require_once "../template/footer.php";

?>