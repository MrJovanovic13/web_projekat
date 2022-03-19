<?php
	class LoggedUser{
		
		var $id;
		var $name;
		var $surname;
        var $email;
        var $username;
        var $password;
        var $telephone;
        var $address;
        var $location;
		var $user_level;
		var $postcode;
		var $dob;

		function __construct($id,$name, $surname,$email,$username,$password,$telephone,$address,$location,$user_level,$postcode,$dob){
			$this->id = $id;
			$this->name = $name;
			$this->surname = $surname;
            $this->email= $email;
			$this->username = $username;
			$this->password = $password;
            $this->telephone = $telephone;
			$this->address = $address;
            $this->location = $location;
			$this->user_level = $user_level;
			$this->postcode = $postcode;
			$this->dob = $dob;
		}
		
	}
?>