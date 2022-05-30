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
        <br>
        <!--First br does nothing for some reason, so i put another one. -->
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        <?php foreach ($users as $user) : ?>
            <?php if ($highlightCounter++ % 2 == 0) : ?>
                <tr class="highlighted">
                <?php else : ?>
                <tr>
                <?php endif; ?>
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

<?php
require_once "../template/footer.php";
?>