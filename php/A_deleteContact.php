<?php
include 'connection.php';
$sql = "DELETE FROM contact  WHERE no='" . $_GET["no"] . "'";
if (mysqli_query($condb, $sql)) {
		echo "<script>alert('Comment Deleted Successfully');
		window.location.href='A_contact.php';</script>";
	}
else {
		echo "<script>alert('Error in Deleting Admin');
		window.history.back();</script>";
}

mysqli_close($condb);
?>