<?php require_once "connection.php"; ?>
<?php
$id = $_GET['id'];
$sql = "SELECT * FROM user WHERE id=$id";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

?>
<form action="./process/insert.php" method="post" enctype="multipart/form-data">
    <img id="profile" src="./process/uploads/<?php echo $user['photo']; ?>" style="height: 100px;" alt="">
    <hr>
    <button type="button" onclick="chooseImage();">Choose Image</button>
    <input type="file" name="file" id="file" style="display: none;"><br>
    <input type="text" value="<?php echo $user['fullname']; ?>" name="fullname" placeholder="Enter full name." id=""><br>
    <input type="text" value="<?php echo $user['username']; ?>" name="username" placeholder="Enter username." id=""><br>
    <input type="password" value="<?php echo $user['password']; ?>" name="password" placeholder="Enter password." id=""><br>
    <button type="submit">Submit</button>
</form>

<hr>

<?php require_once "connection.php"; ?>

<form action="search.php">
    <input type="search" name="q" id="" placeholder="Enter name to search.."/>
    <button type="submit">Search</button>
</form>
<table border="1">
    <thead>
        <tr>
        <th>ID</th>
        <th>Photo</th>
        <th>Fullname</th>
        <th>Username</th>
        <th>Password</th>
        <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $sql = "SELECT * FROM user";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {?>
            <tr>
            <td><?php echo $row['id']; ?></td>
            <td>
                <img style="height: 75px;" src="./process/uploads/<?php echo $row['photo']; ?>" alt="">
            </td>
            <td><?php echo $row['fullname']; ?></td>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['password']; ?></td>
            <td>
                <a href="./process/delete.php?id=<?php echo $row['id']; ?>">Delete</a>
                |<a href="./edit.php?id=<?php echo $row['id']; ?>">Edit</a>
            </td>
            </tr>
            <?php
            } // end of while...
        } else { ?>
            <tr>
            <td colspan="3" style="text-align: center;">No results found..</td>
            </tr>
        <?php
        } // end of if..else...
        $conn->close();
    ?>
    </tbody>
</table>

<script>
file.onchange = (e) => {
    let imageData = e.target.files[0];

    profile.src = URL.createObjectURL(imageData);
}

function chooseImage() {
    file.click();
}
</script>