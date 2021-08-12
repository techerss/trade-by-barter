<?php

require_once('connection.php');
require_once('functions.php');

?>
    <div class="container contactCon">
        <div class="row">
            <div class="col-sm-6 d-flex">
                <div class="container d-flex">
                    <i class="fas fa-envelope"></i>
                    <small><b>Support@primusx.com</b></small>
                </div>
                <div class="container d-flex">
                    <i class="fas fa-phone"></i>
                    <small><b>(+234)810794397</b></small>
                </div>

            </div>
            <div class="col-sm-6">
                <div class="social">
                    <div class="container social-media-icons text-right">
                        <i class="fab fa-twitter fa-lg mr-3" title="Twitter"></i>
                        <i class="fab fa-facebook fa-lg mr-3" title="Facebook"></i>
                        <i class="fab fa-instagram fa-lg mr-3" title="Instagram"></i>
                        <i class="fab fa-skype fa-lg mr-3" title="Skype"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Navigation bar -->
<nav class="navbar navbar-expand-md sticky-top" id="#startchange">
    <div class="container nav-con">
        <div class="brand">
            <!-- Brand -->
            <div class="site-logo">
                <a href="../public/index.php"><img src="../assets/img/logo/logotwo.jpg" alt="" class="img-fluid"></a>
            </div>
            <!-- Brand -->
            <a class="navbar-brand" href="../public/index.php"><h2>PRIMUS-<span class="black">X</span></h2></a>
        </div>
        <!-- Toggler -->

        <ul class="navbar-nav">
            <li class="nav-item link">
                <i class="fas fa-home fa-lg"></i>
                <a href="index.php" class="nav-link"> HOME</a>
            </li>
            <li class="nav-item link">
                <i class="fas fa-pen fa-lg"></i>
                <a href="aboutus.php" class="nav-link"> ABOUT US</a>
            </li>
            <li class="nav-item link">
                <i class="fas fa-phone fa-lg"></i>
                <a href="contact.php" class="nav-link"> CONTACT</a>
            </li>
            <?php if (isset($_SESSION['id'])) { ?>
            <li class="nav-item dropdown">
                <a href="profile.php" class="icon-link"> 
                    <i class="far fa-user fa-lg"></i>
                </a>
                <a href="profile.php" class="nav-link"> PROFILE</a>
            </li>
            <?php }else{ ?>
            <li class="nav-item dropdown">
                <i class="far fa-user fa-lg icon-link-two" id="navbardrop" data-toggle="dropdown"></i>
                <a href="#" class="nav-link dropdown-toggle" id="navbardrop" data-toggle="dropdown"> LOGIN</a>
                <div class="dropdown-menu text-center">
                    <a class="dropdown-item" href="login.php" class="login">LOGIN</a>
                    <a class="dropdown-item" href="signup.php" class="signup">SIGNUP</a>
                </div>
            </li>
            <?php } ?>
        </ul>
        <button class="btn btn-light" type="button" id="openSideNav">
            <i class="fas fa-bars"></i>
        </button>
        <button class="btn btn-light" type="button" id="closeSideNav">
            <i class="fas fa-times"></i>
        </button>
    </div>
</nav>