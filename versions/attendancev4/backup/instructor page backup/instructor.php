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

            <div class="header-logo">
                    <a class="site-logo" href="index.php">
                        <img src="images/logo.svg"  style="width:500px;height:130px;" alt="Homepage">
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
                    <li><a class="smoothscroll"  href="#styles" title="GO TO Respond Form">Respond Form</a></li>
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
        <a>40<em>CNG 140</em></a>
        <a>25<em>CNG 111</em></a>
        <a>29<em>CNG 213</em></a>
        <a>36<em>CNG 223</em></a>
    </li>
    </ul>
</div>
</div> <!-- end row -->

</div> <!-- end row -->


  
<div id="students" class="row add-bottom">


<div class="col-twelve">

    <h3>Students</h3>
    <p>List of students enrolled.</p>

    <div class="table-responsive">

        <table>
                <thead>
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
                </tbody>
        </table>

    </div>

</div>

</div> <!-- end row -->        




    <div id="obj" class="row add-bottom">

            <div class="col-twelve">

                <h3>Objections waiting</h3>
                <p>Objections made by students.</p>

                <div class="table-responsive">

                    <table>
                            <thead>
                            <tr>
                                <th>Student ID</th>
                                <th>Course</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Location</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>e202020</td>
                                <td>MAT 120</td>
                                <td>29.02.2019</td>
                                <td>08.40-09.40</td>
                                <td>TZ-20</td>
                                <td><input id="120" value="Respond!" onclick="moveNumbers('e202020','MAT 120','29.02.2019','08.40-09.40','images/newface.jpg')" type="button" class="btn btn--primary full-width"></td>
                            </tr>
                            <tr>
                                <td>e202080</td>
                                <td>ENGL 211</td>
                                <td>28.02.2019</td>
                                <td>15.40-17.40</td>
                                <td>S-103</td>
                                <td><input id="120" value="Respond!" onclick="moveNumbers('e202080','ENGL 211','28.02.2019','15.40-17.40','images/face.jpg')" type="button" class="btn btn--primary full-width"></td>
                            </tr>
                            </tbody>
                    </table>

                </div>

            </div>
            
        </div> <!-- end row -->



  
    <!-- styles
    ================================================== -->
    <section id="styles" class="s-styles">
        
        <div class="row">

            <div class="center">

                <h3>Respond Form</h3>

                <form>
                        <div>
                            <label for="sampleInput">Student ID</label>
                            <input class="full-width" type="email" placeholder="e202020" id="studentId" readonly style="width:200px;">
                    </div>
                            <div class="full-width" style="position:absolute; left:280px;">
                                <label for="sampleRecipientInput">Course you're objecting</label>
                                <input id="courseCode" type="email" name="codeInput" readonly style="width:200px;">
                            </div>
                            
                            <div class="full-width" style="position:absolute; left:550px;">
                                <label for="dateInput">Course Date</label>
                                <input id="courseDate" type="email" name="dateInput" readonly style="width:200px;">
                            </div>

                            <div class="full-width" style="position:absolute; left: 825px;">
                                <label for="timeInput">Course Time</label>
                                <input id="courseTime" type="email" name="timeInput" readonly style="width:200px;">
                            </div>

                            

                        <br>
                        <br>

                        <div class="col-six tab-full">

                <h3>Class Photo</h3>
                <p><img src="images/face2.jpg" alt=""></p>

            </div>

            <div class="col-six tab-full">

                <h3>Student Photo</h3>
                <p><img id="theImage" src="images/face.jpg" width="200" height="40"></p>

            
                </div>

              

                
                <div class="container">
                    
                    <h2>Is Present ?</h2>
                    
                <ul>
                <li>
                    <input type="radio" id="f-option" name="selector">
                    <label for="f-option">Present</label>
                    
                    <div class="check"></div>
                </li>
                
                <li>
                    <input type="radio" id="s-option" name="selector">
                    <label for="s-option" required>Not Present</label>
                    
                    <div class="check"><div class="inside"></div></div>
                </li>
                </ul>
                </div>

                        <label for="exampleMessage">Message</label>
                        <textarea required class="full-width" placeholder="Please indicate your response details here." id="exampleMessage"></textarea>
                        <input class="btn--primary full-width" type="submit" value="Submit" style="width:400px;">

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
       // var btnSelam=document.getElementById("120");
	btnSelam.onclick=function moveNumbers(value){
		window.alert(value);
        document.getElementsByName('sampleRecipientInput')[0].placeholder='new text for email';
	}
    </script>

<script>
       function moveNumbers(studentid,course,datevar,timevar,facevar) {
        
        var input = document.getElementById ("studentId");
        input.placeholder = studentid;
        
        var input = document.getElementById ("courseCode");
        input.placeholder = course;

        var input = document.getElementById ("courseDate");
        input.placeholder = datevar;

        var input = document.getElementById ("courseTime");
        input.placeholder = timevar;

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