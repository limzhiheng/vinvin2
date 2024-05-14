<?php
include 'connection.php';

$checkoutid = isset($_GET["id"]) ? $_GET["id"] : "";
$checkoutid = mysqli_real_escape_string($condb, $checkoutid);

// Check if the user has confirmed the deletion
$confirmed = isset($_GET['confirm']) ? $_GET['confirm'] : false;

if (!$confirmed) {
    // Display a confirmation dialog
    echo '<script>';
    echo 'var confirmed = confirm("Are you sure you want to delete this checkout list?");';
    echo 'if (confirmed) {';
    echo '    window.location.href = "A_deletecheckout.php?id=' . $checkoutid . '&confirm=true";';
    echo '} else {';
    echo '    window.location.href = "checkout_list.php";';  // Redirect back if not confirmed
    echo '}';
    echo '</script>';
    exit;
}

// Continue with the deletion process
$sql = "DELETE FROM checkout WHERE id=?";
$stmt = mysqli_prepare($condb, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "i", $checkoutid);
    if (mysqli_stmt_execute($stmt)) {
        echo "Checkout List Deleted Successfully";
        header('Location: checkout_list.php');
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
