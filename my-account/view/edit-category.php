<?php require_once "../template/navbarLogged.php"; ?>
<div class="shell">
    <div class="buttons-div">
        <?php require_once "../template/accountMenu.php"; ?>
    </div><br>
    <div class="container" id="container">
        <h1>Edit category</h1>
        <br>
        <form action="../edit-category/" method="post">
            <p>
                Name:
                <input type="text" name="name" value="<?= $name; ?>">
                <span class="error"><?= $nameErr ?? '' ?></span>
            </p>
            <p>
                <input type="hidden" name="categoryId" value="<?php echo $categoryId; ?>">
            </p>
            <br>
            <input id="button-helper" type="submit" value="Edit category">
            </p>
        </form>
    </div>
</div>
</body>
<?php require_once "../template/footer.php"; ?>