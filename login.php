<?php
session_start();

if(!empty($_SESSION['logged_in'])) {
    die(header("Location: ./"));
}

?>
<h1>Login Here</h1>
<form action="./process/login.php" method="post">
    <input type="text" name="username" placeholder="Enter username" /><br>
    <input type="text" name="password" placeholder="Enter password" /><br>
    <button type="submit">Login</button>
</form>