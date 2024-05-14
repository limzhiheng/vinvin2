<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>
<style>

ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color:#CCCCFF;
}

li {
  float: left;
}

li a, .dropbtn {
  display: inline-block;
  color: black;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover, .dropdown:hover .dropbtn {
  background-color:#87CEFA;
}

li.dropdown {
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #9999FF;
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
	   <header>
       <div class="collapse navbar-collapse" id="navbarNav">
            <div class="shopname">
                <div class="menu-icon" onclick="toggleMenu()">&#9776;</div>
                <ul>
			<li class="nav-item active">
			<li class="dropdown">
			<a href="javascript:void(0)" class="dropbtn">&#128722;Shop</a>
		<div class="dropdown-content">
			<a href="A_product.php">All products</a>
			<a href="A_productCategory.php?category=1">Flower</a>
			<a href="A_productCategory.php?category=2">Cake</a>
			<a href="A_productCategory.php?category=3">Chocolate</a>
			<a href="A_productCategory.php?category=4">Bear</a>
		</div>
			</li>
			<li>
      <a href="test.php">&#43;Add Product</a>
      <a href="coupon_list.php">&#43;Voucher List</a>
			<a href="A_member_list.php">&#128221; Customer List</a>
      <a href="checkout_list.php"><i class="fa fa-folder-open-o" style="font-size:20px"></i>C_Checkout List</a>
			<a href="A_logout.php">&#128682; Log Out </a>
      
    </li>
			</ul>
                </ul>
                </ul>
            </div>
        </div>
    </header>
	
	   <script>
        // JavaScript to toggle the menu on small screens
        function toggleMenu() {
            const menuList = document.querySelector('.shopname ul');
            menuList.classList.toggle('show');
        }
    </script>
	</body>
</html>