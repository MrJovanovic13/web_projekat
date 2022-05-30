<?php
require_once "../connection/connection.php";
require_once "../controller/category.php";
require_once "../controller/product.php";

$categories = array();
$products = array();
$counter = 0;
$q = "SELECT `id`, `name` FROM `category`";

$result = $conn->query($q);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if (isset($_POST["category"]) && $_POST["category"] == $row["id"]) {
            $categoryObj = new Category($row['id'], $row['name'], 1);
            $categories[] = $categoryObj;
            continue;
        }
        $categoryObj = new Category($row['id'], $row['name'], 0);
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

      $result = $conn->query($q);

      if ($result->num_rows > 0) {
        echo '<div class="row">';
        while ($row = $result->fetch_assoc()) {
          if ($row['in_stock'] == 0) {
            continue;
          }
          $productObj = new ShopProduct($row['id'],$row['name'],$row['price'],$row['imgUrl'],$row['description']);
          $products[] = $productObj;
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
