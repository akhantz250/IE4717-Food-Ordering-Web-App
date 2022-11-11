<?php
include "./inc/header.php";
include "./inc/db_connection.php";
$displayMessage = "";
// User already logged in
if (isset($_SESSION["userid"])) {
    header("Location: ./index.php");
    $conn->close();
    die();
}
if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["confirm-password"])) {
    if ($_POST["password"] != $_POST["confirm-password"]) {
        $displayMessage = "Passwords do not match";
    } else {
        $hashedpassword = md5($_POST["password"]);
        $username = $_POST["username"];
        $query = "SELECT UserID FROM users WHERE Username = '$username'";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            $displayMessage = "Username already taken";
        } else {
            $query = "INSERT INTO users (Username, HashedPassword) VALUES ('$username','$hashedpassword')";
            $result = $conn->query($query);
            $userID = $conn->insert_id;
            $_SESSION["userid"] = $userID;
            $_SESSION["username"] = $username;
            header("Location: ./index.php");
            $conn->close();
            die();
        }
    }
}
?>
<main class="main-section">
    <h1 class="section-header">Register</h1>
    <div class="centered-container">
        <form id="register-form" action="./register.php" method="post" style="display: flex; flex-direction:column; align-items:center;" class="login-form">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required minlength="5" maxlength="16">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required minlength="8">
            <label for="password">Confirm Password</label>
            <input type="password" name="confirm-password" id="confirm-password" required minlength="8">
            <input id="login-btn" type="submit" value="Register" style="margin-top: 24px ;">
        </form>
        <div style="color: red; margin-top: 40px;"><?php echo $displayMessage ?></div>
    </div>
</main>
<footer>
    Project for IE4717 by Zaw and Zion
</footer>
<script>
    const formElement = document.querySelector("#register-form");
    const usernameElement = document.getElementById("username");
    const passwordElement = document.getElementById("password");
    const confirmPasswordElement = document.getElementById("confirm-password");

    formElement.addEventListener("submit", (e) => {
        const password = passwordElement.value;
        const confirmPassword = confirmPasswordElement.value;
        if (password !== confirmPassword) {
            alert("Passwords do not match!");
            e.preventDefault();
        }
    });
</script>
</body>

</html>