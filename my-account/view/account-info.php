<?php
require_once "../template/navbarLogged.php";
?>
<link rel="stylesheet" href="../../css/dashboard.css">
<div class="shell">
    <div class="buttons-div">
        <?php
        require_once "../template/accountMenu.php";
        ?>

    </div><br>
    <div class="container" id="container">
        <form action="../account-info/" method="post">

            <p>
                Name:
                <input type="text" name="name" value="<?= $user->name; ?>">
                <span class="error"> <?php if (isset($nameErr)) : ?><span><?= $nameErr ?> <?php endif ?></span>
            </p>
            <p>
                Surname:
                <input type="text" name="surname" value="<?= $user->surname; ?>">
                <span class="error"> <?php if (isset($surnameErr)) : ?><span><?= $surnameErr ?> <?php endif ?></span>
            </p>
            <p>
                Email:
                <input type="text" name="email" value="<?= $user->email; ?>">
                <span class="error"> <?php if (isset($emailErr)) : ?><span><?= $emailErr ?> <?php endif ?></span>
            </p>
            <p>
                Telephone number:
                <input type="text" name="telephone" value="<?= $user->telephone; ?>">
                <span class="error"> <?php if (isset($telephoneErr)) : ?><span><?= $telephoneErr ?> <?php endif ?></span>
            </p>
            <p>
                Username:
                <input type="text" name="username" value="<?= $user->username; ?>">
                <span class="error"> <?php if (isset($usernameErr)) : ?><span><?= $usernameErr ?> <?php endif ?></span>
            </p>
            <p>
                Address:
                <input type="text" name="address" value="<?= $user->address; ?>">
                <span class="error"> <?php if (isset($addressErr)) : ?><span><?= $addressErr ?> <?php endif ?></span>
            </p>
            <p>
                Location:
                <input type="text" name="location" value="<?= $user->location; ?>">
                <span class="error"> <?php if (isset($locationErr)) : ?><span><?= $locationErr ?> <?php endif ?></span>
            </p>
            <p>
                Postcode:
                <input type="text" name="postcode" value="<?= $user->postcode; ?>">
                <span class="error"> <?php if (isset($postcodeErr)) : ?><span><?= $postcodeErr ?> <?php endif ?></span>
            </p>
            <p>
                Data of birth:
                <input type="date" name="dob" value="<?= $user->dob; ?>">
                <span class="error"> <?php if (isset($dobErr)) : ?><span><?= $dobErr ?> <?php endif ?></span>
            </p>
            <p>
                Password:
                <input type="password" name="password" value="">
                <span class="error"> <?php if (isset($passwordErr)) : ?><span><?= $passwordErr ?> <?php endif ?></span>
            </p>
            <p>
                Retype password:
                <input type="password" name="retypePassword" value="">
                <span class="error"> <?php if (isset($retypePasswordErr)) : ?><span><?= $retypePasswordErr ?> <?php endif ?></span>
            </p>
            <br>
            <p>
                <input id="button-helper" type="submit" value="Edit user">
                <input type="hidden" id="userId" name="userId" value="<?= $user->id; ?>">
            </p>
        </form>
    </div>


    <?php
    require_once "../template/footer.php";

    ?>