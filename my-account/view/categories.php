<?php
require_once "../template/navbarLogged.php";
?>
<link rel="stylesheet" href="../../css/dashboard.css">
<div class="shell">

    <div class="buttons-div">
        <?php
        require_once "../template/accountMenu.php";
        ?>

    </div><br>
    <div class="container" id="container">
        <h1>Categories</h1>
        <br>
        <div class="buttons-div-second">
            <form class="menuForm" action="../add-category/">
                <input class="menuButton" type="submit" value="Add category" />
            </form>
            <form class="menuForm" action="../products/">
                <input class="menuButton" type="submit" value="Return" />
            </form>
        </div>
        <br>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $category) : ?>
                    <tr>
                        <td><?= $category->id ?></td>
                        <td><?= $category->name ?></td>
                        <td>
                            <a href='../categories?action=removeCategory&categoryId=<?= $category->id ?>'>
                                <button class='iconButton'>
                                    <img class='deleteIcon' src='../../images/deleteIcon.png' alt='deleteIcon'>
                                </button>
                            </a>

                            <a href='../edit-category?action=editCategory&categoryId=<?= $category->id ?>'>
                                <button class='iconButton'>
                                    <img class='editIcon' src='../../images/editIcon.png' alt='editIcon'>
                                </button>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php if (isset($deleteErr)) : ?><span><?= $deleteErr ?> <?php endif ?>
    </div>
</div>
<?php
require_once "../template/footer.php";

?>