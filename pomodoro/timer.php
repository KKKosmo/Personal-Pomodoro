<!-- the main page -->
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
    <title>Timer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <style>
        body{
            background-color: #C25E58;
            text-align: center;
        }


        .dots {
            position: relative;
            display: inline-block;
            width: 100px;
            height: 100px;
            border-radius: 50%;
        }
        .dots.red{
            background: #f00;
        }
        .dots.green{
            background: green;
        }
        .dots.yellow{
            background: #B9AF02;
        }
        .dots.orange{
            background: orange;
        }

        .dots .tooltiptext {
            visibility: hidden;
            width: 120px;
            background-color: black;
            color: rgb(255, 255, 255);
            text-align: center;
            position: absolute;
            z-index: 1;
            left: 0%;
            right: 0%;
        }
        .dots:hover .tooltiptext {
            visibility: visible;
        }
        .controlButtons{
            height: 70px;
        }
        .controlButtons2{
            height: 40px;
        }

    </style>



    <script>
        var red = "#C25E58";
        var orange = "#e28800";
        var green = "#00AA0C";
        var yellow = "#B9AF02";

        var myInterval = -1;
        var isPaused = false;
        var isResting = false;
        var countDownDate = 0;
        var distance = 0
        var studyTime = 25;
        var minorRest = 5;
        var majorRest = 15;
        var autoStudy = false;
        var autoMinorRest = false;
        var autoMajorRest = false;

        var started = false;

        var sRC = 0;

        var afk = false;

        var isSkipped = false;

        var audio = new Audio('bell.mp3');

        var timedOut = false;

        window.onbeforeunload = function () {
            if(!timedOut){
                timeOut();
            }
            return "Do you really want to close?";
        };
        

        function afkfunction(){
            var afkbutton = document.getElementById("afk");
            if(afk){
                afkbutton.className = "border border-dark btn btn-danger controlButtons2";
                afk = false;
            }
            else{
                afkbutton.className = "border border-dark btn btn-info controlButtons2";
                afk = true;
            }
        }

        function dashboard(){
            window.open("dashboard.php");
        }
        function timeIn(){
            window.open("timeIn.php");
        }
        function timeOut(){
            console.log("TIMED OUT");
            timedOut = true;
            window.open("timeOut.php");
        }
        




        function start(){
            showHideSkip();
            if(started){
                if(isSkipped){
                    sRC = 0;
                    isSkipped = false;
                }
                if(currentCirc == 0){
                    console.log(sRC + " ADDED TO MAJREST");
                    window.open("majRest.php?variable=" + sRC);
                    sRC = 0;
                }
                else{
                    console.log(sRC + " ADDED TO MINREST");
                    window.open("minRest.php?variable=" + sRC);
                    sRC = 0;
                }
            }
            else{
                console.log("STARTED");
                started = true;
                let timerWorker = new Worker('worker.js');

                timerWorker.onmessage = function(event) {
                    if(!afk){
                        sRC = sRC + 1;
                    }
                console.log(sRC);
                };
            }

            buttonPause();
            var title = document.getElementById("title");
            var status = document.getElementById("status");
            status.innerHTML = "STUDYING";
            document.body.style.backgroundColor = green;
            var startPause = document.getElementById("startPause");
            startPause.setAttribute( "onClick", "javascript: pause();" );
            changeCircle(circles[currentCirc], "border border-dark dots orange");

            countDownDate = new Date().getTime() + studyTime * 60 * 1000;

            var now = new Date().getTime();
            distance = countDownDate - now;
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            title.innerHTML =  minutes + ":" + seconds;
            myInterval = setInterval(function(){
                if(!isPaused){
                    now = new Date().getTime();
                    distance = countDownDate - now;
                    minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    seconds = Math.floor((distance % (1000 * 60)) / 1000);
                    title.innerHTML =  minutes + ":" + seconds;
                }

                //if timer is done
                if (distance < 0){
                    showHideSkip();
                    clearInterval(myInterval);
                    isResting = true;
                    status.innerHTML = "RESTING";
                    document.body.style.backgroundColor = yellow;
                    document.getElementById("title").innerHTML = "00:00";
                    changeCircle(circles[currentCirc], "border border-dark dots yellow");


                    if(currentCirc < 3){
                        countDownDate = new Date().getTime() + minorRest * 60 * 1000;
                    }
                    else{
                        countDownDate = new Date().getTime() + majorRest * 60 * 1000;
                    }

                    now = new Date().getTime();
                    distance = countDownDate - now;
                    minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    seconds = Math.floor((distance % (1000 * 60)) / 1000);
                    title.innerHTML =  minutes + ":" + seconds;
                    
                    if(autoMajorRest || autoMinorRest){
                        rest();
                    }
                    else{
                        startPause.setAttribute( "onClick", "javascript: rest(countDownDate);" );
                        buttonStart();
                    }
                    audio.play();
                }
            }, 1000);
        }

        //change button appearances
        function buttonStart(){
            var startPause = document.getElementById("startPause");
            startPause.className = "border border-dark btn btn-success controlButtons";
            startPause.innerHTML = "Start";
        }
        //change button appearances
        function buttonPause(){
            var startPause = document.getElementById("startPause");
            startPause.className = "border border-dark btn btn-danger controlButtons";
            startPause.innerHTML = "Pause";
        }

        
        function rest(){
            showHideSkip();
            buttonPause();
            countDownDate = distance + new Date().getTime();
            var startPause = document.getElementById("startPause");
            startPause.setAttribute( "onClick", "javascript: pause();" );
            var title = document.getElementById("title");
            var status = document.getElementById("status");
            if(isSkipped){
                sRC = 0;
                isSkipped = false;
            }
            console.log(sRC + " ADDED TO STUDY");
            window.open("study.php?variable=" + sRC);
            sRC = 0;
            myInterval = setInterval(function(){
                if(!isPaused){
                    now = new Date().getTime();
                    distance = countDownDate - now;
                    minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    seconds = Math.floor((distance % (1000 * 60)) / 1000);
                    title.innerHTML =  minutes + ":" + seconds;
                }

                if(distance < 0){
                    showHideSkip();
                    if(currentCirc < 3){
                        changeCircle(circles[currentCirc], "border border-dark dots green");
                        currentCirc++;
                    }
                    else{
                        for(let i = 0; i < 4; i++){
                            changeCircle(circles[i], "border border-dark dots red")
                        }
                        currentCirc = 0;
                    }
                    document.getElementById("title").innerHTML = "00:00";
                    stop();
                    isResting = false;
                    
                    status.innerHTML = "HELLO";
                    document.body.style.backgroundColor = red;
                    startPause.setAttribute("onClick", "javascript: start();");
                    audio.play();
                    if(autoStudy){
                        start();
                    }
                }
            }, 1000);
        }

        function pause(){
            var status = document.getElementById("status");
            if(!isPaused){
                isPaused = true;
                afk = true;
                buttonStart();
                if(isResting){
                    status.innerHTML = "RESTING - PAUSED";
                }
                else{
                    status.innerHTML = "STUDYING - PAUSED";
                }
                document.body.style.backgroundColor = orange;
            }
            else{
            //to preserve the remaining time, add the current time again to make it seem like it never stopped, cause the timer is based on Date().getTime()
                countDownDate = distance + new Date().getTime();
                isPaused = false;
                afk = false;
                buttonPause();
                if(isResting){
                    status.innerHTML = "RESTING";
                    document.body.style.backgroundColor = yellow;
                }
                else{
                    status.innerHTML = "STUDYING";
                    document.body.style.backgroundColor = green;
                }
            }
        }

        function stop(){
            buttonStart();
            clearInterval(myInterval);
            myInterval = -1;
        }

        function skip(){
            if(countDownDate <= 0){
                if(isResting){
                    rest();
                }
                else{
                    start();
                }
            }
            
            isSkipped = true;
            countDownDate = -1;
            sRC = 0;
        }

        function changeCircle(circle, result){
            document.getElementById(circle.id).className = result;
        }


        //for toggling auto major rests
        function major(){
            var autobutton = document.getElementById("autoMajor");
            if(autoMajorRest){
                autobutton.className = "border border-dark btn btn-danger controlButtons2";
                autoMajorRest = false;
            }
            else{
                autobutton.className = "border border-dark btn btn-info controlButtons2";
                autoMajorRest = true;
            }
        }
        //for toggling auto minor rests
        function minor(){
            
            var autobutton = document.getElementById("autoMinor");
            if(autoMinorRest){
                autobutton.className = "border border-dark btn btn-danger controlButtons2";
                autoMinorRest = false;
            }
            else{
                autobutton.className = "border border-dark btn btn-info controlButtons2";
                autoMinorRest = true;
            }
        }
        function autoresume(){
            var autobutton = document.getElementById("autoResume");
            if(autoStudy){
                autobutton.className = "border border-dark btn btn-danger controlButtons2";
                autoStudy = false;
            }
            else{
                autobutton.className = "border border-dark btn btn-info controlButtons2";
                autoStudy = true;
            }
        }
        function showHideSkip(){   
            var x = document.getElementById("skip");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
    </script>
</head>
<body>
    <div class="page-header" style="background-color: #840000;">
        <button onclick = "dashboard()" class="btn" style="color:black; width: 100%; font-size: 3rem; background-color:transparent">GO TO DASHBOARD</button>
    </div>
    <h1 id="status" style="position:relative; top:40px; font-size: 5rem; color: white">
        HELLO
    </h1>
    <h1 id="title" style="position:relative; top:40px; font-size: 5rem; color: white">
        00:00
    </h1>
    <div style="position:relative; top:130px;">
        <div id="circle1" class="border border-dark dots red">
        </div>
        <div id="circle2" class="border border-dark dots red">
        </div>
        <div id="circle3" class="border border-dark dots red">
        </div>
        <div id="circle4" class="border border-dark dots red">
        </div>
    </div>
    <script>
        var currentCirc = 0;
        const circles = [];
        class cirlce{
            constructor(div, phase, id){
                this.div = div;
                this.id = id;
                this.phase = phase;
            }
        }
        for(let i = 0; i < 4; i++){
            circles[i] = new cirlce(document.getElementById("circle" + (i + 1)), 0, "circle" + (i + 1));
        }
        

    </script>
    <div class="d-grid gap-3" style="position:relative; top:240px; padding-left: 30%; padding-right: 30%">
        <button type="button" onclick="start()" id="startPause" class="border border-dark btn btn-success controlButtons">Resume</button>
        <button type="button" onclick="skip()" id="skip" class="border border-dark btn btn-warning controlButtons" style="display: none;">Skip</button>
    </div>
    <div style="position: fixed; right: 0px;">
        <button type="button" onclick="timeIn()" id="startPause" class="border border-dark btn btn-success controlButtons">Time In</button>
        <button type="button" onclick="timeOut()" id="startPause" class="border border-dark btn btn-success controlButtons">Time Out</button>
    </div>

    <div class="d-grid gap-1" style="position: fixed; bottom: 0; right: 0;">
        <button type="button" onclick="afkfunction()" id="afk" class="border border-dark btn btn-danger controlButtons2">AFK</button>
        <button type="button" onclick="minor()" id="autoMinor" class="border border-dark btn btn-danger controlButtons2">Auto 5 Min Rest</button>
        <button type="button" onclick="major()" id="autoMajor" class="border border-dark btn btn-danger controlButtons2">Auto 15 Min Rest</button>
        <button type="button" onclick="autoresume()" id="autoResume" class="border border-dark btn btn-danger controlButtons2">Auto Resume</button>
        
    </div>
</body>
</html>