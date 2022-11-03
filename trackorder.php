<?php
include "./inc/header.php";
include "./inc/db_connection.php";
$show_order = false;
$current_progress = 1;
$orderno;
$order_items;
if (isset($_GET['orderno']) && isset($_SESSION['placedorders'])) {
    $orderno = $_GET['orderno'];
    $query = "SELECT OrderID, DateCreated, TotalSale, Progress FROM orders WHERE OrderID = '$orderno'";
    $result = $conn->query($query);
    if (($result->num_rows) > 0) {
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $data = $rows[0];
        $order = $data["OrderID"];
        $show_order = in_array($order, $_SESSION['placedorders']);
    }
    $query = "SELECT Progress FROM orderprogress WHERE OrderID = '$orderno'";
    $result = $conn->query($query);
    if ($result -> num_rows == 0) {
        // order does not exist. redirect.
        header("Location: ./forbidden.php");
        $conn -> close();
        die();
    }
    $current_progress = (mysqli_fetch_all($result, MYSQLI_ASSOC))[0]['Progress'];

    $query = "SELECT menu.Name, menu.Price, menu.ImageURL, orderitems.Quantity 
    FROM orderitems 
    INNER JOIN menu ON menu.MenuID=orderitems.MenuID 
    WHERE orderitems.OrderID = '$orderno';";
    $result = $conn->query($query);
    $order_items = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
if (!$show_order) {
    // the customer didn't make this order. redirect.
    header("Location: ./forbidden.php");
    $conn -> close();
    die();
}
$displayOrder = ($show_order) ? $orderno : "ERROR";
$displaySale = ($show_order) ? $data["TotalSale"] : "ERROR";
$displayDateTime = ($show_order) ? $data["DateCreated"] : "ERROR";

?>
<main class="order-page">
    <div class="modal-container">
        <div class="modal">
            <div class="close-modal">
                <div id="close-modal-btn">
                    <span class="material-symbols-outlined" style="pointer-events: none;">close</span>
                </div>
            </div>
            <div class="order-items-container">
                    <?php foreach ($order_items as $item): ?>
                        <div style="display: flex; flex-direction:row; padding:8px 32px; justify-content: space-between; align-items:center">
                            <img class="display-img" src="./src/img/fooditems/<?php echo $item["ImageURL"]?>.png" alt="" srcset="" style="width: 64px;height:64px;">
                            <p><?php echo $item["Name"]?></p>
                            <p>x<?php echo $item["Quantity"]?></p>
                        </div>
                    <?php endforeach; ?>
            </div>
        </div>
    </div>
    <section class="order-info">
        <div class="order-info-row">
            <div>
                <h2>Order ID</h2>
                <p>#<?php echo $displayOrder ?></p>
            </div>
            <div>
                <h2>Order Placed</h2>
                <p><?php echo $displayDateTime ?></p>
            </div>
            <div>
                <h2>Order Total</h2>
                <p>$<?php echo $displaySale ?></p>
            </div>
            <button id="view-order">View Order</button>
        </div>
    </section>
    <section class="timeline">
        <div class="timeline-grid">


            <?php if ($current_progress >= 4) : ?>
                <?php 
                    $query = "SELECT DeliveryStart FROM orderprogress WHERE OrderID = '$orderno'";
                    $result = $conn -> query($query);
                    $date_string = (mysqli_fetch_all($result, MYSQLI_ASSOC))[0]["DeliveryStart"];
                    $time = substr($date_string, 11, 5);
                ?>
                <div class="timeline-time"><?php echo $time?></div>
                <div class="timeline-checkmark"></div>
                <div class="timeline-card">
                    <div class="timeline-card-icon">
                        <img src="./src/img/order/take-away.png" alt="">
                    </div>
                    <div>
                        <div class="timeline-card-title">Pickup Order</div>
                        <div class="timeline-card-description">Order ready to pickup. Enjoy your meal.</div>
                    </div>
                </div>
            <?php endif; ?>


            <?php if ($current_progress >= 3) : ?>
                <?php 
                    $query = "SELECT DeliveryStart FROM orderprogress WHERE OrderID = '$orderno'";
                    $result = $conn -> query($query);
                    $date_string = (mysqli_fetch_all($result, MYSQLI_ASSOC))[0]["DeliveryStart"];
                    $time = substr($date_string, 11, 5);
                    $title_display = ($current_progress == 3)? "Delivering Order" : "Delivered Order";
                    $description_display = ($current_progress ==3)? "Delivery is on its way.": "We have delivered your order.";
                ?>
                <div class="timeline-time"><?php echo $time?></div>
                <div class="timeline-checkmark"></div>
                <div class="timeline-card">
                    <div class="timeline-card-icon">
                        <img src="./src/img/order/fast-delivery.png" alt="">
                    </div>
                    <div>
                        <div class="timeline-card-title"><?php echo $title_display?></div>
                        <div class="timeline-card-description"><?php echo $description_display?></div>
                    </div>
                </div>
            <?php endif; ?>


            <?php if ($current_progress >= 2) : ?>
                <?php 
                    $query = "SELECT PreparationStart FROM orderprogress WHERE OrderID = '$orderno'";
                    $result = $conn -> query($query);
                    $date_string = (mysqli_fetch_all($result, MYSQLI_ASSOC))[0]["PreparationStart"];
                    $time = substr($date_string, 11, 5);
                    $title_display = ($current_progress == 2)? "Preparing Order" : "Prepared Order";
                    $description_display = ($current_progress ==2)? "We are preparing you order.": "We have prepared your order.";
                ?>
                <div class="timeline-time"><?php echo $time?></div>
                <div class="timeline-checkmark"></div>
                <div class="timeline-card">
                    <div class="timeline-card-icon">
                        <img src="./src/img/order/cooking.png" alt="">
                    </div>
                    <div>
                        <div class="timeline-card-title"><?php echo $title_display?></div>
                        <div class="timeline-card-description"><?php echo $description_display?></div>
                    </div>
                </div>
            <?php endif; ?>


            <?php if ($current_progress >= 1) : ?>
                <?php 
                    $query = "SELECT DateCreated FROM orderprogress WHERE OrderID = '$orderno'";
                    $result = $conn -> query($query);
                    $date_string = (mysqli_fetch_all($result, MYSQLI_ASSOC))[0]["DateCreated"];
                    $time = substr($date_string, 11, 5);
                ?>
                <div class="timeline-time"><?php echo $time?></div>
                <div class="timeline-checkmark"></div>
                <div class="timeline-card">
                    <div class="timeline-card-icon">
                        <img src="./src/img/order/payment-check.png" alt="">
                    </div>
                    <div>
                        <div class="timeline-card-title">Received Order</div>
                        <div class="timeline-card-description">We have received your order.</div>
                    </div>
                </div>
            <?php endif; ?>



        </div>
    </section>
</main>
<footer>
    Project for IE4717 by Zaw and Zion
</footer>
<script>
    const viewOrderBtn = document.querySelector("#view-order");
    const closeModalBtn = document.querySelector("#close-modal-btn");
    const modal = document.querySelector(".modal-container");
    viewOrderBtn.onclick = function() {
        modal.classList.add("show-modal");
    }
    closeModalBtn.onclick = function() {
        modal.classList.remove("show-modal");
    }


</script>
</body>

</html>
<?php $conn->close(); ?>