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
    
    
    
    unset($_SESSION['cart']);
    unset($_SESSION['totalitems']);
    echo "Success";
    die();
} else if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_SESSION['cart'])) {
    echo "Something went wrong";
    die();
}
session_abort();
?>