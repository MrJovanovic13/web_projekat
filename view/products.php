<?php
require_once "../template/navbar.php";
require_once "../connection/connection.php";

?>
<link rel="stylesheet" href="../css/card.css">

<?php
$q = "SELECT `id`, `name`, `description`, `price`, `imgUrl`, `in_stock` 
                FROM `products`";

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

<?php
require_once "../template/footer.php";
?>