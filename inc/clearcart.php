<?php
session_start();
$myObj;
if (!isset($_POST["empty"]) || $_POST["empty"] != "true") {
    $myObj = ["success" => false];
    echo json_encode($myObj);
    die();
}
$myObj = ["success" => true];
unset($_SESSION["cart"]);
unset($_SESSION["totalitems"]);
echo json_encode($myObj);
