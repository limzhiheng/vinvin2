<?php
include('connection.php');

$role="";
$admin_name = "";
$gender = "";
$email = "";

// Check if 'id' is set in the URL
$row = isset($_GET['id']) ? $_GET['id'] : '';

if (isset($_POST['submit'])) {
    $role = mysqli_real_escape_string($condb, $_POST['role']);
    $admin_name = mysqli_real_escape_string($condb, $_POST['admin_name']);
    $gender = mysqli_real_escape_string($condb, $_POST['gender']);
    $email = mysqli_real_escape_string($condb, $_POST['email']);

    // Check if 'id' is set and not empty before constructing the query
    if (!empty($row)) {
        $updateQuery = "UPDATE admins SET role='$role', admin_name='$admin_name', gender='$gender', email='$email' WHERE id='$row'";
        $updateResult = mysqli_query($condb, $updateQuery);

        if ($updateResult) {
            $message = "Record Modified Successfully";
        } else {
            $message = "Error modifying record: " . mysqli_error($condb);
        }
    } else {
        $message = "Error: ID is empty or not set";
    }
}

// Check if 'id' is set and not empty before fetching data
if (!empty($row)) {
    $sql = "SELECT * FROM admins WHERE id = '$row'";
    $result = mysqli_query($condb, $sql);

    if ($result) {
        $data = mysqli_fetch_array($result);
    } else {
        $message = "Error fetching data: " . mysqli_error($condb);
    }
} else {
    $message = "Error: ID is empty or not set";
}
?>

<html>
<head>
    <title>Edit Admin</title>
    <link href="../css/A_editadmin.css" rel="stylesheet"/>
    <?php include 'A_main_header.php'; ?>
</head>

<body>
    <form name="frmUser" method="post" action="A_editadmin.php?id=<?php echo $row; ?>">
        <div><?php if (isset($message)) echo $message; ?></div>

        <div class='box2'>
            <h2>Edit Admin_info</h2>
            Admin Name: <br>
            <input type="text" name="admin_name" class="txtField" value="<?php echo $data['admin_name']; ?>">
            <br>
            <br>
            Role:<br>
            <select name="role" required>
                <option value="">Select the Role</option>
                <option value="main" <?php echo ($data['role'] === 'main') ? 'selected' : ''; ?>>Main Staff</option>
                <option value="normal" <?php echo ($data['role'] === 'normal') ? 'selected' : ''; ?>>Normal Staff</option>
            </select>
            <br>
            <br>
            Gender: <br>
            <input type="text" name="gender" class="txtField" value="<?php echo $data['gender']; ?>">
            <br>
            <br>
            Email: <br>
            <input type="text" name="email" class="txtField" value="<?php echo $data['email']; ?>">
            <br>
            <br>
            <input type="submit" name="submit" value="Submit" class="btn info"><br>
            <a type="button" class="back" href="A_admin_list.php">Back</a>
        </div>
    </form>
</body>
</html>
