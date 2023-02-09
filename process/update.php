<?php
require_once "../connection.php";

$last_name = $_POST['last_name'];
$first_name = $_POST['first_name'];
$id = $_POST['id'];

$sql = "UPDATE names SET last_name='$last_name', first_name='$first_name' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Name updated successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
  
$conn->close();

echo "<hr><a href='../'>Home</a>";
?>