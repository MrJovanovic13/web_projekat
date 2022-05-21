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
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        <?php

        $q = "SELECT `id`, `name`, `email`
FROM `users`";

        $result = $conn->query($q);
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" .
                "<a href='../users?action=deleteUser&userId=" . $row['id'] . "'><p><button>Remove</button></p> </a>
                <a href='../edit-user?action=editUser&userId=" . $row['id'] . "'><p><button>Edit</button></p> </a>"
                . "</td>";
            echo "</tr>";
        }
        ?>
</div>
</table>

<?php
require_once "../template/footer.php";

?>