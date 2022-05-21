<?php
require_once "../template/navbar.php";
require_once "../connection/connection.php";

?>
<link rel="stylesheet" href="../css/card.css">

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

<div class="container" id="container">

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

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      echo "
    <div class='card'>
  <img class ='image_size' src='../images/" . $row["imgUrl"] . "'alt=" . $row["imgUrl"] . "'" . $row["name"] . "'>
  <h1>" . $row["name"] . "</h1>
  <p class='price'>" . $row["price"] . "$</p>
  <p class='description'>" . $row["description"] . "</p>
  <a  href='../controller/cart.php?action=addToCart&id=" . $row['id'] . "&quantity=1'>
  <p><button >Add to Cart</button></p> </a>
</div>";
    }
  }
  ?>
</div>

<?php
require_once "../template/footer.php";
?>