<?php

class UserValidator
{
    protected $data;
    protected $errors = [];
    protected static $fields = ['username', 'email', 'password', 'retypePassword', 'dob'];
    
    public function __construct($postData)
    {
        $this->data = $postData;
    }
    
    public function validateForm()
    {

        foreach (self::$fields as $field) {
            if (!array_key_exists($field, $this->data)) {
                trigger_error("'$field' is not present in the data");
                return;
            }
        }

        $this->validateUsername();
        $this->validateEmail();
        $this->validatePassword();
        $this->validateRetypePassword();
        $this->validateDob();

        foreach ($this->data as $key => $formInput) { // empty field validation for all input fields which don't have special validation requirements
            if (!in_array($key, self::$fields)) {
                if (empty($formInput)) {
                    $this->addError($key, ucfirst($key . ' cannot be empty!'));
                }
            }
        }
        return $this->errors;
    }

    protected function validateDob()
    {
        $val = self::testInput($this->data['dob']);

        if (empty($val)) {
            $this->addError('dob', 'Date of birth cannot be empty!');
        } elseif (!preg_match("#^([0-9]{4})-([0-9]{2})-([0-9]{2})$#", $this->data['dob'], $parts)) {
            $this->addError('dob', "The date of birth is not a valid date in the format MM/DD/YYYY");
        } elseif (!checkdate($parts[2], $parts[3], $parts[1])) {
            $this->addError('dob', 'The date of birth is invalid. Please check that the month is between 1 and 12 and the day is valid for that month.');
        } elseif (intval($parts[1]) < 1890) {
            $this->addError('dob', 'You must be alive to register.');
        } elseif (!((intval($parts[1]) < (intval(date("Y") - 14))) || // this code precisely checks if user is at least 13 years old.
            (intval($parts[1]) == (intval(date("Y")) - 13) &&
            (intval($parts[2]) < intval(date("m")))) ||
            (intval($parts[1]) == (intval(date("Y")) - 13) &&
            (intval($parts[2]) ==  intval(date("m"))) &&
            (intval($parts[3]) <= intval(date("d")))))) {
            $this->addError('dob', 'You must be at least 13 years old!');
        }
    }

    protected function validateRetypePassword()
    {
        $val = self::testInput($this->data['password']);
        $valRetype = self::testInput($this->data['retypePassword']);

        if ($val != $valRetype) {
            $this->addError('retypePassword', "Passwords don't match!");
        }
    }

    protected function validatePassword()
    {
        $val = self::testInput($this->data['password']);

        if (empty($val)) {
            $this->addError('password', 'Password cannot be empty!');
        } else {
            $uppercase = preg_match('@[A-Z]@', $val);
            $lowercase = preg_match('@[a-z]@', $val);
            $number    = preg_match('@[0-9]@', $val);

            if (!$uppercase || !$lowercase || !$number || strlen($val) < 8) {
                $this->addError('password', 'Password must be longer than 8 characters and it must contain at least 1 uppercase,1 lowercase character and 1 number!');
            }
        }
    }

    protected function validateUsername()
    {
        $val = self::testInput($this->data['username']);
        $database = new Database();

        $q = "SELECT `id` FROM `users` WHERE `username` = ? LIMIT 1";
        $stmt = $database->prepareQuery($q);
        $stmt->bind_param('s', $val);
        $stmt->execute();
        $result = $stmt->get_result();

        if (empty($val)) {
            $this->addError('username', 'Username cannot be empty!');
        } elseif ($result->num_rows > 0) {
            $this->addError('username', 'Username already in use!');
        } else {
            if (!preg_match('/^[a-zA-Z0-9]{6,12}$/', $val)) {
                $this->addError('username', 'Username must be 6-12 chars & alphanumeric');
            }
        }
    }

    protected function validateEmail()
    {
        $val = self::testInput($this->data['email']);
        $database = new Database();

        $q = "SELECT `id` FROM `users` WHERE `email` = ? LIMIT 1";
        $stmt = $database->prepareQuery($q);
        $stmt->bind_param('s', $val);
        $stmt->execute();
        $result = $stmt->get_result();

        if (empty($val)) {
            $this->addError('email', 'Email cannot be empty!');
        } elseif ($result->num_rows > 0) {
            $this->addError('email', 'Email already in use!');
        } else {
            if (!filter_var($val, FILTER_VALIDATE_EMAIL)) {
                $this->addError('email', 'Email must be a valid email address!');
            }
        }
    }

    protected function addError($key, $val)
    {
        $this->errors[$key] = $val;
    }

    public function testInput($info)
    {
        $info = trim($info);
        $info = stripslashes($info);
        $info = htmlspecialchars($info);
        return $info;
    }
}

class AddUserValidator extends UserValidator
{

    protected static $fields = ['username', 'email', 'password', 'retypePassword', 'dob', 'userLevel'];

    public function validateForm()
    {

        foreach (self::$fields as $field) {
            if (!array_key_exists($field, $this->data)) {
                trigger_error("'$field' is not present in the data");
                return;
            }
        }

        $this->validateUsername();
        $this->validateEmail();
        $this->validatePassword();
        $this->validateRetypePassword();
        $this->validateDob();
        $this->validateUserLevel();

        foreach ($this->data as $key => $formInput) { // empty field validation for all input fields which don't have special validation requirements
            if (!in_array($key, self::$fields)) {
                if (empty($formInput)) {
                    $this->addError($key, ucfirst($key . ' cannot be empty!'));
                }
            }
        }
        return $this->errors;
    }

