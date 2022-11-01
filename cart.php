<?php 
    include "./inc/header.php";
    include "./inc/db_connection.php";
    $myObj = array();
    $cart_items;
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
    <main class="cart-page">
        <h1>Your Cart</h1>
        <section class="cart-row-container">
            <?php if (!empty($myObj)): ?>
                <?php foreach ($myObj as $key=>$value) : ?>
                    <div class="cart-row" data-menuid="<?php echo $myObj[$key]["data"]["MenuID"]?>">
                        <img src="./src/img/fooditems/<?php echo $myObj[$key]["data"]["ImageURL"]?>.png">
                        <div class="cart-row-name"><?php echo $myObj[$key]["data"]["Name"] ?></div>
                        <div class="cart-row-quantity-wrapper">
                            <div class="remove-cart-btn" data-menuid="<?php echo $myObj[$key]["data"]["MenuID"]?>"><span class="material-symbols-outlined">remove</span></div>
                            <div class="cart-quantity" data-menuid-quantity="<?php echo $myObj[$key]["data"]["MenuID"]?>"><?php echo $myObj[$key]["quantity"] ?></div>
                            <div class="add-cart-btn" data-menuid="<?php echo $myObj[$key]["data"]["MenuID"]?>"><span class="material-symbols-outlined">add</span></div>
                        </div>
                        <div class="cart-row-price-wrapper">
                            $0.00
                        </div>
                    </div>
                <?php endforeach; ?>
                <div class="cart-section-footer">
                <div class="cart-total-row">Total: $100.00</div>
                <div class="cart-section-footer-buttons">
                    <button id="cart-section-footer-clear">Clear All</button>
                    <button id="cart-section-footer-checkout">Checkout</button>
                </div>
        </div>
            <?php endif; ?>
            <?php if (empty($myObj)): ?>
                <div id="empty-cart">Your cart is empty</div>
            <?php endif; ?>
        </section>
    </main>
    <footer>
        Project for IE4717 by Zaw and Zion
    </footer>
    <script>
        const cartTotalElement = document.querySelector("#cart-item-total");
        const removeBtnList = document.querySelectorAll(".remove-cart-btn");
        const addBtnList = document.querySelectorAll(".add-cart-btn");
        const cartRowContainerElement = document.querySelector(".cart-row-container");
        for (const addBtnElement of addBtnList) {
            addBtnElement.addEventListener("click", (e) => {
                const menuID = e.target.getAttribute("data-menuid");
                console.log(menuID);
                fetch("./inc/addtocart.php", { // fetch the file
                    method: "POST", // POST method
                    headers: { "Content-Type": "application/x-www-form-urlencoded" }, // set the content type
                    body: "add=" + menuID // value of the input
                }).then(function (response) { // when the response is returned
                    return response.json(); // return the response
                }).then(function (myObj) {
                    const numberOfItems = myObj["totalitems"];
                    cartTotalElement.textContent = `${numberOfItems} items`;
                    const quantityDisplayElement = document.querySelector(`[data-menuid-quantity="${menuID}"]`);
                    quantityDisplayElement.textContent = myObj["cartitems"][menuID];
                });
            
            })
        }
        for (const removeBtnElement of removeBtnList) {
            removeBtnElement.addEventListener("click", (e) => {
                const menuID = e.target.getAttribute("data-menuid");
                console.log(menuID);
                fetch("./inc/removefromcart.php", { // fetch the file
                    method: "POST", // POST method
                    headers: { "Content-Type": "application/x-www-form-urlencoded" }, // set the content type
                    body: "remove=" + menuID // value of the input
                }).then(function (response) { // when the response is returned
                    return response.json(); // return the response
                }).then(function (myObj) {
                    if (!myObj["success"]) {
                        alert("Can't go below zero");
                        return;
                    }
                    if (myObj["totalitems"] == 0) {
                        location.reload();
                        return;
                    }
                    if (myObj["quantity"] == 0) {
                        const row = document.querySelector(`.cart-row[data-menuid="${menuID}"`);
                        cartRowContainerElement.removeChild(row);
                    }
                    const numberOfItems = myObj["totalitems"];
                    cartTotalElement.textContent = `${numberOfItems} items`;
                    const quantityDisplayElement = document.querySelector(`[data-menuid-quantity="${menuID}"]`);
                    quantityDisplayElement.textContent = myObj["quantity"];
                });
            
            })
        }
    </script>
</body>

</html>