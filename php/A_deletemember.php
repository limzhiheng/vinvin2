<?php
include 'connection.php';
$sql = "DELETE FROM users  WHERE id='" . $_GET["id"] . "'";
if (mysqli_query($condb, $sql)) {
		echo "<script>alert('Member Deleted Successfully');
		window.location.href='A_member_list.php';</script>";
	}
else {
		echo "<script>alert('Error in Deleting Member');
		window.history.back();</script>";
}

mysqli_close($condb);
?>