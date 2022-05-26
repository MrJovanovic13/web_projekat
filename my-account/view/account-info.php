<?php
require_once "../template/navbarLogged.php";
require_once "../../controller/user.php";
$user = unserialize($_SESSION['userObj']);

$nameErr = $locationErr = $postcodeErr = $addressErr = $emailErr = $telephoneErr = $surnameErr  = $usernameErr = $userLevelErr = $passwordErr = $retypePasswordErr = "";

$name = $user->name;
$surname = $user->surname;
$email = $user->email;
$telephone = $user->telephone;
$username = $user->username;
$address = $user->address;
$location = $user->location;
$postcode = $user->postcode;
$dob = $user->dob;
$password = "";
$retypePassword = "";
$userLevel = $user->user_level;

?>
<link rel="stylesheet" href="../../css/dashboard.css">

<div class="buttons-div">
<?php
require_once "../template/accountMenu.php";
?>

</div><br>

<div class="container" id="container">
        <form action="../account-info/" method="post">

        <p>
                Name:
                <input type="text" name="name" value="<?php if (isset($name)) echo $name; ?>">
                <span class="error"> <?php echo $nameErr; ?></span>
            </p>
            <p>
                Surname:
                <input type="text" name="surname" value="<?php if (isset($surname)) echo $surname; ?>">
                <span class="error"> <?php echo $surnameErr; ?></span>
            </p>
            <p>
                Email:
                <input type="text" name="email" value="<?php if (isset($email)) echo $email; ?>">
                <span class="error"> <?php echo $emailErr; ?></span>
            </p>
            <p>
                Telephone number:
                <input type="text" name="telephone" value="<?php if (isset($telephone)) echo $telephone; ?>">
                <span class="error"> <?php echo $telephoneErr; ?></span>
            </p>
            <p>
                Username:
                <input type="text" name="username" value="<?php if (isset($username)) echo $username; ?>">
                <span class="error"> <?php echo $usernameErr; ?></span>
            </p>
            <p>
                Address:
                <input type="text" name="address" value="<?php if (isset($address)) echo $address; ?>">
                <span class="error"> <?php echo $addressErr; ?></span>
            </p>
            <p>
                Location:
                <input type="text" name="location" value="<?php if (isset($location)) echo $location; ?>">
                <span class="error"> <?php echo $locationErr; ?></span>
            </p>
            <p>
                Postcode:
                <input type="text" name="postcode" value="<?php if (isset($postcode)) echo $postcode; ?>">
                <span class="error"> <?php echo $postcodeErr; ?></span>
            </p>
            <p>
                Data of birth:
                <input type="date" name="dob" value="<?php if (isset($dob)) echo $dob; ?>">
                <span class="error"><?php if(isset($dobErr)) echo $dobErr; ?></span>
            </p>
            <p>
                Password:
                <input type="password" name="password" value="<?php if (isset($password)) echo $password; ?>">
                <span class="error"> <?php echo $passwordErr; ?></span>
            </p>
            <p>
                Retype password:
                <input type="password" name="retypePassword">
                <span class="error"> <?php echo $retypePasswordErr; ?></span>
            </p>
            <br>
            <p>
                <input id="button-helper" type="submit" value="Edit user">
                <input type="hidden" id="userId" name="userId" value="<?php echo $id ?>">
            </p>
        </form>
    </div>
</table>

<?php
require_once "../template/footer.php";

?>