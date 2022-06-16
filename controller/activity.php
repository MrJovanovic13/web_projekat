<?php 
    class Activity{

        var $action;
        var $date;

        function __construct($action,$date)
        {
            $this->action = $action;
            $this->date = $date;
        }
    }
?>