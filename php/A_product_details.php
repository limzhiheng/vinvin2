<?php
session_start();

include('connection.php');

// Fetch products from the database
$query_products = "SELECT * FROM products";
$result_products = $condb->query($query_products);

if (!$result_products) {
    die("Error retrieving products: " . $condb->error);
}

$products = array();
while ($row = $result_products->fetch_assoc()) {
    $products[$row['id']] = $row; // Use product ID as the key
}

function addToCart($id, $quantity) {
    // Initialize cart if not exists
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Convert ID to integer
    $id = (int)$id;

    // Convert quantity to integer
    $quantity = (int)$quantity;

    // Fetch the product details from the $products array
    global $products;

    // Check if the product ID exists in the array
    if (isset($products[$id])) {
        $product = $products[$id];

        // Add product to cart
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['quantity'] += $quantity;
        } else {
            $_SESSION['cart'][$id] = array(
                'quantity' => $quantity,
                'details' => $product  // Store the product details in the cart
            );
        }
    }

    // Debugging statements
    echo "Product ID: $id, Quantity: $quantity<br>";
    var_dump($_SESSION['cart']);
}

// Fetch product details based on the provided ID
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    // Check if the product ID exists in the array
    if (isset($products[$id])) {
        $product = $products[$id];
    } else {
        die("Product not found.");
    }
} else {
    die("Product ID not specified.");
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_to_cart'])) {
        $quantity = $_POST['quantity'];
        addToCart($product['id'], $quantity);
        // Redirect to cart page or wherever you want after adding to the cart
        header('Location: cart.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/A_product_details.css" rel="stylesheet"/>
    <title>Product Details</title>
</head>

<body>
    <h1>Product Details</h1>
    <div>
        <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" style="max-width: 200px;">
        <div class="details">
            <h2><?php echo $product['name']; ?></h2>
            <p>Product ID:<?php echo $product['id']; ?></p>
            <p>Price: RM<?php echo $product['price']; ?></p>
            <p>Category: <?php echo $product['category']; ?></p>
            
            <a href="A_product.php">Back</a>
        </div>
    </div>
    <center><h4>Details: <?php echo $product['details']; ?></h4></center>
    <br><br>
</body>
</html>
