<?php
	include ('connection.php');
		$result = mysqli_query($condb,"SELECT * FROM coupon_code");
			?>

<!DOCTYPE html>
	<html>
		<head>
			<title>Coupon List</title>
			<link href="../css/A_coupon_list.css" rel="stylesheet"/>
		<?php include 'A_header.php'; ?>	
	</head>
<body> 
	<center><h1>Coupon Code List</h1>
    <h4>STATUS: 1 for Active, 0 for Inactive</h4>
        <br>
        <div class="zoomed-table">
        	<table>
        		<tr>
				<center><td>No.</td></center>
	    	<td>Code</td>
		<td>Value(RM)</td>
        <td>Status</td>
	<td>Edit</td>
        <td>Delete</td>
			</tr>
			<?php
				$i=0;
				while($row = mysqli_fetch_array($result)) {
			?>
	  <tr>
	<td><?php echo $row["id"]; ?></td>
		<td><?php echo $row["coupon_code"]; ?></td>
			<td><?php echo $row["value"]; ?></td>
            <td><?php echo $row["status"]; ?></td>
            <td><a href="A_editcoupon.php?id=<?php echo $row["id"]?>">Edit</td>
    <td><a href="A_deletecoupon.php?no=<?php echo $row["id"]; ?>">Delete</a></td>
      </tr>
			<?php
			$i++;
			}
			?>
		</table>
<br><br>
<a class="add" href="A_addcoupon.php">Add new Coupon</a>
        </div>
		</center>
    </body>
</html>