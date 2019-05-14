<!DOCTYPE html>
<html class="no-js" lang="en">
<head>

    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <title>Attendance</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- mobile specific metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/vendor.css">
    <link rel="stylesheet" href="css/main.css">

    <style type="text/css" media="screen">
        .s-styles { 
            padding-top: 18rem;
            padding-bottom: 15rem;
        }
    </style>

    <!-- script
    ================================================== -->
    <script src="js/modernizr.js"></script>

    <!-- favicons
    ================================================== -->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

</head>


<body id="top">
    
    <!-- preloader
    ================================================== -->
    <div id="preloader">
        <div id="loader" class="dots-jump">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

    <!-- header
    ================================================== -->
    <header class="s-header">
            <br>
            <br>
            <div class="header-logo">
                    <a class="site-logo" href="index.php">
                        <img src="images/logohome.png"  style="width:500px;height:130px;" alt="Homepage">
                    </a>
            </div> <!-- end header-logo -->

            <div style="margin-left:1200px;">
            <?php
                $studentid = isset($_GET['id']) ? $_GET['id'] : '';
                
            ?>
            
            <ul class="nav">
            <li>
                <a><b>
                    <i class="icon-user icon-white"></i>
                    <?php 
                    if($studentid != null)
                    {
                        echo $studentid;
                    }
                    else{
                        echo "Please sign with your userid";
                    }
                    ?>
                </a></b>
            </li>
                
            </ul>
            </div>
            


        <nav class="header-nav">

            <a href="#0" class="header-nav__close" title="close"><span>Close</span></a>

            <h3>Navigate to</h3>

            <div class="header-nav__content">
                
                <ul class="header-nav__list">
                    <li><a class="smoothscroll"  href="#missed" title="GO TO Missed Lectures">Last missed lectures</a></li>
                    <li><a class="smoothscroll"  href="#objection" title="GO TO Objection Form">Objection Form</a></li>
                </ul>
            </div> <!-- end header-nav__content -->

        </nav> <!-- end header-nav -->

        <a class="header-menu-toggle" href="#0">
            <span class="header-menu-icon"></span>
        </a>

    </header> <!-- end s-header -->

    <br>
    <br>
    <br>


    <!-- <div class="col-six tab-full">
        <h3>Attendance Progress</h3>
        <h5>This section shows how much attendance you've covered so far.</h5>
        <mark>red indicates failed threshold for attendance</mark>
        <ul class="skill-bars">
             


            <li>
            <div class="progress percent90"><span>90%</span></div>
            <strong>MAT 120</strong>
            </li>
            <li>
            <div class="progress percent85"><span>85%</span></div>
            <strong>EEE 281</strong>
            </li>
            <li>
            <div class="progress percent70"><span>70%</span></div>
            <strong>CNG 213</strong>
            </li>
            <li>
            <div class="progress percent95"><span>95%</span></div>
            <strong>CNG 223</strong>
            </li>
            <li>
            <div class="progress percent35"><span>35%</span></div>
            <strong><mark>ENGL 211</mark></strong>
            </li>
        </ul>

    </div> -->

