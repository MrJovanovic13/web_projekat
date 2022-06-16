<?php
$user = unserialize($_SESSION['userObj']);
$userLevel = $user->userLevel;
?>
<ul class="menuBar">
<?php if ($userLevel == 2) : ?>
    <li><a href="../account-info/" data-hover="Account info">Account info</a></li>
    <li><a href="../orders/" data-hover="Orders">Orders</a></li>
    <li><a href="../users/" data-hover="Users">Users</a></li>
    <li><a href="../reports/" data-hover="Reports">Reports</a></li>
    <li><a href="../products/" data-hover="Products">Products</a></li>
    <li><a href="../tickets/" data-hover="Tickets">Tickets</a></li>
<?php elseif ($userLevel == 1) : ?>
    <li><a href="../account-info/" data-hover="Account info">Account info</a></li>
    <li><a href="../orders/" data-hover="Orders">Orders</a></li>
    <li><a href="../users/" data-hover="Users">Users</a></li>
    <li><a href="../tickets/" data-hover="Tickets">Tickets</a></li>
<?php else : ?>
    <li><a href="../account-info/" data-hover="Account info">Account info</a></li>
    <li><a href="../orders/" data-hover="Orders">Orders</a></li>
    <li><a href="../tickets/" data-hover="Tickets">Tickets</a></li>
<?php endif; ?>
</ul>