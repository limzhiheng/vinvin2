<?php
// Include the connection file
require_once('connection.php');

// Handle product addition logic
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $details = $_POST['details'];

    // Check if a file was uploaded
    if (isset($_FILES['upload']) && $_FILES['upload']['error'] == 0) {
        // Get category label
        $categoryLabel = getCategoryLabel($category);

        if ($categoryLabel !== null) {
            // Prepare the SQL statement with parameterized query
            $stmt = $condb->prepare("INSERT INTO products (category, name, price, image, details) VALUES (?, ?, ?, ?, ?)");
            if ($stmt) {
                // Retrieve file data from $_FILES['upload']
                $image = $_FILES['upload']['name'];

                // Move the uploaded file to a designated directory
                $uploadsDirectory = "uploads/";
                $targetFile = $uploadsDirectory . basename($_FILES["upload"]["name"]);

                if (move_uploaded_file($_FILES["upload"]["tmp_name"], $targetFile)) {
                    // Bind parameters to the prepared statement
                    $stmt->bind_param("ssdss", $category, $name, $price, $targetFile, $details);

                    // Execute the statement
                    $stmt->execute();

                    // Check for execution errors
                    if ($stmt->affected_rows > 0) {
                        // Redirect to the product page
                        header("Location: product.php?category=" . $categoryLabel);
                        exit();
                    } else {
                        $message = 'Error adding product.';
                    }

                    // Close the statement
                    $stmt->close();
                } else {
                    $message = 'Error moving uploaded file.';
                }
            } else {
                $message = 'Error in prepared statement.';
            }
        } else {
            $message = 'Invalid category selection.';
        }
    } else {
        $message = 'Error uploading file.';
    }
}

// Function to get category label
function getCategoryLabel($category) {
    $categoryLabels = [
        '1' => 'Flower',
        '2' => 'Cake',
        '3' => 'Chocolate',
        '4' => 'Bear',
    ];

    return $categoryLabels[$category] ?? null;
}

// Fetch products from the database
// Replace this with an actual database query to fetch products
$products = []; // Placeholder for the products
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="../css/test.css" rel="stylesheet" />
    <?php include 'A_header.php'; ?>
</head>

<body>
    <center>
        <h1>Add New Products</h1>

        <div id="productContainer">
            <?php foreach ($products as $product): ?>
                <div class="productCard">
                    <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                    <h3><?php echo $product['category']; ?></h3>
                    <h3><?php echo $product['name']; ?></h3>
                    <p>Price: $<?php echo number_format($product['price'], 2); ?></p>
                    <p>Details: <?php echo $product['details']; ?></p>
                </div>
            <?php endforeach; ?>
        </div>

        <form method="POST" action="upload.php" enctype="multipart/form-data" onsubmit="openAlert()">
            <label for="upload img">Update image:</label>
            <input type="file" name="upload[]" multiple required>
            <br><br>
            <label for="name">Product Name:</label>
            <input type="text" name="name" required>
            <label for="price">Product Price:</label>
            <input type="number" name="price" step="0.01" required>

            <br><br>

            <label for="category">Select Category:</label>
            <select name="category" id="category" required>
                <option value="">Click to Select</option>
                <option value="1">1(Flower)</option>
                <option value="2">2(Cake)</option>
                <option value="3">3(Chocolate)</option>
                <option value="4">4(Bear)</option>
                <!-- Add more options for other categories as needed -->
            </select>
            <br><br>
            
            <label for="details">Product Details Information:</label>
            <input type="text" name="details" required>
            <br>
            <input type="submit" value="Upload"><br>
        </form>

        <br><br><br>
    </center>
</body>
<script>
    function openAlert() {
        window.alert("Upload Successful.");
    }
</script>
</html>
