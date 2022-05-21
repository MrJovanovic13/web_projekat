<?php
require_once "../template/navbarLogged.php";
$nameErr = $locationErr = $postcodeErr = $addressErr = $emailErr = $telephoneErr = $surnameErr  = $usernameErr = $passwordErr = $retypePasswordErr = "";

$name = isset($_POST['name'])?$_POST['name']:"";
$surname = isset($_POST['surname'])?$_POST['surname']:"";
$email = isset($_POST['email'])?$_POST['email']:"";
$telephone = isset($_POST['telephone'])?$_POST['telephone']:"";
$username = isset($_POST['username'])?$_POST['username']:"";
$address = isset($_POST['address'])?$_POST['address']:"";
$location = isset($_POST['location'])?$_POST['location']:"";
$postcode = isset($_POST['postcode'])?$_POST['postcode']:"";
$dob = isset($_POST['dob'])?$_POST['dob']:"";
$password = isset($_POST['password'])?$_POST['password']:"";
$retypePassword = isset($_POST['retypePassword'])?$_POST['retypePassword']:"";


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="../../css/registration.css"> -->
    <link rel="stylesheet" href="../../css/dashboard.css">
    <title>Register</title>
</head>

<body>
<div class="buttons-div">
<?php
require_once "../template/accountMenu.php";
?>

</div>
    <div class="container" id="container">
        <form action="../add-user/" method="post">

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
            <p>
                <input id="button-helper" type="submit" value="Add user">
            </p>
        </form>
    </div>


</body>
<?php
require_once "../template/footer.php";
?>

</html>