</div> <!-- end row -->


    <div class="col-six tab-full">

        <div class="col-twelve">

                <h3>Stats Tabs</h3>
                <h4>Missed Hours</h4>

            <ul class="stats-tabs">
                <li>
                    <?php
                        $servername = "127.0.0.1:3307";
                        $username = "root";
                        $password = "";
                        $dbname = "attendance";

                        // Create connection
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        } 

                        $sql = "select count(present) as 'missedHours',course.name as cid from attendance,class,course where attendance.present=0 and attendance.student=$studentid and attendance.class=class.id and class.course = course.id;";
                        $result = $conn->query($sql);

                        
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $field1name = $row["missedHours"];
                                $field2name = $row["cid"];
                                $missedHours=$field1name;
                                echo '<ul> 
                                        <a>'.$field1name.'</a> 
                                        <em>'.$field2name.'</em>
                                    </ul>';
                            }
                            $result->free();
                        } 

                        $conn->close();
                    ?>





                <!-- select count(present) as "missedHours",class.course from attendance,class where attendance.present=0 and attendance.student=102 and attendance.class=class.id; -->

                </li>
            </ul>

            <h4>Remaining Hours/Percentage</h4>

            <ul class="stats-tabs">
                <li>
                    <?php
                            $servername = "127.0.0.1:3307";
                            $username = "root";
                            $password = "";
                            $dbname = "attendance";

                            // Create connection
                            $conn = new mysqli($servername, $username, $password, $dbname);
                            // Check connection
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            } 

                            $sql = "select course.name as cid,count(class.period)*14 as totalHour from attendance,class,course where attendance.student=101 and attendance.class=class.id and class.course = course.id;";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $field1name = $row["cid"];
                                    $field2name = $row["totalHour"];
                                    $leftHour = $field2name - $missedHours;

                                    $perc = ($leftHour-$missedHours) / $leftHour *100;
                                    echo '<ul> 
                                            <em>'.$field1name.'</em> 
                                            <a>'.$leftHour.'</a>
                                            <a> / </a>
                                            <a>    % '.round($perc).'</a> 
                                            

                                        </ul>';
                                }
                                $result->free();
                            } 

                            $conn->close();
                        ?>
                        


                <!-- <a style="color: rgb(0,255,0)">10<em>MAT 120</em></a>
                <a style="color: rgb(0,255,0)">9<em>EEE 281</em></a>
                <a style="color: rgb(0,255,0)">7<em>CNG 213</em></a>
                <a style="color: rgb(0,255,0)">10<em>CNG 223</em></a>
                <a style="color: rgb(255,0,0)">0<em>ENGL 211</em></a> -->
            </li>
            </ul>



            
        </div>
    </div> <!-- end row -->


    <div class="row add-bottom">

            <div class="col-twelve" id="missed">

                <h3>Last missed lectures</h3>
                <p>Displays the last 7 days.</p>

                <div class="table-responsive">

                    <table>


                        <?php
                            $servername = "127.0.0.1:3307";
                            $username = "root";
                            $password = "";
                            $dbname = "attendance";

                            

                            // Create connection
                            $conn = new mysqli($servername, $username, $password, $dbname);
                            // Check connection
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            } 

                            $sql = "SELECT student.id,student.name AS sname ,student.surname,course.name AS cname,period.start,classroom.name, class.id AS classid FROM attendance, student, class, period, course, classroom WHERE attendance.student=student.id AND attendance.class = class.id AND attendance.present=0 AND class.course = course.id AND class.period = period.id AND class.classroom = classroom.id AND student.id = $studentid;";

                            $result = $conn->query($sql);


                            echo '<table border="0" cellspacing="2" cellpadding="2"> 
                                <tr> 
                                    <th>Course Name</th>
                                    <th>Course Time</th>
                                    <th>Course Location</th>
                                </tr>';
                            $imageVariable='images/newface.jpg';
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {

                                    $copy = [];

                                    foreach ($row as $index){
                                        array_push($copy,$index);
                                    }
                                    $field1name = $copy[0]; // Student id
                                    $field2name = $copy[1]; // Student name
                                    $field3name = $copy[2]; // Student surname
                                    $field4name = $copy[3]; // Course name
                                    $field5name = $copy[4]; // Course period
                                    $field6name = $copy[5]; // Classroom name
                                    $field7name = $copy[6]; // Class id

                                    


                                    echo '<tr> 
                                            <td>'.$field4name.'</td>
                                            <td>'.$field5name.'</td> 
                                            <td>'.$field6name.'</td>
                                            <td>
                                            <input id="120" value="Respond!" onclick="moveNumbers(\''.$field1name.'\',\''.$field4name.'\',\''.$field5name.'\',\''.$field7name.'\')" type="button" class="btn btn--primary full-width">
                                            </td>

                                        </tr>';
                                }
                                $result->free();
                            } 

                            $conn->close();
                    ?>

                    </table>

                </div>

            </div>
            
        </div> <!-- end row -->



  
    <!-- styles
    ================================================== -->
    <section id="styles" class="s-styles">
        
        <div class="row">

            <div class="center" href="#objection" id="objection">

                <h3>Objection Form</h3>




                    <form action="sendobjection.php" method="post" enctype="multipart/form-data">
                        <div class="full-width">
                            <label for="sampleInput">Student ID</label>
                            <input type="text" id="sid" name="sid" readonly style="width:200px;">
                        </div>
                            
                        <div class="full-width" style="left:190px;">
                            <label for="sampleRecipientInput">Course you're objecting</label>
                            <input type="text" id="courseCode" name="codeInput" readonly style="width:200px;">
                        </div>

                        <div class="full-width" style="left: 725px;">
                            <label for="timeInput">Course Time</label>
                            <input type="text" id="courseTime" name="timeInput" readonly style="width:200px;">
                        </div>   

                        <div class="full-width" style="left: 725px;">
                            <label for="timeInput">Class ID</label>
                            <input type="text" id="classidvar" name="cid" readonly style="width:200px;">
                        </div>                            
                        
                        
                        <textarea required class="full-width" placeholder="Please indicate your response details here." id="exampleMessage"></textarea>



                        <button type="submit" name="submit">Submit</button>
                        
                </form> 

            </div>
        </div> <!-- end row -->

        <div class="home-content__scroll">
                <a href="#objection" class="scroll-link smoothscroll">
                    Scroll to the objection form
                </a>
        </div>

    </section> <!-- end styles -->

    <!-- footer
    ================================================== -->
    <footer>
        <div class="row">
            <div class="col-full ss-copyright">
                <span>© Copyright ODTUclass 2019</span>
            </div>
        </div>

        <div class="ss-go-top">
            <a class="smoothscroll" title="Back to Top" href="#top">Back to Top</a>
        </div>
    </footer>


    <!-- photoswipe background
    ================================================== -->
    <div aria-hidden="true" class="pswp" role="dialog" tabindex="-1">

        <div class="pswp__bg"></div>
        <div class="pswp__scroll-wrap">

            <div class="pswp__container">
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
            </div>

            <div class="pswp__ui pswp__ui--hidden">
                <div class="pswp__top-bar">
                    <div class="pswp__counter"></div><button class="pswp__button pswp__button--close" title="Close (Esc)"></button> <button class="pswp__button pswp__button--share" title=
                    "Share"></button> <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button> <button class="pswp__button pswp__button--zoom" title=
                    "Zoom in/out"></button>
                    <div class="pswp__preloader">
                        <div class="pswp__preloader__icn">
                            <div class="pswp__preloader__cut">
                                <div class="pswp__preloader__donut"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                    <div class="pswp__share-tooltip"></div>
                </div><button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button> <button class="pswp__button pswp__button--arrow--right" title=
                "Next (arrow right)"></button>
                <div class="pswp__caption">
                    <div class="pswp__caption__center"></div>
                </div>
            </div>

        </div>

    </div> <!-- end photoSwipe background -->


    <!-- Java Script
    ================================================== -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>

    <script>
       // var btnSelam=document.getElementById("120");
	btnSelam.onclick=function moveNumbers(value){
		window.alert(value);
        document.getElementsByName('sampleRecipientInput')[0].placeholder='new text for email';
	}
    </script>

<script>
       function moveNumbers(studentvar,course,timevar,classidvar,facevar) {
        var input = document.getElementById ("sid");
        input.value = studentvar;
        
        var input = document.getElementById ("courseCode");
        input.value = course;

        var input = document.getElementById ("courseTime");
        input.value = timevar;

        var input = document.getElementById ("classidvar");
        input.value = classidvar;

}
    </script>

</body>