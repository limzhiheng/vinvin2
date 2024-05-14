<?php
	include ('connection.php');
		$result = mysqli_query($condb,"SELECT * FROM admins");
			?>
		<!DOCTYPE html>
	<html>
<head>
	<title>Zeta Shop - Admin List(Staff)</title>
		<link href="../css/A_admin_list.css" rel="stylesheet"/>
	 		<?php include 'A_main_header.php'; ?>	
				</head>
			<body> 
		<center><h1>Admin List</h1></center>
	<div class='box'>
<br><br>
    <center><table>
        <tr>
			<center><td>No.</td></center>
				<td>Admin_name</td>
	    		<td>Role</td>
					<td>Gender</td>
				<center><td>Email</td></center>
			<td>Edit</td>
        <td>Delete</td>
	</tr>
<?php
	$i=0;
		while($row = mysqli_fetch_array($result)) {
			?>
	  	<tr>
	<td><?php echo $row["id"]; ?></td>
	<td><?php echo $row["admin_name"]; ?></td>
	<td><?php echo $row["role"]; ?></td>
		<td><?php echo $row["gender"]; ?></td>
			<td><?php echo $row["email"]; ?></td>
		<td><a href="A_editadmin.php?id=<?php echo $row["id"]; ?>">Edit admin_info</a></td>
    <td><a href="A_deleteadmin.php?id=<?php echo $row["id"]; ?>">Delete admin</a></td>
</tr>
	<?php
		$i++;
				}
			?>
	</table>
<br>
	<br>
		 <br>				
			<a class="add" href="A_addadmin.php">Add new admin</a>
		 </div>
		 <br>
		 <center><a class="back" href="A_main_admin.php">Back</a></center>
	   </center>
    </body>
</html>