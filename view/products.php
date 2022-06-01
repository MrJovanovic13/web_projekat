<?php
require_once "../template/navbar.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Products</title>
  >
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css'>
  <link rel="stylesheet" href="../css/card2.css">

</head>

<body>

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
        <?php if (isset($categoryErr)) echo "<span style='color:red;'>" . $categoryErr . "</span>"; ?>
      </form>
    </div>

    <div class="container">
      <div class="row">
        <?php foreach ($products as $product) : ?>
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
<?php
require_once "../template/footer.php";
?>
</html>