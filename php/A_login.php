<?php
require_once('connection.php');
session_start();

// Login logic
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $loginEmail = strtoupper(trim(mysqli_real_escape_string($condb, $_POST['loginEmail'])));
    $loginPassword = mysqli_real_escape_string($condb, $_POST['loginPassword']);

    // Check if it's an admin login using prepared statement
    $adminQuery = "SELECT * FROM admins WHERE admin_name = ?";
    $stmt = mysqli_prepare($condb, $adminQuery);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $loginEmail);
        mysqli_stmt_execute($stmt);
        $adminResult = mysqli_stmt_get_result($stmt);

        if ($adminResult && mysqli_num_rows($adminResult) == 1) {
            $adminRow = mysqli_fetch_assoc($adminResult);

            // Verify the hashed password for admin
            if (password_verify($loginPassword, $adminRow['password_hash'])) {
                // Successful login for admin
                $_SESSION['admin_name'] = $loginEmail;

                // Regenerate session ID for security
                session_regenerate_id(true);
                if ($adminRow['role'] == 'main') {
                    header("Location: A_main_admin.php");
                } else {
                    header("Location: A_product.php");
                }

                exit();
            }
            
        } else {
            // Invalid login
            $loginError = 'Invalid username or password.';
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // Error preparing the statement
        $loginError = 'Error preparing login statement.';
    }

    // Close the database connection
    mysqli_close($condb);
}
?>

<!-- HTML Code -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Login and Registration</title>
    <link href="../css/A_login.css" rel="stylesheet"/>
    <!-- Add your CSS stylesheets here -->
</head>
<body>
    <!-- Login Form -->
    <div style="text-align: center;">
        <h2>Staff Login</h2>
        <form action="" method="POST">
            <label><i class="fa fa-user-circle" style="font-size:24px"></i>Admin Name:</label>
            <input type="text" name="loginEmail" required>
            <br><br><br>
            <label><i class="fa fa-lock" style="font-size:24px"></i>  Password:</label>
            <input type="password" id="loginPassword" name="loginPassword" required>
            <br><br>
            <button type="button" id="togglePassword" class="password-toggle" onclick="togglePasswordVisibility()">Show Password</button>
            <?php if (isset($loginError)) echo "<p style='color: red;'>$loginError</p>"; ?>
            <br><br>
            <input type="submit" name="login" value="Login">
        </form>
    </div>

    <!-- JavaScript for password visibility toggle -->
    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById('loginPassword');
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
</body>
</html>
