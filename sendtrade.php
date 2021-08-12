<?php
	require_once('connection.php');
	require_once('functions.php');
	


if (isset($_POST['submit'])) {



	
	$tradewith = isset($_POST['tradewith'])?trim($_POST['tradewith']): '';

	$tradeid = isset($_POST['tradeid'])?trim($_POST['tradeid']): '';
	$sender_id = isset($_POST['sender_id'])?trim($_POST['sender_id']): '';
	$reciver_id = isset($_POST['reciver_id'])?trim($_POST['reciver_id']): '';


	
	$sql = "SELECT * FROM market WHERE id = '$tradewith'";
	$result1 = mysqli_Query($connect, $sql);
    $row = mysqli_fetch_assoc($result1);
    $with_name = $row['item_name'];
    $withuser_id = $row['user_id'];
    $with_duration = $row['item_duration'];
    $with_location = $row['item_location'];
    $with_category = $row['item_category'];
    $with_image = $row['item_image'];


    $sql = "SELECT * FROM market WHERE id = '$tradeid'";
	$result1 = mysqli_Query($connect, $sql);
    $row = mysqli_fetch_assoc($result1);
    $item_name = $row['item_name'];
    $item_image = $row['item_image'];
    $item_duration = $row['item_duration'];
    $item_location = $row['item_location'];
    $item_category = $row['item_category'];
    
  
    
   

	    
    

	$main_date = date("Y-m-d");

	$sqlt = "UPDATE `market` SET `traded` = 0 WHERE id = '$tradewith'";
	$resultt = mysqli_Query($connect, $sqlt);

	$sql2 = "INSERT INTO receive(sender_id, receiver_id, tradewith_id, market_id, send_date, reader_id) 
	VALUES('$sender_id', '$reciver_id', '$tradewith', '$tradeid', '$main_date', '$reciver_id')";
	$result2 = mysqli_query($connect, $sql2);
	$newid = base64_encode($tradewith);
	$request = 1;
	$read = 3;
	$sql = "INSERT INTO inbox( receiver_id, sender_id,with_id, item_id, with_name, item_name, with_duration, with_location, with_image, created_date, item_image,  request, read_id) 
	VALUES( '$reciver_id', '$sender_id', '$tradewith', '$tradeid', '$with_name', '$item_name', '$with_duration', '$with_location', '$with_image', '$main_date', '$item_image',  '$request', '$read')";
	$result = mysqli_query($connect, $sql);

	$sql1 = "INSERT INTO sent(  sender_id, receiver_id, item_name, with_name, item_duration, item_location, item_image, created_date, with_image) 
	VALUES(  '$sender_id', '$reciver_id', '$item_name', '$with_name', '$item_duration', '$item_location', '$item_image', '$main_date', '$with_image')";
	$result1 = mysqli_query($connect, $sql1);


	

	if($result1){

		// $sql1 = "SELECT * FROM users WHERE id = '$reciver_id' AND status = 1";
		// $result1 = mysqli_query($connect, $sql1);
		// $row = mysqli_fetch_assoc($result1);
		// $email1 = $row['email'];

		// $sql2 = "SELECT * FROM users WHERE id = '$sender_id' AND status = 1";
		// $result2 = mysqli_query($connect, $sql2);
		// $row = mysqli_fetch_assoc($result2);
		// $firstname = $row['firstname'];

		// $newid = base64_encode($tradewith);

	$success = "trade request successful";
	header("location: ../public/accept_trade.php?items_id=$newid");
				
			
	}else{
		$failed = "trade request failed"; 
		header("location: ../public/trade_with.php?tradeid=$tradeid?error=".$failed);
	}



}

