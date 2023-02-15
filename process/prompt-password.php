<?php
session_start();
require_once "../connection.php";

$password = $_GET['password'];

$sql = "SELECT * FROM user WHERE password='$password'";

$result = $conn->query($sql);

if($result->num_rows > 0) {
    $response = ["status" => "success", "message" => "You entered a correct password!"];
} else {
    $response = ["status" => "error", "message" => "You entered an incorrect password!"];
}

echo json_encode($response);
// print_r($response);
?>