<?php 
    class Ticket{

        var $id;
        var $name;
        var $isOpen;

        function __construct($id,$name,$isOpen)
        {
            $this->id = $id;
            $this->name = $name;
            $this->isOpen = $isOpen;
        }
    }
?>