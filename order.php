<?php include "./inc/header.php" ?>

    <main class="order-page">
        <section class="order-info">
            <div class="order-info-row">
                <div>
                    <h2>Order ID</h2>
                    <p>#234789</p>
                </div>
                <div>
                    <h2>Order Placed</h2>
                    <p>12:00, Wed, 28 Sep</p>
                </div>
                <div>
                    <h2>Order Total</h2>
                    <p>$100.00</p>
                </div>
                <button id="view-order">View Order</button>
            </div>
        </section>
        <section class="timeline">
            <div class="timeline-grid">
                <div class="timeline-checkmark"></div>
                <div class="timeline-card">
                    <div class="timeline-card-icon">
                        <img src="./src/img/order/take-away.png" alt="">
                    </div>
                    <div>
                        <div class="timeline-card-title">Pickup Order</div>
                        <div class="timeline-card-description">Order ready to pickup. Enjoy your meal.</div>
                        <div class="timeline-card-time">14:00</div>
                    </div>
                </div>
                <div class="timeline-checkmark"></div>
                <div class="timeline-card">
                    <div class="timeline-card-icon">
                        <img src="./src/img/order/fast-delivery.png" alt="">
                    </div>
                    <div>
                        <div class="timeline-card-title">Delivered Order</div>
                        <div class="timeline-card-description">We have delivered your order.</div>
                        <div class="timeline-card-time">13:30</div>
                    </div>
                </div>
                <div class="timeline-checkmark"></div>
                <div class="timeline-card">
                    <div class="timeline-card-icon">
                        <img src="./src/img/order/cooking.png" alt="">
                    </div>
                    <div>
                        <div class="timeline-card-title">Prepared Order</div>
                        <div class="timeline-card-description">We have prepared your order.</div>
                        <div class="timeline-card-time">13:00</div>
                    </div>
                </div>
                <div class="timeline-checkmark"></div>
                <div class="timeline-card">
                    <div class="timeline-card-icon">
                        <img src="./src/img/order/payment-check.png" alt="">
                    </div>
                    <div>
                        <div class="timeline-card-title">Received Order</div>
                        <div class="timeline-card-description">We have received your order.</div>
                        <div class="timeline-card-time">12:00</div>
                    </div>
                </div>
                
            </div>
        </section>
    </main>
<footer>
    Project for IE4717 by Zaw and Zion
</footer>
</body>

</html>