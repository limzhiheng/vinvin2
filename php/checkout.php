<?php
session_start();
include('connection.php');

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header('Location: message.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['form_type']) && $_POST['form_type'] === 'checkout') {
    $name = mysqli_real_escape_string($condb, $_POST['name'] ?? '');
    $email = mysqli_real_escape_string($condb, $_POST['email'] ?? '');
    $phone = mysqli_real_escape_string($condb, $_POST['phone'] ?? '');
    $address = mysqli_real_escape_string($condb, $_POST['address'] ?? '');

    // Extract relevant details from the cart
    $cartDetails = array();
    foreach ($_SESSION['cart'] as $id => $cartItem) {
        $cartDetails[] = array(
            'id' => $id,
            'Category' => $cartItem['details']['category'],
            'quantity' => $cartItem['quantity']
        );
    }

    // Store form data in session for later use in checkout2.php
    $_SESSION['checkout_data'] = array(
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'address' => $address
    );

    // Prepare and execute the SQL query to insert data into the "checkout" table
    $insertQuery = "INSERT INTO checkout (name, email, phone, address, details) VALUES (?, ?, ?, ?, ?)";
    $stmt = $condb->prepare($insertQuery);

    // Check for SQL query preparation error
    if (!$stmt) {
        die("Error preparing checkout insert statement: " . $condb->error);
    }

    // Bind parameters and execute the query
    $stmt->bind_param("sssss", $name, $email, $phone, $address, json_encode($cartDetails));
    $stmt->execute();

    // Check for execution error
    if ($stmt->error) {
        die("Error inserting checkout details: " . $stmt->error);
    }

    // Close the statement
    $stmt->close();

    // Redirect to checkout2.php
    header('Location: checkout2.php');
    exit();
}
?>

<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <link href="../css/checkout.css" rel="stylesheet" />
                <title>Checkout</title>
            </head>
        <body>
    <center>
<h1> Delivery Address</h1>

<!-- Checkout form on checkout.php -->
<form action="checkout.php" method="post" onsubmit="return validateForm()">
    <input type="hidden" name="form_type" value="checkout">
        <h2>Customer Information</h2>
            <label for="name">Name:</label>
                <br>
            <input type="text" name="name" id="name" required>
        <br>
    <label for="email">Email:</label>
<br>
    <input type="email" name="email" id="email" required>
        <br>
            <label for="phone">Phone:</label>
                <br>
            <input type="tel" name="phone" id="phone" required>
        <br>
    <label for="address">Address:</label>
<br>
    <textarea name="address" id="address" required></textarea>
        <br>
            <button type="submit">Go to select the payment method</button>
                </form>
        </center>
    </body>
    <script>
        function validateForm() {
            var phoneInput = document.getElementById("phone");
            var phoneValue = phoneInput.value.trim();

            return true;
        }
    </script>
</html>
