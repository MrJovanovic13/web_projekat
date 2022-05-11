<?php 
    class CartL{

        var $id;
        var $quantity;

        function __construct($id,$quantity)
        {
            $this->id = $id;
            $this->quantity = $quantity;
        }
    }
?>