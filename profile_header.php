 <?php

 require_once('connection.php');
 require_once('functions.php');


 session();
?>


 <!-- Side narbar small screen -->
    <div class="sidenav" id="profileNav">
        <button type="button" class="btn btn-light" id="myProfilebtnClose" onclick="closeProfileSide()">
            <i class="fas fa-times"></i>
        </button>
        <div class="smallImgCon">
            <img src="../includes/profile/<?=$photo?>" alt="" class="img-fluid xlprofilepic">
        </div>
        <div class="container">
            <div class="container text-center">
                <h3><small><?=$firstname.' '.$surname?></small></h3>
            </div>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <i class="fas fa-users"></i>
                <a href="market.php" class="nav-link">STORE</a>
            </li>
            <li class="nav-item">
                <i class="fas fa-handshake"></i>
                <a href="trade.php" class="nav-link">UPLOAD TRADE ITEM</a>
            </li>
            <li class="nav-item">
                <i class="fas fa-calendar"></i>
                <a href="active.php" class="nav-link">ACTIVE TRADE ITEMS</a>
            </li>
            <li class="nav-item hidden" id="phonelink">
                <i class="fas fa-search fa-lg"></i>
                <a href="search_market.php" class="nav-link"> SEARCH</a>
            </li>
            <li class="nav-item">
                <i class="fas fa-wrench"></i>
                <a href="settings.php" class="nav-link">SETTINGS</a>
            </li>
            <li class="nav-item">
                <i class="fas fa-power-off"></i>
                <a  href="../includes/logout.php" class="nav-link"> LOGOUT</a>
            </li>
            
            <li class="nav-item back" id="phonelink">
                <i class="fas fa-arrow-left"></i>
                <a href="index.php" class="nav-link"> HOME</a>
            </li>
        </ul>
    </div>