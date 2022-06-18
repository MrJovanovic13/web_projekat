<?php require_once "../template/navbarLogged.php"; ?>

<!DOCTYPE html>
<html lang="en">
<div class="shell">
    <div class="buttons-div">
        <?php require_once "../template/accountMenu.php"; ?>
    </div><br>
    <div class="container" id="container">
        <h1>Add user</h1>
        <br>
        <form class="menuForm" action="../users/">
            <input class="menuButton" type="submit" value="Return" />
        </form>
        <br>
        <form action="../add-user/" method="post">

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
                Password:
                <input type="password" name="password" value="<?= $addUser->password ?>" required>
                <span class="error"> <?= $errors['password'] ?? '' ?></span>
            </p>
            <p>
                Retype password:
                <input type="password" name="retypePassword" required>
                <span class="error"> <?= $errors['retypePassword'] ?? '' ?></span>
            </p>
            <br>
            <p>
                <input id="button-helper" type="submit" name="submit" value="Add user">
            </p>
        </form>
    </div>
</div>

</body>
<?php require_once "../template/footer.php"; ?>

</html>