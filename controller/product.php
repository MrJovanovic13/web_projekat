<?php 
    class Product {
        var $id;
        var $name;
        var $price;
        function __construct($id,$name,$price)
        {
            $this->id = $id;
            $this->name = $name;
            $this->price = $price;
        }
    }
    class ShopProduct extends Product{

        var $imgUrl;
        var $description;

        function __construct($id,$name,$price,$imgUrl,$description)
        {
            parent::__construct($id,$name,$price);
            $this->imgUrl = $imgUrl;
            $this->description = $description;
        }
    }
    class EditProduct extends ShopProduct{

        var $inStock;

        function __construct($id,$name,$price,$imgUrl,$description,$inStock)
        {
            parent::__construct($id,$name,$price,$imgUrl,$description);
            $this->inStock = $inStock;
        }
    }
    class OrderProduct extends Product{
        var $quantity;

        function __construct($id,$name,$price,$quantity)
        {
            parent::__construct($id,$name,$price);
            $this->quantity = $quantity;
        }
    }
    class CartProduct extends OrderProduct {

        var $imgUrl;

        function __construct($id,$quantity,$name,$price,$imgUrl)
        {
            parent::__construct($id,$name,$price,$quantity);
            $this->imgUrl = $imgUrl;
        }
    }
    class AccountMenuProduct extends Product {

        var $inStock;
        var $category;

        function __construct($id,$name,$price,$inStock,$category)
        {
            parent::__construct($id,$name,$price);
            $this->inStock = $inStock;
            $this->category = $category;
        }
    }
?>