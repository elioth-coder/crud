<?php
session_start();
require_once "../connection.php";

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM user WHERE username='$username' 
    AND password='$password'";

$result = $conn->query($sql);

if($result->num_rows > 0) {
    $_SESSION['logged_in'] = TRUE;
    $user = $result->fetch_assoc();
    $_SESSION['user'] = $user;
    die(header("Location: ../"));
} else {
    echo "<p style='color: red'>Invalid username or password</p>";
}
?>
<a href="../login.php">Login again</a>