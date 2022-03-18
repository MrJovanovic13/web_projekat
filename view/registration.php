<?php
require_once "../template/navbar.php";
$nameErr = $surnameErr = $dobErr = $usernameErr = $passwordErr = $retypePasswordErr = "";
$name = $surname = $gender = $dob = $username = $password = $retypePassword = "";
$username = $_SESSION['username'];
$password = $_SESSION['password'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/registration.css">
    <title>Register</title>
</head>

<body>
    <div class="container" id="container">
        <form action="#" method="post">


            <p>
                Username:
                <input type="text" name="username" value="<?php if (isset($username)) echo $username; ?>">
                <span class="error">* <?php echo $usernameErr; ?></span>
            </p>
            <p>
                Password:
                <input type="password" name="password" value="<?php if (isset($password)) echo $password; ?>">
                <span class="error">* <?php echo $passwordErr; ?></span>
            </p>
            <p>
                Retype password:
                <input type="password" name="retypePassword">
                <span class="error">* <?php echo $retypePasswordErr; ?></span>
            </p>
            <p>
                <input type="submit" value="Submit">
            </p>
        </form>
    </div>


</body>
<?php
require_once "../template/footer.php";
?>

</html>