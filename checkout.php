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
                            <td class="order-row-description">
                                <div><?php echo $value["data"]["Name"] ?></div>
                                <div class="unit-price"><?php echo "($" . $value["data"]["Price"] . ")" ?></div>
                            </td>
                            <td class="centered"><?php echo $value["quantity"] ?></td>
                            <td class="centered"><?php echo "$" . sprintf("%0.2f", $value["data"]["Price"] * $value["quantity"]) ?></td>
                            <?php $currentOrderTotal += $value["data"]["Price"] * $value["quantity"]; ?>
                        </tr>
                    <?php endforeach; ?>
                    <tr class="order-total-row">
                        <td colspan="4" class="centered">Total Amount Payable: <?php echo "$" . $currentOrderTotal; ?></td>
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
                    <input type="text" id="order-form-cc" name="cc" required maxlength="16">
                </div>
            </div>
            <div class="order-form-row order-form-multiple">
                <div class="order-form-component">
                    <label for="order-form-cvv">CVV *</label>
                    <input type="text" id="order-form-cvv" name="cvv" required maxlength="3" minlength="3">
                </div>
                <div class="order-form-component">
                    <label for="order-form-address">Issue Date *</label>
                    <input type="text" id="order-form-ccissue" name="ccissue" required placeholder="MM/YY" maxlength="5" minlength="5">
                </div>
                <div class="order-form-component">
                    <label for="order-form-postalcode">Expiry Date *</label>
                    <input type="text" id="order-form-ccexpiry" name="ccexpiry" required placeholder="MM/YY" maxlength="5" minlength="5">
                </div>
            </div>
        </fieldset>
        <input id="make-payment-btn" type="submit" value="Make Payment">
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

    // form validation

    const formElement = document.querySelector("#order-form");
    const nameInput = document.querySelector("#order-form-name");
    const emailInput = document.querySelector("#order-form-email");
    const phoneInput = document.querySelector("#order-form-phone");
    const postalInput = document.querySelector("#order-form-postalcode");

    const ccInput = document.querySelector("#order-form-cc");
    const cvvInput = document.querySelector("#order-form-cvv");
    const ccIssueInput = document.querySelector("#order-form-ccissue");
    const ccExpiryInput = document.querySelector("#order-form-ccexpiry");
    const cardholderInput = document.querySelector('#order-form-cardholder');

    formElement.addEventListener("submit", (e) => {
        const emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/g;
        const nameRegex = /^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/;
        const ccRegex = /^(?:4[0-9]{12}(?:[0-9]{3})?|(?:5[1-5][0-9]{2}|222[1-9]|22[3-9][0-9]|2[3-6][0-9]{2}|27[01][0-9]|2720)[0-9]{12}|3[47][0-9]{13}|3(?:0[0-5]|[68][0-9])[0-9]{11}|6(?:011|5[0-9]{2})[0-9]{12}|(?:2131|1800|35\d{3})\d{11})$/g;
        const phonenoRegex = /^[6|9|8][0-9]{7}$/g;
        const postalcodeRegex = /^[0-9]{6}$/g;
        const cvvRegex = /^[0-9]{3}$/g;
        const ccDateRegex = /^[0-9]{2}[/][0-9]{2}/;

        if (!nameRegex.test(nameInput.value)) {
            alert("Invalid name");
            e.preventDefault();
            return;
        }
        if (!emailRegex.test(emailInput.value)) {
            alert("Invalid email");
            e.preventDefault();
            return;
        }
        if (!phonenoRegex.test(phoneInput.value)) {
            alert("Invalid phone number");
            e.preventDefault();
            return;
        }
        if (!postalcodeRegex.test(postalInput.value)) {
            alert("Invalid postal code");
            e.preventDefault();
            return;
        }
        if (!nameRegex.test(cardholderInput.value)) {
            alert("Invalid cardholder name");
            e.preventDefault();
            return;
        }
        if (!ccRegex.test(ccInput.value)) {
            alert("Invalid CC number");
            e.preventDefault();
            return;
        }
        if (!cvvRegex.test(cvvInput.value)) {
            alert("Invalid CVV number");
            e.preventDefault();
            return;
        }
        if (!ccDateRegex.test(ccIssueInput.value)) {
            alert("Invalid CC issue date");
            e.preventDefault();
            return;
        }
        if (!ccDateRegex.test(ccExpiryInput.value)) {
            alert("Invalid CC expiry date");
            e.preventDefault();
            return;
        }
        const ccIssueMonth = +ccIssueInput.value.slice(0,2);
        const ccExpiryMonth = +ccExpiryInput.value.slice(0,2);
        const ccIssueYear = +ccIssueInput.value.slice(3);
        const ccExpiryYear = +ccExpiryInput.value.slice(3);
        if (ccIssueMonth > 12 || ccExpiryMonth > 12 || ccIssueMonth == 0 || ccExpiryMonth == 0) {
            alert("Invalid month");
            e.preventDefault();
            return;
        }
        if (ccExpiryYear < ccIssueYear) {
            alert("Issue date greater than expiry");
            e.preventDefault();
            return;
        }
        if (ccExpiryYear == ccIssueYear) {
            if (ccExpiryMonth < ccIssueMonth) {
                alert("Issue date greater than expiry");
                e.preventDefault();
                return; 
            }
        }
    });
</script>
</body>
</html>
<?php $conn -> close(); ?>