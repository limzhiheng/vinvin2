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

function addToCart($id, $quantity, $size) {
    // Initialize cart if not exists
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Convert ID to integer
    $id = (int)$id;

    // Convert quantity to integer
    $quantity = (int)$quantity;

    // Fetch the product details from the database
    global $products;

    // Check if the product ID exists in the array
    if (isset($products[$id])) {
        $product = $products[$id];

        // Add product to cart with both ID and size as part of the key
        $cartKey = $id . '_' . $size;

        if (isset($_SESSION['cart'][$cartKey])) {
            $_SESSION['cart'][$cartKey]['quantity'] += $quantity;
        } else {
            $_SESSION['cart'][$cartKey] = array(
                'quantity' => $quantity,
                'size' => $size,  // Store the selected size in the cart
                'details' => $product  // Store the product details in the cart
            );
        }
    }

    // Debugging statements
    echo "Product ID: $id, Quantity: $quantity, Size: $size<br>";
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
        $size = $_POST['size']; // Assuming you have a form field named 'size'
        addToCart($product['id'], $quantity, $size);
        // Redirect to cart page or wherever you want after adding to the cart
        header('Location: cart.php');
        exit;
    }
}
?>
<?php
function getCategoryWord($categoryId) {
    switch ($categoryId) {
        case 1:
            return 'Flower';
        case 2:
            return 'Cake';
        case 3:
            return 'Chocolate';
        case 4:
            return 'Bear';
        default:
            return 'Unknown Category';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/product_details.css" rel="stylesheet"/>
    <title>Product Details</title>
    <?php include 'header.php';?>
</head>

<body>
    <h1>Product Details</h1>
    <div>
        <img class="image" src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
        <div class="details">
            <h2><?php echo $product['name']; ?></h2>
            <p>Product id:<?php echo $product['id']?></p>
            <p>Price: RM<?php echo $product['price']; ?></p>
            <p>Category: <?php echo getCategoryWord($product['category']); ?></p>
            
            <!-- Add to Cart Form -->
            <form action="product_details.php?id=<?php echo $product['id']; ?>" method="post">
                <label for="quantity">Quantity:</label>
                <button type="button" class="quantity-button" onclick="changeQuantity(-1)">&#8722;</button>
                <span id="displayQuantity">1</span>
                <button type="button" class="quantity-button" onclick="changeQuantity(1)">&#43;</button>
                <input type="hidden" id="quantity" name="quantity" value="1" min="1" max="10" class="quantity">
                <br>

<br><br>
                <button type="submit" class="add_to_cart" name="add_to_cart">Add to Cart</button>
                <br><br>
                <a href="c_product.php">BACK</a>
            </form>
        </div>
        <h3>Details: <?php echo $product['details']; ?></h3>
    <br><br>

    <script>
        function changeQuantity(change) {
            var quantityInput = document.getElementById("quantity");
            var displayQuantity = document.getElementById("displayQuantity");
            var currentQuantity = parseInt(quantityInput.value);
            
            // Ensure the quantity remains within the range of 1 to 10
            if (currentQuantity + change >= 1 && currentQuantity + change <= 10) {
                quantityInput.value = currentQuantity + change;
                displayQuantity.innerHTML = quantityInput.value;
            }
        }
    </script>
    <br><br><br><br><br><br><br><br><br><br><br><br>
    <?php include 'footer.php';?>
</body>
</html>
