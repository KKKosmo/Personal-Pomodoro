<!-- dashboard categorized in weeks inside a month -->
<!DOCTYPE html>
<?php 
    include 'connect.php';
    include 'yearAdder.php';
    $variable = $_GET['variable'];
    $monthWord = substr($variable, 4);
    $monthNum = date("m", strtotime($monthWord));
    $year = substr($variable, 0, 4);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>month</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <style>
        body{
            background-color: #C25E58;
        }
        .sidepanel{
            background-color: bisque;
            overflow-x: scroll;
            overflow-y: hidden;
            width: 0px;
            height: 80vh;
        }
        .grid-container {
            display: grid;
            grid-template-columns: auto 0px auto 0px auto 0px auto 0px auto 0px;
            row-gap: 90px;
            column-gap: 10px;
            padding: 10px;
            margin-left: auto;
            margin-right: auto;
            width: 98%;
            justify-items: center;
            align-items: center;
            position: relative;
            top: 80px;
        }
        .grid-container2 {
            display: grid;
            grid-template-columns: auto auto auto auto auto auto auto;
            row-gap: 5px;
            column-gap: 10px;
            padding: 10px;
            margin-left: auto;
            margin-right: auto;
            width: 98%;
            justify-items: center;
            align-items: center;
        }
        .week {
            background-color: rgba(255, 255, 255, 0.8);
            border: 2px solid rgba(0, 0, 0, 0.8);
            font-size: 30px;
            text-align: center;
            width: 100%; 
            height: 80vh;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .weekHeader{
            background-color: rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(0, 0, 0, 0.8);
            background-color: #32C61A;
            height: 34%;
        }
        .weekStudy{
            background-color: rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(0, 0, 0, 0.8);
            background-color:  #FF6C6C;
            height: 33%;
        }
        .weekRest{
            background-color: rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(0, 0, 0, 0.8);
            background-color: #AEAEAE;
            height: 33%;
        }
        
        .day {
            background-color: rgba(255, 255, 255, 0.8);
            border: 2px solid rgba(0, 0, 0, 0.8);
            font-size: 30px;
            text-align: center;
            width: 100%; 
            height: 70vh;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .dayHeader{
            background-color: #626262;
            border: 1px solid rgba(0, 0, 0, 0.8);
            height: 20%;
        }
        .dayCount{
            background-color: #D9D9D9;
            border: 1px solid rgba(0, 0, 0, 0.8);
            height: 40%;
        }
        .dayTotal{
            background-color: #D9D9D9;
            border: 1px solid rgba(0, 0, 0, 0.8);
            height: 40%;
        }
        
        p{
            margin:0;
            font-size: 1rem;
        }
        .majorCount{
            position:relative; 
            top: 10px;
        }
    </style>
    <script>
        var currentPanel = -1;
        //template for generating a week
        DivObject = function(_id, _study, _rest){
            var week = document.createElement("button");
            document.getElementById("myCont").appendChild(week);
            week.className = "week";
            week.id = "b" + _id;

            var weekHeader = document.createElement("div");
            weekHeader.id = "weekHeader" + _id;
            week.appendChild(weekHeader);
            weekHeader.className = "weekHeader";

            var tempText = "week " + (_id);
            var headerText = document.createElement('p');
            headerText.innerHTML = tempText;
            weekHeader.appendChild(headerText);

            var weekStudy = document.createElement("div");
            week.appendChild(weekStudy);
            weekStudy.className = "weekStudy";
            studyText = document.createTextNode("Study: "+ _study); 
            weekStudy.append(studyText);

            var weekRest = document.createElement("div");
            week.appendChild(weekRest);
            weekRest.className = "weekRest";
            restText = document.createTextNode("Rest: "+ _rest); 
            weekRest.append(restText);

            var sidepanel = document.createElement("div");
            document.getElementById("myCont").appendChild(sidepanel) ;
            sidepanel.className = "sidepanel";
            sidepanel.id = _id;

            week.onclick = function(){

                if(currentPanel != -1){
                    var temp = document.getElementById(currentPanel).firstChild;
                    temp.click();
                }

                sidepanel.style.width = "100%";
                sidepanel.style.border = "2px solid rgba(0, 0, 0, 0.8)";
                switch(_id){
                    case 1:
                        document.getElementById("myCont").style.gridTemplateColumns = "400px 1400px 600px 0px 600px 0px 600px 0px 600px 0px"
                        document.getElementById("myCont").style.width = "150%";
                        scrollTo(10, 0);
                        break;
                    case 2:
                        document.getElementById("myCont").style.gridTemplateColumns = "600px 0px 400px 1400px 600px 0px 600px 0px 600px 0px"
                        document.getElementById("myCont").style.width = "150%";
                        scrollTo(630, 0);
                        break;
                    case 3:
                        document.getElementById("myCont").style.gridTemplateColumns = "600px 0px 600px 0px 400px 1400px 600px 0px 600px 0px"
                        document.getElementById("myCont").style.width = "150%";
                        scrollTo(1250, 0);
                        break;
                    case 4:
                        document.getElementById("myCont").style.gridTemplateColumns = "600px 0px 600px 0px 600px 0px 400px 1400px 600px 0px"
                        document.getElementById("myCont").style.width = "150%";
                        scrollTo(1870, 0);
                        break;
                    case 5:
                        document.getElementById("myCont").style.gridTemplateColumns = "600px 0px 600px 0px 600px 0px 600px 0px 400px 1400px"
                        document.getElementById("myCont").style.width = "150%";
                        scrollTo(2490, 0);
                        break;
                } 

                var rect = week.getBoundingClientRect();
                currentPanel = sidepanel.id;
            }

            var a = document.createElement('button');
            a.style.backgroundColor = "red";
            a.style.height = "50px";
            a.style.width = "50px";
            sidepanel.appendChild(a);
            a.className = "closebtn";
            a.onclick = function(){
                sidepanel.style.width = "0px";
                sidepanel.style.border = "0px solid rgba(0, 0, 0, 0.8)";
                document.getElementById("myCont").style.gridTemplateColumns = "auto 0px auto 0px auto 0px auto 0px auto 0px";
                document.getElementById("myCont").style.width = "98%";
                currentPanel = -1;
            }

            var grid = document.createElement("div");
            grid.id = ("grid" + _id);
            sidepanel.appendChild(grid) ;
            grid.className = "grid-container2";
        }
        //to give IDs to comment text boxes
        var commentCounter = 0;

        //template for generating a day
        spawnDay = function(_grid, _date, _wordDate, _study, _maj, _min, _comments){
            var day = document.createElement("div");
            _grid.appendChild(day) ;
            day.className = "day";

            var dayHeader = document.createElement("div");
            day.appendChild(dayHeader) ;
            dayHeader.className = "dayHeader";
            var dayHeadertext = document.createTextNode(_date + " - " + _wordDate);
            dayHeader.appendChild(dayHeadertext);

            var dayCount = document.createElement("div");
            day.appendChild(dayCount) ;
            dayCount.className = "dayCount";

            var commentCont = document.createElement("div");
            dayCount.appendChild(commentCont) ;
            commentCont.className = "majorCount";

            var comments = document.createElement("div");
            commentCont.appendChild(comments) ;
            commentCont.id = "comments" + (commentCounter++);
            

            var dayTotal = document.createElement("div");
            day.appendChild(dayTotal) ;
            dayTotal.className = "dayTotal";

            var dayTotalDetails = document.createElement("div");
            dayTotal.appendChild(dayTotalDetails) ;
            dayTotalDetails.style = "position: relative; bottom: 0px;"


            var totalStudyTime = document.createElement("p");
            var totalStudyTimeP = document.createTextNode("Total study time:");
            totalStudyTime.appendChild(totalStudyTimeP);
            totalStudyTime.className = "text-uppercase fw-bold";
            dayTotalDetails.appendChild(totalStudyTime);

            var totalStudyTimeValue = document.createElement("p");
            var totalStudyTimeValueP = document.createTextNode(_study);
            totalStudyTimeValue.appendChild(totalStudyTimeValueP);
            dayTotalDetails.appendChild(totalStudyTimeValue);


            var total5MinRestTime = document.createElement("p");
            var total5MinRestTimeP = document.createTextNode("Total 5 min rest time:");
            total5MinRestTime.appendChild(total5MinRestTimeP);
            total5MinRestTime.className = "text-uppercase fw-bold";
            dayTotalDetails.appendChild(total5MinRestTime);

            var total5MinRestTimeValue = document.createElement("p");
            var total5MinRestTimeValueP = document.createTextNode(_min);
            total5MinRestTimeValue.appendChild(total5MinRestTimeValueP);
            dayTotalDetails.appendChild(total5MinRestTimeValue);


            var total15MinRestTime = document.createElement("p");
            var total15MinRestTimeP = document.createTextNode("Total 15 min rest time:");
            total15MinRestTime.appendChild(total15MinRestTimeP);
            total15MinRestTime.className = "text-uppercase fw-bold";
            dayTotalDetails.appendChild(total15MinRestTime);

            var total15MinRestTimeValue = document.createElement("p");
            var total15MinRestTimeValueP = document.createTextNode(_maj);
            total15MinRestTimeValue.appendChild(total15MinRestTimeValueP);
            dayTotalDetails.appendChild(total15MinRestTimeValue);
        }


        <?php $weeks = array(); ?>


        //dynamically generate the weeks
        spawnWeeks = function(){
                <?php
                    $query = "SELECT DAY(thedate) as thedate, WEEKOFYEAR(thedate) as week, SUM(study) as study, SUM(majRest + minRest) AS rest FROM main WHERE MONTH(thedate) = $monthNum AND YEAR(thedate) = $year GROUP BY WEEKOFYEAR(thedate)";
                    $result = $mysqli->query($query);
                    $xx = 1;
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            array_push($weeks, $row["week"]);

                            if(is_null($row["study"])){
                                $row["study"] = 0;
                            }
                            if(is_null($row["rest"])){
                                $row["rest"] = 0;
                            }
                                
                            ?> 
                                var myDiv = new DivObject(<?php echo $xx ?>, '<?php echo (number_format($row["study"], 2))?> minutes', '<?php echo (number_format($row["rest"], 2))?> minutes', <?php echo $row["thedate"] ?>); 
                            <?php
                            $xx = $xx + 1;
                        }
                    }
                ?>
                displayDays(myDiv);
            }


        //dynamically generate the days
        displayDays = function(_DivObject){
            <?php 
                $z = 0;
                for ($x = 0; $x < count($weeks); $x++){
                    $days = array();
                    ?>
                        var days = "";
                    <?php
                    
                    $query = "SELECT DAY(thedate) as thedate FROM main WHERE MONTH(thedate) = $monthNum AND YEAR(thedate) = $year AND WEEKOFYEAR(thedate) = $weeks[$x]";
                    $result = $mysqli->query($query);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            ?> 
                                days = days.concat(<?php echo $row["thedate"]?> + "<br>");
                            <?php
                                array_push($days, $row["thedate"]);
                        }
                    }
                    ?>
                        var headerText3 = document.createElement('p');
                        headerText3.innerHTML = <?php echo count($days)?> + " Days";
                        document.getElementById("weekHeader<?php echo ($x+1) ?>").appendChild(headerText3);

                        var headerText2 = document.createElement('p');
                        headerText2.innerHTML = days;
                        document.getElementById("weekHeader<?php echo ($x+1) ?>").appendChild(headerText2);

                        <?php 
                            for($i = 0; $i < count($days); $i++){
                                    $query = "SELECT thedate as fulldate, DAY(thedate) as thedate, study, majRest, minRest, comments FROM main WHERE MONTH(thedate) = $monthNum AND YEAR(thedate) = $year AND DAY(thedate) = $days[$i]";
                                    $result = $mysqli->query($query);
                                    if (mysqli_num_rows($result) > 0) {
                                        while($row = mysqli_fetch_assoc($result)) {
                                            $newDate = date("l", strtotime($row["fulldate"]));
                                            ?> 
                                                spawnDay(document.getElementById("grid<?php echo ($x+1) ?>"), <?php echo $row["thedate"] ?>, "<?php echo $newDate ?>", "<?php echo $row["study"]?> minutes"
                                                ,"<?php echo $row["majRest"]?> minutes", "<?php echo $row["minRest"]?> minutes", "<?php echo $row["comments"] ?>");

                                            
                                                const form<?php echo $z?> = document.createElement('form');
                                                form<?php echo $z?>.method = 'post';

                                                const textarea<?php echo $z?> = document.createElement('textarea');
                                                textarea<?php echo $z?>.id = 'txtarea<?php echo $z?>';
                                                textarea<?php echo $z?>.name = 'textarea_name<?php echo $z?>';
                                                textarea<?php echo $z?>.rows = 4;
                                                textarea<?php echo $z?>.value = '<?php echo $row["comments"] ?>';

                                                const submitButton<?php echo $z?> = document.createElement('input');
                                                submitButton<?php echo $z?>.type = 'submit';
                                                submitButton<?php echo $z?>.name = 'submit'+ "<?php echo $z ?>";
                                                submitButton<?php echo $z?>.value = 'Submit';

                                                form<?php echo $z?>.appendChild(textarea<?php echo $z?>);
                                                form<?php echo $z?>.appendChild(document.createElement('br'));
                                                form<?php echo $z?>.appendChild(submitButton<?php echo $z?>);

                                                document.getElementById("comments" + "<?php echo $z ?>").appendChild(form<?php echo $z?>);


                                                <?php
                                                if(isset($_POST['submit' . $z])) {
                                                    $textarea_value = $_POST['textarea_name'.$z];
                                                    $stmt = $mysqli->prepare("UPDATE main SET comments = ? WHERE thedate = ?");
                                                    $stmt->bind_param("ss", $textarea_value, $row["fulldate"]);
                                                    $stmt->execute();

                                                    $stmt = $mysqli->prepare("SELECT comments FROM main WHERE thedate = ?");
                                                    $stmt->bind_param("s", $row["fulldate"]);
                                                    $stmt->execute();
                                                    $stmt->bind_result($row["fulldate"]);
                                                    $stmt->fetch();

                                                    $stmt->close();
                                                    ?> document.getElementById("txtarea<?php echo $z ?>").value = '<?php echo $row["fulldate"] ?>';
                                                    <?php
                                                }
                                            ?>


                                            <?php
                                        }
                                    }
                                    $z++;
                            }
                        ?>
                    <?php
                }
            ?>
        }
    </script>
</head>
<body onLoad = "spawnWeeks();">
    <div class="page-header" id="dash" style="background-color: #840000; width: 100%; position: fixed;">

        <button onclick="location.href='dashboard.php'" class="btn dashbutton" style="font-size: 3rem; background-color:transparent; color: black; width: 100%;">VIEWING
        <?php 
            echo $monthWord." ".$year;
        ?>
         - GO TO DASHBOARD MENU</button>
    </div>
    <div class="grid-container" id="myCont" >
        <!-- weeks go here -->
    </div>
    <footer>
        <button onclick="location.href='timer.php'" class="btn" style="position: fixed; bottom: 0px; font-size: 2rem; background-color: RGB(255, 191, 1); color: black;  height: 50px;">GO TO TIMER</button>
    </footer>
</body>
</html>