<?php
require_once "../connection.php";

$fullname = $_POST['fullname'];
$username = $_POST['username'];
$password = $_POST['password'];

$photo = "IMG_" . time() . ".png";
$target_file = "./uploads/" . $photo;

if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["file"]["name"])). " has been uploaded.";
} else {
    echo "Sorry, there was an error uploading your file.";
}

$sql = "INSERT INTO user (fullname, username, password, photo) 
    VALUES ('$fullname', '$username', '$password', '$photo')";

if ($conn->query($sql) === TRUE) {
    echo "New user created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
  
$conn->close();

echo "<hr><a href='../'>Home</a>";
?>