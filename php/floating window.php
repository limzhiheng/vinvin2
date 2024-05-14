<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Image Hover Example</title>
</head>
<style>
    .image-container {
    position: relative;
    display: inline-block;
}

.hover-image {
    display: none;
    position: absolute;
    top: 0;
    left: 0;
}

.image-container:hover .hover-image {
    display: block;
}

.image-container:hover .default-image {
    display: none;
}

</style>
<body>

<?php
// Set the default image and hover image paths
$image1 = '../img/fb.png';
$image2 = '../img/ins.jpeg';
?>

<div class="image-container">
    <img src="<?php echo $image1; ?>" alt="Image 1" class="default-image" />
    <img src="<?php echo $image2; ?>" alt="Image 2" class="hover-image" />
</div>

</body>
</html>
