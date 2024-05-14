<?php
session_start();

// Check if the cart is not empty
if (empty($_SESSION['cart'])) {
    header('Location: message.php'); // Redirect to the message page if the cart is empty
    exit();
}

// Include your connection file and any other necessary files
include('connection.php');

// Fetch products from the database (assuming you have a products table)
$query = "SELECT * FROM products";

$result = $condb->query($query);

if (!$result) {
    die("Error retrieving products: " . $condb->error);
}

$products = array();
while ($row = $result->fetch_assoc()) {
    $products[$row['id']] = $row;
}

// Function to display cart items
function displayCart() {
    global $products;

    $maxQuantity = 10; // Set the maximum quantity

    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        echo '<ul>';
        $totalPrice = 0;

        foreach ($_SESSION['cart'] as $id => $cartItem) {
            echo '<li>';
            // Check if product details exist
            if (isset($cartItem['details']) && is_array($cartItem['details'])) {
                // Display image
                echo ' Product: ' . $cartItem['details']['name'] . ' | Price: RM' . number_format($cartItem['details']['price'], 2, '.', '');

                // Display original price
                echo ' | Quantity: ';

                // Quantity value
                echo '<span class="quantity-value">' . $cartItem['quantity'] . '</span>';

                // Display selected size
                if (!empty($cartItem['size'])) {
                    echo ' | Size:UK ' . $cartItem['size'];
                }

                // Calculate subtotal for the current product
                $subtotal = $cartItem['details']['price'] * $cartItem['quantity'];
                echo ' | Subtotal: RM' . number_format($subtotal, 2, '.', '');

                $totalPrice += $subtotal;
            } else {
                echo 'Invalid product details';
            }

            echo '</li>';
        }

        echo '</ul>';
        echo '<p>Total Price: RM<span id="total_price" name="total_price">' . number_format($totalPrice, 2, '.', '') . '</span></p>';
    } else {
        echo '<p>Your cart is empty.</p>';
    }
}

// Function to calculate and display total price
function displayTotalPrice() {
    global $products;
    // Calculate and return the total price here
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize customer information
    $name = mysqli_real_escape_string($condb, $_POST['name'] ?? '');
    $email = mysqli_real_escape_string($condb, $_POST['email'] ?? '');
    $phone = mysqli_real_escape_string($condb, $_POST['phone'] ?? '');
    $address = mysqli_real_escape_string($condb, $_POST['address'] ?? '');

    // Insert customer information and cart details into the database
    $insertQuery = "INSERT INTO checkout (name, email, phone, address, details) VALUES (?, ?, ?, ?, ?)";
    $stmt = $condb->prepare($insertQuery);
    $stmt->bind_param("sssss", $name, $email, $phone, $address, json_encode($_SESSION['cart']));
    $stmt->execute();

    if ($stmt->errno) {
        die("Error inserting checkout details: " . $stmt->error);
    }

    // Clear the cart (session storage or cookies)
    unset($_SESSION['cart']);

    // Redirect to receipt page
    header('Location: receipt.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link href="../css/checkout.css" rel="stylesheet" />
    <title>Checkout</title>
    <!-- Add your stylesheets, scripts, or other head elements here -->
</head>
<body>
    <center>
        <h1>Checkout</h1>

        <?php if (empty($_SESSION['cart'])): ?>
            <p>Your cart is empty. <a href="message.php">Go back to shopping</a></p>
        <?php else: ?>
            <h2>Product List</h2>
            <?php displayCart(); ?>

            <h1> Payment Method</h1>
            
            <form onsubmit=" return openAlert()">
                <select name="paymentMethod" id="paymentMethod" required>
                    <option value="">Select the payment method</option>
                    <option value="Card">Card</option>
                    <option value="Cash On Delivery">Cash on delivery</option>
                    <option value="TNG">TNG e-wallet</option>
                </select>
                <br><br>
                <button type="submit">Process to payment</button>
            </form>
        <?php endif; ?>
        <script>
      function openAlert() {
    // Access form elements
    var formData = {
        paymentMethod: document.getElementById('paymentMethod').value,
        totalPrice: document.getElementById('total_price').innerText
        // Add more inputs as needed
    };

    // Display an alert box with form data and success message
    window.alert("Payment processed successfully!\n\n" + 
        "Payment Method: " + formData.paymentMethod + "\n" +
        "Total Price: RM " + formData.totalPrice
    );

    // Clear the cart (session storage or cookies)
    clearCart();

    // Redirect to c_main.php after the alert
    window.location.href = 'c_main.php';

    // Prevent the form from submitting
    return false;
}

function clearCart() {
    $.ajax({
        type: "POST",
        url: "clear_cart.php", // Create a separate PHP file to handle clearing the cart
        success: function (data) {
            // Handle success if needed
        },
        error: function (xhr, status, error) {
            console.error("Error clearing cart: " + error);
        }
    });
}
    </script>
</body>
</html>
