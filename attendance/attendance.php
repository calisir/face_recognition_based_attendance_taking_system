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

            <div class="header-logo">
                    <a class="site-logo" href="index.html">
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


    <div class="col-six tab-full">
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

    </div>

</div> <!-- end row -->


    <div class="col-six tab-full">

        <div class="col-twelve">

                <h3>Stats Tabs</h3>
                <h4>Missed Hours</h4>

            <ul class="stats-tabs">
                <li>
                <a>4<em>MAT 120</em></a>
                <a>5<em>EEE 281</em></a>
                <a>2<em>CNG 213</em></a>
                <a>3 <em>CNG 223</em></a>
                <a>14 <em>ENGL 211</em></a>
                </li>
            </ul>

            <h4>Remaining Hours</h4>

            <ul class="stats-tabs">
                <li>
                <a style="color: rgb(0,255,0)">10<em>MAT 120</em></a>
                <a style="color: rgb(0,255,0)">9<em>EEE 281</em></a>
                <a style="color: rgb(0,255,0)">7<em>CNG 213</em></a>
                <a style="color: rgb(0,255,0)">10<em>CNG 223</em></a>
                <a style="color: rgb(255,0,0)">0<em>ENGL 211</em></a>
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
                            <thead>
                            <tr>
                                <th>Course</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Location</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>MAT 120</td>
                                <td>29.02.2019</td>
                                <td>08.40-09.40</td>
                                <td>TZ-20</td>
                                <td><input id="120" value="Object!" onclick="moveNumbers('MAT 120','29.02.2019','08.40-09.40')" type="button" class="btn btn--primary full-width"></td>
                            </tr>
                            <tr>
                                <td>ENGL 211</td>
                                <td>28.02.2019</td>
                                <td>15.40-17.40</td>
                                <td>S-103</td>
                                <td><input id="120" value="Object!" onclick="moveNumbers('ENGL 211','28.02.2019','15.40-17.40')" type="button" class="btn btn--primary full-width"></td>
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

            <div class="center" href="#objection" id="objection">

                <h3>Objection Form</h3>

                <form>
                        <div>
                            <label for="sampleInput">Student ID</label>
                            <input class="full-width" type="email" placeholder="e202020" id="sampleInput" readonly style="width:200px;">
                    </div>
                            <div class="full-width" style="position:absolute; left:115px;">
                                <label for="sampleRecipientInput">Course you're objecting</label>
                                <input id="courseCode" type="email" name="codeInput" readonly style="width:200px;">
                            </div>
                            
                            <div class="full-width" style="position:absolute; left:350px;">
                                <label for="dateInput">Course Date</label>
                                <input id="courseDate" type="email" name="dateInput" readonly style="width:200px;">
                            </div>

                            <div class="full-width" style="position:absolute; left: 575px;">
                                <label for="timeInput">Course Time</label>
                                <input id="courseTime" type="email" name="timeInput" readonly style="width:200px;">
                            </div>
                

                        <br>
                        <br>
                        <br>
                        <br>
                        <br>

                        <label for="exampleMessage">Message</label>
                        <textarea required class="full-width" placeholder="Please indicate time,date and reason for you objection." id="exampleMessage"></textarea>
                        <input class="btn--primary full-width" type="submit" value="Submit" style="width:400px;">

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
       function moveNumbers(course,datevar,timevar) {
        var input = document.getElementById ("courseCode");
        input.placeholder = course;

        var input = document.getElementById ("courseDate");
        input.placeholder = datevar;

        var input = document.getElementById ("courseTime");
        input.placeholder = timevar;


}
    </script>

</body>