<?php 
include "./inc/header.php";
include "./inc/db_connection.php";
$displayMessage ="";
// User already logged in
if (isset($_SESSION["userid"])) {
    header("Location: ./index.php");
    $conn -> close();
    die();
}
if (isset($_POST["username"]) && isset($_POST["password"])) {
    $hashedpassword = md5($_POST["password"]);
    $username = $_POST["username"];
    $query = "SELECT UserID FROM users WHERE Username = '$username' AND HashedPassword = '$hashedpassword'";
    $result = $conn -> query($query);
    if ($result -> num_rows > 0) {
        $data = (mysqli_fetch_all($result, MYSQLI_ASSOC))[0];
        $userID = $data["UserID"];
        $_SESSION["userid"] = $userID;
        $_SESSION["username"] = $username;
        $query = "SELECT OrderID FROM userorders WHERE UserID = '$userID'";
        $result = $conn -> query($query);
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $orders = array();
        foreach ($rows as $row) {
            $order = $row["OrderID"];
            array_push($orders, $order);
        }
        $_SESSION["placedorders"] = $orders;
        header("Location: ./index.php");
        $conn -> close();
        die();
    } else {
        $displayMessage = "Wrong Username or Password";
    }
}
?>
    <main class="main-section">
        <h1 class="section-header">Log In Page</h1>
        <div class="centered-container">
        <form action="./login.php" method="post" style="display: flex; flex-direction:column; align-items:center;">
            <label for="username">Username</label>
            <input type="text" name="username" id="password">
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
            <input id="login-btn" type="submit" value="Log me in" style="margin-top: 24px ;">
        </form>
        <div style="color: red; margin-top: 40px;"><?php echo $displayMessage ?></div>
        </div>
        <div style="margin-top: 42px; text-align:center;"><a style="color:blue; text-decoration:underline" href="./register.php">No account? Sign Up Here!</a></div>
    </main> 
    <footer>
        Project for IE4717 by Zaw and Zion
    </footer>
</body>

</html>