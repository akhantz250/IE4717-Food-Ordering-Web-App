<?php include "./inc/header.php"; 
    $isLoggedOut = false;
    if (isset($_SESSION["isAdmin"])) {
        unset($_SESSION["isAdmin"]);
        $isLoggedOut = true;
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
    </header>
    <main class="main-section">
        <h1 class="section-header">Log Out Page</h1>
        <div class="centered-container">
            <?php 
            if ($isLoggedOut) {
                echo "You are logged out.";
            } else {
                echo "You were not logged in to begin with.";
            }
            ?>
            <a href="./loginpage.php" style="color: blue; margin-top:32px;">Log In</a>
        </div>
    </main> 
</body>
<footer>
        Project for IE4717 by Zaw and Zion
    </footer>
</body>