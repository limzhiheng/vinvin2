<?php
require_once('connection.php');
$error = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = strtoupper(trim($_POST['username']));
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $error[] = 'Username/Admin name and password are required.';
    } else {
        // Check if it's a customer login
        $customer_query = "SELECT * FROM users WHERE email = '$username'";
        $customer_result = mysqli_query($condb, $customer_query);

        if ($customer_result && mysqli_num_rows($customer_result) == 1) {
            $customer_row = mysqli_fetch_assoc($customer_result);

            // Verify the hashed password for customer
            if (password_verify($password, $customer_row['password_hash'])) {
                // Successful login for customer
                session_start();
                $_SESSION['user'] = $username;
                header("Location: c_main.php");
                exit();
            } else {
                $error[] = 'Invalid username or password for customer.';
            }
        } else {
            // Check if it's an admin login
            $admin_query = "SELECT * FROM admins WHERE admin_name = '$username'";
            $admin_result = mysqli_query($condb, $admin_query);

            if ($admin_result && mysqli_num_rows($admin_result) == 1) {
                $admin_row = mysqli_fetch_assoc($admin_result);

                // Verify the hashed password for admin
                if (password_verify($password, $admin_row['password_hash'])) {
                    // Successful login for admin
                    session_start();
                    $_SESSION['admin_name'] = $username;
                    header("Location: A_main.php");
                    exit();
                } else {
                    $error[] = 'Invalid username or password for admin.';
                }
            } else {
                $error[] = 'Invalid username or admin name.';
            }
        }
    }
}

mysqli_close($condb);
?>
