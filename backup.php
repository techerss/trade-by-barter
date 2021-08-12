<li class="nav-item" id="phonelink">
                <i class="fas fa-bell">

                    <?php 
                   $sql1 = "SELECT COUNT(*) AS count FROM inbox WHERE receiver_id = '$id' AND final_read = 0";

                    $result1 = mysqli_query($connect, $sql1);
                    $row = mysqli_fetch_array($result1);
                    $read = $row['count'];
                    if($read == 0){
                        
                    }else{ 
                        
                     ?>
                    <span class="badge badge-danger"><?=$read?></span>
             <?php } ?>
                </i>
                <a href="notification.php" class="nav-link">NOTIFICATION</a>
            </li>