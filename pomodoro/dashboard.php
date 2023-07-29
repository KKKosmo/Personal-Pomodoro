<!-- main dashboard -->
<!DOCTYPE html>
<?php 
    include 'connect.php';
    include 'yearAdder.php';
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <style>
        .mainButton1{
            position:absolute;
            top:0%;
            bottom:66.66%;
            width: 100%;
            font-size: 150px;
        }
        .mainButton2{
            position:absolute;
            top:33.33%;
            bottom:33.33%;
            width: 100%;
            font-size: 150px;
        }
        .mainButton3{
            position:absolute;
            top:66.66%;
            bottom:0%;
            width: 100%;
            font-size: 150px;
        }
    </style>
</head>
<body style="background-color: black;">

        <button type="button" class="border border-dark btn btn-danger controlButtons mainButton1" onclick="location.href='month.php?variable=<?php echo date('YF');?>'">Month</button>

        <button type="button" class="border border-dark btn btn-danger controlButtons mainButton2" onclick = "location.href='year.php?variable=<?php echo date('Y');?>'">Year</button>
        <button type="button" class="border border-dark btn btn-danger controlButtons mainButton3" onclick = "location.href='alltime.php'">All-Time</button>
    <footer>
        <button onclick="location.href='timer.php'" class="btn" style="position: fixed; bottom: 0px; font-size: 2rem; background-color: RGB(255, 191, 1); color: black;  height: 50px;">GO TO TIMER</button>
    </footer>
</body>
</html>