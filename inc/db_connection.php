<?php
$conn = new mysqli("localhost","root","","primavera");

if($conn->connect_error) {
    die('Connection failed' . $conn->connect_error);
}
?>