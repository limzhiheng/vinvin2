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
    // Hash the password for admin
    $hashedAdminPassword = password_hash($registerAdminPassword, PASSWORD_DEFAULT);

    // Insert the admin into the database (replace 'admins' with your actual admin table name)
    $registerAdminQuery = "INSERT INTO admins (admin_name, password_hash, email, gender) VALUES ('$registerAdminName', '$hashedAdminPassword', '$registerAdminEmail', '$registerAdminGender')";

    if (mysqli_query($condb, $registerAdminQuery)) {
        // Registration successful
        $registrationMessage = 'Account created successfully!';
        // Store additional admin information in the session
        $_SESSION['admin'] = $registerAdminEmail;
        $_SESSION['admin_name'] = $registerAdminName;
        $_SESSION['admin_gender'] = $registerAdminGender;
    } else {
        // Registration unsuccessful
        $registrationMessage = 'Error creating account. Please try again.';
    }
}

mysqli_close($condb);
?>

<!-- HTML Code -->
<html>
<head>
    <title>Login and Registration</title>
    <link href="../css/A_login.css" rel="stylesheet"/>
    <!-- Add your CSS stylesheets here -->
</head>
<style>
    .password-toggle {
        cursor: pointer;
    }

    .sticky-note {
        background-color: #f8d7da;
        color: #721c24;
        padding: 10px;
        margin-top: 10px;
        border: 1px solid #f5c6cb;
        border-radius: 5px;
    }
</style>
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
        <h2>Registration for Admins</h2>
        <?php
        if (!empty($registrationMessage)) {
            echo "<div class='sticky-note'>$registrationMessage</div>";
        }
        ?>
        <form action="" method="POST">
            <label>Admin Name:</label>
            <input type="text" name="registerAdminName" required>
            <br>
            <label>Email:</label>
            <input type="text" name="registerAdminEmail" required>
            <br>
            <label>Gender:</label>
            <select name="registerAdminGender" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>
            <br>
            <label>Password:</label>
            <input type="password" id="registerAdminPassword" name="registerAdminPassword" required>
            <br>
			<button type="button" id="togglePassword" class="password-toggle" onclick="togglePasswordVisibility()">Show Password</button>
            <br><br>
            <input type="submit" name="registerAdmin" value="Register as Admin">
        </form>
		<a href="A_login.php">Go back Staff login Page</a>
    </center>
</body>
</html>

