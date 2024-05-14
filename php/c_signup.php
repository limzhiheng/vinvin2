<?php
require_once('connection.php');
session_start();

$registrationMessage = ''; // Initialize the registration message

// Registration logic for users
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $registerEmail = trim($_POST['registerEmail']);
    $registerPassword = $_POST['registerPassword'];
    $registerUserName = $_POST['registerUserName'];
    $registerGender = $_POST['registerGender'];

    // Hash the password
    $hashedPassword = password_hash($registerPassword, PASSWORD_DEFAULT);

    // Insert the user into the database (replace 'users' with your actual table name)
    $registerQuery = "INSERT INTO users (email, password_hash, user_name, gender) VALUES ('$registerEmail', '$hashedPassword', '$registerUserName', '$registerGender')";

    if (mysqli_query($condb, $registerQuery)) {
        // Registration successful
        $registrationMessage = 'Account created successfully!';
        // Store additional user information in the session
        $_SESSION['user'] = $registerEmail;
        $_SESSION['user_name'] = $registerUserName;
        $_SESSION['user_gender'] = $registerGender;
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
    <title>User Registration and Login</title>
    <link href="../css/c_signup.css" rel="stylesheet"/>
    <style>
        .password-toggle {
            cursor: pointer;
        }
        
    </style>
    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById('registerPassword');
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
</head>
<body>
    <h2>Customer Registration</h2>
    <?php
    // Display registration message if present
    if (!empty($registrationMessage)) {
        echo "<center><div class='sticky-note'>$registrationMessage</div></center>";
    }
    ?>
	<center>
    <form action="" method="POST">
		<label>Name:</label>
        <input type="text" name="registerUserName" placeholder="Name" required>
        <br>
        <label>Email:</label>
        <input type="text" name="registerEmail" placeholder="Your Email" required>
        <br>
        <label>Password:</label>
        <input type="password" id="registerPassword" placeholder="Password" name="registerPassword" required>
        <br>
		Show/Hide Password
        <div class="checkbox-wrapper-22">
            <label class="switch" for="checkbox">
            <input type="checkbox" id="checkbox" onclick="togglePasswordVisibility()"/>
            <div class="slider round"></div>
            </label>
        </div>
        <br>
        <label>Gender:</label>
        <select name="registerGender" required>
            <option value="">Select your gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
        </select>
        <br>
        <input type="submit" name="register" value="Register">
    </form>
	<br>
    <a href="c_login.php">Go back to Customer login page</a>
	</center>
</body>
</html>
