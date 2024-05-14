<?php
	include ('connection.php');
		$result = mysqli_query($condb,"SELECT * FROM checkout");
			?>

<!DOCTYPE html>
	<html>
		<head>
			<title>Zeta Shop - Members List(Staff)</title>
    			<link rel="stylesheet" href="../css/s_memberlist.css">
			<link href="../css/A_member_list.css" rel="stylesheet"/>
		<?php include 'A_header.php'; ?>	
	</head>
<body> 
	<center><h1>Product checkout List</h1>
        <br><br>
        	<table>
        		<tr>
				<center><td>No.</td></center>
	    	<td>Customer name</td>
		<td>Email</td>
	<center><td>Phone</td></center>
<td>Home Address</td>
	<td>Product List</td>
        <td>Delete</td>
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
		<td><?php echo $row["details"]; ?></a></td>
    <td><a href="A_deletemember.php?no=<?php echo $row["id"]; ?>">Delete</a></td>
      </tr>
			<?php
			$i++;
			}
			?>
		</table>
<br><br>
		</center>
    </body>
</html>