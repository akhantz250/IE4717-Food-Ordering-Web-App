<?php 
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
        <a href="index.php"><p id="site-name">PRIMAVERA</p></a>
        <nav class="nav-bar">
            <ul>
                <li><a href="menu.php">Menu</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contacts</a></li>
                <li><a href="order.php">Orders</a></li>
                <li>
                    <a href="cart.php">
                        <div id="cart-button">
                            <img id="shopping-cart-icon" src="./src/img/shopping_cart_FILL1_wght400_GRAD0_opsz24.svg" alt="">
                            <p id="cart-item-total"><?php echo $cartTotal . " items"?></p>
                        </div>
                    </a>
                </li>
                <li><?php echo isset($_SESSION['name'])? $_SESSION['name'] : "Guest" ?></li>
            </ul>
        </nav>
    </header>