<?php 
    class Category{

        var $id;
        var $name;

        function __construct($id,$name)
        {
            $this->id = $id;
            $this->name = $name;
        }
    }
    class CategoryProduct extends Category{

        var $selected;

        function __construct($id,$name,$selected)
        {
            parent::__construct($id,$name);
            $this->selected = $selected;
        }
    }
?>