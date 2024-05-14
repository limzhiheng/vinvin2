<?php
require_once('connection.php');
session_start();

// Login logic
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $loginEmail = strtoupper(trim($_POST['loginEmail']));
    $loginPassword = $_POST['loginPassword'];

    // Check if it's a customer login
    $customerQuery = "SELECT * FROM users WHERE email = '$loginEmail'";
    $customerResult = mysqli_query($condb, $customerQuery);

    if ($customerResult && mysqli_num_rows($customerResult) == 1) {
        $customerRow = mysqli_fetch_assoc($customerResult);

        // Verify the hashed password for customer
        if (password_verify($loginPassword, $customerRow['password_hash'])) {
            // Successful login for customer
            $_SESSION['user'] = $loginEmail;
            header("Location: c_main.php");
            exit();
        }
    }
    // Invalid login
    $loginError = 'Invalid email or password.';
}

mysqli_close($condb);
?>

<html>
<head>
	<title>Zeta Shop - Customer Login</title>
    <meta charset="UTF-8">
    <link href="../css/c_login.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <style>
        .password-toggle {
            cursor: pointer;
        }
    </style>

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
</head>

<body>
    <div class="box1">
		<h2>Welcome to Royal Racket</h2><br><br><br><br><br>
		<a class="button2" href="c_signup.php">Don't have an account?</a>
	</div>

    <center>
        <div class="box2">
            <div class="login">
                <br>
                <center><h3>Customer Login</h3></center>
                <hr>

                <form class="login" action="c_login.php" method="POST">
                    <center>
                        <p>&#x1F464;Email:</p>
                        <input type="text" name="loginEmail" required>
                        <br>

                        <p>&#128274;Password:</p>
                        <input type="password" name="loginPassword" id="loginPassword" required>
                        <br><br>
                        
                        <b>Show/Hide Password</b>
                        <div class="checkbox-wrapper-22">
                          <label class="switch" for="checkbox">
                            <input type="checkbox" id="checkbox" onclick="togglePasswordVisibility()"/>
                            <div class="slider round"></div>
                          </label>
                        </div>
                        
                        <?php if (isset($loginError)) echo "<p style='color: red;'>$loginError</p>"; ?>

                        <br><br><br>

                        <?php
                        if (!empty($error)) {
                            echo "<ul style='color: pink;'>";
                            foreach ($error as $value) {
                                echo "<center>$value</center>";
                            }
                            echo "</ul>";
                            // Display the "Go back to login" link only when there are errors
                            echo "<br><br><a href='c_login.php'>Go back to login</a>";
                        }
                        ?>
                        <input type="submit" class="button" name="login" value="Login"><br><br>
                    </center>
                </form>
            </div>
        </div>
    </center>
</body>
</html>
