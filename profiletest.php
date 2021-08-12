<?php

require_once('connection.php');
require_once('functions.php');
require_once('header.php');

	

if (isset($_GET['item_id'])) {
    $item_id = $_GET['item_id'];
    


    $sql = "SELECT * FROM market WHERE id = '$item_id' and item_status = 1";
        $result1 = mysqli_Query($connect, $sql);
    $row = mysqli_fetch_assoc($result1);
    $marketid = $row['id'];
    $item_name = $row['item_name'];
    $user_id = $row['user_id'];
    $item_duration = $row['item_duration'];
    $item_location = $row['item_location'];
    $item_category = $row['item_category'];
    $item_image = $row['item_image'];
    $item_date = $row['item_date'];

      
        

 $sql1 = "INSERT INTO bookmark(maket_id,sender_id,user_id,item_name,item_location,item_duration,item_image,item_date) VALUES('$marketid', '$user_id', '$id', '$item_name', '$item_location', '$item_duration', '$item_image', '$item_date')";
        $result1 = mysqli_query($connect, $sql1);
        if ($result1) {
        	echo "success";
        }else{
        	echo "failed";
        }
}

?>