<?php
include('connection.php');

$coupon_code = "";
$value = "";
$status = "";
$message = "";

$row = isset($_GET['id']) ? $_GET['id'] : '';

function validateFormattedNumber($input) {
    // Validate if the input is a valid number
    return is_numeric($input);
}

if (isset($_POST['submit'])) {
    $coupon_code = mysqli_real_escape_string($condb, $_POST['coupon_code']);
    $value = mysqli_real_escape_string($condb, $_POST['value']);
    $status = mysqli_real_escape_string($condb, $_POST['status']);

    // Validation for Value (formatted number)
    if (!validateFormattedNumber($value)) {
        $message = "Invalid value. Please enter a valid number.";
    }

    // Validation for Status (0 or 1)
    if ($status !== '0' && $status !== '1') {
        $message = "Invalid status. Please enter 0 or 1.";
    }

    if (empty($message)) {
        if (!empty($row)) {
            $updateQuery = "UPDATE coupon_code SET coupon_code='$coupon_code', value='$value', status='$status' WHERE id='$row'";
            $updateResult = mysqli_query($condb, $updateQuery);

            if ($updateResult) {
                $message = "Record Modified Successfully";
            } else {
                $message = "Error modifying record: " . mysqli_error($condb);
            }
        } else {
            $message = "Error: ID is empty or not set";
        }
    }
}

if (!empty($row)) {
    $sql = "SELECT * FROM coupon_code WHERE id = '$row'";
    $result = mysqli_query($condb, $sql);

    if ($result) {
        $data = mysqli_fetch_array($result);
    } else {
        $message = "Error fetching data: " . mysqli_error($condb);
    }
} else {
    $message = "Error: ID is empty or not set";
}
?>
<html>
<head>
    <title>EDIT COUPON</title>
    <link href="../css/A_editcoupon.css" rel="stylesheet"/>
    <?php include 'A_header.php'; ?>
</head>
<body>
    <br><br>
    <form name="EditCoupon" method="POST" action="A_editcoupon.php?id=<?php echo $row; ?>">
       
        <center>
            <div class='box2'>
                <h2>EDIT Coupon Code</h2> 
                
                <br>
                Coupon Code:<br>
                <input type="text" name="coupon_code" class="txtField" value="<?php echo $data['coupon_code']; ?>">
                <br>
                <br>
                Discount Price:<br>
                <input type="text" name="value" class="txtField" value="<?php echo $data['value']; ?>">
                <br>
                <br>
                Status:<br>
                <input type="text" name="status" class="txtField" value="<?php echo $data['status']; ?>">
                <br>
                <br>
                <input type="submit" name="submit" value="Submit" class="btn info">
                <br>
                <br>
                <a type="button" class="back" href="coupon_list.php">BACK</a>
                <br>
                <br>
                <div><?php if (isset($message)) echo $message; ?></div>
            </div>
        </center>
    </body>
</html>
