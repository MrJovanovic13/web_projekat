<?php require_once "../template/navbarLogged.php"; ?>
<div class="shell">
    <div class="buttons-div">
        <?php require_once "../template/accountMenu.php"; ?>
    </div>
    <br>
    <div class="container" id="container">
        <h1>Ticket conversation</h1>
        <br>
        <div class="buttons-div-second">
            <form class="menuForm" action="../tickets/">
                <input class="menuButton" type="submit" value="Return" />
            </form>
        </div>
        <br>
        <p>
        <h2>Title: <?= $ticket->name ?></h2>
        </p>
        <?php foreach ($messages as $message) : ?>
            <div class="containerChatBox">
                <p class="message"><?= $message->messageContent ?></p>
                <span class="span-right"><?= $message->time ?></span>
                <?php if ($message->userLevel == 2) : ?>
                    <span class="span-left adminUser">
                    <?php elseif ($message->userLevel == 1) : ?>
                        <span class="span-left managerUser">
                        <?php else : ?>
                            <span class="span-left">
                            <?php endif; ?>
                            <?= $message->name ?></span>
            </div>
            </tr>
        <?php endforeach; ?>

        <?php if ($ticket->isOpen) : ?>
            <br>
            <form action="../edit-ticket/" method="post">
                <textarea name="messageContent" placeholder="Write your message here." rows="7" cols="100"></textarea>
                <input type="hidden" name="userId" value="<?= $user->id ?>">
                <input type="hidden" name="ticketId" value="<?= $ticketId ?>">
                <?php if (isset($errorMessageFlag) && $errorMessageFlag == 1) : ?><span class="error"><?= $messageErr ?> <?php endif ?>
                    <br>
                    <input id="button-helper" type="submit" value="Reply to ticket">
            </form>
            <br>
            <form action="../tickets/" method="post">
                <input type="hidden" name="ticketId" value="<?= $ticketId ?>">
                <input id="button-helper" type="submit" value="Close ticket">
            </form>
        <?php endif; ?>
    </div>
</div>
</body>
<?php require_once "../template/footer.php"; ?>