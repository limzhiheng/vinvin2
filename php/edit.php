<?php
require_once('connection.php');
session_start();

$message = ''; // Initialize the message

// Edit logic for users
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit'])) {
    $editEmail = $_SESSION['user']; // Assuming the email is unique
    $editUserName = trim($_POST['editUserName']);
    $editGender = $_POST['editGender'];

    // Update user information in the database (replace 'users' with your actual table name)
    $editQuery = "UPDATE users SET user_name = '$editUserName', gender = '$editGender' WHERE email = '$editEmail'";

    if (mysqli_query($condb, $editQuery)) {
        // Edit successful
        $message = 'Information updated successfully!';
        // Update session with new information
        $_SESSION['user_name'] = $editUserName;
        $_SESSION['user_gender'] = $editGender;
    } else {
        // Edit unsuccessful
        $message = 'Error updating information. Please try again.';
    }
}

// Password change logic for users
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['changePassword'])) {
    $changeEmail = $_SESSION['user'];
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];

    // Retrieve the current hashed password from the database
    $getCurrentPasswordQuery = "SELECT password_hash FROM users WHERE email = '$changeEmail'";
    $result = mysqli_query($condb, $getCurrentPasswordQuery);
    $row = mysqli_fetch_assoc($result);
    $currentHashedPassword = $row['password_hash'];

    // Verify the old password
    if (password_verify($oldPassword, $currentHashedPassword)) {
        // Hash the new password
        $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Update the password in the database
        $changePasswordQuery = "UPDATE users SET password_hash = '$newHashedPassword' WHERE email = '$changeEmail'";
        
        if (mysqli_query($condb, $changePasswordQuery)) {
            // Password change successful
            $message = 'Password changed successfully!';
        } else {
            // Password change unsuccessful
            $message = 'Error changing password. Please try again.';
        }
    } else {
        // Old password is incorrect
        $message = 'Incorrect old password. Please try again.';
    }
}

mysqli_close($condb);
?>

<!-- HTML Code -->
<!-- ... (unchanged code above) -->

<h2>Edit Information</h2>
<?php
// Display message if present
if (!empty($message)) {
    echo "<center><div class='sticky-note'>$message</div></center>";
}
?>
<center>
    <form action="" method="POST">
        <label>Name:</label>
        <input type="text" name="editUserName" value="<?php echo $_SESSION['user_name']; ?>" required>
        <br>
        <label>Gender:</label>
        <select name="editGender" required>
            <option value="male" <?php echo ($_SESSION['user_gender'] == 'male') ? 'selected' : ''; ?>>Male</option>
            <option value="female" <?php echo ($_SESSION['user_gender'] == 'female') ? 'selected' : ''; ?>>Female</option>
            <option value="other" <?php echo ($_SESSION['user_gender'] == 'other') ? 'selected' : ''; ?>>Other</option>
        </select>
        <br>
        <input type="submit" name="edit" value="Save Changes">
    </form>

    <h2>Change Password</h2>
    <form action="" method="POST">
        <label>Old Password:</label>
        <input type="password" name="oldPassword" required>
        <br>
        <label>New Password:</label>
        <input type="password" name="newPassword" required>
        <br>
        <input type="submit" name="changePassword" value="Change Password">
    </form>
</center>
</body>
</html>