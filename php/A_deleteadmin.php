<?php
include 'connection.php';

// Check if the 'id' parameter is set in the URL
if (!isset($_GET["id"])) {
    echo "<script>alert('Invalid request');</script>";
    exit(); // Stop execution if 'id' is not set
}

// Get the 'id' from the URL
$id = $_GET["id"];

// Prepare the SQL query using a prepared statement
$sql = "DELETE FROM admins WHERE id = ?";
$stmt = mysqli_prepare($condb, $sql);

// Bind the 'id' parameter to the prepared statement
mysqli_stmt_bind_param($stmt, "i", $id);

// Execute the prepared statement
if (mysqli_stmt_execute($stmt)) {
    echo "<script>alert('Admin Deleted Successfully'); window.location.href='A_admin_list.php';</script>";
} else {
    // Display the error message
    echo "<script>alert('Error in Deleting Admin'); window.history.back();</script>";
}

// Close the prepared statement and the connection
mysqli_stmt_close($stmt);
mysqli_close($condb);
?>
