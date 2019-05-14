

<!DOCTYPE html>
<html class="no-js" lang="en">
<head>

    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <title>Instructor Attendance Management Page</title>
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
            <br><br>
            <div class="header-logo">
                    <a class="site-logo" href="index.php">
                        <img src="images/logohome.png"  style="width:500px;height:130px;" alt="Homepage">
                    </a>
            </div> <!-- end header-logo -->

            <div style="margin-left:1200px;">
            <ul class="nav">
                  <li><a><b><i class="icon-user icon-white"></i>admin</a></b></li>
            </ul>
            </div>
            


        <nav class="header-nav">

            <a href="#0" class="header-nav__close" title="close"><span>Close</span></a>

            <h3>Navigate to</h3>

            <div class="header-nav__content">
                
                <ul class="header-nav__list">
                    <li><a class="smoothscroll"  href="#students" title="GO TO Students">Students</a></li>
                    <li><a class="smoothscroll"  href="#obj" title="GO TO Waiting Objections">Objections Waiting</a></li>
                    <li><a class="smoothscroll"  href="#respondform" title="GO TO Respond Form">Respond Form</a></li>
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


    <div class="col-six tab-full">
        <h3>Attendance Management</h3>
        <h5>This section shows the details of the students' attendance.</h5>
        <mark>red indicates failed students</mark>
    </div>

    <div class="col-six half-bottom">

    


<div class="col-twelve">

        <h3>Your Course Stats</h3>
        <h4>Total Students</h4>


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

        $sql = "SELECT studentsEnrolled, name FROM course";
        $result = $conn->query($sql);



        // echo '<table border="0" cellspacing="2" cellpadding="2"> 
        //     <tr> 
        //         <th>Student ID</th>
        //         <th>Name</th>
        //     </tr>';
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $field1name = $row["studentsEnrolled"];
                $field2name = $row["name"];
        
                echo '<ul> 
                        <a>'.$field1name.'</a> 
                        <em>'.$field2name.'</em>
                    </ul>';
            }
            $result->free();
        } 

        $conn->close();
        ?>
            <!-- <a>40<em>CNG 140</em></a>
            <a>25<em>CNG 111</em></a>
            <a>29<em>CNG 213</em></a>
            <a>36<em>CNG 223</em></a> -->
        </li>
    </ul>
</div>
</div> <!-- end row -->

</div> <!-- end row -->




  
<div class="row add-bottom">


<div class="col-twelve">


<br>
<br>

    <h3 id="students">Students</h3>
    <p>List of students enrolled.</p>
    <form name="add" method="post">
        <select name="taskOption">
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

            $sql = "SELECT id,name FROM course";
            $result = $conn->query($sql);

            // echo '<table border="0" cellspacing="2" cellpadding="2"> 
            //     <tr> 
            //         <th>Student ID</th>
            //         <th>Name</th>
            //     </tr>';
            
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $field1name = $row["id"];
                    $field2name = $row["name"];

                    echo '
                        <option value='.$field1name.'>'.$field2name.'</option>
                        ';
                }
                $result->free();
            }
            

            $conn->close();
            ?>
            
        </select>
        <input type='submit' value="Choose Course" name='submit'/>
    </form>
    

    

    
    <?php

    $selectOption = $_POST['taskOption'];
    //echo $selectOption;

    //$command = escapeshellcmd('python C:\xampp\htdocs\attendance\videos\folder\test.py');
    //$output = shell_exec('python C:\xampp\htdocs\attendance\videos\folder\test.py');
    //echo "$output"; 
    ?>


<?php
$servername = "127.0.0.1:3307";
$username = "root";
$password = "";
$dbname = "attendance";

$allUploaded=1;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT student.id, student.name, student.surname,student.videoStatus FROM student,enrolled where course=$selectOption and student.id=enrolled.student;";
$result = $conn->query($sql);



echo '<table border="0" cellspacing="2" cellpadding="2"> 
      <tr> 
        <th>Student ID</th>
        <th>Name</th>
        <th>Surname</th>
        <th>Video Status</th>
      </tr>';
 
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $field1name = $row["id"];
        $field2name = $row["name"];
        $field3name = $row["surname"];
        $field4name = $row["videoStatus"];
        
        if($field4name==0){
            //echo $field4name;
            $allUploaded=0;
        }
        echo '<tr> 
                  <td>'.$field1name.'</td> 
                  <td>'.$field2name.'</td> 
                  <td>'.$field3name.'</td>
                  <td>'.$field4name.'</td>
              </tr>';
    }
    $result->free();
} 

$conn->close();
?>


<!-- <td style="color:red;">Not Uploaded</td>
//                         <td>
//                         <a href="#" class="btn btn-info btn-lg">
//                         <span class="glyphicon glyphicon-send"></span> Send Email
//                         </a>
//                     </td> -->

        











    
    

    <div class="table-responsive">

        <table>
                <!-- <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Video Status</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>e201671</td>
                    <td>Alper</td>
                    <td>Calisir</td>
                    <td style="color:red;">Not Uploaded</td>
                    <td><a href="#" class="btn btn-info btn-lg">
                    <span class="glyphicon glyphicon-send"></span> Send Email
                    </a>
                    </td>
                </tr>
                <tr>
                    <td>e202080</td>
                    <td>Some</td>
                    <td>Person</td>
                    <td style="color:green;">Uploaded</td>
                </tr>
                </tbody> -->
        </table>


        <?php
        if($allUploaded==1) { ?>
        <!-- <input id="1010" name="train" value="Start Training" type="button" class="btn btn--primary full-width"> -->
        <form method="post">
            <input type="submit" name="test" id="test" value="Start Training" /><br/>
        </form>
        <?php 
        } else { ?>
        <p>Not all students uploaded his/her videos.</p>
        <?php } ?>

        

                
        <?php

        function testfun()
        {
            //$command = escapeshellcmd('python C:\xampp\htdocs\attendance\videos\folder\test.py');
            $output = shell_exec('python C:\xampp\htdocs\attendance\videos\ok1.py -f C:\xampp\htdocs\attendance\videos\cng492\ -o C:\xampp\htdocs\attendance\videos\cng492dataset');
            echo "All students have been trained."; 
        }

        if(array_key_exists('test',$_POST)){
        testfun();
        }

        ?>








    </div>





