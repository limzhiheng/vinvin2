<?php
$currentDateTime = date('d-m-Y H:i:s');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real-Time Clock</title>
    <script>
        function updateClock() {
            var currentTime = new Date();
            var year = currentTime.getFullYear();
            var month = String(currentTime.getMonth() + 1).padStart(2, '0'); // Adding 1 because months are zero-based
            var day = String(currentTime.getDate()).padStart(2, '0');
            var hours = currentTime.getHours();
            var minutes = currentTime.getMinutes();
            var seconds = currentTime.getSeconds();

            // Add leading zero if the values are less than 10
            hours = (hours < 10) ? "0" + hours : hours;
            minutes = (minutes < 10) ? "0" + minutes : minutes;
            seconds = (seconds < 10) ? "0" + seconds : seconds;

            // Display the updated date and time
            var formattedDateTime = day + ' - ' + month + ' - ' + year + ' ' + hours + ":" + minutes + ":" + seconds;
            document.getElementById('realTime').innerHTML = formattedDateTime;

            // Update every second
            setTimeout(updateClock, 1000);
        }

        // Initial call to start the clock
        window.onload = updateClock;
    </script>
</head>
<body>
    <h3 class="time" id="realTime"><?php echo $currentDateTime; ?></h3>
<style>
    .time{
        color:black;
    }
</style>
</body>
</html>
