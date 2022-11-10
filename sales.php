<?php
session_start();
if (!isset($_SESSION["isAdmin"])) {
    header("Location: ./forbidden.php");
    die();
}
include "./inc/db_connection.php";
$display = false;
$no_results = true;

function top_selling_item($db, $category, $start_date, $end_date) {
    $query = "SELECT menu.Name, orderitems.MenuID, SUM(orderitems.Quantity) FROM menu INNER JOIN orderitems ON menu.MenuID = orderitems.MenuID INNER JOIN orders ON orderitems.OrderID = orders.OrderID WHERE DateCreated >= '$start_date' AND DateCreated < DATE_ADD('$end_date', INTERVAL 24 DAY_HOUR) AND menu.Category = '$category' GROUP BY orderitems.MenuID ORDER BY SUM(orderitems.Quantity) DESC";
    $result = $db -> query($query);
    if ($result -> num_rows > 0) {
        $row = (mysqli_fetch_all($result, MYSQLI_ASSOC))[0];
        return $row["Name"];
    }
    else {
        return "None";
    }
}


if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    if (isset($_POST["start-date"]) && isset($_POST['end-date'])) {
        $start_date = $_POST["start-date"];
        $end_date = $_POST["end-date"];
        $display = true;
        $query = "SELECT SUM(TotalSale), COUNT(OrderID), AVG(TotalSale) FROM orders WHERE DateCreated >= '$start_date' AND DateCreated < DATE_ADD('$end_date', INTERVAL 24 DAY_HOUR)";
        $result = $conn -> query($query);
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        if ($rows[0]["COUNT(OrderID)"] > 0) {
            $no_results = false;
        }
        $data = $rows[0];

        $topSellingMain = top_selling_item($conn,"mains", $start_date, $end_date);
        $topSellingDrink = top_selling_item($conn,"drinks", $start_date, $end_date);
        $topSellingDessert = top_selling_item($conn,"desserts", $start_date, $end_date);
        $topSellingStarters = top_selling_item($conn,"starters", $start_date, $end_date);

        $query = "SELECT menu.Name, orderitems.MenuID, SUM(orderitems.Quantity), SUM(orderitems.Quantity * orderitems.UnitPrice)
        FROM menu 
        INNER JOIN orderitems ON menu.MenuID = orderitems.MenuID
        INNER JOIN orders ON orderitems.OrderID = orders.OrderID
        WHERE DateCreated >= '$start_date' AND DateCreated < DATE_ADD('$end_date', INTERVAL 24 DAY_HOUR)
        GROUP BY orderitems.MenuID";

        $result = $conn -> query($query);
        $item_rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}
?>
    <?php include "./inc/admin_header.php" ?>
    <main class="main-section">
        <h1 class="section-header">Sales</h1>
        <div class="centered-container">
            <form action="./sales.php" id="date-picker-form" method="post">
                <label for="start-date">Start Date:</label>
                <input type="date" name="start-date" id="start-date" required>
                <label for="end-date" style="margin-left:32px;">End Date:</label>
                <input type="date" name="end-date" id="end-date" required>
                <button type="submit" style="margin-left:32px;">Enter</button>
            </form>
        </div>
        <?php if (!$display) : ?>
            <div class="centered-container" style="margin-top: 64px;">Nothing to display</div>
        <?php endif; ?>
        <?php if ($display && $no_results) : ?>
            <div class="centered-container" style="margin-top: 64px;">
                <?php echo "There are no results" ?>
            </div>
        <?php endif; ?>
        <?php if ($display && !$no_results) : ?>
            <div class="centered-container" style="margin-top: 64px">
                <div style="margin-bottom: 64px;"><?php echo $start_date . " to " . $end_date?></div>
                <div><?php echo "Total orders: " . $data["COUNT(OrderID)"]?></div>
                <div><?php echo "Total sales: $" . $data["SUM(TotalSale)"]?></div>
                <div><?php echo "Average sale: $" . number_format($data["AVG(TotalSale)"], 2)?></div>
                <div style="margin-top: 64px;"><?php echo "Top selling main: " . $topSellingMain?></div>
                <div><?php echo "Top selling starter: " . $topSellingStarters?></div>
                <div><?php echo "Top selling dessert: " . $topSellingDessert?></div>
                <div><?php echo "Top selling drink: " . $topSellingDrink?></div>
                <table border='1' style="margin:auto; border-collapse: collapse; text-align: center; margin-top: 64px; " class="edit-order-table">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Total Amount</th>
                        </tr>
                    </thead>
                <tbody>
                    <?php foreach ($item_rows as $row) : ?>
                        <tr>
                            <td><?php echo $row["Name"]?></td>
                            <td><?php echo $row["SUM(orderitems.Quantity)"]?></td>
                            <td><?php echo $row["SUM(orderitems.Quantity * orderitems.UnitPrice)"]?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                </table>
            </div>
        <?php endif; ?>
    </main>
    <script>
        const startDateElement = document.getElementById("start-date");
        const endDateElement = document.getElementById("end-date");
        const formElement = document.getElementById("date-picker-form");
        formElement.addEventListener('submit', (e) => {
            if (startDateElement.value > endDateElement.value) {
                alert("Start date cannot be greater than end date.");
                e.preventDefault();
            }
        });
    </script>
</body>
<footer>
    Project for IE4717 by Zaw and Zion
</footer>
</body>