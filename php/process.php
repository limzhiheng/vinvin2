<?php
session_start();
include('connection.php');

$coupon_code = isset($_POST['coupon_code']) ? $_POST['coupon_code'] : '';

if (!empty($coupon_code)) {
    $query = mysqli_query($condb, "SELECT * FROM coupon_code WHERE coupon_code='$coupon_code' AND status=1");

    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_array($query);
        echo json_encode(array(
            "statusCode" => 200,
            "value" => $row['value']
        ));
    } else {
        echo json_encode(array("statusCode" => 201));
    }
} else {
    echo json_encode(array("statusCode" => 201, "message" => "Coupon code not provided"));
}
?>
