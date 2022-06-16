<?php
require_once "../template/navbarLogged.php";
require_once "../../connection/connection.php";

?>
<html>
<link rel="stylesheet" href="../../css/dashboard.css">

<body>
    <div class="shell">
        <div class="buttons-div">
            <?php
            require_once "../template/accountMenu.php";
            ?>
        </div>
        <br>
        <div class="container" id="container">
            <form class="menuForm" action="../add-user/">
                <input class="menuButton" type="submit" value="Add user" />
            </form>
            <table>
                <br>
                <br>
                <!--First br does nothing for some reason, so i put another one. -->
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
                </thead>
                <?php foreach ($users as $user) : ?>
                        <tr>
                        <td><?= $user->id ?></td>
                        <td><?= $user->name ?></td>
                        <td><?= $user->email ?></td>
                        <td>
                            <a href='../users?action=deleteUser&userId=<?= $user->id ?>'>
                                <button class='iconButton'>
                                    <img class='deleteIcon' src='../../images/deleteIcon.png' alt='deleteIcon'>
                                </button>
                            </a>
                            <a href='../edit-user?action=editUser&userId=<?= $user->id ?>'>
                                <button class='iconButton'>
                                    <img class='editIcon' src='../../images/editIcon.png' alt='editIcon'>
                                </button>
                            </a>

                        </td>
                    <?php endforeach; ?>
                        </tr>
        </div>
        </table>
    </div>
    </div>
</body>
<?php
require_once "../template/footer.php";
?>

</html>