</div>

</div> <!-- end row -->        




    <div id="obj" class="row add-bottom">

            <div class="col-twelve">

                <h3>Objections waiting</h3>
                <p>Objections made by students.</p>




                

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

                $sql = "SELECT student.id,student.name AS sname ,student.surname,course.name AS cname,period.start,classroom.name, class.id AS classid FROM objection, student, class, period, course, classroom WHERE objection.student = student.id AND objection.class = class.id AND class.course = course.id AND class.period = period.id AND class.classroom = classroom.id;";
                $result = $conn->query($sql);


                echo '<table border="0" cellspacing="2" cellpadding="2"> 
                    <tr> 
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Course</th>
                        <th>Time</th>
                        <th>Location</th>
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
                                <td>'.$field1name.'</td>
                                <td>'.$field2name.' '.$field3name.'</td>
                                <td>'.$field4name.'</td> 
                                <td>'.$field5name.'</td>
                                <td>'.$field6name.'</td>
                                <td>
                                    <input id="120" value="Respond!" onclick="moveNumbers(\''.$field1name.'\',\''.$field4name.'\',\''.$field5name.'\',\''.$field7name.'\',\''.$imageVariable.'\')" type="button" class="btn btn--primary full-width">
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

            <div class="center">

                <h3 id="respondform">Respond Form</h3>

                <form action="updateattendancequery.php" method="post" enctype="multipart/form-data">
                        <div class="full-width">
                            <label for="sampleInput">Student ID</label>
                            <!-- <input type="text" id="sid" name ="sid" readonly style="width:200px;"> -->
                            <input type="text" id="sid" name="sid" readonly style="width:200px;">
                        </div>
                            
                        <div class="full-width" style="left:190px;">
                            <label for="sampleRecipientInput">Course you're responding</label>
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
                        
                        <h3>Class Photo</h3>
                        <p><img src="images/face2.jpg" alt=""></p>
                        <br>
                        <br>

                        <div class="col-six tab-full">

                

                        </div>
                        

            <div class="col-six tab-full">

                <h3>Student Photo</h3>
                <p><img id="theImage" src="images/face.jpg" width="200" height="40"></p>

            
                </div>

              
                <div class="col-six tab-full">
                    
                    <h2>Is Present ?</h2>
                    
                <ul>
                <li>
                    <input type="radio" name="present" value="1" id="f-option"/>

                    <label for="f-option">Present</label>
                    
                    <div class="check"></div>
                </li>
                
                <li>
                    <input type="radio" name="present" value="0" id="s-option"/>

                    <label for="s-option" required>Not Present</label>
                    
                    <div class="check"><div class="inside"></div></div>
                </li>
                </ul>
                </div>

                
                        <br>
                        
                        <textarea required class="full-width" placeholder="Please indicate your response details here." id="exampleMessage"></textarea>
                        <!-- <input class="btn--primary full-width" onclick="updateAttendanceQuery()" type="submit" value="Submit" style="width:400px;"> -->



                        <button type="submit" name="submit">Submit</button>
                        
                        </form>

                        
                        

            </div>
        </div> <!-- end row -->

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

var count = 1
setTimeout(demo, 500)
setTimeout(demo, 700)
setTimeout(demo, 900)
setTimeout(reset, 2000)

setTimeout(demo, 2500)
setTimeout(demo, 2750)
setTimeout(demo, 3050)


var mousein = false
function demo() {
   if(mousein) return
   document.getElementById('demo' + count++)
      .classList.toggle('hover')
   
}

function demo2() {
   if(mousein) return
   document.getElementById('demo2')
      .classList.toggle('hover')
}

function reset() {
   count = 1
   var hovers = document.querySelectorAll('.hover')
   for(var i = 0; i < hovers.length; i++ ) {
      hovers[i].classList.remove('hover')
   }
}

document.addEventListener('mouseover', function() {
   mousein = true
   reset()
})


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

        document.getElementById("theImage").src=facevar;

        }
    </script>




    <script>

const st = {};

st.flap = document.querySelector('#flap');
st.toggle = document.querySelector('.toggle');

st.choice1 = document.querySelector('#choice1');
st.choice2 = document.querySelector('#choice2');

st.flap.addEventListener('transitionend', () => {

    if (st.choice1.checked) {
        st.toggle.style.transform = 'rotateY(-15deg)';
        setTimeout(() => st.toggle.style.transform = '', 400);
    } else {
        st.toggle.style.transform = 'rotateY(15deg)';
        setTimeout(() => st.toggle.style.transform = '', 400);
    }

})

st.clickHandler = (e) => {

    if (e.target.tagName === 'LABEL') {
        setTimeout(() => {
            st.flap.children[0].textContent = e.target.textContent;
        }, 250);
    }
}

document.addEventListener('DOMContentLoaded', () => {
    st.flap.children[0].textContent = st.choice2.nextElementSibling.textContent;
});

document.addEventListener('click', (e) => st.clickHandler(e));


    </script>




</body>