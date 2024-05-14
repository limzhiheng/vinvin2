<html>
<head>

</head>
<style>
body{
   
}    
    
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color:none;
}

li {
  float: left;
}

li p, .dropbtn {
  display: inline-block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li p:hover, .dropdown:hover .dropbtn {
  font-size:20px;
}

li.dropdown {
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: gold;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

.dropdown-content a:hover {
	background-color: #f1f1f1;
}

.dropdown:hover .dropdown-content {
  display: block;
}
    
    .shopname{
        background-color: none;
        border-radius: 10px;
    }
@media screen and (max-width: 768px) {
            .shopname ul {
                display: none;
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .shopname ul.show {
                display: flex;
            }

            .shopname li {
                width: 100%;
                margin: 0;
            }

            .dropdown-content {
                display: none;
            }

            .dropbtn {
                display: block;
                width: 100%;
                text-align: left;
                cursor: pointer; /* Add this line to make the cursor change on hover */
            }

            .menu-icon {
                display: block;
                cursor: pointer;
            }
        }
        
        /* Hide the menu icon by default on larger screens */
        @media screen and (min-width: 769px) {
            .menu-icon {
                display: none;
            }
        }
</style>
<body>
<header>
	<div class="collapse navbar-collapse" id="navbarNav">
	    <div class="shopname">
        <div class="menu-icon" onclick="toggleMenu()">&#9776;</div>
		    
            
            <ul>
                <li><a href="c_main.php"><img src="../img/shop logo.png" height="100px" width="150px"></a></li>
            <span style="float:right">
			<li class="dropdown">
                <a href="javascript:void(0)" ><p>&#x1F7CA;Shop</p></a>
		<div class="dropdown-content">
            <a href="c_product.php">All products</a>
			<a href="product.php?category=1">Flower</a>
			<a href="product.php?category=2">Cake</a>
			<a href="product.php?category=3">Chocolate</a>
			<a href="product.php?category=4">Bear</a>
		</div>
			</li>
			<li><a href="c_contact.php"><p>&#128222;Contact Us</p></a></li>
			<li><a href="cart.php"><p>&#128722;Cart</p></a></li>
            <li><a href="c_profiles.php"><p>&#128100;My Profiles</p></a></li>
			<li><a href="c_logout.php"><p>&#128682;Logout</p> </a></li>
      
        </span>
    </ul>
		</div>
	</div>
	</header>
	</body>
  <script>
        // JavaScript to toggle the menu on small screens
        function toggleMenu() {
            const menuList = document.querySelector('.shopname ul');
            menuList.classList.toggle('show');
        }
    </script>
</html>