<?php 
    session_start();
    if (!isset($_SESSION["isAdmin"])) {
        header("Location: ./forbidden.php");
        die();
    }
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
                <li><a href="#">Menu</a></li>
                <li><a href="#">Sales</a></li>
                <li><a href="ordermanagement.php">Orders</a></li>
                <li><a href="logoutpage.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main class="main-section">
    </main>
</body>
<footer>
        Project for IE4717 by Zaw and Zion
    </footer>
</body>