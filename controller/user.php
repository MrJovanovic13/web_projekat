<?php
	class LightUser {
		var $id;
		var $name;
		var $email;

		function __construct($id,$name,$email){
			$this->id = $id;
			$this->name = $name;
			$this->email= $email;
	}
}
	class LoggedUser extends LightUser{
		
		var $surname;
        var $username;
        var $password;
        var $telephone;
        var $address;
        var $location;
		var $user_level;
		var $postcode;
		var $dob;

		function __construct($id,$name, $surname,$email,$username,$password,$telephone,$address,$location,$user_level,$postcode,$dob){
            parent::__construct($id,$name,$email);

			$this->surname = $surname;
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