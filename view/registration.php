<?php
require_once "../template/navbar.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/dashboard.css">
    <title>Register</title>
</head>

<body>
    <div class="shell">
        <div class="container" id="container">
            <form action="../registration/" method="post">

            <p>
                Name:
                <input type="text" name="name" value="<?= $addUser->name ?>">
                <span class="error"> <?php if (isset($nameErr)) : ?><span><?= $nameErr ?> <?php endif ?></span>
            </p>
            <p>
                Surname:
                <input type="text" name="surname" value="<?= $addUser->surname ?>">
                <span class="error"> <?php if (isset($surnameErr)) : ?><span><?= $surnameErr ?> <?php endif ?></span>
            </p>
            <p>
                Email:
                <input type="text" name="email" value="<?= $addUser->email ?>">
                <span class="error"> <?php if (isset($emailErr)) : ?><span><?= $emailErr ?> <?php endif ?></span>
            </p>
            <p>
                Telephone number:
                <input type="text" name="telephone" value="<?= $addUser->telephone ?>">
                <span class="error"> <?php if (isset($telephoneErr)) : ?><span><?= $telephoneErr ?> <?php endif ?></span>
            </p>
            <p>
                Username:
                <input type="text" name="username" value="<?= $addUser->username ?>">
                <span class="error"> <?php if (isset($usernameErr)) : ?><span><?= $usernameErr ?> <?php endif ?></span>
            </p>
            <p>
                Address:
                <input type="text" name="address" value="<?= $addUser->address ?>">
                <span class="error"> <?php if (isset($addressErr)) : ?><span><?= $addressErr ?> <?php endif ?></span>
            </p>
            <p>
                Location:
                <input type="text" name="location" value="<?= $addUser->location ?>">
                <span class="error"> <?php if (isset($locationErr)) : ?><span><?= $locationErr ?> <?php endif ?></span>
            </p>
            <p>
                Postcode:
                <input type="text" name="postcode" value="<?= $addUser->postcode ?>">
                <span class="error"> <?php if (isset($postcodeErr)) : ?><span><?= $postcodeErr ?> <?php endif ?></span>
            </p>
            <p>
                Data of birth:
                <input type="date" name="dob" value="<?= $addUser->dob ?>">
                <span class="error"> <?php if (isset($dobErr)) : ?><span><?= $dobErr ?> <?php endif ?></span>
            </p>
            <p>
                Password:
                <input type="password" name="password" value="<?= $addUser->password ?>">
                <span class="error"> <?php if (isset($passwordErr)) : ?><span><?= $passwordErr ?> <?php endif ?></span>
            </p>
            <p>
                Retype password:
                <input type="password" name="retypePassword">
                <span class="error"> <?php if (isset($retypePasswordErr)) : ?><span><?= $retypePasswordErr ?> <?php endif ?></span>
            </p>
                <p>
                    <input id="button-helper" type="submit" value="Sign Up">
                </p>
            </form>
        </div>
    </div>


</body>
<?php
require_once "../template/footer.php";
?>

</html>