    protected function validateDob()
    {
        $val = self::testInput($this->data['dob']);

        if (empty($val)) {
            $this->addError('dob', 'Date of birth cannot be empty!');
        } elseif (!preg_match("#^([0-9]{4})-([0-9]{2})-([0-9]{2})$#", $this->data['dob'], $parts)) {
            $this->addError('dob', "The date of birth is not a valid date in the format MM/DD/YYYY");
        } elseif (!checkdate($parts[2], $parts[3], $parts[1])) {
            $this->addError('dob', 'The date of birth is invalid. Please check that the month is between 1 and 12 and the day is valid for that month.');
        } elseif (intval($parts[1]) < 1890) {
            $this->addError('dob', 'User must be alive to register.');
        } elseif (!((intval($parts[1]) < (intval(date("Y") - 14))) || // this code precisely checks if user is at least 13 years old.
            (intval($parts[1]) == (intval(date("Y")) - 13) &&
            (intval($parts[2]) < intval(date("m")))) ||
            (intval($parts[1]) == (intval(date("Y")) - 13) &&
            (intval($parts[2]) ==  intval(date("m"))) &&
            (intval($parts[3]) <= intval(date("d")))))) {
            $this->addError('dob', 'User must be at least 13 years old!');
        }
    }

    protected function validateUserLevel()
    {
        $val = self::testInput($this->data['userLevel']);

        if ($val != 0 && $val != 1 && $val != 2) {
            $this->addError('userLevel', "Invalid user level!");
        }
    }
}

class EditUserValidator extends AddUserValidator
{

    protected static $fields = ['username', 'email', 'dob', 'userLevel'];

    public function validateForm()
    {

        foreach (self::$fields as $field) {
            if (!array_key_exists($field, $this->data)) {
                trigger_error("'$field' is not present in the data");
                return;
            }
        }

        $this->validateUsername();
        $this->validateEmail();
        $this->validateDob();
        $this->validateUserLevel();

        foreach ($this->data as $key => $formInput) { // empty field validation for all input fields which don't have special validation requirements
            if (!in_array($key, self::$fields) && $key != "password" && $key != "retypePassword") {
                if (empty($formInput)) {
                    $this->addError($key, ucfirst($key . ' cannot be empty!'));
                }
            }
        }
        return $this->errors;
    }

    protected function validateEmail()
    {
        $val = self::testInput($this->data['email']);
        $userId = self::testInput($this->data["userId"]);
        $database = new Database();

        $q = "SELECT `id` FROM `users` WHERE `email` = ? AND `id` != ? LIMIT 1";
        $stmt = $database->prepareQuery($q);
        $stmt->bind_param('si', $val, $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        if (empty($val)) {
            $this->addError('email', 'Email cannot be empty!');
        } elseif ($result->num_rows > 0) {
            $this->addError('email', 'Email already in use!');
        } else {
            if (!filter_var($val, FILTER_VALIDATE_EMAIL)) {
                $this->addError('email', 'Email must be a valid email address!');
            }
        }
    }
    protected function validateUsername()
    {
        $val = self::testInput($this->data['username']);
        $userId = self::testInput($this->data["userId"]);
        $database = new Database();

        $q = "SELECT `id` FROM `users` WHERE `username` = ? AND `id` != ? LIMIT 1";
        $stmt = $database->prepareQuery($q);
        $stmt->bind_param('si', $val, $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        if (empty($val)) {
            $this->addError('username', 'Username cannot be empty!');
        } elseif ($result->num_rows > 0) {
            $this->addError('username', 'Username already in use!');
        } else {
            if (!preg_match('/^[a-zA-Z0-9]{6,12}$/', $val)) {
                $this->addError('username', 'Username must be 6-12 chars & alphanumeric');
            }
        }
    }
}

class PasswordOnlyValidator extends AddUserValidator
{
    protected static $fields = ['password', 'retypePassword'];
    public function validateForm()
    {
        foreach (self::$fields as $field) {
            if (!array_key_exists($field, $this->data)) {
                trigger_error("'$field' is not present in the data");
                return;
            }
        }

        $this->validatePassword();
        $this->validateRetypePassword();

        return $this->errors;
    }
}

class AccountInfoValidator extends EditUserValidator {
    protected static $fields = ['username', 'email', 'password', 'retypePassword', 'dob'];

    public function validateForm()
    {

        foreach (self::$fields as $field) {
            if (!array_key_exists($field, $this->data)) {
                trigger_error("'$field' is not present in the data");
                return;
            }
        }

        $this->validateUsername();
        $this->validateEmail();
        $this->validatePassword();
        $this->validateRetypePassword();
        $this->validateDob();

        foreach ($this->data as $key => $formInput) { // empty field validation for all input fields which don't have special validation requirements
            if (!in_array($key, self::$fields)) {
                if (empty($formInput)) {
                    $this->addError($key, ucfirst($key . ' cannot be empty!'));
                }
            }
        }
        return $this->errors;
    }

    protected function validateRetypePassword()
    {
        $val = self::testInput($this->data['password']);
        $valRetype = self::testInput($this->data['retypePassword']);

        if ($val != $valRetype) {
            $this->addError('retypePassword', "Passwords don't match!");
        }
    }

    protected function validatePassword()
    {
        $val = self::testInput($this->data['password']);
        $userId = self::testInput($this->data['userId']);
        $database = new Database();

        $q = "SELECT `id`,`password` FROM `users` WHERE `id` = ? LIMIT 1";
        $stmt = $database->prepareQuery($q);
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if (empty($val)) {
            $this->addError('password', 'Password cannot be empty!');
        } elseif($row['password']!=$val) {
            $this->addError('password', 'Incorrect password!');
        } 
    }
}