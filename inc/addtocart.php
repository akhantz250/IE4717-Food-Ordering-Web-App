<?php
session_start();
$item = $_POST["add"];

if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = array();    
}
if (!isset($_SESSION["totalitems"])) {
    $_SESSION["totalitems"] = 1;
} else {
    $_SESSION["totalitems"] ++;
} 

if (!array_key_exists($item, $_SESSION["cart"])) {
    $_SESSION["cart"][$item] = 1;
} else {
    $_SESSION["cart"][$item] ++;
}
$myObj = ["cartitems" => $_SESSION["cart"], "totalitems" => $_SESSION["totalitems"]];

echo json_encode($myObj);