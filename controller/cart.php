<?php 
require_once('../controller/cartL.php');

$action = isset($_REQUEST["action"])? $_REQUEST["action"] : "";

    if ($_SERVER['REQUEST_METHOD']=="GET"){
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    if($action=='addToCart'){
        if(!isset($_SESSION['cart'])){
            $_SESSION['cart']=array();
        }
        $id = isset($_GET['id'])?$_GET['id']:"";
        $quantity = isset($_GET['quantity'])?$_GET['quantity']:"";
        $cartO = new CartL($id,$quantity);
        addToCart($cartO,1);
        $cart = $_SESSION['cart'];
        header('Location: ../products/');
    }
    elseif($action=='remove'){
        $id = isset($_GET['id'])?$_GET['id']:0;
        removeFromCart($id);
        header('Location: ../cart/');
    }
}

function addToCart($cartO,$quantity){
    $found = false;
    $index = 0;
    for($i=0;$i<count($_SESSION['cart']);$i++){
        if($_SESSION['cart'][$i]->id==$cartO->id){
            $found = true;
            $index = $i;
        }
    }
    if($found){
        $_SESSION['cart'][$index]->id = $cartO->id;
        $_SESSION['cart'][$index]->quantity =  $_SESSION['cart'][$index]->quantity+$quantity;
    }
    else{
        $_SESSION['cart'][] = $cartO;
    }
}

function removeFromCart($id){
    if(count($_SESSION['cart'])>0)
	for ($i = 0; $i < count($_SESSION['cart']); $i++) {
		if($_SESSION['cart'][$i]->id == $id){
			unset($_SESSION['cart'][$i]);
			$_SESSION['cart'] = array_values($_SESSION['cart']);
			break;
		}
	}
}