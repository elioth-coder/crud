<?php
session_start();

if(empty($_SESSION['logged_in'])) {
    die(header("Location: ./login.php"));
}
?>
<?php $user = $_SESSION['user']; ?>
<h1>Welcome! <?php echo $user['fullname']; ?></h1>
<img style="height: 100px; width: 100px; border-radius: 50%;" src="./process/uploads/<?php echo $user['photo']; ?>" alt="">
<hr>
<a href="./process/logout.php">Logout</a>
<hr>
<form action="./process/insert.php" method="post" enctype="multipart/form-data">
    <img id="profile" src="profile.png" style="height: 100px;" alt="">
    <hr>
    <button type="button" onclick="chooseImage();">Choose Image</button>
    <input type="file" name="file" id="file" style="display: none;"><br>
    <input type="text" name="fullname" placeholder="Enter full name." id=""><br>
    <input type="text" name="username" placeholder="Enter username." id=""><br>
    <input type="password" name="password" placeholder="Enter password." id=""><br>
    <button type="button" onclick="promptPassword();">Submit</button>
    <button id="submitBtn" type="submit" style="display:none">Submit</button>
</form>

<hr>

<?php require_once "connection.php"; ?>

<form action="search.php">
    <input onkeyup="searchAjax();" type="search" name="q" id="search" placeholder="Enter name to search.."/>
    <button type="submit">Search</button>
</form>
<form action="./process/delete-selected.php" method="post">
<table border="1">
    <thead>
        <tr>
        <th style="text-align: center">
            <input type="checkbox" name="" id="checkall">
        </th>
        <th>ID</th>
        <th>Photo</th>
        <th>Fullname</th>
        <th>Username</th>
        <th>Password</th>
        <th>Action</th>
        </tr>
    </thead>
    <tbody id="tbody">
    <?php
        $sql = "SELECT * FROM user";

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
    <tfoot>
        <tr>
        <td style="text-align: right;" colspan="7">
            <button type="submit">Delete Selected</button>
        </td>
        </tr>
    </tfoot>
    </tbody>
</table>
</form>
<script src="sweetalert.min.js"></script>
<script>
file.onchange = (e) => {
    let imageData = e.target.files[0];

    profile.src = URL.createObjectURL(imageData);
}

checkall.onchange = () => {
    let not_checked = document.querySelectorAll("[name='checked[]']:not(:checked)");
    let checked = document.querySelectorAll("[name='checked[]']:checked");

    if(checkall.checked) {
        not_checked.forEach((elem) => elem.click());
    } else {
        checked.forEach((elem) => elem.click());
    }
}

function chooseImage() {
    file.click();
}

async function promptPassword() {
    let userInput = await swal({
        text: 'Enter a valid password to insert data: ',
        content: "input",
        button: {
            text: "Submit",
            closeModal: false,
        },
    });

    if(userInput) {
        let response = await fetch("./process/prompt-password.php?password=" + userInput);
        let data = await response.json();
    
        console.log(data);
        if(data.status == 'success') {
            swal("Congrats! " + data.message);
            submitBtn.click();
        } else {
            swal("Whahaha! " + data.message);
        }
        
    } else {
        swal("No text entered");
    }
}


async function searchAjax() {
    let userInput = search.value;
    let response = await fetch("./process/ajax-search.php?q=" + userInput);
    let data = await response.text();

    tbody.innerHTML = data;
}
</script>