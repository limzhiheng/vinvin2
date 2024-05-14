<?php
require_once('connection.php');
session_start();

$registrationMessage = '';

// Registration logic for admins
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['registerAdmin'])) {
    $registerAdminName = trim($_POST['registerAdminName']);
    $registerAdminPassword = $_POST['registerAdminPassword'];
    $registerAdminEmail = $_POST['registerAdminEmail'];
    $registerAdminGender = $_POST['registerAdminGender'];
    $role = $_POST['role']; // Added to get the selected role

    // Hash the password for admin
    $hashedAdminPassword = password_hash($registerAdminPassword, PASSWORD_DEFAULT);

    // Insert the admin into the database (replace 'admins' with your actual admin table name)
    $registerAdminQuery = "INSERT INTO admins (admin_name, password_hash, email, gender, role) VALUES ('$registerAdminName', '$hashedAdminPassword', '$registerAdminEmail', '$registerAdminGender', '$role')";

    if (mysqli_query($condb, $registerAdminQuery)) {
        // Registration successful
        $registrationMessage = 'Add Admin Successfully!';
        // Store additional admin information in the session
        $_SESSION['admin'] = $registerAdminEmail;
        $_SESSION['admin_name'] = $registerAdminName;
        $_SESSION['admin_gender'] = $registerAdminGender;
        $_SESSION['admin_role'] = $role; // Added to store the role in the session
    } else {
        // Registration unsuccessful
        $registrationMessage = 'Error creating account. Please try again.';
    }
}

mysqli_close($condb);
?>


<!DOCTYPE html>
    <html>
        <head>
	        <title>Zeta Shop - Add Member(Staff)</title>
	            <link href="../css/A_addadmin.css" rel="stylesheet" />
	        <?php include 'A_main_header.php'; ?>	
        </head>	
    <script>
function togglePasswordVisibility() {
    var passwordInput = document.getElementById('registerAdminPassword');
        var toggleButton = document.getElementById('togglePassword');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                    toggleButton.innerText = 'Hide Password';
                } else {
            passwordInput.type = 'password';
        toggleButton.innerText = 'Show Password';
    }
}
</script>
    <body>
        <!-- Login Form -->
            <center>
                <h2>Add Admins</h2>
            <?php
        if (!empty($registrationMessage)) {
    echo "<div class='sticky-note'>$registrationMessage</div>";
}
    ?>
        <form action="" method="POST">
            <label>Admin Name:</label><br>
        <input type="text" name="registerAdminName" required>
    <br>
    <label>Role:</label><br>
    <select name="role" required>
        <option value="">Select the Role</option>
        <option value="main">Main</option>
        <option value="normal">Normal</option>
</select>
<label>Email:</label><br>
    <input type="text" name="registerAdminEmail" required>
        <br>
            <label>Gender:</label><br>
                <select name="registerAdminGender" required>
                <option value="">Select Gender</option>    
                <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            <br>
        <label>Password:</label><br>
    <input type="password" id="registerAdminPassword" name="registerAdminPassword" required>
  <br>
<button type="button" id="togglePassword" class="password-toggle" onclick="togglePasswordVisibility()">Show Password</button>
    <br><br>
        <input type="submit" name="registerAdmin" value="Add Admin">
            </form>
            <a href="A_admin_list.php">Back</a>
		</center>
    </body>
</html>