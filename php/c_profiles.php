<?php
require_once('connection.php');
session_start();

$updateMessage = ''; // Initialize the update message
$updatePasswordMessage = ''; // Initialize the update password message

// Fetch user information from the database
if (isset($_SESSION['user'])) {
    $userEmail = $_SESSION['user'];
    $fetchUserQuery = "SELECT * FROM users WHERE email = '$userEmail'";
    $result = mysqli_query($condb, $fetchUserQuery);

    if ($result) {
        $userData = mysqli_fetch_assoc($result);
    }
}

// Check if the user is updating their profile
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateProfile'])) {
    $updateUserName = $_POST['registerUserName'];
    $updateGender = $_POST['registerGender'];
    $updateEmail = $_POST['registerEmail'];

    // Update the user's profile in the database
    $updateQuery = "UPDATE users SET user_name = '$updateUserName', gender = '$updateGender', email = '$updateEmail' WHERE email = '$userEmail'";

    if (mysqli_query($condb, $updateQuery)) {
        // Update successful
        $updateMessage = 'Profile updated successfully!';
        $userData['user_name'] = $updateUserName;
        $userData['gender'] = $updateGender;
        $userData['email'] = $updateEmail; // Update the email in the user's session data
    } else {
        // Update unsuccessful
        $updateMessage = 'Error updating profile. Please try again.';
    }
}

// Check if the user is updating their password
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updatePassword'])) {
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];

    // Check if the old password and new password are the same
    if ($oldPassword === $newPassword) {
        $updatePasswordMessage = 'Old password and new password cannot be the same.';
    } else {
        // Retrieve the current hashed password from the database
        $getCurrentPasswordQuery = "SELECT password_hash FROM users WHERE email = '$userEmail'";
        $result = mysqli_query($condb, $getCurrentPasswordQuery);
        $row = mysqli_fetch_assoc($result);
        $currentHashedPassword = $row['password_hash'];

        // Verify the old password
        if (password_verify($oldPassword, $currentHashedPassword)) {
            // Hash the new password
            $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            // Update the password in the database
            $changePasswordQuery = "UPDATE users SET password_hash = '$newHashedPassword' WHERE email = '$userEmail'";
            
            if (mysqli_query($condb, $changePasswordQuery)) {
                // Password change successful
                $updatePasswordMessage = 'Password changed successfully!';
            } else {
                // Password change unsuccessful
                $updatePasswordMessage = 'Error changing password. Please try again.';
            }
        } else {
            // Old password is incorrect
            $updatePasswordMessage = 'Incorrect old password. Please try again.';
        }
    }
}

mysqli_close($condb);
?>

<html>
<head>
    <title>User Profile and Update</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link href="../css/c_profiles.css" rel="stylesheet"/>
    <style>
        .password-toggle {
            cursor: pointer;
        }
    </style>
    <script>
        function togglePasswordVisibility() {
            var oldPasswordInput = document.getElementById('oldPassword');
            var newPasswordInput = document.getElementById('newPassword');
            var toggleButton = document.getElementById('togglePassword');

            if (oldPasswordInput.type === 'password' && newPasswordInput.type === 'password') {
                oldPasswordInput.type = 'text';
                newPasswordInput.type = 'text';
                toggleButton.innerText = 'Hide Password';
            } else {
                oldPasswordInput.type = 'password';
                newPasswordInput.type = 'password';
                toggleButton.innerText = 'Show Password';
            }
        }
    </script>
</head>
<?php include 'header.php'; ?>
<body>
<div id="video-background">
                <video autoplay muted loop>
                <source src="../video/bg.mp4" type="video/mp4">
            Your browser does not support the video tag.
                </video>
            </div>
    <br><br>
    <div class="container">
        <div class="info">
            <h2>User Profile / Update Information</h2>
            <?php
            // Display update message if present
            if (!empty($updateMessage)) {
                echo "<center><div class='sticky-note'>$updateMessage</div></center>";
            }
            ?>
            <!-- Form for updating profile information -->
            <center>
                <form action="" method="POST">
                    <label>Name:</label>
                    <input type="text" name="registerUserName" value="<?php echo isset($userData['user_name']) ? $userData['user_name'] : ''; ?>" required>
                    <br>
                    <label>Email:</label>
                    <input type="text" name="registerEmail" value="<?php echo isset($userData['email']) ? $userData['email'] : ''; ?>" required>
                    <br>
                    <label>Gender:</label>
                    <select name="registerGender" required>
                        <option value="male" <?php echo (isset($userData['gender']) && $userData['gender'] == 'male') ? 'selected' : ''; ?>>Male</option>
                        <option value="female" <?php echo (isset($userData['gender']) && $userData['gender'] == 'female') ? 'selected' : ''; ?>>Female</option>
                        <option value="other" <?php echo (isset($userData['gender']) && $userData['gender'] == 'other') ? 'selected' : ''; ?>>Other</option>
                    </select>
                    <br>
                    <input type="submit" name="updateProfile" value="Update Profile">
                </form>
            </center>
        </div>
        <div class="password">
            <!-- Form for updating password -->
            <h2>Change Password</h2>
            <?php
            // Display password change message if present
            if (!empty($updatePasswordMessage)) {
                echo "<center><div class='sticky-note'>$updatePasswordMessage</div></center>";
            }
            ?>
            <form action="" method="POST">
                <label>Old Password:</label>
                <input type="password" name="oldPassword" id="oldPassword" required>
                <br>
                <label>New Password:</label>
                <input type="password" name="newPassword" id="newPassword" required>
                <br><br>
                <button type="button" id="togglePassword" class="password-toggle" onclick="togglePasswordVisibility()">Show Password</button>
                <br><br>
                <input type="submit" name="updatePassword" value="Change Password">
            </form>
        </div>
    </div>
    <br><br>
    
    <?php include "footer.php"; ?>
</body>
</html>