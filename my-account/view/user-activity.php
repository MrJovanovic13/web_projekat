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

        <div class="buttons-div-second">
            <form class="menuForm" action="../edit-user/?action=editUser">
            <input type="hidden" id="action" name="action" value="editUser">
                <input type="hidden" id="userId" name="userId" value="<?= $userId ?>">
                <input class="menuButton" type="submit" value="Return" />
            </form>
        </div>
        <br>
        Orders:
        <table>
            <thead>
                <tr>
                    <th>Action</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($activitiesOrders as $activity) : ?>
                    <td><?= $activity->action?></td>
                    <td><?= $activity->date?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <br>
        Tickets:
        <table>
            <thead>
                <tr>
                    <th>Action</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($activitiesTickets as $activity) : ?>
                    <td><?= $activity->action?></td>
                    <td><?= $activity->date?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
require_once "../template/footer.php";
?>