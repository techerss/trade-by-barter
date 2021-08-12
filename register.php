<?php 

	require_once('connection.php');
	require_once('functions.php');
	

	


	$error = array();
	if (isset($_POST['submit'])) {


		$firstname = isset($_POST['firstname'])?trim($_POST['firstname']): '';

		$surname = isset($_POST['surname'])?trim($_POST['surname']): '';

		$email = isset($_POST['email'])?trim($_POST['email']): '';

		$password = isset($_POST['password'])?trim($_POST['password']): '';

		$state = isset($_POST['state'])?trim($_POST['state']): '';
		$phone = isset($_POST['phone'])?trim($_POST['phone']): '';


		







		

		
		if ($firstname == "" || $surname == "" || $email == "" || $password == "" || $state == "" || $phone == "" ) {
			$error[] = urlencode("All fields are required");
		}else{
			$firstname = trimData($_POST['firstname']);
			$surname = trimData($_POST['surname']);
			$email = trimData($_POST['email']);
			$password = trimData($_POST['password']);
			$state = trimData($_POST['state']);
			$phone = trimData($_POST['phone']);

			



		}
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$error[] = urlencode("Invalid email format");
		}
		if(empty($error)){
			$new_pass = password_encrypt($password);
			$firstname = mysql_prep($connect, $firstname);
			$surname = mysql_prep($connect, $surname);
			$email = mysql_prep($connect, $email);
			$state = mysql_prep($connect, $state);
			$phone = mysql_prep($connect, $phone);

			


			$new_pass = mysql_prep($connect, $new_pass);

			$check = "SELECT * FROM users WHERE email = '$email'";
			$check_result = 
			mysqli_query($connect, $check);
			if (mysqli_num_rows($check_result) == 1) {
				$exist = "user with email address already exists";
				header("location: ../public/register.php?error=".$exist);
			}else{
				$main_date = date("Y-m-d");
				$sql = "INSERT INTO users(firstname,surname,email,state,phone,password) VALUES('$firstname', '$surname', '$email', '$state', '$phone', '$new_pass')";
				$result = mysqli_query($connect, $sql);
				if($result){	
					
					$success = "registeration successful";header("location: ../public/login.php?success=".$success);
					
				
				}else{
					$failed = "registeration failed"; header("location: ../public/register.php?error=".$failed);
				}
			}
		}else{
			header("location: ../public/register.php?error=".join($error, urlencode('<br>')));
		}

	}



	if (isset($_POST['update'])) {


		$firstname = isset($_POST['firstname'])?trim($_POST['firstname']): '';

		$surname = isset($_POST['surname'])?trim($_POST['surname']): '';

		$email = isset($_POST['email'])?trim($_POST['email']): '';

		$state = isset($_POST['state'])?trim($_POST['state']): '';
		$phone = isset($_POST['phone'])?trim($_POST['phone']): '';
		$id = isset($_POST['id'])?trim($_POST['id']): '';


		
	
			$firstname = trimData($_POST['firstname']);
			$surname = trimData($_POST['surname']);
			$email = trimData($_POST['email']);
			$state = trimData($_POST['state']);
			$phone = trimData($_POST['phone']);

			



		
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$error[] = urlencode("Invalid email format");
		}
		if(empty($error)){
			
			$firstname = mysql_prep($connect, $firstname);
			$surname = mysql_prep($connect, $surname);
			$email = mysql_prep($connect, $email);
			$state = mysql_prep($connect, $state);
			$phone = mysql_prep($connect, $phone);

			


		
		
			
				$main_date = date("Y-m-d");
				
				$sql = "UPDATE `users` SET  `firstname` = '$firstname', `surname` = '$surname', `email` = '$email', `state` = '$state',`phone` = '$phone'  WHERE `id` = '$id'";
				$result = mysqli_query($connect, $sql);
				if($result){	
					
					$success = "Update successful";header("location: ../public/editprofile.php?success=".$success);
					
				
				}else{
					$failed = "update failed"; header("location: ../public/editprofile.php?error=".$failed);
				}
		
		}else{
			header("location: ../public/editprofile.php?error=".join($error, urlencode('<br>')));
		}

	}


 ?>