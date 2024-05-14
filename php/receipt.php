<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <title>Receipt</title>
    <link rel="stylesheet" href="../css/receipt.css"> <!-- Add this line to link the CSS file -->
    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            .print-section, .print-section * {
                visibility: visible;
            }
            .print-section {
                position: absolute;
                left: 0;
                top: 0;
            }
        }
    </style>
</head>
<body>
<?php
session_start();

// Include your connection file and any other necessary files
include('connection.php');

$discountedPrice = isset($_SESSION['discounted_price']) ? $_SESSION['discounted_price'] : 0;


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
function displayCart($products) {
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
                echo ' Product: ' . $cartItem['details']['name'] . '| Price: RM' .number_format($cartItem['details']['price'], 2, '.', '');

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
        echo '<h2>Total Price: RM<span id="total_price" name="total_price">' . number_format($totalPrice, 2, '.', '') . '</span></h2>';
    } else {
        echo '<p>Your cart is empty.</p>';
    }
}

// Function to calculate and return total price
function displayTotalPrice() {
    global $products;

}

function clearCart() {
    $_SESSION['cart'] = array();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $paymentMethod = $_POST['paymentMethod'];

    // For simplicity, we'll just display the information on the receipt
    echo '<div class="print-section">';
    echo '<h1 style="color: blue;">Receipt</h1>';
    echo '<h2 style="font-style: italic;">Product List</h2>';
    displayCart($products);
    echo '<h2>Payment Method</h2>';
    echo '<h3>Payment Method: ' . ucfirst($paymentMethod) . '</h3>';
    echo '<h2>Thank you !!&#9829;</h2>';
    echo '<button class="print" onclick="printReceipt()">Print</button>';
    echo '<button class="back" onclick="goback()">Back</button>';
    echo '</div>';
    clearCart();
} else {
    header("Location: checkout.php"); // Redirect if accessed directly without submitting the form
    exit();
}
?>

<!-- JavaScript to handle the print functionality -->
<script>
    function printReceipt() {
        window.print();
    }

    function goback() {
        window.location.href = 'c_main.php';
    }
</script>
</body>
</html>