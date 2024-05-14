<?php
include 'connection.php';

$productID = isset($_GET["id"]) ? $_GET["id"] : "";
$productID = mysqli_real_escape_string($condb, $productID);

// Check if the user has confirmed the deletion
$confirmed = isset($_GET['confirm']) ? $_GET['confirm'] : false;

if (!$confirmed) {
    // Display a confirmation dialog
    echo '<script>';
    echo 'var confirmed = confirm("Are you sure you want to delete this product?");';
    echo 'if (confirmed) {';
    echo '    window.location.href = "A_deleteProduct.php?id=' . $productID . '&confirm=true";';
    echo '} else {';
    echo '    window.location.href = "A_product.php";';  // Redirect back if not confirmed
    echo '}';
    echo '</script>';
    exit;
}

// Continue with the deletion process
$sql = "DELETE FROM products WHERE id=?";
$stmt = mysqli_prepare($condb, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "i", $productID);
    if (mysqli_stmt_execute($stmt)) {
        echo "Product Deleted Successfully";
        header('Location: A_product.php');
        exit;
    } else {
        echo "Error executing deletion: " . mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
} else {
    echo "Error preparing deletion: " . mysqli_error($condb);
}

mysqli_close($condb);
?>
