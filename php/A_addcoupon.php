<?php
require_once('connection.php');
session_start();
$registerMessage = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])){
    $registercoupon_code = trim($_POST['registercoupon_code']);
    $registervalue = $_POST['registervalue'];
    $registerstatus = $_POST['registerstatus'];

    // Validation for Discount Price (formattedNumber)
    if (!preg_match('/^\d+(\.\d{1,2})?$/', $registervalue)) {
        $registerMessage = 'Invalid Discount Price format. Please enter a valid number.';
    } elseif ($registervalue <= 0) {
        $registerMessage = 'Discount Price must be greater than zero.';
    }

    // Validation for Status (0 or 1)
    if (!in_array($registerstatus, [0, 1])) {
        $registerMessage = 'Invalid Status. Please enter 0 or 1.';
    }

    // Proceed if no validation errors
    if (empty($registerMessage)) {
        // Use prepared statement to prevent SQL injection
        $registerQuery = "INSERT INTO coupon_code (coupon_code, value, status) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($condb, $registerQuery);

        // Bind parameters
        mysqli_stmt_bind_param($stmt, "ssi", $registercoupon_code, $registervalue, $registerstatus);

        if (mysqli_stmt_execute($stmt)){
            $registerMessage = 'Coupon Add Successful!';

            // Set session variables
            $_SESSION['voucher_coupon_code'] = $registercoupon_code;
            $_SESSION['voucher_value'] = $registervalue;
            $_SESSION['voucher_status'] = $registerstatus;
        } else {
            $registerMessage = 'Error adding coupon. Please try again.';
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }
}

mysqli_close($condb);
?>

<html>
<head>
    <title>Add Coupon</title>
    <link href="../css/A_addcoupon.css" rel="stylesheet"/>
    <?php include 'A_header.php'; ?>
    <script>
            function showAlert() {
                alert("Add New Voucher Successfully");
            }
        </script>
</head>
<body>
    <br><br>
    <center>
        <div class="table">
        <form action="" method="POST" onsubmit="showAlert()">
        <br>
        <br>
        <br>
        <br>
            <label class="word">Coupon Code:</label><br>
            <input class="text" type="text" name="registercoupon_code" placeholder="Coupon Code" required>
            <br>
            <label class="word">Discount Price:</label><br>
            <input class="text" type="number" name="registervalue" placeholder="Discount Price" required>
            <br>
            <label class="word">Status:</label><br>
            <input class="text" type="number" name="registerstatus" placeholder="Status 0/1 only" required>
            <br>
            <br>
            <input class="add" type="submit" name="register" value="Add voucher">
            <br>
            <br>
            <a class="back" href="coupon_list.php">BACK</a> 
            <div><?php if (!empty($registerMessage)) echo $registerMessage; ?></div>
        </form>
        </div>
    </center>
</body>
</html>
