<!-- Side narbar small screen -->
    <div class="sidenav" id="sideNav">
        <!-- <div>
            <div class="brand">
                <div class="site-logo">
                    <a href="../public/index.php"><img src="../assets/img/logo/logotwo.jpg" alt="" class="img-fluid"></a>
                </div>
                <a class="navbar-brand" href="../public/index.php"><h2>BARTER-<span class="black">X</span></h2></a>
            </div>
        </div> -->
        <ul class="nav flex-column">
            <li class="nav-item">
                <i class="fas fa-home"></i>
                <a href="index.php" class="nav-link active"> HOME</a>
            </li>
            <li class="nav-item link">
                <i class="fas fa-pen fa-lg"></i>
                <a href="aboutus.php" class="nav-link"> ABOUT US</a>
            </li>
            <li class="nav-item link">
                <i class="fas fa-phone fa-lg"></i>
                <a href="contact.php" class="nav-link"> CONTACT</a>
            </li>
            <?php if (empty((isset($_SESSION['id'])))) { 

            }else{ ?> 

            <li class="nav-item">
                <i class="fas fa-users"></i>
                <a href="profile.php" class="nav-link">PROFILE</a>
            </li>
            <li class="nav-item">
                <i class="fas fa-users"></i>
                <a href="market.php" class="nav-link">STORE</a>
            </li>
            <?php } ?>

        </ul>
    </div>

    <?php
    require_once('connection.php');

        

        if (isset($_SESSION['id'])) {
         $id = $_SESSION['id'];
        $sql = "SELECT * FROM users WHERE id = '$id'";
        $result = mysqli_Query($connect, $sql);
        $row = mysqli_fetch_assoc($result);
        $userid = $row['id'];
        


      }

    ?>