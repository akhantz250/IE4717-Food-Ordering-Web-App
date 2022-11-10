<?php
session_start();
if (!isset($_SESSION["isAdmin"])) {
    header("Location: ./forbidden.php");
    die();
}
$data = null;
include "./inc/db_connection.php";
$result = $conn -> query("SELECT Name, Email, PhoneNo, Type, Message, OrderNo FROM feedback");
if ($result -> num_rows > 0) {
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
?>
    <?php include "./inc/admin_header.php" ?>
    <main class="main-section">
        <h1 class="section-header">Feedback</h1>
        <div class="centered-container">
            <?php if (is_null($data)): ?>
                Nothing to display
            <?php endif; ?>
            <?php if (!is_null($data)): ?>
                <?php foreach ($data as $row): ?>
                    <div class="feedback-container">
                        <div class="feedback-first-row">
                                <div class="feedback-row-label"><?php echo "By: " . $row["Name"]?></div>
                                <div class="feedback-row-label"><?php echo "Email: " . $row["Email"]?></div>
                                <div class="feedback-row-label"><?php echo "HP: " . $row["PhoneNo"]?></div>
                                <div class="feedback-row-label"><?php echo "Type: " . $row["Type"]?></div>
                                <div class="feedback-row-label"><?php echo "Order: " . $row["OrderNo"]?></div>
                        </div>
                        <div class="feedback-second-row">
                                <div class="feedback-row-label"><?php echo $row["Message"]?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </main>
</body>
<footer>
    Project for IE4717 by Zaw and Zion
</footer>
</body>