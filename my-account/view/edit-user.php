<?php
require_once "../template/navbarLogged.php";

$nameErr = $locationErr = $postcodeErr = $addressErr = $emailErr = $telephoneErr = $surnameErr  = $usernameErr = $userLevelErr = $passwordErr = $retypePasswordErr = "";

?>
<link rel="stylesheet" href="../../css/dashboard.css">

<div class="buttons-div">
<?php
require_once "../template/accountMenu.php";
?>

</div>
<br>
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