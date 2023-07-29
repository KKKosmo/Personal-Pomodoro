<!-- adds time to major rests after finished with major rest -->
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
            $variable = round($_GET['variable'] / 60, 2);

            $query = "UPDATE `main` SET `majRest` = majRest + '$variable' WHERE `main`.`thedate` = '$thedate'";
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