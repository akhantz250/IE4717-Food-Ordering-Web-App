<?php 
    include "./inc/db_connection.php";
    session_start();
    if (isset($_SESSION["isAdmin"])) {
        // if already loggedin redirect
        header("Location: ./ordermanagement.php");
        die();
    }
    $loginFail = false;
    if (isset($_POST["username"]) && $_POST["password"]) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $hashedpassword = md5($password);
        $query = "SELECT Username FROM adminusers WHERE Username = '$username' AND HashedPassword = '$hashedpassword'";
        $result = $conn -> query($query);
        if ($result -> num_rows == 0) {
            $loginFail = true;
        } else {
            $_SESSION["isAdmin"] = true;
            header("Location: ./ordermanagement.php");
        }
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
        <h1 class="section-header">Admin Log-In</h1>
        <div class="centered-container">
        <?php if($loginFail): ?>
            <div>Login failed</div>
        <?php endif; ?>
        <form action="./adminlogin.php" method="post" style="display: flex; flex-direction:column; align-items:center;" class="login-form">
            <label for="username">Username</label>
            <input type="text" name="username" id="password">
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
            <input id="login-btn" type="submit" value="Log me in" style="margin-top: 24px ;">
        </form>
        </div>
    </main> 
</body>
<footer>
        Project for IE4717 by Zaw and Zion
    </footer>
</body>