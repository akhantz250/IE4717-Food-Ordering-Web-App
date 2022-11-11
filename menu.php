<?php
include "./inc/header.php";
include "./inc/db_connection.php";
$categories = array("mains", "starters", "desserts", "drinks");
$selected_category;
if (!isset($_GET["type"])) {
    $selected_category = "mains";
} else {
    $temp = strtolower($_GET["type"]);
    if (in_array($temp, $categories)) {
        $selected_category = $temp;
    } else {
        $selected_category = "mains";
    }
}
$query = "SELECT MenuID, Name, Price, ImageURL FROM `menu` WHERE Category = '$selected_category'
     AND Availability = 'yes'";
$result = mysqli_query($conn, $query);
$menu_items_array = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<main class="menu">
    <nav class="menu-nav">
        <form action="menu.php" method="get">
            <ul>
                <?php
                foreach ($categories as $category) {
                    $text = ucfirst($category);
                    if ($selected_category == $category) {
                        echo "<li><input class='menu-nav-selected' type='submit' value='$text' name='type'></li>";
                    } else {
                        echo "<li><input type='submit' value='$text' name='type'></li>";
                    }
                }
                ?>
            </ul>
        </form>
    </nav>
    <h1>Menu</h1>
    <div class="menu-container">
        <?php foreach ($menu_items_array as $menu_item) : ?>
            <div class="menu-card">
                <div class="menu-item-name"><?php echo $menu_item["Name"] ?></div>
                <img src="./src/img/fooditems/<?php echo $menu_item["ImageURL"] ?>.png" alt="">
                <div class="menu-item-price">$<?php echo $menu_item["Price"] ?></div>
                <div class="menu-item-footer">
                    <button class="add-to-cart-button" data-menuid="<?php echo $menu_item["MenuID"] ?>">Add to cart</button>
                </div>
            </div>
        <?php endforeach; ?>
</main>
<footer>
    Project for IE4717 by Zaw and Zion
</footer>
<script>
    const buttonList = document.querySelectorAll(".add-to-cart-button");
    const cartTotalElement = document.querySelector('#cart-item-total');
    for (const button of buttonList) {
        button.addEventListener('click', (e) => {
            const menuID = e.target.getAttribute("data-menuid");

            fetch("./inc/addtocart.php", { // fetch the file
                method: "POST", // POST method
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                }, // set the content type
                body: "add=" + menuID // value of the input
            }).then(function(response) { // when the response is returned
                return response.json(); // return the response
            }).then(function(myObj) {
                const numberOfItems = myObj["totalitems"];
                cartTotalElement.textContent = `${numberOfItems} items`;
            });
        });
    }
</script>
</body>

</html>
<?php $conn->close(); ?>