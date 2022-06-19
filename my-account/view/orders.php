<?php require_once "../template/navbarLogged.php"; ?>
<div class="shell">
    <div class="buttons-div">
        <?php require_once "../template/accountMenu.php"; ?>
    </div><br>
    <div class="container" id="container">
        <h1>Orders</h1>
        <br>
        <form action="../orders/" method="post">
            <?php while ($i <= $pageCounter) : ?>
                <?php if ($currentPageUser == $i) : ?>
                    <button type="submit" class="page-current" name="page" value="<?= $i ?>"><?= $i ?></button>
                <?php else : ?>
                    <button type="submit" class="page" name="page" value="<?= $i ?>"><?= $i ?></button>
                <?php endif; ?>
                </a>
                <?php $i++ ?>
            <?php endwhile; ?>
        </form>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty(returnOrdersFromPage($currentPageUser, $orders))) : ?>
                    <h1>There are no products!</h1>
                <?php endif; ?>
                <?php foreach (returnOrdersFromPage($currentPageUser, $orders) as $order) : ?>
                    <tr>
                        <td><?= $order->id ?></td>
                        <td><?= $order->date ?></td>
                        <td><?= $order->price ?>$</td>
                        <td><?= $order->status ?></td>

                        <td>
                            <a href='../orders/?action=removeOrder&orderId=<?= $order->id ?>'>
                                <button class='iconButton'>
                                    <img class='deleteIcon' src='../../images/deleteIcon.png' alt='deleteIcon'>
                                </button>
                            </a>

                            <a href='../edit-order/?action=editOrder&userId=<?= $order->userId ?>&orderId=<?= $order->id ?>'>
                                <button class='iconButton'>
                                    <img class='editIcon' src='../../images/editIcon.png' alt='editIcon'>
                                </button>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php if (empty($orders)) : ?>
            <div>
                <h2>You haven't placed any orders!</h2>
            </div>
        <?php endif; ?>
    </div>
</div>
</body>

</html>
<?php require_once "../template/footer.php"; ?>