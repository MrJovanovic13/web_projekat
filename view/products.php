<?php
require_once "../template/navbar.php";
require_once "../connection/connection.php";
?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Products</title>
  ><link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css'>
<link rel="stylesheet" href="../css/card2.css">

</head>
<body>



<div class="shell">

<div class="buttons-div">
  <form action="../products/" method="post">
    <label for="category">Category:</label>
    <select id="category" name="category" size="0" onchange="this.form.submit()">

      <?php
      $q = "SELECT `id`, `name` 
                FROM `category`";

      $result = $conn->query($q);

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          if(isset($_POST["category"])&&$_POST["category"]==$row["id"]) {
            echo "<option value=" . $row["id"] . " selected>" . $row["name"] . "</option>";
            continue;
          }
          echo "<option value=" . $row["id"] . ">" . $row["name"] . "</option>";
        }
      } else {
        $categoryErr = "No categories";
      }
      ?>

    </select>
    <?php if (isset($categoryErr)) echo "<span style='color:red;'>" . $categoryErr . "</span>"; ?>
  </form>
</div>

  <div class="container">

    <?php
if(isset($_POST["category"])&&$_POST["category"]!=1){ // 1 is the default category in the database which shows all products
  $q = "SELECT `id`, `name`, `description`, `price`, `imgUrl`, `in_stock` 
                FROM `products`
                WHERE `category_id` =".$_POST["category"];
} else {
  $q = "SELECT `id`, `name`, `description`, `price`, `imgUrl`, `in_stock` 
                FROM `products`;";
}
  
  $result = $conn->query($q);

  $counter = 0;

  if ($result->num_rows > 0) {
    echo '<div class="row">';
    while ($row = $result->fetch_assoc()) {
      if($row['in_stock']==0){ continue; }
      if($counter%4 == 0){
          if($counter != 0){
            echo '</div>';
            echo '<div class="row">';
          }

      }
      $counter++;
      echo '
      <div class="col-md-3">
        <div class="wsk-cp-product">
          <div class="wsk-cp-img">
            <img src="../images/'. $row["imgUrl"] .'" alt="'. $row["imgUrl"] .'" />
          </div>
          <div class="wsk-cp-text">
            <div class="title-product">
              <h3>'. $row["name"] .'</h3>
            </div>
            <div class="">
              <p>'.$row["description"].'</p>
            </div>
            <div class="card-footer">
              <div class="wcf-left"><span class="price">'. $row["price"] .'$</span></div>
              <div class="wcf-right"><a href="../controller/cart.php?action=addToCart&id=' . $row['id'] . '&quantity=1" class="buy-btn"><i class="zmdi zmdi-shopping-basket"></i></a></div>
            </div>
          </div>
        </div>
      </div>
      ';
    }
  }
?>
      </div>
    </div>
    
  </div>
</div>
<!-- partial -->
  
</body>
</html>
