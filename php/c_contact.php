<?php
include ('connection.php');
?>

<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Contact Us</title>
        
		<link href="../css/c_contact.css" rel="stylesheet" /> 
		<?php include 'header.php'; ?>
	</head>
	<body>
	<div class="box0">
	<p>Contact us on social media:</p>
    <a class="social" href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook fa-5x" aria-hidden="true"></i>&nbsp;&nbsp;</a> 
    <a class="social" href="https://www.instagram.com/" target="_blank"><i class="fa fa-instagram fa-5x" aria-hidden="true"></i>&nbsp;&nbsp;</a>
    <a class="social" href="https://wa.me/0123456789" target="_blank"><i class="fa fa-whatsapp fa-5x" aria-hidden="true"></i>&nbsp;&nbsp;</a>

	</div>
	<br><br><br><br><br><br>
	<div class="box1">
        <form action="" method="post" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="firstName">Name:</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="name" autocomplete="off">
            </div><br>

            <div class="form-group">
                <label for="phoneNumber">Phone Number:</label>
                <input type="text" class="form-control" id="Phone" name="Phone" placeholder="PhoneNumber"
                       autocomplete="off">
            </div><br>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="Email" class="form-control" id="Email" name="Email" placeholder="Email" autocomplete="off">
            </div><br>

            <div class="form-group">
                <label for="message">Message:</label>
                <textarea id="Message" class="form-control" name="Message" rows="4" placeholder="Write your question"
                          autocomplete="off"></textarea>
            </div><br>

            <input type="submit" class="btn btn-primary btn-large" value="Send" name="submit">
        </form>
    </div>
</center>

<?php
if (isset($_POST['submit'])) {
    // Validate form data before processing
    if (empty($_POST['name']) || empty($_POST['Phone']) || empty($_POST['Email']) || empty($_POST['Message'])) {
        echo "<script>alert('Please fill in all the required fields.');</script>";
    } else {
        // Proceed with inserting data into the database
        $fetchqry = "SELECT * FROM `contact`";
        $result = mysqli_query($condb, $fetchqry);

        $num = mysqli_num_rows($result);
        $No = $num + 1;
        $Name = $_POST['name'];
        $Phone = $_POST['Phone'];
        $Email = $_POST['Email'];
        $Message = $_POST['Message'];
        $qry = "INSERT INTO `contact`(`No`, `Name`, `Phone`, `Email`, `Message`) VALUES ($No, '$Name', '$Phone', '$Email', '$Message')";
        $done = mysqli_query($condb, $qry);
        if ($done == TRUE) {
            echo "<script>alert('Contact comment successfully added'); window.location.href='c_contact.php';</script>";
        } else {
            echo "<script>alert('Error in adding contact comment');</script>";
        }
    }
}
?>

<script>
    function validateForm() {
        var name = document.getElementById("name").value;
        var phone = document.getElementById("Phone").value;
        var email = document.getElementById("Email").value;
        var message = document.getElementById("Message").value;

        if (name === '' || phone === '' || email === '' || message === '') {
            alert('Please fill in all the blank.');
            return false;
        }

        return true;
    }
</script>
</body>
<br><br><br><br><br><br><br><br><br><br><br>		
	<?php include 'footer.php';?>
</html>
