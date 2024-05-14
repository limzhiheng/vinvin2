<?php
require_once('connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Email = strtoupper(trim($_POST['Email']));
    $password = $_POST['password'];

    $error = array();

    if (empty($Email) || empty($password)) {
        $error[] = 'Email and password are required.';
    } else {
        // Assuming you have a table named 'users' with columns 'Email' and 'password'
        $query = "SELECT * FROM customer WHERE Email = '$Email' AND password = '$password'";
        $result = mysqli_query($condb, $query);

        if ($result && mysqli_num_rows($result) == 1) {
            // Successful login
            header("Location: c_main.php");
            exit();
        } else {
            $error[] = 'Invalid account. Please check your Email and password.';
        }
    }
}

mysqli_close($condb);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Result</title>
</head>
<body>
    <?php
    if (!empty($error)) {
        echo "<ul style='color: red;'>";
        foreach ($error as $value) {
            echo "<li>$value</li>";
        }
        echo "</ul>";
    }
    ?>
    <a href="c_login.php">Go back to login</a>
</body>
</html>

