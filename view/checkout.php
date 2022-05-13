<?php
require_once "../controller/cartL.php";
require_once "../controller/user.php";
require_once "../template/navbar.php";
require_once "../connection/connection.php";
?>

<link rel="stylesheet" href="../css/dashboard.css">

<div class="container" id="container">
    Delivery information:
    <hr>
    <?php
    $user = unserialize($_SESSION['userObj']);
    echo $user->name . "<br>";
    echo $user->surname . "<br>";
    echo $user->email . "<br>";
    echo $user->address . "<br>";
    echo $user->location . "<br>";
    ?>
    <hr>
    Order details:
    <hr>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
        </tr>
        <?php
        $cart_total = 0;
        for ($i = 0; $i < count($_SESSION['cart']); $i++) {
            echo "<tr>";
            if (isset($_SESSION['cart'][$i])) {
                $cart_item_id = $_SESSION['cart'][$i]->id;
                $q = "SELECT `id`, `name`, `price`
                FROM `products`
                WHERE `id`=$cart_item_id";
                $result = $conn->query($q);
                $row = $result->fetch_assoc();

                $cart_total += $row['price'];

                echo "<th>" . $row['id'] . "</th>";
                echo "<th>" . $row['name'] . "</th>";
                echo "<th>" . $row['price'] . "$</th>";
                echo "<th>" . $_SESSION['cart'][$i]->quantity . "</th>";
            }
            echo "</tr>";
        }
        ?>
    </table>
    VAT: 
    <?php
        echo $cart_total;
    ?>
    <br>
    Shipping: 10$
    <br>
    Total: <?php echo $cart_total+10; ?>
    <a href='../my-account/?action=checkout'>
      <p><button>Checkout</button></p>
    </a>
</div>


<?php
require_once "../template/footer.php";
?>