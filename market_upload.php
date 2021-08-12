<?php
	require_once('connection.php');
	require_once('functions.php');
    require_once("../includes/header.php");


	$error = array();
	if(isset($_POST['submit'])){

		$name = isset($_POST['name'])?trim($_POST['name']): '';

		$duration = isset($_POST['duration'])?trim($_POST['duration']): '';
		$location = isset($_POST['location'])?trim($_POST['location']): '';
		$categories = isset($_POST['categories'])?trim($_POST['categories']): '';
		$userid = isset($_POST['userid'])?trim($_POST['userid']): '';
		$posters_name = isset($_POST['posters_name'])?trim($_POST['posters_name']): '';
		$description = isset($_POST['description'])?trim($_POST['description']): '';



		$sql = "SELECT * FROM category WHERE cat_name = '$categories'";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_assoc($result);
		$cat_id = $row['cat_id'];

	

		
		


		if($name == "" || $duration == "" || $location == "" || $categories == "" || $description == ""){

			$error[] = urlencode('All fields are required');
		}else{
			$name = trimData($_POST['name']);
			$duration = trimData($_POST['duration']);
			$location = trimData($_POST['location']);
			$categories = trimData($_POST['categories']);
			$userid = trimData($_POST['userid']);
			$posters_name = trimData($_POST['posters_name']);
			$description = trimData($_POST['description']);




		}


					if (empty($error)) {
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
							if ($filesize < 8000000) {
								$pic = uniqid('', true).'.'.$fileactualext;
								$filedestination = 'market/'.$pic;
					$compressedimage = compressImage($fileTemp, $filedestination, 35);


						$main_date = date('Y-m-d h:i:sa');

						
						$sql6 = "INSERT INTO market (posters_name, item_name, item_duration, item_location, item_category, description, cat_id, item_image, user_id, item_date) VALUES ('$posters_name','$name', '$duration', '$location', '$categories', '$description', '$cat_id', '$pic', '$userid', '$main_date')";
						
							$result6 = mysqli_query($connect, $sql6);
							if ($result6) {

								$success = "Trade uploaded";
								header("location: ../public/active.php?success=".$success);
								
							}else{
								$error = "upload failed";
								header("location: ../public/trade.php?error=".$error);
							}
								}else{
					$error = "file too large";
					header("location: ../public/trade.php?error=".$error);
				}
			}else{
				$error = "invalid file format";
				header("location: ../public/trade.php?error=".$error);
			}
		}else{
			$error = "file not found";
			header("location: ../public/trade.php?error=".$error);
		}

					}else{
						$error = "All fields Required";
						header("location: ../public/trade.php?error=".$error);
					}

					
		
		

	}

	










?>

