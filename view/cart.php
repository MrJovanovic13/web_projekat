<?php
require_once "../template/navbar.php";
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
      <?php foreach ($cartProducts as $cartProduct) : ?>
        <div class='layout-inline row'>
          <!-- picture -->
          <div class='col col-pro layout-inline'>
            <img src="../images/<?= $cartProduct->imgUrl ?>">
            <p><?= $cartProduct->name ?></p>
          </div>
          <!-- price -->
          <div class='col col-price col-numeric align-center '>
            <p><?= $cartProduct->price ?>$</p>
          </div>
          <!-- quantity -->
          <div class='col col-qty layout-inline'>
            <input type='number' name='quantity-1' min='0' max='100' value=<?= $cartProduct->quantity ?>>
          </div>
          <!-- total -->
          <div class='col col-total col-numeric align-center'>
            <p><?= $cartProduct->price * $cartProduct->quantity ?>$</p>
          </div>
          <div class='col align-center'>
            <div class='remove button'>
              <a href='../controller/cart.php?action=remove&id=<?= $cartProduct->id ?>'>
                <button class='iconButton'>
                  <img class='deleteIcon' src='../images/deleteIcon.png' alt='deleteIcon'>
                </button> </a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
      <?php if ($emptyCart == 1) : ?>
        <div class="row layout-inline">
          <div>
            <p>You have no products in your cart!</p>
          </div>
        </div>
      <?php else : ?>
        <div class=" tf">
          <div class="row layout-inline">
            <div class="col">
              <p>PRICE</p>
            </div>
            <div class="col"><?= $cartTotal ?>$</div>
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
            <div class="col"><?= $cartTotal + 10 ?>$</div>
          </div>
        </div>
    </div>
    <a href='../checkout/'>
      <p><button id='button-helper'>Checkout</button></p>
    </a>
    <br>
    <br>
    <br>
  <?php endif; ?>
  </div>
  <?php
  include_once "../template/footer.php";
  ?>
</body>