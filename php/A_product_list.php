<?php
include ('connection.php');

// Set the number of records to display per page
$recordsPerPage = 10;

// Get the current page number from the URL parameter
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$startFrom = ($page - 1) * $recordsPerPage;

// Fetch records from the database with LIMIT clause
$result = mysqli_query($condb, "SELECT * FROM products LIMIT $startFrom, $recordsPerPage");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Zeta Shop - Members List(Staff)</title>
    <link rel="stylesheet" href="../css/s_memberlist.css">
    <link href="../css/c_main.css" rel="stylesheet" />
    <?php include 'A_header.php'; ?>
</head>

<style>
    table, tr, td {
        border: 1px solid black;
    }
</style>
<body>

    <center><h1>Admin List</h1></center>
    <div class='box'>
        <br><br>
        <table>
            <tr>
                <center><td>ID.</td></center>
                <td>Product_name</td>
                <td>Price</td>
                <td>image</td>
                <td>Edit</td>
                <td>Delete</td>
            </tr>
            <?php
            $i = 0;
            while ($row = mysqli_fetch_array($result)) {
                ?>
                <tr>
                    <td><?php echo $row["id"]; ?></td>
                    <td><?php echo $row["name"]; ?></td>
                    <td><?php echo $row["price"]; ?></td>
                    <td><?php echo $row["image"]; ?></td>
                    <td><a href="A_edit_product.php?no=<?php echo $row["id"]; ?>">Edit Product</a></td>
                    <td><a href="A_deleteProduct.php?no=<?php echo $row["id"]; ?>">Delete Product</a></td>
                </tr>
                <?php
                $i++;
            }
            ?>
        </table>
        <br>
        <?php
        // Display "Load More" button if there are more records
        $nextPage = $page + 1;
        $sqlCount = "SELECT COUNT(id) as total FROM products";
        $resultCount = mysqli_query($condb, $sqlCount);
        $rowCount = mysqli_fetch_assoc($resultCount)['total'];

        if ($rowCount > $page * $recordsPerPage) {
            echo '<a class="load-more" href="?page=' . $nextPage . '">Load More</a>';
        }
        ?>
        <br>
        <a class="add" href="test.php">Add Product</a>
    </div>

</body>
</html>
