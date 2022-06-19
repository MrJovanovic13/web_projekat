<?php 
    class Order{

        var $id;
        var $date;
        var $price;
        var $status;
        var $userId;

        function __construct($id,$date,$price,$status,$userId)
        {
            $this->id = $id;
            $this->date = $date;
            $this->price = $price;
            $this->status = $status;
            $this->userId = $userId;
        }
    }
    class AdminMenuOrder extends Order{

        var $page;

        function __construct($id,$date,$price,$status,$userId,$page)
        {
            parent::__construct($id,$date,$price,$status,$userId);
            $this->page = $page;
        }
    }
?>