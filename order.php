<?php
include "./inc/header.php";
include "./inc/db_connection.php";
$show_order = false;
$orders;
if (isset($_SESSION["placedorders"])) {
    $orders = $_SESSION["placedorders"];
    $show_order = true;
    rsort($orders);
}
$progress = array("Received", "Preparing", "Delivering", "Delivered");
$display = ($show_order) ? "success" : "failure";
?>
<main class="main-section">
    <h1 class="section-header">Your Orders</h1>
    <div class="centered-container">
        <?php if ($show_order) : ?>
            <?php foreach ($orders as $orderno) : ?>
                <?php
                $query = "SELECT DateCreated, Progress FROM orderprogress WHERE OrderID = '$orderno'";
                $result = $conn->query($query);
                $data = (mysqli_fetch_all($result, MYSQLI_ASSOC))[0];
                ?>
                <div class="view-order-row">
                    <div>
                        <div style="font-size: 18px; margin-bottom:12px">Order #<?php echo $orderno ?></div>
                        <div class="view-order-subrow">
                            <div><?php echo $data["DateCreated"] ?></div>
                            <div><?php echo $progress[$data["Progress"] - 1] ?></div>
                        </div>
                    </div>
                    <a class="view-order-btn" href="./trackorder.php?orderno=<?php echo $orderno ?>">View</a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</main>
<footer>
    Project for IE4717 by Zaw and Zion
</footer>
</body>

</html>