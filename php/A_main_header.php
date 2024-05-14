<!DOCTYPE html>
<html>
<head>
</head>
<style>
body{
	margin: 0;
    font-family: Arial, Helvetica, sans-serif;
    transition: margin-left 0.5s;
}
nav {
    width: 200px;
    height: 100%;
    position: fixed;
    background-color: #CCCCFF;
    padding-top: 15px;
    padding-left: 15px;
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
    display: none;
    margin-left: 10px;
}

nav ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
}

nav li {
    margin-bottom: 10px;
}

nav a {
    text-decoration: none;
    color: black;
    display: block;
    padding: 10px;
    border-radius: 5px;
}

nav a:hover {
    background-color: #87CEFA;
}
.menu-icon {
    cursor: pointer;
    font-size: 24px;
    position: fixed;
    margin-left: 10px;
    margin-top: 10px;
    z-index: 2;
}

.content {
    margin-left: 0;
    padding: 15px;
    transition: margin-left 0.5s;
}

.menu-open .content {
    margin-left: 200px;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #CCCCFF;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    z-index: 1;
}

.dropdown:hover .dropdown-content {
    display: block;
}
</style>
<body>
    <div class="menu-icon" onclick="toggleMenu()">&#9776;</div>
<nav>
        <ul>
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropbtn">&#128722;Shop &#x2B07;</a>
                <div class="dropdown-content">
                    <a href="A_main_admin.php">All products</a>
                    <a href="A_productCategory.php?category=1">Man shoes</a>
                    <a href="A_productCategory.php?category=2">Woman shoes</a>
                    <a href="A_productCategory.php?category=3">Kid shoes</a>
                    <a href="A_productCategory.php?category=4">Shoes bag</a>
                </div>
            </li>
            <li><a href="A_addadmin.php">Add new staff</a></li>
            <li><a href="test.php">&#43;Add Product</a></li>
            <li><a href="coupon_list.php">Voucher List</a></li>
            <li><a href="A_addcoupon.php">&#43;Add Voucher</a></li>
            <li><a href="A_admin_list.php">&#128221; Admin List</a></li>
            <li><a href="A_member_list.php">&#128221; Customer List</a></li>
            <li><a href="checkout_list.php">&#10319;C_checkout List &#10488;</a></li>
            <li><a href="A_contact.php">&#128195;Customer feedback</a></li>
            <li><a href="A_logout.php">&#128682; Log Out </a></li>
        </ul>
    </nav>
</body>
<script>
    function toggleMenu() {
        var body = document.body;
        var nav = document.querySelector('nav');
        var content = document.querySelector('.content');

        body.classList.toggle('menu-open');
        nav.style.display = (nav.style.display === 'none' || nav.style.display === '') ? 'block' : 'none';

        // Force a reflow to ensure smooth transition
        content.offsetWidth;
    }
</script>
</html>