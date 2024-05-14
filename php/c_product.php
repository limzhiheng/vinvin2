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

        // Add product to cart
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['quantity'] += $quantity;
        } else {
            $_SESSION['cart'][$id] = array(
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


function displayCart() {
    global $products;

    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        echo '<ul>';
        $totalPrice = 0;

        foreach ($_SESSION['cart'] as $id => $cartItem) {
            echo '<li>';
            // Display image
            echo '<img src="' . $cartItem['details']['image'] . '" alt="' . $cartItem['details']['name'] . '" style="max-width: 100px; max-height: 100px;">';
            echo ' Product: ' . $cartItem['details']['name'] . '| Quantity: ' . $cartItem['quantity'];

            $subtotal = $cartItem['details']['price'] * $cartItem['quantity'];
            echo ' | Subtotal: $' . number_format($subtotal, 2);
            $totalPrice += $subtotal;
            echo '</li>';
        }

        echo '</ul>';
        echo '<p>Total Price: $' . number_format($totalPrice, 2) . '</p>';
    } else {
        echo '<p>Your cart is empty.</p>';
    }
}

function clearCart() {
    unset($_SESSION['cart']);
}

function removeFromCart($id, $size) {
    // Generate the cart key using ID and size
    $cartKey = $id . '_' . $size;

    // Check if the product exists in the cart
    if (isset($_SESSION['cart'][$cartKey])) {
        unset($_SESSION['cart'][$cartKey]);
    }
}

// Handle actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_GET['action'])) {
        $action = $_GET['action'];

        switch ($action) {
            case 'add':
             // Example usage in the product page
            $id = $_GET['id']; // Assuming you get the product ID from the URL
            $quantity = $_POST['quantity'];
            $size = $_POST['size']; // Assuming you have a form field named 'size'
            addToCart($id, $quantity, $size);
                header('Location: cart.php');
                exit;
                break;

            case 'remove':
                $id = $_GET['id'];
                $size = $_SESSION['cart'][$id]['size']; // Get the size from the cart
                removeFromCart($id, $size);
                header('Location: cart.php');
                exit;
                break;                

            case 'remove':
                $id = $_GET['id'];
                removeFromCart($id);
                header('Location: cart.php');
                exit;
                break;

            case 'clear':
                clearCart();
                header('Location: cart.php');
                exit;
                break;

            default:
                // Do nothing
                break;
        }
    }
}

?>
<?php
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

// Handle search
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
if (!empty($searchTerm)) {
    // Filter products based on the search term
    $filteredProducts = array_filter($products, function ($product) use ($searchTerm) {
        return stripos($product['name'], $searchTerm) !== false || $product['id'] == $searchTerm;
    });

    // Use the filtered products for display
    $products = $filteredProducts;
}
?>
<!DOCTYPE html>
    <html>
        <head>
	        <meta charset="utf-8" />
	            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
	                <meta name="viewport" content="width=device-width, initial-scale=1.0">
	                    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
	                        <title>Customer Products</title>
	                    <link href="../css/c_product.css" rel="stylesheet" />
	                <?php include 'header.php'; ?>
                    <?php include 'category.php';?>	
                </head>
            <body>
            <div id="video-background">
                <video autoplay muted loop>
                <source src="../video/bg.mp4" type="video/mp4">
            Your browser does not support the video tag.
                </video>
            </div>
         <div class="search-container">
         <form action="" method="GET">
    <input class="search" type="text" id="search" name="search" placeholder="Enter product name or ID">
    <button class="search-btn" type="submit">Search</button>
    <?php if (!empty($searchTerm)) : ?>
        <input type="hidden" name="page" value="<?php echo $current_page; ?>">
        <input type="hidden" name="search" value="<?php echo $searchTerm; ?>">
    <?php endif; ?>
</form>
</div>

<br>
    <h1>Customer product page</h1>
<center><?php include 'time.php' ;?></center>
<br>
	    <?php
            // Pagination settings
                $productsPerPage = 12;
                    $totalProducts = count($products);
                        $totalPages = ceil($totalProducts / $productsPerPage);

                         // Determine current page
                        $current_page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
                    $offset = ($current_page - 1) * $productsPerPage;

                // Display products from the database for the current page
            echo '<center>';
        echo '<div class="container">';
    $count = 0; // Variable to track the number of displayed products

foreach ($products as $product) {
    if ($count >= $offset && $count < ($offset + $productsPerPage)) {
        echo '<div class="column">';
            echo '<a href="product_details.php?id=' . $product['id'] . '" class="product-link">';
                        echo '<img class="img" src="' . (isset($product['image']) ? $product['image'] : '') . '" height="150px;" width="150px;">';
                     echo '<h2>' . $product['name'] . '</h2>';
                    echo '<p>Price: RM' . $product['price'] . '</p>';
                    echo '</a>';
                    echo '</div>';
    }
    $count++;
}

echo '</div>';
    echo '</center>';
        echo '<br><br>';
        echo '<center><div class="pagination">';
if ($current_page > 1) {
    // Display the previous button
    echo '<button class="page" onclick="window.location.href=\'?page=' . ($current_page - 1) . '&search=' . urlencode($searchTerm) . '\'" class="pagination-btn">&laquo;</button>';
}

// Display page buttons
$visiblePages = 3; // Number of visible page buttons
$startPage = max(1, $current_page - floor($visiblePages / 2));
$endPage = min($startPage + $visiblePages - 1, $totalPages);

for ($page = $startPage; $page <= $endPage; $page++) {
    $activeClass = ($page == $current_page) ? 'active' : '';
    // Display a button for each page
    echo '<button class="page" onclick="window.location.href=\'?page=' . $page . '&search=' . urlencode($searchTerm) . '\'" class="' . $activeClass . ' pagination-btn">' . $page . '</button>';
}

// Display ellipsis if there are more pages
if ($endPage < $totalPages) {
    echo '<button class="page"><span class="pagination-ellipsis">....</span></button>';
}

if ($current_page < $totalPages) {
    // Display the next button
    echo '<button class="page" onclick="window.location.href=\'?page=' . ($current_page + 1) . '&search=' . urlencode($searchTerm) . '\'" class="pagination-btn">&raquo;</button>';
}
echo '</div></center>';

    echo '<br><br>';
?>

<script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="js/custom.js"></script>
<script>
    function decreaseQuantity(id_from_html) {
        var quantityInput = document.getElementById("quantity_" + id_from_html);
            var displayQuantity = document.getElementById("displayQuantity_" + id_from_html);
                    var currentQuantity = parseInt(quantityInput.value);
                if (currentQuantity > 1) {
            quantityInput.value = currentQuantity - 1;
        displayQuantity.innerHTML = quantityInput.value;
        }
    }
    function increaseQuantity(id_from_html) {
        var quantityInput = document.getElementById("quantity_" + id_from_html);
            var displayQuantity = document.getElementById("displayQuantity_" + id_from_html);
                var currentQuantity = parseInt(quantityInput.value);
                    if (currentQuantity < 10) {
                quantityInput.value = currentQuantity + 1;
            displayQuantity.innerHTML = quantityInput.value;
        }
    }
</script>
</body>
<?php
include 'footer.php';
?>
</html>