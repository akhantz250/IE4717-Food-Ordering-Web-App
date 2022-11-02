<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['cart'])) {
    if (!isset($_POST["name"]) || !isset($_POST["email"]) || !isset($_POST["phoneno"])
    || !isset($_POST["address"]) || !isset($_POST["postalcode"]) || !isset($_POST["unit"])
    || !isset($_POST["message"]) || !isset($_POST["cardholder"]) || !isset($_POST["cc"])
    || !isset($_POST["cvv"]) || !isset($_POST["ccissue"]) || !isset($_POST["ccexpiry"])) {
        echo "Missing post data";
        die();
    }
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phoneno = $_POST["phoneno"];
    $address = $_POST["name"];
    $unitno = $_POST["unit"];
    $postalcode = $_POST["postalcode"];

    $message = $_POST["message"]; // for order
    
    // Create customer data
    $query = "INSERT INTO customers (Name, Email, PhoneNumber, Address, PostalCode, UnitNo) 
              VALUES ('$name', '$email','$phoneno','$address','$postalcode','$unitno')";
    $conn -> query($query);
    $customerID = $conn -> insert_id;

    // Create order
    $query = "INSERT INTO orders (CustomerID, Instructions) VALUES ('$customerID', '$message')";
    $conn -> query($query);
    $orderID = $conn -> insert_id;
    
    // Create progress
    $query = "INSERT INTO orderprogress (OrderID) VALUES ('$orderID')";
    $conn -> query($query);

    // Calculate total amount //
    $totalAmount = 0;
    $cartitems = $_SESSION["cart"];
    foreach ($cartitems as $menuID => $qty) {
        $query = "SELECT Price FROM menu WHERE MenuID = '$menuID'";
        $result = $conn -> query($query);
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $data = $rows[0];
        $unitPrice = $data["Price"];
        $totalAmount += $unitPrice * $qty;
        $query = "INSERT INTO orderitems (MenuID, OrderID, Quantity, UnitPrice) 
                VALUES ('$menuID', '$orderID', '$qty', '$unitPrice')";
        $conn -> query($query);
    }
    $query = "UPDATE orders SET TotalSale='$totalAmount' WHERE OrderID = '$orderID'";
    $conn -> query($query);

    // Clear session variables
    unset($_SESSION['cart']);
    unset($_SESSION['totalitems']);
    // Add placed orders
    if (!isset($_SESSION["placedorders"])) {
        $_SESSION["placedorders"] = array($orderID);
    } else {
        array_push($_SESSION["placedorders"], $orderID);
    }
    session_write_close();
    include("orderconfirmation.php");
    $conn -> close();
    die();
} else if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_SESSION['cart'])) {
    echo "Forbidden";
    $conn -> close();
    die();
}
session_abort();
?>