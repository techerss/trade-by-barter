<?php

require_once('connection.php');
	require_once('functions.php');

	
	$userid = $_SESSION['id'];
	
	$error = [];
	if (isset($_POST['submit'])) {
		$item_name = isset($_POST['item_name'])?trim($_POST['item_name']): '';

		$item_duration = isset($_POST['item_duration'])?trim($_POST['item_duration']): '';

		$item_location = isset($_POST['item_location'])?trim($_POST['item_location']): '';
		$categories = isset($_POST['categories'])?trim($_POST['categories']): '';
		$market_id = isset($_POST['market_id'])?trim($_POST['market_id']): '';
		$description = isset($_POST['description'])?trim($_POST['description']): '';




		if($item_name == "" || $item_duration == "" || $item_location == "" || $categories == "" || $description == "" ){
			$error = "All fields are required";
			header("location: ../public/edit.php?error=".$error);
			
		}else{
			$item_name = trimData($_POST['item_name']);
		$item_duration = trimData($_POST['item_duration']);
		$item_location = trimData($_POST['item_location']);
		$categories = trimData($_POST['categories']);
		$description = trimData($_POST['description']);

		}


		

				


		if (isset($_FILES)) {
			$filename = $_FILES['file']['name'];
			$fileTemp = $_FILES['file']['tmp_name'];
			$filesize = $_FILES['file']['size'];
			$fileerror = $_FILES['file']['error'];
			$filetype = $_FILES['file']['type'];
			$fileext = explode('.', $filename);
			$fileactualext = strtolower(end($fileext));


			$allow = array('jpg', 'jpeg', 'png', 'gif', 'mp3', 'mp4', 'avi');
			
			if (in_array($fileactualext, $allow)) {
				if ($filesize < 800000) {
					$pic = uniqid('', ture).'.'.$fileactualext;
					$filedestination = 'market/'.$pic;
					$compressedimage = compressImage($fileTemp, $filedestination, 35);
					if (empty($error)) {
						$sql6 = "UPDATE `market` SET  `item_name` = '$item_name', `item_duration` = '$item_duration', `item_location` = '$item_location',`description` = '$description', `item_image` = '$pic' WHERE `id` = '$market_id'";
							
						
						
							$result6 = mysqli_query($connect, $sql6);
							if ($result6) {

								$success = "picture uploaded";
								header("location: ../public/active.php?success=".$success);
								
							}else{
								$error = "uploaded failed";
								header("location: ../public/edit.php?error=".$error);
							}

					}else{
						$error = "error uploading";
						header("location: ../public/edit.php?error=".$error);
					}

				}else{

					$error = "file too large";
					header("location: ../public/edit.php?error=".$error);
				}
			}else{
				if (empty($error)) {
						$sql6 = "UPDATE `market` SET  `item_name` = '$item_name', `item_duration` = '$item_duration', `item_location` = '$item_location' WHERE `id` = '$market_id'";
							
						
						
							$result6 = mysqli_query($connect, $sql6);
							if ($result6) {

								$success = "picture uploaded";
								header("location: ../public/active.php?success=".$success);
								
							}else{
								$error = "uploaded failed";
								header("location: ../public/edit.php?error=".$error);
							}

					}else{
						$error = "error uploading";
						header("location: ../public/edit.php?error=".$error);
					}
				// $error = "invalid file format";
				// header("location: ../public/edit.php?error=".$error);
			}
		}else{
			$error = "file not found";
			header("location: ../public/edit.php?error=".$error);
		}
	}



	if (isset($_GET['delete'])) {
		$market_id = $_GET['delete'];

		$sql6 = "UPDATE `market` SET  `item_status` = 0, `active` = 0  WHERE `id` = '$market_id'";
							
						
					
			$result6 = mysqli_query($connect, $sql6);
			if ($result6) {

				$success = "Deleted";
				header("location: ../public/active.php?success=".$success);
				
			}else{
				$error = "Deleting Failed";
				header("location: ../public/active.php?error=".$error);
			}


	}

?>