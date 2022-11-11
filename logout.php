<?php
session_start();
if (isset($_SESSION["userid"])) {
    session_destroy();
    header("Location: ./login.php");
    die();
}
session_write_close();
?>

<?php include "./inc/header.php"; ?>
<main class="main-section">
    <h1 class="section-header">Log Out Page</h1>
    <div class="centered-container">
        You were not logged in to begin with. LOL
    </div>
</main>
</body>
<footer>
    Project for IE4717 by Zaw and Zion
</footer>