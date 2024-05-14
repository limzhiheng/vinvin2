<?php
require_once ('connection.php');
$result = mysqli_query($condb,"SELECT * FROM contact");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
	<title>Contact record</title>
	<link href="../css/A_contact.css" rel="stylesheet" />
	<?php include 'A_main_header.php'; ?>
</head>

<body>
        <br>
        <center><h1>Customer's contact information</h1></center>
        
    <div class="box">
        <?php
            if (mysqli_num_rows($result) > 0) {
            ?>
            
            <center>
        <div class="table">
        <table>
		<tr>
		<td>No.</td>
        <td>Name</td>
		<td>Phone number
		<br>(+60)</td>
		<td>Email</td>
		<td>Message</td>
		<td>Delete</td>
		</tr>
			<?php
			$i=0;
			while($row = mysqli_fetch_array($result)) {
			?>
	  <tr>
		<td><?php echo $row["No"];?></td>
		<td><?php echo $row["Name"]; ?></td>
		<td><?php echo $row["Phone"]; ?></td>
		<td><?php echo $row["Email"]; ?></td>
		<td><?php echo $row["Message"]; ?></td>
		<td><a class="delete" href="A_deleteContact.php?no=<?php echo $row["No"]; ?>">Delete Comment</a></td>
      </tr>
			<?php
			$i++;
			}
			?>
             <?php
}
else
{
    echo "No result found";
}
?>
    
</table>
        <br><br>
        </div>
        </center>
    </div>
                
        
</body>

</html>