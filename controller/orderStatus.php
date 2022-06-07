<?php 
    class OrderStatusLight {
        var $name;
        function __construct($name)
        {
            $this->name = $name;
        }
    }
    class OrderStatus extends OrderStatusLight{
        var $id;
        function __construct($id,$name)
        {
            parent::__construct($name);
            $this->id = $id;
        }
    }
    class OrderStatusHistory extends OrderStatusLight {
        var $datetime;
        function __construct($name,$datetime){
            parent::__construct($name);
            $this->datetime = $datetime;
        }
    }
?>