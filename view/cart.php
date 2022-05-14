<?php
require_once "../controller/cartL.php";
require_once "../template/navbar.php";
require_once "../connection/connection.php";

?>
<link rel="stylesheet" href="../css/cart.css">

<body>

  <div class="container">

    <div class="table">

      <div class="layout-inline row th">
        <div class="col col-pro">Product</div>
        <div class="col col-price align-center ">
          Price
        </div>
        <div class="col col-qty align-center">QTY</div>
        <div class="col">Total</div>
      </div>

      <?php


      $cart_total = 0;

      for ($i = 0; $i < count($_SESSION['cart']); $i++) {
        if (isset($_SESSION['cart'][$i])) {
          $cart_item_id = $_SESSION['cart'][$i]->id;
          $q = "SELECT `id`, `name`, `description`, `price`, `imgUrl`
                FROM `products`
                WHERE `id`=$cart_item_id";
          $result = $conn->query($q);
          $row = $result->fetch_assoc();

          $cart_total += $row['price'] * $_SESSION['cart'][$i]->quantity;

          // <img src='../images/'" . $row['imgUrl'] adds a whitespace between so I had to do a little workaround.
          $image_path = "../images/" . $row["imgUrl"];
          echo "
            
            <div class='layout-inline row'>
        <!-- slika -->
        <div class='col col-pro layout-inline'>
          <img src=$image_path alt=" . $row['imgUrl'] .  ">
          <p>" . $row['name'] . "</p>
        </div>
        <!-- cena -->
        <div class='col col-price col-numeric align-center '>
          <p>" . $row['price'] . "$</p>
        </div>
        <!-- kolicina -->
        <div class='col col-qty layout-inline'>
          <input type='number' name='quantity-1' min='0' max='100' value=".$_SESSION['cart'][$i]->quantity . ">
        </div>
        <!-- ukupno -->
        <div class='col col-total col-numeric'>
          <p>". $row['price'] * $_SESSION['cart'][$i]->quantity ."$</p>
        </div>
        <div class='remove button'>
        <a  href='../controller/cart.php?action=remove&id=" . $row['id'] . "'>
            <p><button >Remove</button></p> </a>
        </div>
        </div>
            ";
        }
      }
      ?>
      <div class="tf">
        <div class="row layout-inline">
          <div class="col">
            <p>VAT</p>
          </div>
          <div class="col"><?php echo $cart_total ?>$</div>
        </div>
        <div class="row layout-inline">
          <div class="col">
            <p>Shipping</p>
          </div>
          <div class="col">10$</div>
        </div>
        <div class="row layout-inline">
          <div class="col">
            <p>Total</p>
          </div>
          <div class="col"><?php echo $cart_total + 10 ?>$</div>
        </div>
      </div>
    </div>
    <a href='../checkout/'>
      <p><button>Checkout</button></p>
    </a>
  </div>

  <?php
  include_once "../template/footer.php";
  ?>
</body>