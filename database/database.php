<?php
require_once "../connection/connection.php";

// user_levels:
// 0 = user; 
// 1 = manager;
// 2 = admin;
$sql = "CREATE TABLE IF NOT EXISTS `users`(
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(25) NOT NULL,
    `surname` varchar(25) NOT NULL,
    `email` varchar(50) NOT NULL,
    `username` varchar(50) NOT NULL,
    `password` varchar(255) NOT NULL,
    `phone_number` varchar(12) NOT NULL,
    `address` varchar(25) NOT NULL,
    `location` varchar(25) NOT NULL,
    `user_level` int(11) NOT NULL,
    `postcode` varchar(14) NOT NULL,
    `dob` DATE NOT NULL,
    PRIMARY KEY (id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

$sql .= "CREATE TABLE IF NOT EXISTS `category`(
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    PRIMARY KEY(id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

$sql .= "CREATE TABLE IF NOT EXISTS `orders` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `date` date NOT NULL,
    `user_id` int(11) NOT NULL,
    `additional_info` VARCHAR(255) DEFAULT NULL,
     PRIMARY KEY (id),
     FOREIGN KEY(`user_id`) REFERENCES users(id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

$sql .= "CREATE TABLE IF NOT EXISTS products(
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `description` varchar(1024) NOT NULL,
    `price` float NOT NULL,
    `imgUrl` varchar(255) NOT NULL,
    `in_stock` tinyint(1) DEFAULT NULL, 
    `category_id` int(11) NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY(category_id) REFERENCES category(id)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

$sql .= "CREATE TABLE IF NOT EXISTS `status` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    PRIMARY KEY(id)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
/*
INSERT INTO `status` (`id`, `name`) VALUES
(1, 'Processing'),
(2, 'On hold'),
(3, 'Completed'),
(4, 'Sent'),
(5, 'Cancelled');
*/
$sql .= "CREATE TABLE IF NOT EXISTS `order_status` (
  `date` date NOT NULL,
  `time` time NOT NULL,
  `order_id` int(11) NOT NULL,
  `status_id` int (1) NOT NULL,
  PRIMARY KEY(`time`, order_id),
  FOREIGN KEY(order_id) REFERENCES orders(id),
  FOREIGN KEY(status_id) REFERENCES status(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

$sql .= "CREATE TABLE IF NOT EXISTS `items` (
    `order_id` int(11) NOT NULL,
    `product_id` int(11) NOT NULL,
    `amount` int(11) NOT NULL,
    `additional info` int(11) DEFAULT NULL,
    PRIMARY KEY(order_id, product_id),
    FOREIGN KEY(order_id) REFERENCES orders(id),
    FOREIGN KEY(product_id) REFERENCES products(id)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

$sql .= "CREATE TABLE IF NOT EXISTS `wishlist` (
    `user_id` int(11) NOT NULL,
    `product_id` int(11) NOT NULL,
    PRIMARY KEY(`user_id`, product_id),
    FOREIGN KEY(`user_id`) REFERENCES users(id),
    FOREIGN KEY(`product_id`) REFERENCES products(id)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

$sql .= "CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `date_time` DATETIME NOT NULL,
  `message_content` TEXT NOT NULL,
  `ticket_id` int(11) NOT NULL,
  PRIMARY KEY(`id`),
  FOREIGN KEY(`ticket_id`) REFERENCES tickets(id),
  FOREIGN KEY(`user_id`) REFERENCES users(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

$sql .= "CREATE TABLE IF NOT EXISTS `tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(127) NOT NULL,
  `user_sender` int(11) NOT NULL,
  `is_open` int(11) NOT NULL,
  PRIMARY KEY(`id`) 
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

if ($conn->multi_query($sql)) {
  echo "<p>Successful</p>";
} else {
  echo "<p>Error: $conn->error </p>";
}
