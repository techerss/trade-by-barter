<?php

require_once('connection.php');
require_once('functions.php');

session();
?>
            
            
<!-- Navigation bar -->
<nav class="navbar navbar-expand-md sticky-top sticky startchange" id="#startchange">
    <div class="container nav-con">
        <div class="brand">
            <!-- Brand -->
            <div class="site-logo">
                <a href="../public/index.php"><img src="../assets/img/logo/logotwo.jpg" alt="" class="img-fluid"></a>
            </div>
            <!-- Brand -->
            <a class="navbar-brand" href="../public/index.php"><h2>PRIMUS-<span class="black">X</span></h2></a>
        </div>
        <ul class="navbar-nav">
            <li class="nav-item hidden">
                <i class="fas fa-home"></i>
                <a href="index.php" class="nav-link"> HOME</a>
            </li>
            <li class="nav-item seen">
                <a href="profile.php" class="phone-icon-link"> 
                    <i class="far fa-user"></i>
                </a>
                <a href="profile.php" class="nav-link">PROFILE</a>
            </li>
            <li class="nav-item hidden">
                <a href="profile.php" class="phone-icon-link"> 
                    <i class="fas fa-bell">
                        <?php 
                            $sql1 = "SELECT COUNT(*) AS count FROM inbox WHERE receiver_id = '$id' AND final_read = 0";

                                $result1 = mysqli_query($connect, $sql1);
                                $row = mysqli_fetch_array($result1);
                                $read = $row['count'];

                                // $sql2 = "SELECT COUNT(*) AS countt FROM inbox WHERE receiver_id = '$id' AND final_read = 4";
                                // $result2 = mysqli_query($connect, $sql2);
                                // $row2 = mysqli_fetch_array($result2);
                                // $read1 = $row2['countt'];

                                // $final= $read + $read1;
                                if($read == 0){
                                    
                                }else{ 
                                
                                ?>
                                <span class="badge badge-danger"><?=$read?></span>
                        <?php } ?>
                    </i>
                </a>

                <a href="notification.php" class="nav-link">NOTIFICATION</a>
            </li>
            <li class="nav-item hidden">
                <i class="fas fa-search fa-lg"></i>
                <a href="search_market.php" class="nav-link"> SEARCH</a>
            </li>
        </ul>
        <ul class="navbar-nav navTwo">
            <li class="nav-item seenTwo">
                <a href="notification.php" class="phone-icon-link"> 
                    <i class="far fa-bell">
                        <?php 
                            $sql1 = "SELECT COUNT(*) AS count FROM inbox WHERE receiver_id = '$id' AND final_read = 0";

                                $result1 = mysqli_query($connect, $sql1);
                                $row = mysqli_fetch_array($result1);
                                $read = $row['count'];

                                // $sql2 = "SELECT COUNT(*) AS countt FROM inbox WHERE receiver_id = '$id' AND final_read = 4";
                                // $result2 = mysqli_query($connect, $sql2);
                                // $row2 = mysqli_fetch_array($result2);
                                // $read1 = $row2['countt'];

                                // $final= $read + $read1;
                                if($read == 0){
                                    
                                }else{ 
                                
                                ?>
                                <span class="badge badge-danger"><?=$read?></span>
                        <?php } ?>
                    </i>
                </a>

            </li>
        </ul>
        <button type="button" class="btn btn-light" id= "myProfilebtnOpen" onclick="profileSide()">
            <i class="fas fa-bars"></i>
        </button>
    </div>
</nav>