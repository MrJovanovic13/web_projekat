<?php 
    class Message{

        var $name;
        var $messageContent;
        var $time;
        var $userLevel;

        function __construct($name,$messageContent,$time,$userLevel)
        {
            $this->name = $name;
            $this->messageContent = $messageContent;
            $this->time = $time;
            $this->userLevel = $userLevel;
        }
    }
?>