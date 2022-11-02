<?php
    include "header.php";
?>
    <main class="main-section order-confirmation">
        <h1 class="section-header">Order Confirmation</h1>
        <div class="centered-container">
            <p>Order placed successfully. Your order number is <?php echo $orderID;?></p>
            <a id="track-order-btn" href="./trackorder.php?orderno=<?php echo $orderID?>">Track this order</a>
        </div>
    </main>
    <footer>
        Project for IE4717 by Zaw and Zion
    </footer>
</body>

</html>