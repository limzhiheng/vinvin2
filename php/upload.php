<?php
include('connection.php');

foreach ($_FILES['upload']['name'] as $key => $name) {
    $newFilename = time() . "_" . $name;
    $uploadPath = 'upload/' . $newFilename;

    // Check file type if necessary
    $allowedTypes = ['image/jpeg', 'image/png']; // Add more types as needed
    if (!in_array($_FILES['upload']['type'][$key], $allowedTypes)) {
        die("Invalid file type. Allowed types: " . implode(', ', $allowedTypes));
    }

    if (move_uploaded_file($_FILES['upload']['tmp_name'][$key], $uploadPath)) {
        // Use prepared statement to prevent SQL injection
        $stmt = $condb->prepare("INSERT INTO products (category, name, price, image, details) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdss", $category, $name, $price, $uploadPath, $details);

        // Assuming you have category, name, and price variables from your form
        $category = $_POST['category'];
        $name = $_POST['name'];
        $price = $_POST['price'];
		$details = $_POST['details'];

        $stmt->execute();
        $stmt->close();
    } else {
        die("Error uploading file.");
    }
}

header('location:test.php');
?>
