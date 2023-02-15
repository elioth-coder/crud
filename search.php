<?php require_once "connection.php"; ?>

<table border="1">
    <thead>
        <tr>
        <th>ID</th>
        <th>Lastname</th>
        <th>Firstname</th>
        <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $q = $_GET['q'];
        $sql = "SELECT * FROM user WHERE fullname LIKE '%$q%'";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {?>
            <tr>
            <td style="text-align: center">
                <input type="checkbox" 
                    value="<?php echo $row['id']; ?>" 
                    name="checked[]" id=""
                />
            </td>
            <td><?php echo $row['id']; ?></td>
            <td>
                <img style="height: 75px;" src="./process/uploads/<?php echo $row['photo']; ?>" alt="">
            </td>
            <td><?php echo $row['fullname']; ?></td>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['password']; ?></td>
            <td>
                <a href="./process/delete.php?id=<?php echo $row['id']; ?>&img=<?php echo $row['photo']; ?>">Delete</a>
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
<hr>
<a href="./">HOME</a>