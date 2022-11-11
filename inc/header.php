<?php
ini_set('session.cookie_lifetime', 60 * 60 * 24 * 7);
session_start();
$cartTotal = isset($_SESSION["totalitems"]) ? $_SESSION["totalitems"] : 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/stylesheets/style.css">
    <link rel="shortcut icon" href="./src/img/leaf.png" type="image/x-icon">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Primavera</title>
</head>
<body>
    <header class="header">
        <a href="index.php">
            <p id="site-name">PRIMAVERA</p>
        </a>
        <nav class="nav-bar">
            <ul>
                <li><a href="menu.php">Menu</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contacts</a></li>
                <li><a href="order.php">Orders</a></li>
                <li>
                    <a href="cart.php">
                        <div id="cart-button">
                            <span class="material-symbols-outlined">
                                shopping_cart
                            </span>
                            <p id="cart-item-total"><?php echo $cartTotal . " items" ?></p>
                        </div>
                    </a>
                </li>
                <?php if (isset($_SESSION["userid"])) : ?>
                    <li><?php echo $_SESSION["username"]; ?></li>
                    <li>
                        <a href="./logout.php">
                            <span style="display: flex; align-items:center" class="material-symbols-outlined icon">
                                logout
                            </span></a>
                    </li>
                <?php endif; ?>
                <?php if (!isset($_SESSION["userid"])) : ?>
                    <li><a href="login.php">Log-In</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>