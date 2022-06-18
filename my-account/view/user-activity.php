<?php require_once "../template/navbarLogged.php"; ?>
<div class="shell">
    <div class="buttons-div">
        <?php require_once "../template/accountMenu.php"; ?>
    </div><br>
    <div class="container" id="container">
        <h1>User activity</h1>
        <br>
        <div class="buttons-div-second">
            <form class="menuForm" action="../edit-user/?action=editUser">
                <input type="hidden" id="action" name="action" value="editUser">
                <input type="hidden" id="userId" name="userId" value="<?= $userId ?>">
                <input class="menuButton" type="submit" value="Return" />
            </form>
        </div>
        <br>
        <h1>
            Orders:
        </h1>
        <table>
            <thead>
                <tr>
                    <th>Action</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($activitiesOrders as $activity) : ?>
                    <td><?= $activity->action ?></td>
                    <td><?= $activity->date ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <br>
        <h1>
            Tickets:
        </h1>
        <table>
            <thead>
                <tr>
                    <th>Action</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($activitiesTickets as $activity) : ?>
                    <td><?= $activity->action ?></td>
                    <td><?= $activity->date ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</body>

<?php require_once "../template/footer.php"; ?>