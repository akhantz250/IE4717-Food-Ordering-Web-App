<?php
session_start();
if (!isset($_SESSION["isAdmin"])) {
    header("Location: ./forbidden.php");
    die();
}
include "./inc/db_connection.php";
$result = $conn -> query("SELECT Name, Email, PhoneNo, Type, Message, OrderNo FROM feedback");
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
    <?php include "./inc/admin_header.php" ?>
    <main class="main-section">
        <h1 class="section-header">Feedback</h1>
    </main>
    
</body>
<footer>
    Project for IE4717 by Zaw and Zion
</footer>
</body>