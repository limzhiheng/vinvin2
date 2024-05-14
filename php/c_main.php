<?php

session_start();

// Check if the user is not logged in
if (!isset($_SESSION['user'])) {
    header("Location: c_login.php");
    exit();
}
require_once ('connection.php');
$result = mysqli_query($condb,"SELECT * FROM contact");
?>
<?php
require_once('connection.php');
// Retrieve user information from the database
$userEmail = $_SESSION['user'];
$customerQuery = "SELECT * FROM users WHERE email = '$userEmail'";
$customerResult = mysqli_query($condb, $customerQuery);

if ($customerResult && mysqli_num_rows($customerResult) == 1) {
    $customerRow = mysqli_fetch_assoc($customerResult);
    // You can access customer information like $customerRow['name'], $customerRow['address'], etc.
} else {
    // Handle the case where user information is not found
    // Redirect to login page or display an error message
    header("Location: c_login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
                <meta name="description" content="" />
                    <meta name="author" content="" />
                <title>Online Shop</title>
            <link href="../css/c_main.css" rel="stylesheet" />
        <!--<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<meta name="viewport" content="width=device-width, initial-scale=0.5">-->
	</head>

	    <body>
            
            
            <div id="video-background">
                <video autoplay muted loop>
                <source src="../video/bg.mp4" type="video/mp4">
            Your browser does not support the video tag.
                </video>
            </div>
            
	        <?php include 'header.php'; ?>
            <br><br>
<center>
	            <div class="col mb-5">
		            <div class="a">
                <h2>Hi, <?php echo $customerRow['user_name']; ?>!</h2>
			    <h1>Welcome Computer Science Socity</h1>
			<h3>Empowering Minds, Transforming Futures</h3>
            <?php include 'time.php'; ?>
        </div>	

	</div>
</center>	
	<div class="view">
    
	    <div class="man_shoes">
		    <div class="row">
			    <div class="col-sm-6 col-md-4 col-lg-3">
			    	<div class="box">
				<div class="img-box">
			<a href="product.php?category=1">
		<img src="../img/yonex racket.jpeg" alt="Racket" class="cat_img">
	</a>
</div>

    <div class="detail-box">
        <h6>
            Flower <br><br>
                  <a href="product.php?category=1">Click See More &rarr;</a>
                </h6>
					</div>
				</div>
			</div>	
		</div>
	</div>

	<div class="woman_shoes">	
		 <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="box">
             <div class="img-box">
			  <a href="product.php?category=2">
			   <img src="../img/shoes.jpeg" alt="Woman_shoes" class="cat_img">
			    </a>
               </div>
              <div class="detail-box">
             <h6>
               Cake<br><br>
               <a href="product.php?category=2">Click See More &rarr;</a>
                </h6>
               </div>            
              </div>
	           </div>
	            </div>
	
	<div class="kid_shoes">
		 <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="box">
              <div class="img-box">
			   <a href="product.php?category=3">
				<img src="../img/clothing.jpg" alt=""class="cat_img"> 
				</a>
              </div>
              <div class="detail-box">
                <h6>
                Chocolate<br><br>
                  <a href="product.php?category=3">Click See More &rarr;</a>
                </h6>
              </div>
          </div>
        </div>	
        </div>	
		
		<div class="shoes_bag">
		 <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="box">
              <div class="img-box">
			  <a href="product.php?category=4">
                <img src="../img/bag.jpeg" alt="" class="cat_img">
			  </a>
              </div>
              <div class="detail-box">
                <h6>
                   Bear<br><br>
                <a href="product.php?category=4">Click See More &rarr;</a>
                </h6>
              </div>
          </div>
        </div>	
        </div>
	<br><br>
					<ul class="b">
					<li><a href="c_product.php" ><br>&nbsp;Shop Now</a></li>
					</ul>	
	</div><br><br>
            <?php include "slideshow.php"; ?>
		<div class="shopus">
		<h2>WHY SHOP US</h2>
		<p>&#9745; 100% genuine guarantee &nbsp;&nbsp;  &#9745;7 Days No Reason returns &nbsp;&nbsp;  &#9745;Free Delivery</p>
		</div>
<center>
    <h2>FeedBack</h2>
    <div class="box1">
        <form action="" method="post" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="firstName">Name:</label>
                <input type="text" class="form-control" id="name" name="name" autocomplete="off">
            </div><br>

            <div class="form-group">
                <label for="phoneNumber">Phone Number:</label>
                <input type="text" class="form-control" id="Phone" name="Phone" autocomplete="off">
            </div><br>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="Email" class="form-control" id="Email" name="Email" autocomplete="off">
            </div><br>

            <div class="form-group">
                <label for="message">Message:</label>
                <textarea id="Message" class="form-control" name="Message" rows="4" autocomplete="off"></textarea>
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
            echo "<script>alert('FeedBack comment successfully added'); window.location.href='c_main.php';</script>";
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
            alert('Please fill in all the required fields.');
            return false;
        }

        // Validate phone number
        var phoneRegex = /^[0-9]+$/; // Regular expression to allow only numbers
        if (!phone.match(phoneRegex)) {
            alert('Phone number no need -.');
            return false;
        }

        return true;
    }
</script>

	</div>
</body>
<br>
<br>
    <?php
    include 'footer.php';
    ?>
</html>