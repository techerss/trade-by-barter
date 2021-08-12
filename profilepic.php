<?php


	require_once('connection.php');
	require_once('functions.php');
	

	session_start();
	$userid = $_SESSION['id'];
	

	if (isset($_POST['upload'])) {
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
				if ($filesize < 80000000) {
					$pic = uniqid('', ture).'.'.$fileactualext;
					$filedestination = 'profile/'.$pic;
					$compressedimage = compressImage($fileTemp, $filedestination, 35);
					if (empty($error)) {
						$sql6 = "UPDATE `users` SET  `photo` = '$pic' WHERE id = '$userid' ";
							$result6 = mysqli_query($connect, $sql6);
							if ($result6) {

								$success = "picture uploaded";
								header("location: ../public/profile.php?success=".$success);
								
							}else{
								$error = "uploaded failed";
								header("location: ../public/profilepicadd.php?error=".$error);
							}

					}else{
						$error = "error uploading";
						header("location: ../public/profilepicadd.php?error=".$error);
					}

				}else{
					$error = "file too large";
					header("location: ../public/profilepicadd.php?error=".$error);
				}
			}else{
				$error = "invalid file format";
				header("location: ../public/profilepicadd.php?error=".$error);
			}
		}else{
			$error = "file not found";
			header("location: ../public/profilepicadd.php?error=".$error);
		}
	}else{
		$failed = "failed";
		    header("location: ../public/profilepicadd.php?error=".$failed);
	}



	

?>

