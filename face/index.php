<!DOCTYPE html>
<html class="no-js" lang="en">
<head>

    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <title>Video Upload Page | ODTUclass</title>
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

    <!-- script
    ================================================== -->
    <script src="js/modernizr.js"></script>

    <!-- favicons
    ================================================== -->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <?php
        include('session.php');
    ?>


</head>


<body id="top" style="background-image:url('images/atten.png');background-size: cover;background-position: center;background-repeat: no-repeat;background-attachment: fixed;">
    
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
            <a class="site-logo" href="login.php">
                <img src="images/logohome.png" style="width:500px;height:130px;" alt="Homepage">
            </a>
        </div> <!-- end header-logo -->
    </header> <!-- end s-header -->


    <!-- home
    ================================================== -->
    <section id="home" class="s-home page-hero target-section" data-parallax="scroll" data-natural-width=3000 data-natural-height=2000 data-position-y=center>

    
        <div class="home-content">

            <div class="row home-content__main">

                <h3>
                Upload your video for face regonition system
                </h3>

                <div class="home-content__video">
                    <a class="video-link" href="videos/sinan.mp4" data-lity>
                        <span class="video-icon"></span>
                        <span class="video-text">Watch Video if you are unsure what to do</span>
                    </a>
                </div>
            </div> <!-- end home-content__main -->

            <div class="home-content__scroll">
                <a href="#about" class="scroll-link smoothscroll">
                    Scroll down
                </a>
            </div>

        </div> <!-- end home-content -->
    </section> <!-- end s-home -->

 

    <!-- about
    ================================================== -->
    <section id="about" class="s-about target-section">

        <form action="upload.php" method="POST" enctype="multipart/form-data">
            Please select video: <br>
            <input  type="file" name="file" style="width: 300px;"><br>
            <button class="btn btn--primary half-width" type="submit" name="submit">UPLOAD</button>
        </form>

        <div class="row section-header bit-narrow" data-aos="fade-up">
            <div class="col-full">
                <h3 class="subhead">Why do you need to upload your video ?</h3>
                <h1 class="display-1">
                In order for the cameras in the classes to recognize you, every student has to upload a video that shows his/her face clearly.
                </h1>
            </div>
        </div> <!-- end section-header -->

        </div> <!-- end row -->

    </section> <!-- end s-about -->

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

</body>