<!-- to log when the day started -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
        <?php
            include 'connect.php';
            include 'yearAdder.php';
            $time = date("H:i:s");
            $query = "UPDATE `main` SET `timeStart` = '$time' WHERE `main`.`thedate` = '$thedate'";
            $result = $mysqli->query($query);
            if (!$result) {
                echo "Error: " . $mysqli->error;
            } else {
                echo "<script>window.close();</script>";
            }
        ?>
</head>
<body>
    
</body>
</html>
