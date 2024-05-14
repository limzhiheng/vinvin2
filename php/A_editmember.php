<?php
include('connection.php');

$No = "";
$Customer_name = "";
$Gender = "";
$Email = "";
$password = "";
$row = isset($_GET['no']) ? $_GET['no'] : '';

if (isset($_POST['submit'])) {
    // Validation for Customer Name (max 50 characters)
    $Customer_name = mysqli_real_escape_string($condb, $_POST['Customer_name']);
    if (strlen($Customer_name) > 50) {
        $error_message = "Customer Name cannot exceed 50 characters.";
    }

    // Validation for Gender (either 'male' or 'female')
    $Gender = mysqli_real_escape_string($condb, $_POST['Gender']);
    if (!in_array(strtolower($Gender), ['male', 'female'])) {
        $error_message = "Gender must be either 'Male' or 'Female'.";
    }

    // Validation for Email
    $Email = mysqli_real_escape_string($condb, $_POST['Email']);
    if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email format.";
    }

    // Validation for Password (at least one character and one digit)
    $password = mysqli_real_escape_string($condb, $_POST['password']);
    if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{1,}$/', $password)) {
        $error_message = "Password must contain at least one character and one digit.";
    }

    // If no validation errors, proceed with the update
    if (!isset($error_message)) {
        $updateQuery = "UPDATE customer SET Customer_name='" . $_POST['Customer_name'] . "', Gender='" . $_POST['Gender'] . "', Email='" . $_POST['Email'] . "', password='" . $_POST['password'] . "' WHERE no='" . $row . "'";

        $updateResult = mysqli_query($condb, $updateQuery);

        if ($updateResult) {
            $message = "Record Modified Successfully";
        } else {
            $message = "Error modifying record: " . mysqli_error($condb);
        }
    }
}

$sql = "SELECT * FROM customer WHERE no = $row";
$result = mysqli_query($condb, $sql);

if ($result) {
    $data = mysqli_fetch_array($result);
} else {
    $message = "Error fetching data: " . mysqli_error($condb);
}
?>

<html>
<head>
    <title>Edit Member</title>
    <link href="../css/A_editmember.css" rel="stylesheet"/>
    <?php include 'A_header.php'; ?>
</head>
<body>
    <form name="frmUser" method="post" action="A_editmember.php?no=<?php echo $row; ?>">
        <div><?php if (isset($message)) echo $message; ?></div>
        <div><?php if (isset($error_message)) echo $error_message; ?></div>

        <div class='box2'>
            <h2>Edit Members</h2>
            Customer Name: <br>
            <input type="text" name="Customer_name" class="txtField" value="<?php echo $data['Customer_name']; ?>">
            <br>
            <br>
            Gender: <br>
            <input type="text" name="Gender" class="txtField" value="<?php echo $data['Gender']; ?>">
            <br>
            <br>
            Email: <br>
            <input type="text" name="Email" class="txtField" value="<?php echo $data['Email']; ?>">
            <br>
            <br>
            Password: <br>
            <input type="text" name="password" class="txtField" value="<?php echo $data['password']; ?>">
            <br>
            <br>
            <input type="submit" name="submit" value="Submit" class="btn info"><br>
            <a class="back" type="button" href="A_member_list.php">Back</a>
        </div>
    </form>
</body>
</html>
