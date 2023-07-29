   <!-- this is responsible for adding the day into the database, ignore the file name. 
        also idk why i forgot why i didnt put this in conn.php-->
   <!DOCTYPE html>
   <html lang="en">
   <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
<?php 
            include 'connect.php';
            date_default_timezone_set('Asia/Hong_Kong');


            $thedate = date("Y-m-d");
            $query = "SELECT * FROM main where thedate = '$thedate'";

            $result = $mysqli->query($query);

            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    // echo "found " . $thedate;
                }
                else{
                    $query = "INSERT INTO `main` (`thedate`, `study`, `majRest`, `minRest`, `comments`) VALUES ('$thedate', '0', '0', '0', '')";
                    $result = $mysqli->query($query);
                }
            }
            else {
                echo 'Error: ' . mysqli_error();
            }
        ?>
    </script>
   </head>
   <body>
        
   </body>
   </html>