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
        <h1>Tickets</h1>
        <br>
        <div class="buttons-div-second">
            <form class="menuForm" action="../open-ticket/">
                <input class="menuButton" type="submit" value="Open a ticket" />
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
                <?php foreach ($tickets as $ticket) : ?>
                    <?php if ($ticket->isOpen) : ?>
                        <tr class="openTicket">
                        <?php else : ?>
                        <tr class="closedTicket">
                        <?php endif; ?>
                        <td><?= $ticket->id ?></td>
                        <td><?= $ticket->name ?></td>
                        <td>
                            <a href='../edit-ticket?action=editTicket&ticketId=<?= $ticket->id ?>'>
                                <button class='iconButton'>
                                    <img class='editIcon' src='../../images/editIcon.png' alt='editIcon'>
                                </button>
                            </a>
                        </td>
                        </tr>
                    <?php endforeach; ?>
            </tbody>
            <?php if (isset($deleteErr)) : ?><span><?= $deleteErr ?> <?php endif ?>
        </table>
    </div>
</div>

<?php
require_once "../template/footer.php";
?>