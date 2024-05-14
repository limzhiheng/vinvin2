<?php
include ('connection.php');
$result = mysqli_query($condb,"SELECT * FROM users");
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

    <center><h1>Members List</h1>
        <br><br>
        <table class="table-zoom">
        <tr>
		<center><td>No.</td></center>
		<center><td>Name</td><center>
		<center><td>Email</td></center>
		<center><td>Gender</td></center>
        <td>Delete</td>
	  </tr>
			<?php
			$i=0;
			while($row = mysqli_fetch_array($result)) {
			?>
	  <tr>
	<td><?php echo $row["id"]; ?></td>
	<td><?php echo $row["user_name"]; ?></td>
	<td><?php echo $row["email"]; ?></td>
	<td><?php echo $row["gender"]; ?></td>
    <td><a class="link" href="A_deletemember.php?id=<?php echo $row["id"]; ?>">Delete member</a></td>
      </tr>
			<?php
			$i++;
			}
			?>
		</table>
<br><br><br>	
		<a class="add" href="A_addmember.php">Add new member</a>
	</center>
    </body>
    </html>