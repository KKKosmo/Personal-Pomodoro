<!-- dashboard categorized in months -->
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
    <title>year</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <style>
        body{
            background-color: #C25E58;
        }
        
        .grid-container {
            display: grid;
            grid-template-columns: auto auto auto auto auto auto;
            row-gap: 90px;
            column-gap: 20px;
            padding: 10px;
            margin-left: auto;
            margin-right: auto;
            width: 98%;
            justify-items: center;
            align-items: center;
        }
        .month {
            background-color: rgba(255, 255, 255, 0.8);
            border: 2px solid rgba(0, 0, 0, 0.8);
            font-size: 30px;
            text-align: center;
            width: 95%; 
            height: 310px;
            margin-top: 20px;
            margin-bottom: 20px;
            padding: 0;
        }
        .monthHeader{
            background-color: rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(0, 0, 0, 0.8);
            background-color: #32C61A;
            height: 34%;
        }
        .monthStudy{
            background-color: rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(0, 0, 0, 0.8);
            background-color:  #FF6C6C;
            height: 33%;
        }
        .monthRest{
            background-color: rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(0, 0, 0, 0.8);
            background-color: #AEAEAE;
            height: 33%;
        }
    </style>
    <script>

        // template for months
        DivObject = function(_header, _study, _rest, _id){
            var wrapper = document.createElement("button");
            wrapper.onclick = function(){
                <?php $variable = $_GET['variable']; ?>
                window.location.href = ('month.php?variable=<?php echo $variable ?>' + _header);
            };
            document.getElementById("myCont").appendChild(wrapper) ;
            wrapper.className = "month";
            wrapper.id = _id;

            var header = document.createElement("div");
            wrapper.appendChild(header) ;
            header.className = "monthHeader";
            var headerText = document.createTextNode(_header);
            header.append(headerText);
            
            var study = document.createElement("div");
            wrapper.appendChild(study) ;
            study.className = "monthStudy";

            studyText = document.createTextNode("Study: " + _study); 
            study.append(studyText);

            var rest = document.createElement("div");
            wrapper.appendChild(rest) ;
            rest.className = "monthRest";

            var restText = document.createTextNode("Rest: " + _rest);

            rest.append(restText);
        }

        //make 12 months, and sort the data by month
        spawnMonths = function(){
            
            <?php
                for ($x = 0; $x < 12; $x++) {
                    
                    $variable = $_GET['variable'];
                    $query = "SELECT SUM(study) AS study, SUM(majRest + minRest) AS rest FROM main WHERE MONTH(thedate) = ($x + 1) AND YEAR(thedate) = $variable";

                    $result = $mysqli->query($query);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {

                            if(is_null($row["study"])){
                                $row["study"] = 0;
                            }
                            if(is_null($row["rest"])){
                                    $row["rest"] = 0;
                                }
                            ?> 
                            
                                switch(<?php echo $x ?>){
                                    case 0:
                                        new DivObject("Jaunuary", '<?php echo (number_format($row["study"], 2))?> minutes', '<?php echo (number_format($row["rest"], 2))?> minutes', <?php echo $x ?>);
                                        break;
                                    case 1:
                                        new DivObject("February", '<?php echo (number_format($row["study"], 2))?> minutes', '<?php echo (number_format($row["rest"], 2))?> minutes', <?php echo $x ?>);
                                        break;
                                    case 2:
                                        new DivObject("March", '<?php echo (number_format($row["study"], 2))?> minutes', '<?php echo (number_format($row["rest"], 2))?> minutes', <?php echo $x ?>);
                                        break;
                                    case 3:
                                        new DivObject("April", '<?php echo (number_format($row["study"], 2))?> minutes', '<?php echo (number_format($row["rest"], 2))?> minutes', <?php echo $x ?>);
                                        break;
                                    case 4:
                                        new DivObject("May", '<?php echo (number_format($row["study"], 2))?> minutes', '<?php echo (number_format($row["rest"], 2))?> minutes', <?php echo $x ?>);
                                        break;
                                    case 5:
                                        new DivObject("June", '<?php echo (number_format($row["study"], 2))?> minutes', '<?php echo (number_format($row["rest"], 2))?> minutes', <?php echo $x ?>);
                                        break;
                                    case 6:
                                        new DivObject("July", '<?php echo (number_format($row["study"], 2))?> minutes', '<?php echo (number_format($row["rest"], 2))?> minutes', <?php echo $x ?>);
                                        break;
                                    case 7:
                                        new DivObject("August", '<?php echo (number_format($row["study"], 2))?> minutes', '<?php echo (number_format($row["rest"], 2))?> minutes', <?php echo $x ?>);
                                        break;
                                    case 8:
                                        new DivObject("September", '<?php echo (number_format($row["study"], 2))?> minutes', '<?php echo (number_format($row["rest"], 2))?> minutes', <?php echo $x ?>);
                                        break;
                                    case 9:
                                        new DivObject("October", '<?php echo (number_format($row["study"], 2))?> minutes', '<?php echo (number_format($row["rest"], 2))?> minutes', <?php echo $x ?>);
                                        break;
                                    case 10:
                                        new DivObject("November", '<?php echo (number_format($row["study"], 2))?> minutes', '<?php echo (number_format($row["rest"], 2))?> minutes', <?php echo $x ?>);
                                        break;
                                    case 11:
                                        new DivObject("December", '<?php echo (number_format($row["study"], 2))?> minutes', '<?php echo (number_format($row["rest"], 2))?> minutes', <?php echo $x ?>);
                                        break;
                                }
                            <?php
                        }
                    }


                }
            ?>

        }
    </script>
</head>
<body onLoad = "spawnMonths();">
    <div class="page-header" id="dash" style="background-color: #840000; width: 100%; position: fixed; top: 0;">
        <button onclick="location.href='dashboard.php'" class="btn dashbutton" style="font-size: 3rem; background-color:transparent; color: black; width: 100%;">VIEWING
        <?php 
            echo $variable;
        ?>
        - GO TO DASHBOARD MENU</button>
    </div>
    <div style="text-align: center; margin-top: 20px; font-size: 30px; color:white">
        2023
    </div>
    <div class="grid-container" id="myCont">
        <!-- months go here -->
    </div>
    <footer>
        <button onclick="location.href='timer.php'" class="btn" style="position: fixed; bottom: 0px; font-size: 2rem; background-color: RGB(255, 191, 1); color: black;  height: 50px;">GO TO TIMER</button>
    </footer>
</body>
</html>