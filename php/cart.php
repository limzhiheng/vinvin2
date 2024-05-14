<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/cart.css" rel="stylesheet" />
    <title>Cart Page</title>
</head>

<body>
    <h1>Shopping Cart</h1>

    <?php
    include('function.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action'])) {
        $action = $_GET['action'];

        switch ($action) {
            case 'add':
                $id = $_GET['id'];
                $quantity = $_POST['quantity'];
                addToCart($id, $quantity);
                break;

            case 'update':
                $id = $_GET['id'];
                $quantity = $_POST['quantity'];
                $_SESSION['cart'][$id] = $quantity;
                break;
    
            case 'remove':
                $id = $_GET['id'];
                echo "Removing product with ID: $id";
                removeFromCart($id);
                header('Location: cart.php');
                exit;
                break;

            case 'clear':
                clearCart();
                break;

            // Additional cases can be added if needed

            default:
                // Do nothing
                break;
        }

        // Redirect back to cart page
        header('Location: cart.php');
        exit;
    }

    // Display cart contents
    displayCart();
    ?>

    <!-- Add this form for "Checkout" -->
    <form action="checkout.php" method="post">
        <button class="checkout">Checkout</button>
    </form>

    <!-- Add this form for "Clear Cart" -->
    <form action="cart.php?action=clear" method="post">
        <button class="clear" type="submit">Clear Cart</button>
    </form>

    <!-- Add this form for "Go Back to Product Page" -->
    <form action="c_product.php" method="get">
        <button class="productpage" type="submit">Start to Shopping</button>
    </form>

</body>
<br><br><br><br><br><br><br>
<?php include 'footer.php';?>
</html>
