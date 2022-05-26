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
    <table>
    <form class="menuForm" action="../add-user/">
    <input class="menuButton" type="submit" value="Add user" />
</form>
<br>
<br> <!--First br does nothing for some reason, so i put another one. -->
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        <?php

        $counter=0;
        echo "<tr>";
        $q = "SELECT `id`, `name`, `email`
FROM `users`";

        $result = $conn->query($q);
        while ($row = $result->fetch_assoc()) {

            if($counter != 0&&$counter%2==1){
                echo '</tr>';
                echo '<tr class="highlighted">';
              } else {
                  echo '</tr>';
                  echo '<tr>';
              }
            $counter++;
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" .
                "<a href='../users?action=deleteUser&userId=" . $row['id'] . "'><p><button class='iconButton'>
                <img class='deleteIcon' src='../../images/deleteIcon.png' alt='deleteIcon'>
                </button></p> </a>
                <a href='../edit-user?action=editUser&userId=" . $row['id'] . "'><p><button class='iconButton'>
                <img class='editIcon' src='../../images/editIcon.png' alt='editIcon'>
                </button></p> </a>"
                . "</td>";
        }
        echo "</tr>";
        ?>
</div>
</table>

<?php
require_once "../template/footer.php";

?>