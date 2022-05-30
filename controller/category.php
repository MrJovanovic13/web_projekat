<?php 
    class Category{

        var $id;
        var $name;
        var $selected;

        function __construct($id,$name,$selected)
        {
            $this->id = $id;
            $this->name = $name;
            $this->selected = $selected;
        }
    }
?>