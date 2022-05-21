<?php
require_once "../template/navbarLogged.php";

$nameErr = $locationErr = $postcodeErr = $addressErr = $emailErr = $telephoneErr = $surnameErr  = $usernameErr = $userLevelErr = $passwordErr = $retypePasswordErr = "";

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
$userLevel = isset($_POST['userLevel'])?$_POST['userLevel']:"";

?>
<link rel="stylesheet" href="../../css/dashboard.css">

<div class="buttons-div">
    <form action="../add-product/">
        <input type="submit" value="Add product" />
    </form>
    <form action="../add-category/">
        <input type="submit" value="Add category" />
    </form>
    <form action="../add-user/">
        <input type="submit" value="Add user" />
    </form>
    <form action="../orders/">
        <input type="submit" value="Orders" />
    </form>
    <form action="../users/">
        <input type="submit" value="Users" />
    </form>

</div>

<div class="container" id="container">
        <form action="../edit-user/" method="post">

            <p>
                Name:
                <input type="text" name="name" value="<?php echo $row['name']; ?>">
                <span class="error"> <?php echo $nameErr; ?></span>
            </p>
            <p>
                Surname:
                <input type="text" name="surname" value="<?php echo $row['surname']; ?>">
                <span class="error"> <?php echo $surnameErr; ?></span>
            </p>
            <p>
                Email:
                <input type="text" name="email" value="<?php echo $row['email'] ?>">
                <span class="error"> <?php echo $emailErr; ?></span>
            </p>
            <p>
                Telephone number:
                <input type="text" name="telephone" value="<?php echo $row['phone_number']; ?>">
                <span class="error"> <?php echo $telephoneErr; ?></span>
            </p>
            <p>
                Username:
                <input type="text" name="username" value="<?php echo $row['username']; ?>">
                <span class="error"> <?php echo $usernameErr; ?></span>
            </p>
            <p>
                Address:
                <input type="text" name="address" value="<?php echo $row['address']; ?>">
                <span class="error"> <?php echo $addressErr; ?></span>
            </p>
            <p>
                Location:
                <input type="text" name="location" value="<?php echo $row['location']; ?>">
                <span class="error"> <?php echo $locationErr; ?></span>
            </p>
            <p>
                Postcode:
                <input type="text" name="postcode" value="<?php echo $row['postcode']; ?>">
                <span class="error"> <?php echo $postcodeErr; ?></span>
            </p>
            <p>
                User level:
                <input type="text" name="userLevel" value="<?php echo $row['user_level']; ?>">
                <span class="error"> <?php echo $userLevelErr; ?></span>
            </p>
            <p>
                Data of birth:
                <input type="date" name="dob" value="<?php echo $row['dob']; ?>">
                <span class="error"><?php if(isset($dobErr)) echo "<i class='fas fa-exclamation-circle mr-1'></i>".$dobErr; ?></span>
            </p>
            <p>
                Password: 
                <input type="password" name="password" value="<?php  ?>">
                <span class="error"> <?php echo $passwordErr; ?></span>
            </p>
            <p>
                Retype password:
                <input type="password" name="retypePassword">
                <span class="error"> <?php echo $retypePasswordErr; ?></span>
            </p>
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