if (isset($_GET['accept'])) {
	$trade_id = base64_decode($_GET['accept']);
	$trade = base64_encode($trade_id);

	$sql1 = "SELECT * FROM receive WHERE tradewith_id = '$trade_id'";
	$result1 = mysqli_query($connect, $sql1);
	$row = mysqli_fetch_assoc($result1);
	$market_id = $row['market_id'];


	$main_date = date("Y-m-d");

	// $sql4 = "UPDATE `bookmark` SET  `item_status` = 0 WHERE maket_id = '$trade_id' ";
 //    $result4 = mysqli_query($connect, $sql4);
	$sql3 = "UPDATE `market` SET `traded` = 0 WHERE id = '$trade_id'";
	$result3 = mysqli_query($connect, $sql3);
	$sql4 = "UPDATE `market` SET `traded` = 0 WHERE id = '$market_id'";
	$result4 = mysqli_query($connect, $sql4);

	$sql3 = "UPDATE `market` SET `active` = 0 WHERE id = '$trade_id'";
	$result3 = mysqli_query($connect, $sql3);

	$sql4 = "UPDATE `market` SET `active` = 0 WHERE id = '$market_id'";
	$result4 = mysqli_query($connect, $sql4);
	
	$sql5 = "UPDATE `receive` SET `status` = 3 WHERE market_id = '$market_id'";
	$result5 = mysqli_query($connect, $sql5);

	$sql6 = "SELECT * FROM inbox WHERE with_id = '$trade_id'";
	$result6 = mysqli_query($connect, $sql6);
	$row6 = mysqli_fetch_assoc($result6);
	$receiver_id = $row6['receiver_id'];
    $sender_id = $row6['sender_id'];
    $with_id = $row6['with_id'];
    $item_id = $row6['item_id'];
    $with_name = $row6['with_name'];
    $item_name = $row6['item_name'];
    $with_duration = $row6['with_duration'];
    $with_location = $row6['with_location'];
    $with_image = $row6['with_image'];
    $created_date = $row6['created_date'];
    $item_image = $row6['item_image'];
    $read = $row6['read_id'];  	
    $request = 2;
    $read = 3;

    $sql7 = "INSERT INTO inbox( receiver_id, sender_id,with_id, item_id, with_name, item_name, with_duration, with_location, with_image, created_date, item_image,  request, read_id) VALUES('$sender_id', '$receiver_id',  '$with_id', '$item_id', '$with_name', '$item_name', '$with_duration', '$with_location', '$with_image', '$main_date', '$item_image',  '$request', '$read')";
	$result7 = mysqli_query($connect, $sql7);

	$sql2 = "UPDATE `receive` SET `status` = 2 WHERE tradewith_id = '$trade_id' AND market_id = '$market_id'";
	$result2 = mysqli_query($connect, $sql2);

	if($result2){

	$success = "Trade Accepted";
	header("location: ../public/accept_tradedetails.php?item_id=$trade");
				
			
	}else{
		$failed = "Trade Acceptance failed"; 
		header("location: ../public/trade_with.php?item_id=$trade_id");
	}

	
}elseif ($_GET['reject']) {
	$trade_id = base64_decode($_GET['reject']);
	$trade = base64_encode($trade_id);

	$main_date = date("Y-m-d");

	$sql1 = "SELECT * FROM receive WHERE tradewith_id = '$trade_id'";
	$result1 = mysqli_query($connect, $sql1);
	$row = mysqli_fetch_assoc($result1);
	$market_id = $row['market_id'];

	$sqlt = "UPDATE `market` SET `traded` = 1 WHERE id = '$trade_id'";
	$resultt = mysqli_Query($connect, $sqlt);

	$sql6 = "SELECT * FROM inbox WHERE with_id = '$trade_id'";
	$result6 = mysqli_query($connect, $sql6);
	$row6 = mysqli_fetch_assoc($result6);
	$receiver_id = $row6['receiver_id'];
    $sender_id = $row6['sender_id'];
    $with_id = $row6['with_id'];
    $item_id = $row6['item_id'];
    $with_name = $row6['with_name'];
    $item_name = $row6['item_name'];
    $with_duration = $row6['with_duration'];
    $with_location = $row6['with_location'];
    $with_image = $row6['with_image'];
    $created_date = $row6['created_date'];
    $item_image = $row6['item_image']; 	
    $request = 3;
    $read = 3;


    $sql7 = "INSERT INTO inbox( receiver_id, sender_id,with_id, item_id, with_name, item_name, with_duration, with_location, with_image, created_date, item_image, request, read_id) VALUES('$sender_id', '$receiver_id',  '$with_id', '$item_id', '$with_name', '$item_name', '$with_duration', '$with_location', '$with_image', '$main_date', '$item_image',  '$request', '$read')";
	$result7 = mysqli_query($connect, $sql7);





	$sql2 = "UPDATE `receive` SET `status` = 3 WHERE tradewith_id = '$trade_id' AND market_id = '$market_id'";
	$result2 = mysqli_query($connect, $sql2);


	if($result2){

	$success = "Trade rejcted";
	header("location: ../public/accept_trade.php?item_id=$trade");
				
			
	}else{
		$failed = "Trade rejection failed"; 
		header("location: ../public/trade_with.php?item_id=$trade");
	}

}elseif ($_GET['delete']) {
	$trade_id = base64_decode($_GET['delete']);
	


	$sql1 = "SELECT * FROM receive WHERE tradewith_id = '$trade_id'";
	$result1 = mysqli_query($connect, $sql1);
	$row = mysqli_fetch_assoc($result1);
	$market_id = $row['market_id'];
	$trade = base64_encode($market_id);

	$sqlt = "UPDATE `market` SET `traded` = 1 WHERE id = '$trade_id'";
	$resultt = mysqli_Query($connect, $sqlt);

	$sql6 = "SELECT * FROM inbox WHERE with_id = '$trade_id'";
	$result6 = mysqli_query($connect, $sql6);
	$row6 = mysqli_fetch_assoc($result6);
	$receiver_id = $row6['receiver_id'];
    $sender_id = $row6['sender_id'];
    $with_id = $row6['with_id'];
    $item_id = $row6['item_id'];
    $with_name = $row6['with_name'];
    $item_name = $row6['item_name'];
    $with_duration = $row6['with_duration'];
    $with_location = $row6['with_location'];
    $with_image = $row6['with_image'];
    $created_date = $row6['created_date'];
    $item_image = $row6['item_image']; 	
    $request = 3;
    $read = 3;


	$sql2 = "UPDATE `receive` SET `deleted` = 0 WHERE tradewith_id = '$trade_id' AND market_id  = '$market_id' AND deleted = 1";
	$result2 = mysqli_query($connect, $sql2);


	if($result2){

	$success = "Trade Request Deleted";
	header("location: ../public/viewrequest.php?id=$trade");
				
			
	}else{
		$failed = "Trade Deleting failed"; 
		header("location: ../public/viewrequest.php?id=$trade");
	}

}


?>