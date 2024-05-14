<?php
    include('connection.php');
        $id = "";
            $name = "";
                $price = "";
                    $image = "";
                        $category = "";
                            $details = "";
                                $row = isset($_GET['no']) ? $_GET['no'] : '';
                                    $message = "";

                                if (isset($_POST['submit'])) {
                            $category = mysqli_real_escape_string($condb, $_POST['category']);
                        $name = mysqli_real_escape_string($condb, $_POST['name']);
                    $price = mysqli_real_escape_string($condb, $_POST['price']);
                $details = mysqli_real_escape_string($condb, $_POST['details']);

            // Validation
            if (!preg_match('/^[1-4]$/', $category)) {
        $message = "Invalid category. Please enter a number between 1 to 4.";
    } elseif (!preg_match('/^[a-zA-Z0-9\s\p{P}]{1,}$/', $name)) {
$message = "Invalid name. Please enter up to 100 characters, alphanumeric and spaces only.";
    } else {
        // Check if a new file is uploaded
        if (isset($_FILES['upload']) && $_FILES['upload']['error'] == 0 && $_FILES['upload']['size'] > 0) {
            // Move the uploaded file to a designated directory
                $uploadsDirectory = "uploads/";
                    $targetFile = $uploadsDirectory . basename($_FILES["upload"]["name"]);

                        if (move_uploaded_file($_FILES["upload"]["tmp_name"], $targetFile)) {
                            // Use a prepared statement to update data
                                $stmt = $condb->prepare("UPDATE products SET category=?, name=?, price=?, image=?, details=? WHERE id=?");

                            if ($stmt) {
                        // Update the image field in the database
                    mysqli_stmt_bind_param($stmt, "ssdssi", $category, $name, $price, $targetFile, $details, $row);
                $updateResult = mysqli_stmt_execute($stmt);

            if ($updateResult) {
        $message = "Product Modified Successfully";
    } else {
$message = "Error modifying product: " . mysqli_stmt_error($stmt);
    }

        mysqli_stmt_close($stmt);
            } else {
                $message = "Error preparing update: " . mysqli_error($condb);
                    }
                        } else {
                            $message = "Error moving uploaded file.";
                             }
                                } else {
                            // No new file uploaded, update data without modifying the image field
                        $stmt = $condb->prepare("UPDATE products SET category=?, name=?, price=?, details=? WHERE id=?");

                    if ($stmt) {
                mysqli_stmt_bind_param($stmt, "ssdsi", $category, $name, $price, $details, $row);
            $updateResult = mysqli_stmt_execute($stmt);

        if ($updateResult) {
    $message = "Product Modified Successfully";
} else {
    $message = "Error modifying product: " . mysqli_stmt_error($stmt);
        }
            mysqli_stmt_close($stmt);
                } else {
                    $message = "Error preparing update: " . mysqli_error($condb);
                        }
                    }
                }
            }
        // Fetch product data from the database
    $sql = "SELECT * FROM products WHERE id = $row";
$result = mysqli_query($condb, $sql);
    if ($result) {
        $data = mysqli_fetch_array($result);
            } else {
                $message = "Error fetching data: " . mysqli_error($condb);
                    }
                ?>
            <html>
        <head>
    <title>Edit Product</title>
<link href="../css/A_edit_product.css" rel="stylesheet"/>
    <?php include 'A_header.php'; ?>
        </head>
            <body>
            <form name="frmProduct" method="post" action="A_edit_product.php?no=<?php echo $row; ?>" enctype="multipart/form-data">
                <div><?php if (isset($message)) echo $message; ?></div>

                     <div class='box2'>
                        <h2>Edit Product</h2>
                    Category: <br>
                <input type="text" name="category" class="txtField" value="<?php echo $data['category']; ?>">
            <br>
        Name: <br>
    <input type="text" name="name" class="txtField" value="<?php echo $data['name']; ?>">
<br>
    <br>
        Price: <br>
            <input type="text" name="price" class="txtField" value="<?php echo $data['price']; ?>">
                <br>
                    <br>
                        Details: <br>
                    <input type="text" name="details" class="txtField" value="<?php echo $data['details']; ?>">
                <br>
            <input type="submit" name="submit" value="Submit" class="btn info"><br>
        <a class="back" type="button" href="A_product.php">Back</a>
    </div>
</form>
    </body>
</html>
