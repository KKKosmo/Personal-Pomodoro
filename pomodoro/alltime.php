<!-- dashboard categorized in years -->
<!DOCTYPE html>
<?php 
    include 'connect.php';
    include 'yearAdder.php';
    $test = 'testing';
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>alltime</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <style>
        body{
            background-color: #C25E58;
        }

        .year {
            background-color: rgba(255, 255, 255, 0.8);
            border: 5px solid rgba(0, 0, 0, 0.8);
            font-size: 30px;
            text-align: center;
            width: 95%; 
            height: 800px;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .yearHeader{
            background-color: rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(0, 0, 0, 0.8);
            background-color: #32C61A;
            height: 25%;
        }
        .yearStudy{
            background-color: rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(0, 0, 0, 0.8);
            background-color:  #FF6C6C;
            height: 25%;
        }
        .yearRest{
            background-color: rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(0, 0, 0, 0.8);
            background-color: #AEAEAE;
            height: 25%;
        }
        .name{
            position: relative;
            top: 0%;
        }
        .count{
            position: relative;
            top: 50px;
        }
    </style>
    <script type="text/javascript">
        spawnYears = function(){
            <?php
                //get all unique years
                $query = "SELECT DISTINCT YEAR(thedate), SUM(study) AS study, SUM(minRest) AS minRest, SUM(majRest) AS majRest FROM main GROUP BY YEAR(thedate)";
                $result = $mysqli->query($query);

                if ($result) {
                    if (mysqli_num_rows($result) > 0) {
                        //dynamically generate a panel per year
                        while($row = $result->fetch_assoc()) {
                            ?> 
                                var wrapper = document.createElement("button");
                                document.getElementById("myCont").appendChild(wrapper) ;
                                wrapper.className = "year";
                                wrapper.style.padding = "0";
                                wrapper.onclick = function(){
                                    window.location.href = 'year.php?variable=<?php echo $row["YEAR(thedate)"]?>';
                                };

                                var header = document.createElement("div");
                                wrapper.appendChild(header) ;
                                header.className = "yearHeader";
                                var headerText = document.createTextNode(<?php echo $row["YEAR(thedate)"]?>);
                                header.append(headerText);
                                
                                var study = document.createElement("div");
                                wrapper.appendChild(study);
                                study.className = "yearStudy";

                                var studyP = document.createElement("p");
                                var studyText = document.createTextNode("Studies");
                                studyP.appendChild(studyText);
                                studyP.className = "name";
                                study.append(studyP);
                                var studyCountP = document.createElement("p");


                                var studyCount = document.createTextNode("<?php echo (number_format($row["study"], 2))?> minutes");
                                studyCountP.appendChild(studyCount);
                                studyCountP.className = "count";
                                study.append(studyCountP);

                                var minRest = document.createElement("div");
                                wrapper.appendChild(minRest) ;
                                minRest.className = "yearRest";
                                var minRestP = document.createElement("p");
                                var restText = document.createTextNode("5 Minute Rests");
                                minRestP.appendChild(restText);
                                minRestP.className = "name";
                                minRest.append(minRestP);
                                var restCountP = document.createElement("p");
                                var restCount = document.createTextNode("<?php echo (number_format($row["minRest"], 2))?> minutes");
                                restCountP.appendChild(restCount);
                                restCountP.className = "count";
                                minRest.append(restCountP);

                                var majRest = document.createElement("div");
                                wrapper.appendChild(majRest) ;
                                majRest.className = "yearRest";
                                var majRestP = document.createElement("p");
                                var restText = document.createTextNode("15 Minute Rests");
                                majRestP.appendChild(restText);
                                majRestP.className = "name";
                                majRest.append(majRestP);
                                var restCountP = document.createElement("p");
                                
                                var restCount = document.createTextNode("<?php echo (number_format($row["majRest"], 2))?> minutes ");
                                restCountP.appendChild(restCount);
                                restCountP.className = "count";
                                majRest.append(restCountP);
                            <?php
                        }

                    } else {
                        ?> alert("not found"); <?php

                    }
                } else {
                    echo 'Error: ' . mysqli_error();
                }
            ?>


            

        }
    </script>
</head>
<body onload="spawnYears()">
    <div class="page-header" id="dash" style="background-color: #840000; width: 100%; position: relative;">
        <button onclick="location.href='dashboard.php'" class="btn dashbutton" style="font-size: 3rem; background-color:transparent; color: black; width: 100%;">VIEWING ALLTIME - GO TO DASHBOARD MENU</button>
    </div>
    <center>
        <div id="myCont">
            <!-- dynamically generated panels go here -->
        </div>
    </center>
    <footer>
        <button onclick="location.href='timer.php'" class="btn" style="position: fixed; bottom: 0px; font-size: 2rem; background-color: RGB(255, 191, 1); color: black;  height: 50px;">GO TO TIMER</button>
    </footer>
</body>
</html>