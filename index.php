<?php

include('handling/auth.php');
include('handling/redirect.php');
include('handling/write.php');
include('handling/read.php');
if (isset($_GET['logout'])) {
    unset($_SESSION["reg_clgid"]); 
    session_destroy();
    header('location: index.php?msg=Logged+Out+Successfully');
}
if(isset($_SESSION['reg_clgid'])){
    header('location: home.php&getPosts=journal');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <title>Knowledge Portal</title>
    
    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700&display=swap&subset=latin-ext" rel="stylesheet">
    <link href="assets/landing/css/bootstrap.css" rel="stylesheet">
    <link href="assets/landing/css/fontawesome-all.css" rel="stylesheet">
    <link href="assets/landing/css/swiper.css" rel="stylesheet">
	<link href="assets/landing/css/magnific-popup.css" rel="stylesheet">
	<link href="assets/landing/css/styles.css" rel="stylesheet">
</head>

<body data-spy="scroll" data-target=".fixed-top">
<div id="app">
    <div class="spinner-wrapper">
        <div class="spinner">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>
    <!-- end of preloader -->
    

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
        <div class="container">

            <!-- Text Logo - Use this if you don't have a graphic logo -->
            <!-- <a class="navbar-brand logo-text page-scroll" href="index.html">Tivo</a> -->

            <!-- Image Logo -->
            <!-- <a class="navbar-brand logo-image" href="index.html"><img src="assets/landing/img/logo.png" alt="alternative" ></a>  -->
            
            <!-- Mobile Menu Toggle Button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-awesome fas fa-bars"></span>
                <span class="navbar-toggler-awesome fas fa-times"></span>
            </button>
            <!-- end of mobile menu toggle button -->

            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="#header">HOME <span class="sr-only">(current)</span></a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="#details">INFO</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="#video">TOUR</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="#footerframe">CONTACT US</a>
                    </li>

                    <!-- Dropdown Menu -->          
                    <!-- <li class="nav-item dropdown"> -->
                        <!-- <a class="nav-link dropdown-toggle page-scroll" id="navbarDropdown" role="button" aria-haspopup="true" aria-expanded="false">MORE</a> -->
                        <!-- <div class="dropdown-menu" aria-labelledby="navbarDropdown"> -->
                           
                            <!-- <div class="dropdown-items-divide-hr"></div> -->
                            <!-- <a class="dropdown-item" href="#suggestionbox"><span class="item-text">SUGGESTION</span></a> -->
                            <!-- <div class="dropdown-items-divide-hr"></div> -->
                            <!-- <a class="dropdown-item" href="#footerframe"><span class="item-text">CONTACT US</span></a> -->
                            <!-- <div class="dropdown-items-divide-hr"></div> -->
                            <!-- <a class="dropdown-item" href="terms-conditions.html"><span class="item-text">TERMS CONDITIONS</span></a> -->
                            <!-- <div class="dropdown-items-divide-hr"></div> -->
                            <!-- <a class="dropdown-item" href="privacy-policy.html"><span class="item-text">PRIVACY POLICY</span></a> -->
                        <!-- </div> -->
                    <!-- </li> -->
                    <!-- end of dropdown menu -->

                    
                </ul>
                <span class="nav-item">
                    <a class="btn-outline-sm" href="login-signup.php">LOG IN</a>
                </span>
            </div>
        </div> <!-- end of container -->
    </nav> <!-- end of navbar -->
    <!-- end of navigation -->

    <!-- Header -->
    <header id="header" class="header">
        <div class="header-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-xl-5">
                        <div class="text-container">
                            <h1>Stay tuned with your Achievements and Events</h1>
                            <p class="p-large"> with our Site</p>
                            <a class="btn-solid-lg page-scroll" href="login-signup.php">Get Started</a>
                        </div> <!-- end of text-container -->
                    </div> <!-- end of col -->
                    <div class="col-lg-6 col-xl-7">
                        <div class="image-container">
                            <div class="img-wrapper">
                                <img class="img-fluid" src="assets/landing/img/teacher-vector.png" alt="alternative">
                            </div> <!-- end of img-wrapper -->
                        </div> <!-- end of image-container -->
                    </div> <!-- end of col -->
                </div> <!-- end of row -->
            </div> <!-- end of container -->
        </div> <!-- end of header-content -->
    </header> <!-- end of header -->
    <svg class="header-frame" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" viewBox="0 0 1920 310">
        <defs>
            <style>.cls-1{fill:url(#grad1);}</style>
            <linearGradient id="grad1" x1="0%" y1="0%" x2="100%" y2="0%">
                <stop offset="0%" style="stop-color:#00c6ff;stop-opacity:1" />
                <stop offset="100%" style="stop-color:#0072ff;stop-opacity:1" />
            </linearGradient>
        </defs>
        <title>header-frame</title><path class="cls-1" d="M0,283.054c22.75,12.98,53.1,15.2,70.635,14.808,92.115-2.077,238.3-79.9,354.895-79.938,59.97-.019,106.17,18.059,141.58,34,47.778,21.511,47.778,21.511,90,38.938,28.418,11.731,85.344,26.169,152.992,17.971,68.127-8.255,115.933-34.963,166.492-67.393,37.467-24.032,148.6-112.008,171.753-127.963,27.951-19.26,87.771-81.155,180.71-89.341,72.016-6.343,105.479,12.388,157.434,35.467,69.73,30.976,168.93,92.28,256.514,89.405,100.992-3.315,140.276-41.7,177-64.9V0.24H0V283.054Z"/></svg>
    <!-- end of header -->

    <!-- Description -->
    <br><br>
    <div class="cards-1" id="details">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="above-heading">WHAT'S THIS ?</div>
                    <h2 class="h2-heading">A Space for the Teachers to Remember and Broadcast their achivements</h2>
                </div> <!-- end of col -->
            </div> <!-- end of row -->
            <div class="row">
                <div class="col-lg-12">

                    <!-- Card -->
                    <div class="card">
                        <div class="card-image">
                            <img class="img-fluid" src="assets/landing/img/description-1.png" alt="alternative">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">Post </h4>
                            <p>It's Very Easy to Post your Articles, Seminars, Courses and even Projects</p>
                        </div>
                    </div>
                    <!-- end of card -->

                    <!-- Card -->
                    <div class="card">
                        <div class="card-image">
                            <img class="img-fluid" src="assets/landing/img/description-2.png" alt="alternative">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">Connect</h4>
                            <p>You can connect with other faculties and contribute to their Projects, on which we are working on to make it available in Next Update</p>
                        </div>
                    </div>
                    <!-- end of card -->

                    <!-- Card -->
                    <div class="card">
                        <div class="card-image">
                            <img class="img-fluid" src="assets/landing/img/description-3.png" alt="alternative">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">Broadcast</h4>
                            <p>Now you can easily broadcast your achivements with organized data to organizations</p>
                        </div>
                    </div>
                    <!-- end of card -->

                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of cards-1 -->
    <!-- end of description -->

    <!-- Video -->
    <div id="video" class="basic-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <!-- Video Preview -->
                    <div class="image-container">
                        <div class="video-wrapper">
                            <a class="popup-youtube" href="https://www.youtube.com/watch?v=vFkauXJdWK8" data-effect="fadeIn">
                                <img class="img-fluid" src="assets/landing/img/video-image.png" alt="alternative">
                                <span class="video-play-button">
                                    <span></span>
                                </span>
                            </a>
                        </div> <!-- end of video-wrapper -->
                    </div> <!-- end of image-container -->
                    <!-- end of video preview -->

                    <div class="p-heading">Check out our Tour Video!</div>        
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of basic-2 -->
    <!-- end of video -->





   
    <!-- Newsletter -->
    <div class="form" id="suggestionbox">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="above-heading">CONTACT US</div>
                    <div class="text-container">
                    <div class="row">
                <div class="col-lg-12">
                    <div class="icon-container">
                        <span class="fa-stack">
                            <a target="_blank" href="https://facebook.com/sonacollege">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-facebook-f fa-stack-1x"></i>
                            </a>
                        </span>
                        <span class="fa-stack">
                            <a target="_blank" href="https://twitter.com/sonacollege">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-twitter fa-stack-1x"></i>
                            </a>
                        </span>
                        <span class="fa-stack">
                            <a target="_blank" href="https://pinterest.com/sonacollege">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-pinterest-p fa-stack-1x"></i>
                            </a>
                        </span>
                        <span class="fa-stack">
                            <a target="_blank" href="https://instagram.com/sonacollege">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-instagram fa-stack-1x"></i>
                            </a>
                        </span>
                        <span class="fa-stack">
                            <a target="_blank" href="https://www.linkedin.com/school/sona-college-of-technology/">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fab fa-linkedin-in fa-stack-1x"></i>
                            </a>
                        </span>
                    </div> <!-- end of col -->
                </div> <!-- end of col -->
            </div> <!-- end of row -->
                        <!-- <div class="above-heading">Suggestions..?</div>
                        <h2>Feel free to send your Suggestions</h2> -->

                        <!-- Newsletter Form -->
                        <!-- <form id="newsletterform" data-toggle="validator" data-focus="false">
                            <div class="form-group">
                                <input class="form-control-input" id="nemail" required>
                                <label class="label-control" for="nemail">I would like to convey you that...</label>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group checkbox">
                                <input type="checkbox" id="nterms" value="Agreed-to-Terms" required>I've read and agree to <a href="privacy-policy.html">Privacy Policy</a> and <a href="terms-conditions.html">Terms Conditions</a> 
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control-submit-button">Send</button>
                            </div>
                            <div class="form-message">
                                <div id="nmsgSubmit" class="h3 text-center hidden"></div>
                            </div>
                        </form> -->
                        <!-- end of newsletter form -->

                    </div> <!-- end of text-container -->
                </div> <!-- end of col -->
            </div> <!-- end of row -->


            
        </div> <!-- end of container -->
    </div> <!-- end of form -->
    <!-- end of newsletter -->

    <!-- Footer -->
    <svg id="footerframe" class="footer-frame" data-name="Layer 2" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" viewBox="0 0 1920 79">
        <defs>
            <style>.cls-2{fill:url(#grad1);}</style>
            <linearGradient id="grad1" x1="0%" y1="0%" x2="100%" y2="0%">
                <stop offset="0%" style="stop-color:#00c6ff;stop-opacity:1" />
                <stop offset="100%" style="stop-color:#0072ff;stop-opacity:1" />
            </linearGradient>
        </defs>
    <title>footer-frame</title><path class="cls-2" d="M0,72.427C143,12.138,255.5,4.577,328.644,7.943c147.721,6.8,183.881,60.242,320.83,53.737,143-6.793,167.826-68.128,293-60.9,109.095,6.3,115.68,54.364,225.251,57.319,113.58,3.064,138.8-47.711,251.189-41.8,104.012,5.474,109.713,50.4,197.369,46.572,89.549-3.91,124.375-52.563,227.622-50.155A338.646,338.646,0,0,1,1920,23.467V79.75H0V72.427Z" transform="translate(0 -0.188)"/></svg>
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="footer-col first">
                        <h4>Note</h4>
                        <p class="p-small">
                            This Website is a part of Sona College of Technology, meant for the faculty of the college only. For further info, Contact Us. 
                        </p>
                    </div>
                </div> <!-- end of col -->
                <div class="col-md-4">
                    <div class="footer-col middle">
                        <!-- <h4>Important Links</h4> -->
                        <ul class="list-unstyled li-space-lg p-small">
                            <!-- <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">Our business partners <a class="white" href="#your-link">cisco.com</a></div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body">Read our <a class="white" href="terms-conditions.html">Terms & Conditions</a>, <a class="white" href="privacy-policy.html">Privacy Policy</a></div>
                            </li> -->
                        </ul>
                    </div>
                </div> <!-- end of col -->
                <div class="col-md-4">
                    <div class="footer-col last">
                        <h4>Contact Info</h4>
                        <ul class="list-unstyled li-space-lg p-small">
                            <li class="media">
                                <i class="fas fa-map-marker-alt"></i>
                                <div class="media-body">Sona College of Technology.</div>
                                <div class="media-body">Junction Main Road,Salem 636 005. Tamilnadu,</div>
                            </li>
                            <li class="media">
                            <div class="media-body">
                                <i class="fas fa-envelope"></i>
                                <a class="white" href="mailto:contact@sonatech.ac.in">Email us</a>
                            </div><div class="media-body">
                                <i class="fas fa-globe"></i>
                                <a class="white" href="https://sonatech.ac.in">Visit our Site</a>
                            </div>
                            </li>
                        </ul>
                    </div> 
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of footer -->  
    <!-- end of footer -->


    <!-- Copyright -->
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p class="p-small">Copyright © 2020 <a href="">Sona College of Technology. All Rights are Reserved.</a></p>
                </div> <!-- end of col -->
            </div> <!-- enf of row -->
        </div> <!-- end of container -->
    </div> <!-- end of copyright --> 
    <!-- end of copyright -->
    
    	
    <!-- Scripts -->
    <script src="assets/landing/js/jquery.min.js"></script> <!-- jQuery for Bootstrap's JavaScript plugins -->
    <script src="assets/landing/js/popper.min.js"></script> <!-- Popper tooltip library for Bootstrap -->
    <script src="assets/landing/js/bootstrap.min.js"></script> <!-- Bootstrap framework -->
    <script src="assets/landing/js/jquery.easing.min.js"></script> <!-- jQuery Easing for smooth scrolling between anchors -->
    <script src="assets/landing/js/swiper.min.js"></script> <!-- Swiper for image and text sliders -->
    <script src="assets/landing/js/jquery.magnific-popup.js"></script> <!-- Magnific Popup for lightboxes -->
    <script src="assets/landing/js/validator.min.js"></script> <!-- Validator.js - Bootstrap plugin that validates forms -->
    <script src="assets/landing/js/scripts.js"></script> <!-- Custom scripts -->

</div>
</body>
</html>
