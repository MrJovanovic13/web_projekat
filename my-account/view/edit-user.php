<?php require_once "../template/navbarLogged.php"; ?>
<div class="shell">
    <div class="buttons-div">
        <?php require_once "../template/accountMenu.php"; ?>
    </div>
    <br>
    <div class="container" id="container">
        <h1>Edit user</h1>
        <br>
        <div class="buttons-div-second">
            <form class="menuForm" action="../users/">
                <input class="menuButton" type="submit" value="Return" />
            </form>
            <form class="menuForm" action="../user-activity">
                <input type="hidden" id="userId" name="userId" value="<?= $id ?>">
                <input class="menuButton" type="submit" value="User activity" />
            </form>
        </div>
        <br>
        <form action="../edit-user/" method="post">

            <p>
                Name:
                <input type="text" name="name" value="<?= $addUser->name ?>" required>
                <span class="error"> <?= $errors['name'] ?? '' ?></span>
            </p>
            <p>
                Surname:
                <input type="text" name="surname" value="<?= $addUser->surname ?>" required>
                <span class="error"> <?= $errors['surname'] ?? '' ?></span>
            </p>
            <p>
                Email:
                <input type="text" name="email" value="<?= $addUser->email ?>" required>
                <span class="error"><?= $errors['email'] ?? '' ?></span>
            </p>
            <p>
                Telephone number:
                <input type="text" name="telephone" value="<?= $addUser->telephone ?>" required>
                <span class="error"> <?= $errors['telephone'] ?? '' ?></span>
            </p>
            <p>
                Username:
                <input type="text" name="username" value="<?= $addUser->username ?>" required>
                <span class="error"><?= $errors['username'] ?? '' ?></span>
            </p>
            <p>
                Address:
                <input type="text" name="address" value="<?= $addUser->address ?>" required>
                <span class="error"> <?= $errors['address'] ?? '' ?></span>
            </p>
            <p>
                User level: (0=Regular user, 1=Manager, 2=Admin)
                <input type="text" name="userLevel" value="<?= $addUser->userLevel ?>">
                <span class="error"> <?= $errors['userLevel'] ?? '' ?></span>
            </p>
            <p>
                Location:
                <input type="text" name="location" value="<?= $addUser->location ?>" required>
                <span class="error"> <?= $errors['location'] ?? '' ?></span>
            </p>
            <p>
                Postcode:
                <input type="text" name="postcode" value="<?= $addUser->postcode ?>" required>
                <span class="error"> <?= $errors['postcode'] ?? '' ?></span>
            </p>
            <p>
                Date of birth:
                <input type="date" name="dob" value="<?= $addUser->dob ?>" required>
                <span class="error"> <?= $errors['dob'] ?? '' ?></span>
            </p>
            <p>
                Password: (If you wish not to change the password of user just leave this field empty)
                <input type="password" name="password" value="<?= $addUser->password ?>">
                <span class="error"> <?= $passwordErrors['password'] ?? '' ?></span>
            </p>
            <p>
                Retype password:
                <input type="password" name="retypePassword">
                <span class="error"> <?= $passwordErrors['retypePassword'] ?? '' ?></span>
            </p>
            <br>
            <?php if ($userLevel == 2) : ?>
            <p>
                <input id="button-helper" type="submit" name="submit" value="Edit user">
                <input type="hidden" id="userId" name="userId" value="<?= $id ?>">
            </p>
            <?php endif; ?>
        </form>
    </div>
</div>
</body>

<?php require_once "../template/footer.php"; ?>