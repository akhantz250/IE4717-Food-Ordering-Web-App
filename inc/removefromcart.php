<?php

session_start();
$item = $_POST["remove"];
$myObj;
$quantity;
// Removing an item that does not exist
if (!isset($_SESSION['cart'][$item])) {
    $myObj = ["success" => false, "removed" => $item, "quantity" => 0, "totalitems" => $_SESSION["totalitems"]];
    echo json_encode($myObj);
    die();
}

if ($_SESSION['cart'][$item] == 1) {
    unset($_SESSION['cart'][$item]);
    $quantity = 0;
} else {
    $_SESSION['cart'][$item]--;
    $quantity = $_SESSION['cart'][$item];
}
    $_SESSION["totalitems"]--;
    $myObj = ["success" => true, "removed" => $item, "quantity" => $quantity, "totalitems" => $_SESSION["totalitems"]];

    echo json_encode($myObj);
