<?php
include "./inc/db_connection.php";
include "./inc/submitorder.php";
include "./inc/header.php";


$myObj = array();
unset($_SESSION['currentOrderTotal']);
$cart_items;
$currentOrderTotal = 0;
if (isset($_SESSION["cart"])) {
    $cart_items = $_SESSION["cart"];
    foreach ($cart_items as $menuKey => $itemQuantity) {
        $query = "SELECT Name, Price, MenuID, ImageURL FROM menu WHERE menuID = '$menuKey'";
        $result = mysqli_query($conn, $query);
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $data = $rows[0];
        $myObj[$menuKey] = array("data" => $data, "quantity" => $itemQuantity);
    }
}
?>
<?php if (isset($_SESSION["cart"])) : ?>
    <main class="checkout-page">
        <h1 class="section-header">Checkout</h1>
        <section class="order-table-section">
            <table class="order-table">
                <tr>
                    <th colspan="2">Item</th>
                    <th>Qty</th>
                    <th>Amount</th>
                </tr>
                <?php if (!empty($myObj)) : ?>
                    <?php foreach ($myObj as $key => $value) : ?>
                        <tr>
                            <td class="order-row-img"><img src="./src/img/fooditems/<?php echo $value["data"]["ImageURL"] ?>.png" alt=""></td>
                            <td>
                                <div><?php echo $value["data"]["Name"] ?></div>
                                <div class="unit-price"><?php echo "($" . $value["data"]["Price"] . ")" ?></div>
                            </td>
                            <td class="centered"><?php echo $value["quantity"] ?></td>
                            <td class="centered"><?php echo "$" . sprintf("%0.2f", $value["data"]["Price"] * $value["quantity"]) ?></td>
                            <?php $currentOrderTotal += $value["data"]["Price"] * $value["quantity"]; ?>
                        </tr>
                    <?php endforeach; ?>
                    <tr class="order-total-row">
                        <td colspan="3" class="centered">Total Amount Payable</td>
                        <td id="order-total"><?php echo "$" . $currentOrderTotal; ?></td>
                    </tr>
                    <tr class="confirm-order-row">
                        <td colspan="4">
                            <button id="confirm-order-button">Confirm Order</button>
                        </td>
                    </tr>
                <?php endif; ?>
        </section>
        </table>
        </section>
<?php endif; ?>
<?php if (!isset($_SESSION["cart"])) : ?>
    <main class="checkout-page">
        <div class="warning-message">Add items into your cart first</div>
    </main>
    <footer>
        Project for IE4717 by Zaw and Zion
    </footer>
    </body>

    </html>
<?php endif; ?>
<?php if (!isset($_SESSION["cart"])) {
    die();
} ?>
<section class="order-info-section hide">
    <form action="./checkout.php" method="post" id="order-form">
        <fieldset>
            <legend>Delivery Information</legend>
            <div class="order-form-row">
                <div class="order-form-component">
                    <label for="order-form-name">Name *</label>
                    <input type="text" id="order-form-name" name="name" required>
                </div>
            </div>
            <div class="order-form-row">
                <div class="order-form-component">
                    <label for="order-form-email">Email *</label>
                    <input type="email" id="order-form-email" name="email" required>
                </div>
            </div>
            <div class="order-form-row">
                <div class="order-form-component">
                    <label for="order-form-phone">Phone Number *</label>
                    <input type="text" id="order-form-phone" name="phoneno" required>
                </div>
            </div>
            <div class="order-form-row">
                <div class="order-form-component">
                    <label for="order-form-address">Address *</label>
                    <input type="text" id="order-form-address" name="address" required>
                </div>
            </div>
            <div class="order-form-row">
                <div class="order-form-component">
                    <label for="order-form-postalcode">Postal Code *</label>
                    <input type="text" id="order-form-postalcode" name="postalcode" required>
                </div>
            </div>
            <div class="order-form-row">
                <div class="order-form-component">
                    <label for="order-form-postalcode">Unit Number</label>
                    <input type="text" id="order-form-unit" name="unit">
                </div>
            </div>
            <div class="order-form-row">
                <div class="order-form-component">
                    <label for="order-form-postalcode">Message</label>
                    <textarea name="message" id="order-form-message" cols="30" rows="6"></textarea>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>Payment Information</legend>
            <div class="order-form-row">
                <div class="order-form-component">
                    <label for="order-form-cardholder">Cardholder Name *</label>
                    <input type="text" id="order-form-cardholder" name="cardholder" required>
                </div>
            </div>
            <div class="order-form-row">
                <div class="order-form-component">
                    <label for="order-form-cc">Credit Card Number *</label>
                    <input type="text" id="order-form-cc" name="cc" required>
                </div>
            </div>
            <div class="order-form-row order-form-multiple">
                <div class="order-form-component">
                    <label for="order-form-cvv">CVV *</label>
                    <input type="text" id="order-form-cvv" name="cvv" required>
                </div>
                <div class="order-form-component">
                    <label for="order-form-address">Issue Date *</label>
                    <input type="text" id="order-form-ccissue" name="ccissue" required placeholder="MM/YY">
                </div>
                <div class="order-form-component">
                    <label for="order-form-postalcode">Expiry Date *</label>
                    <input type="text" id="order-form-ccexpiry" name="ccexpiry" required placeholder="MM/YY">
                </div>
            </div>
        </fieldset>
        <input type="submit" value="Make Payment">
    </form>
</section>
</main>
<footer>
    Project for IE4717 by Zaw and Zion
</footer>
<script>
    const confirmOrderBtn = document.querySelector('#confirm-order-button');
    confirmOrderBtn.onclick = function() {
        const formSection = document.querySelector(".order-info-section");
        const tableSection = document.querySelector(".order-table-section");
        const sectionContainer = document.querySelector(".checkout-page");
        sectionContainer.removeChild(tableSection);
        formSection.classList.remove("hide");
        window.scrollTo(0,0);
    }
</script>
</body>
</html>