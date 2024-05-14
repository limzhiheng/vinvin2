<?php
    include('connection.php');
        $query_products = "SELECT * FROM products";
            $result_products = $condb-> query ($query_products);
                if (!$result_products){
	                die ("Error retrieving products:" . $condb->error);
                        }
                    $products = array();
                while ($row = $result_products-> fetch_assoc()){
	        $products[] = $row;
        }
    // Get the category ID from the URL
$category = isset($_GET['category']) ? $_GET['category'] : 0;

// Fetch products based on the selected category
    $stmt = $condb->prepare("SELECT * FROM products WHERE category = ?");
        $stmt->bind_param("i", $category);
            $stmt->execute();
                $products = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>
<?php
function getCategoryWord($categoryId) {
    switch ($categoryId) {
        case 1:
            return 'Men';
        case 2:
            return 'Women';
        case 3:
            return 'Kid';
        case 4:
            return 'Shoes Bag';
        default:
            return 'Unknown Category';
    }
}
?>
<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <link href="../css/c_product.css" rel="stylesheet" />
	                    <title>Products - Category</title>
                    </head> 
                <body>
            <?php include('A_header.php');?>
        <ul>
    <?php
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
            echo '<img src="' . $cartItem['details']['image'] . '" alt="' . $cartItem['details']['name'] . '" style="max-width: 100px; max-height: 100px;">';
                echo ' Product: ' . $cartItem['details']['name'] . '| Price: RM' . number_format($cartItem['details']['price'], 2);

            // Display original price
            echo ' | Quantity: ';
                
            // Quantity value
            echo '<span class="quantity-value">' . $cartItem['quantity'] . '</span>';

            // Display selected size
            if (!empty($cartItem['size'])) {
                    echo ' | Size: ' . $cartItem['size'];
                }

            // Button to increase / decrease quantity
            echo '<form action="cart.php?action=update&id=' . $id . '" method="post" onsubmit="return validateForm()">
                    <button type="submit" class="quantity-button" name="quantity" value="' . ($cartItem['quantity'] - 1) . '" ' . ($cartItem['quantity'] <= 1 ? 'disabled' : '') . '>&#8722;</button>
                    <button type="submit" class="quantity-button" name="quantity" value="' . ($cartItem['quantity'] + 1) . '" ' . ($cartItem['quantity'] >= $maxQuantity ? 'disabled' : '') . '>&#43;</button>
                  </form>';

            // Calculate subtotal for the current product
                $subtotal = $cartItem['details']['price'] * $cartItem['quantity'];
                    echo ' | Subtotal: RM' . number_format($subtotal, 2);

            // Button to remove item
            echo '<form action="cart.php?action=remove&id=' . $id . '" method="post">
                    <button type="submit">Remove</button>
                    </form>';
            echo '<hr>';
            $totalPrice += $subtotal;
            } else {
                echo 'Invalid product details';
            }
            echo '</li>';
        }
        echo '</ul>';
        echo '<p>Total Price: RM' . number_format($totalPrice, 2) . '</p>';
    } else {
        echo '<p>Your cart is empty.</p>';
    }
}
function product_list() {
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        echo '<ul>';
        $totalQuantity = 0;

        foreach ($_SESSION['cart'] as $id => $cartItem) {
            echo '<li>';
            // Check if product details exist
            if (isset($cartItem['details']) && is_array($cartItem['details'])) {
                // Display product information
                echo ' ID: ' . $cartItem['details']['id'] . ' | Name: ' . $cartItem['details']['name'] . ' | Quantity: ' . $cartItem['quantity'];
                $totalQuantity += $cartItem['quantity'];
            } else {
                echo 'Invalid product details';
            }

            echo '</li>';
        }

        echo '</ul>';
        echo '<p>Total Quantity: ' . $totalQuantity . '</p>';
    } else {
        echo '<p>Your cart is empty.</p>';
    }
}
function displayCartDetails() {
    global $products;
        if (isset($_SESSION['shopping_cart']) && !empty($_SESSION['shopping_cart'])) {
            echo '<h2>Product Details</h2>';
            echo '<ul>';

        foreach ($_SESSION['shopping_cart'] as $id => $cartItem) {
            echo '<li>';
            // Check if product details exist
            if (isset($_SESSION['shopping_cart']) && !empty($_SESSION['shopping_cart'])) {
                // Display product information
                echo ' ID: ' . $cartItem['details']['id'] . ' | Name: ' . $cartItem['details']['name'] . ' | Category: ' . $cartItem['details']['category'] . ' | Price: RM' . number_format($cartItem['details']['price'], 2);
            } else {
                echo 'Invalid product details';
            }

            echo '</li>';
        }

        echo '</ul>';
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

			case 'update':
				$id = $_GET['id'];
				$quantity = $_POST['quantity'];
				if (isset($_SESSION['cart'][$id])) {
				$_SESSION['cart'][$id]['quantity'] = $quantity;
					}
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
    </ul>
    <div class="link_product">
	    <div class="box0">
			<div class="img-box">
				<a href="A_productCategory.php?category=1">
			    	<img src="../img/men.jpg" alt="Man shoes">
				</a>
			</div>
        <div class="detail-box">
    <h5><a href="A_productCategory.php?category=1">Men</a></h5>
</div>
    </div>
	    <div class="box0">
            <div class="img-box">
			    <a href="A_productCategory.php?category=2">
			        <img src="../img/women.jpeg" alt="Woman_shoes">
			    </a>
            </div>
        <div class="detail-box">
    <h5><a href="A_productCategory.php?category=2">Women</a></h5>
</div>            
    </div>
	    <div class="box0">
            <div class="img-box">
			    <a href="A_productCategory.php?category=3">
				    <img src="../img/kid.jpeg" alt=""> 
				</a>
            </div>
        <div class="detail-box">
    <h5><a href="A_productCategory.php?category=3">Kids</a></h5>
</div>
    </div>
	    <div class="box0">
            <div class="img-box">
			    <a href="A_productCategory.php?category=4">
                    <img src="../img/shoes_bag.jpeg" alt="">
			    </a>
            </div>
        <div class="detail-box">
    <h5><a href="A_productCategory.php?category=4">Shoes Bags</a></h5>
</div>
    </div>
	    </div><hr>
            <h1>Products - <?php echo getCategoryWord($category); ?></h1>
	 <?php
	 // Display products from the database
	 echo'<center>';
	    echo '<div class="container">';
	 
    foreach ($products as $product) {
        echo '<div class="column">';
            echo '<a href="A_product_details.php?id=' . $product['id'] . '" class="product-link">';
                echo '<h2>' . $product['name'] . '</h2>';
                    echo '<p>Price: RM' . $product['price'] . '</p>';
                        echo '<img src="' . (isset($product['image']) ? $product['image'] : '') . '" height="150px;" width="150px;">';
                    echo '</a>';
               
                echo '</div>';
            }
	    echo'</center>';
    ?>
<br>


<script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
            </script>
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
            </script><br>
<?php include 'footer.php';?>
</body>
</html>

<?php
// Close the database connection
$stmt->close();
$condb->close();
?>
