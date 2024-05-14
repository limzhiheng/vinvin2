<!DOCTYPE html>
<html lang="en">
<head>
  <title>Promocode apply project In PHP</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Promocode Apply Project In PHP</h2>
 
    <div class="form-group">
      <label for="email">Original Price:</label>
      <input type="text" class="form-control" id="original_price" name="original_price"> <!-- Replace with actual original price -->
    </div>
    <div class="form-group">
      <label for="email">Discounted Price:</label>
      <input type="text" class="form-control" id="discounted_price" name="discounted_price" placeholder="0"> <!-- Replace with actual discounted price -->
    </div>
    <div class="form-group">
      <label for="promo_code">Apply Promocode:</label>
      <input type="text" class="form-control" id="coupon_code" placeholder="Apply Promocode" name="coupon_code">
      <b><span id="message" style="color:green;"></span></b>
    </div>
    
    <button id="apply" class="btn btn-default">Apply</button>
    <button id="edit" class="btn btn-default" style="display:none;">Edit</button>
  
</div>
<script>
    $("#apply").click(function(){
        if($('#coupon_code').val()!=''){
            $.ajax({
                        type: "POST",
                        url: "process.php",
                        data:{
                            coupon_code: $('#coupon_code').val()
                        },
                        success: function(dataResult){
                            var dataResult = JSON.parse(dataResult);
                            if(dataResult.statusCode==200){
                                // Replace these placeholders with your actual logic for original and discounted prices
                                var originalPrice = $('#original_price').val();
                                var discountedPrice = originalPrice - dataResult.value;

                                // Update the displayed values
                                $('#original_price').val(originalPrice);
                                $('#discounted_price').val(discountedPrice);

                                $('#apply').hide();
                                $('#edit').show();
                                $('#message').html("Promocode applied successfully !");
                            }
                            else if(dataResult.statusCode==201){
                                $('#message').html("Invalid promocode !");
                            }
                        }
            });
        }
        else{
            $('#message').html("Promocode can not be blank .Enter a Valid Promocode !");
        }
    });
    $("#edit").click(function(){
        $('#coupon_code').val("");
        $('#apply').show();
        $('#edit').hide();
        location.reload();
    });
</script>
</body>
</html>
