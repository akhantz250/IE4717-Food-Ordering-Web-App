<?php
include "./db_connection.php";
session_start();
$myObj = array();
if (!isset($_SESSION["cart"])) {
    $myObj["success"] = false;
    echo json_encode($myObj);
}
$cartitems = $_SESSION["cart"];
foreach ($cartitems as $menukey => $value) {
    $query = "SELECT Price FROM menu WHERE MenuID = '$menukey'";
    $result = mysqli_query($conn, $query);
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $data = $rows[0];
    $myObj["prices"]["$menukey"] = $data["Price"];
}
$myObj["success"] = true;

echo json_encode($myObj);