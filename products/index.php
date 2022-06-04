<?php
require "../vendor/autoload.php";

$database = new Database();
$categories = array();
$products = array();
$counter = 0;
$productCounter = 0;
$pageCounter = 1;
$i = 1;
$currentPageUser = isset($_GET['page']) ? $_GET['page'] : "1";
$q = "SELECT `id`, `name` FROM `category`";

$result = $database->executeQuery($q);

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    if (isset($_POST["category"]) && $_POST["category"] == $row["id"]) {
      $categoryObj = new CategoryProduct($row['id'], $row['name'], 1);
      $categories[] = $categoryObj;
      continue;
    }
    $categoryObj = new CategoryProduct($row['id'], $row['name'], 0);
    $categories[] = $categoryObj;
  }
} else {
  $categoryErr = "No categories";
}

if (isset($_POST["category"]) && $_POST["category"] != 1) { // 1 is the default category in the database which shows all products
  $q = "SELECT `id`, `name`, `description`, `price`, `imgUrl`, `in_stock` 
                FROM `products`
                WHERE `category_id` =" . $_POST["category"];
} else {
  $q = "SELECT `id`, `name`, `description`, `price`, `imgUrl`, `in_stock` 
                FROM `products`;";
}

$result = $database->executeQuery($q);

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    if ($row['in_stock'] == 0) {
      continue;
    }
    $productObj = new PageProduct($row['id'], $row['name'], $row['price'], $row['imgUrl'], $row['description'],$pageCounter);
    $products[] = $productObj;
    if(!$productCounter++==0&&$productCounter%8==0){
      $pageCounter++;
    }
  }
}

if ($_SERVER['REQUEST_METHOD'] == "GET") {

  include("../view/products.php");
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
  include("../view/products.php");
} else {
  include("../view/products.php");
  die();
}
