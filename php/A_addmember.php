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

<!DOCTYPE html>
    <html>
        <head>
	        <title>Zeta Shop - Add Member(Staff)</title>
                <link rel="stylesheet" href="../css/s_addevents.css">
	                <link href="../css/A_addmember.css" rel="stylesheet"/>	
	            <?php include 'A_header.php'; ?>
            </head>
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
    <body>
<h2>Add Customer</h2>
    <?php
    // Display registration message if present
        if (!empty($registrationMessage)) {
            echo "<div class='sticky-note'>$registrationMessage</div>";
        }
    ?>
<center>
    <form action="" method="POST">
        <label>Email:</label><br>
            <input class="text" type="text" name="registerEmail" placeholder="Your Email" required>
                <br>
                    <label>Name:</label><br>
                <input class="text" type="text" name="registerUserName" placeholder="Name" required>
            <br>
        <label>Password:</label><br>
    <input class="text" type="password" id="registerPassword" placeholder="Password" name="registerPassword" required>
<br><br>
	<button class="password" type="button" id="togglePassword" class="password-toggle" onclick="togglePasswordVisibility()">Show Password</button>
        <br>
            <label>Gender:</label><br>
                <select name="registerGender" required>
                <option value="">Select Gender</option>    
                <option value="male">Male</option>
                <option value="female">Female</option>
            <option value="other">Other</option>
        </select>
    <br><br>
<input class="add" type="submit" name="register" value="Add Customer">
	<br><br>
	    <a class="back" href="A_member_list.php">BACK</a>
            </form>
        </center>
    </body>
</html>