<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['admin_name'])) {
    header("Location: A_login.php");
    exit();
}

// Assuming you have stored admin information in the session
$adminName = $_SESSION['admin_name'];

?>
<?php
include ('connection.php');

// Set the number of products to display per page
$productsPerPage = 12;

// Get the current page number from the URL parameter
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$startFrom = ($page - 1) * $productsPerPage;

// Fetch products from the database with LIMIT clause
$result = mysqli_query($condb, "SELECT * FROM products LIMIT $startFrom, $productsPerPage");

if (!$result) {
    die("Error retrieving products: " . $condb->error);
}

$products = array();
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}
$recordsPerPage = 12;

// Get the current page number from the URL parameter
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$startFrom = ($page - 1) * $recordsPerPage;

// Fetch records from the database with LIMIT clause
$result = mysqli_query($condb, "SELECT * FROM products LIMIT $startFrom, $recordsPerPage");
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
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
    <title>Products</title>
    <!-- slider stylesheet -->
    <link href="../css/A_product.css" rel="stylesheet" />
    <?php include 'A_main_header.php';?>
</head>
<br>


<body>
   
    <center><h1>Admin Control product page</h1>
    <h2>Welcome Back, <?php echo $adminName; ?> !</h2></center>
    <div class='box'>
        <br><br>
        <div class="search-container">
    <form action="" method="GET">
        <input class="search" type="text" id="search" name="search" placeholder="Enter product name or ID">
        <button class="search-btn" type="submit">Search</button>
    </form></div>
        <table>
            <tr>
                <td>Product_Id</td>
                <td>Product_name</td>
                <td>Price</td>
                <td>image</td>
                <td>Edit</td>
                <td>Delete</td>
            </tr>
            <?php
            $i = 0;
            while ($row = mysqli_fetch_array($result)) {
                ?>
                <tr>
                    <td><?php echo $row["id"]; ?></td>
                    <td><?php echo $row["name"]; ?></td>
                    <td><?php echo $row["price"]; ?></td>
                    <td><?php echo $row["image"]; ?></td>
                    <td><a class="function" href="A_edit_product.php?no=<?php echo $row["id"]; ?>">Edit Product</a></td>
                    <td><a class="function" href="A_deleteProduct.php?id=<?php echo $row["id"]; ?>">Delete Product</a></td>
                </tr>
                <?php
                $i++;
            }
            ?>
        </table>
        <br>

        <br>
        <a class="function" href="test.php">Add Product</a>
    </div>

    <?php
    // Pagination settings
    $productsPerPage = 12;
    $totalProducts = count($products);
    $totalPages = ceil($totalProducts / $productsPerPage);

    // Determine current page
    $current_page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
    $offset = ($current_page - 1) * $productsPerPage;

    // Display products from the database for the current page
    ECHO '<br>';
    echo '<center>';
    echo '<div class="container">';
    $count = 0; // Variable to track the number of displayed products

    foreach ($products as $product) {
    if ($count >= $offset && $count < ($offset + $productsPerPage)) {
    echo '<div class="column">';
    echo '<a href="A_product_details.php?id=' . $product['id'] . '" class="product-link">';
    echo '<h2>' . $product['name'] . '</h2>';
    echo '<p>Price: RM' . $product['price'] . '</p>';
    echo '<img src="' . (isset($product['image']) ? $product['image'] : '') . '" height="150px;" width="150px;">';
    echo '</a>';
    echo '</form>';
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
    echo '<button class="page" onclick="window.location.href=\'?page=' . ($current_page - 1) . '\'" class="pagination-btn">&laquo;</button>';
    }
    // Display page buttons
    $visiblePages = 3; // Number of visible page buttons
    $startPage = max(1, $current_page - floor($visiblePages / 2));
    $endPage = min($startPage + $visiblePages - 1, $totalPages);

    for ($page = $startPage; $page <= $endPage; $page++) {
    $activeClass = ($page == $current_page) ? 'active' : '';
    // Display a button for each page
    echo '<button class="page" onclick="window.location.href=\'?page=' . $page . '\'" class="' . $activeClass . ' pagination-btn">' . $page . '</button>';
    }

    // Display ellipsis if there are more pages
    if ($endPage < $totalPages) {
    echo '<button class="page"><span class="pagination-ellipsis">....</span></button>';
    }

    if ($current_page < $totalPages) {
    // Display the next button
    echo '<button class="page" onclick="window.location.href=\'?page=' . ($current_page + 1) . '\'" class="pagination-btn">&raquo;</button>';
    }
    echo '</div></center>';
    echo '<br><br>';
    ?>
<br>
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
    </script>
    <script src="js/custom.js"></script>
</body>
</html>
