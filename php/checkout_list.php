<?php
include ('connection.php');
$result = mysqli_query($condb,"SELECT * FROM checkout");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Zeta Shop - Checkout_List</title>
	<link href="../css/A_checkout_list.css" rel="stylesheet"/>
	<?php include 'A_header.php';?>
</head>
<body> 

    <center><h1>Customer Checkout List</h1>
		<h3>Category type</h3>
		<h4>1 = Flower&nbsp;&nbsp; 2 = Cake&nbsp;&nbsp; 3 = Chocolate&nbsp;&nbsp; 4 = Bear</h4>
        <table>
        <tr>
		<center><td>No.</td></center>
		<center><td>Name</td><center>
		<center><td>Email</td></center>
		<center><td>Phone</td></center>
        <center><td>Home address</td></center>
        <center><td>Product List</td></center>
        <center><td>Delete</td></center>
	  </tr>
			<?php
			$i=0;
			while($row = mysqli_fetch_array($result)) {
			?>
	  <tr>
	<td><?php echo $row["id"]; ?></td>
	<td><?php echo $row["name"]; ?></td>
	<td><?php echo $row["email"]; ?></td>
	<td><?php echo $row["phone"]; ?></td>
    <td><?php echo $row["address"]; ?></td>
	<td><?php echo $row["details"]; ?></td>
    <center><td><a class="link" href="A_deletecheckout.php?id=<?php echo $row["id"]; ?>">Delete List</a></td></center>
      </tr>
			<?php
			$i++;
			}
			?>
		</table>
<br><br><br>
	</center>
    </body>
    </html>