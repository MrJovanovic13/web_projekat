<?php require_once "../template/navbarLogged.php"; ?>
<div class="shell">
    <div class="buttons-div">
        <?php require_once "../template/accountMenu.php"; ?>
    </div>
    <br>
    <div class="container" id="container">
        <h1>Users</h1>
        <br>
        <?php if ($userLevel == 2) : ?>
            <form class="menuForm" action="../add-user/">
                <input class="menuButton" type="submit" value="Add user" />
            </form>
        <?php endif; ?>
        <table>
            <br>
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
                        <?php if ($userLevel == 2) : ?>
                        <a href='../users/?action=deleteUser&userId=<?= $user->id ?>'>
                            <button class='iconButton'>
                                <img class='deleteIcon' src='../../images/deleteIcon.png' alt='deleteIcon'>
                            </button>
                        </a>
                        <?php endif; ?>
                        <a href='../edit-user/?action=editUser&userId=<?= $user->id ?>'>
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
<?php require_once "../template/footer.php"; ?>