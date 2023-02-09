<?php
require_once "../connection.php";


$sql = "DELETE FROM user WHERE id IN (" . implode(",", $_POST['checked']) . ")";

if ($conn->query($sql) === TRUE) {
    echo "User deleted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
  
$conn->close();

echo "<hr><a href='../'>Home</a>";
?>