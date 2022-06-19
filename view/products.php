<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/navbar.css">
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css'>
  <link rel="stylesheet" href="../css/card2.css">
  <link rel="icon" type="image/x-icon" href="../images/favicon.png">
  <title>IT Store</title>
</head>

<body>

  <ul class="header">
    <div class="left-navbar">
      <li><a href="../../home/">
          <img class="logo" src="../images/ITStore.gif" alt="logo"></i></a></a></li>
    </div>
    <div class="right-navbar" id="right-navbar">
      <li><a href="../products/">Home </a></li>
      <li><a href="../products/">Products</a></li>
      <li><a href="../cart/">Cart</a></li>
      <li><a href="../my-account/">My account</a></li>
      <?php if (isset($_SESSION['userObj'])) : ?>
        <li><a href="../logout/">Logout</a></li>
      <?php endif; ?>
    </div>
  </ul>

  <div class="shell">

    <div class="buttons-div">
      <form action="../products/" method="post">
        <label for="category">Category:</label>
        <select id="category" name="category" size="0" onchange="this.form.submit()">
          <?php foreach ($categories as $category) : ?>
            <?php if ($category->selected) : ?>
              <option value=<?= $category->id ?> selected><?= $category->name ?></option>
            <?php else : ?>
              <option value=<?= $category->id ?>><?= $category->name ?></option>
            <?php endif ?>
          <?php endforeach; ?>
        </select>
        <?php if (isset($categoryErr)) : ?><span><?= $categoryErr ?> <?php endif ?></span>
          <div class="pages">
            <?php while ($i <= $pageCounter) : ?>
              <?php if ($currentPageUser == $i) : ?>
                <button type="submit" class="page-current" name="page" value="<?= $i ?>"><?= $i ?></button>
              <?php else : ?>
                <button type="submit" class="page" name="page" value="<?= $i ?>"><?= $i ?></button>
              <?php endif; ?>
              </a>
              <?php $i++ ?>
            <?php endwhile; ?>
          </div>
      </form>
    </div>

    <div class="container">

      <div class="row">
        <?php if (empty(returnProductsFromPage($currentPageUser, $products))) : ?>
          <h1>There are no products available with the selected category!</h1>
        <?php endif; ?>
        <?php foreach (returnProductsFromPage($currentPageUser, $products) as $product) : ?>
          <?php if ($counter % 4 == 0 && $counter != 0) : ?>
      </div>
      <div class="row">
      <?php endif;
          $counter++ ?>
      <div class="col-md-3">
        <div class="wsk-cp-product">
          <div class="wsk-cp-img">
            <img src="../images/<?= $product->imgUrl ?>" alt="<?= $product->imgUrl ?>" />
          </div>
          <div class="wsk-cp-text">
            <div class="title-product">
              <h3><?= $product->name ?></h3>
            </div>
            <div class="">
              <p><?= $product->description ?></p>
            </div>
            <div class="card-footer">
              <div class="wcf-left"><span class="price"><?= $product->price ?>$</span></div>
              <div class="wcf-right"><a href="../controller/cart.php?action=addToCart&id=<?= $product->id ?>&quantity=1" class="buy-btn"><i class="zmdi zmdi-shopping-basket"></i></a></div>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
      </div>
    </div>
  </div>
</body>
<?php require_once "../template/footer.php"; ?>