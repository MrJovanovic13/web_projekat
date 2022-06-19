<?php require_once "../template/navbarLogged.php"; ?>
<div class="shell">
    <div class="buttons-div"><?php require_once "../template/accountMenu.php"; ?>
    </div><br>
    <div class="container" id="container">
        <h1>Account info</h1>
        <br>
        <div class="buttons-div-second">
            <form class="menuForm" action="../change-password/">
                <input class="menuButton" type="submit" value="Change password" />
            </form>
        </div>
        <br>
        <form action="../account-info/" method="post">

            <p>
                Name:
                <input type="text" name="name" value="<?= $user->name; ?>">
                <span class="error"> <?= $errors['name'] ?? '' ?></span>
            </p>
            <p>
                Surname:
                <input type="text" name="surname" value="<?= $user->surname; ?>">
                <span class="error"> <?= $errors['surname'] ?? '' ?></span>
            </p>
            <p>
                Email:
                <input type="text" name="email" value="<?= $user->email; ?>">
                <span class="error"><?= $errors['email'] ?? '' ?></span>
            </p>
            <p>
                Telephone number:
                <input type="text" name="telephone" value="<?= $user->telephone; ?>">
                <span class="error"> <?= $errors['telephone'] ?? '' ?></span>
            </p>
            <p>
                Username:
                <input type="text" name="username" value="<?= $user->username; ?>">
                <span class="error"><?= $errors['username'] ?? '' ?></span>
            </p>
            <p>
                Address:
                <input type="text" name="address" value="<?= $user->address; ?>">
                <span class="error"> <?= $errors['address'] ?? '' ?></span>
            </p>
            <p>
                Location:
                <input type="text" name="location" value="<?= $user->location; ?>">
                <span class="error"> <?= $errors['location'] ?? '' ?></span>
            </p>
            <p>
                Postcode:
                <input type="text" name="postcode" value="<?= $user->postcode; ?>">
                <span class="error"> <?= $errors['postcode'] ?? '' ?></span>
            </p>
            <p>
                Date of birth:
                <input type="date" name="dob" value="<?= $user->dob; ?>">
                <span class="error"> <?= $errors['dob'] ?? '' ?></span>
            </p>
            <br>
            <p>
                <input id="button-helper" type="submit" name="submit" value="Edit user">
                <input type="hidden" id="userId" name="userId" value="<?= $user->id; ?>">
            </p>
        </form>
    </div>
    <br>
</div>
</body>

<?php require_once "../template/footer.php"; ?>