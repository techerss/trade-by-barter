<?php 

	require_once('connection.php');
	require_once('functions.php');
	// require_once('../SwiftMailer/vendor/autoload.php');
	
	$error = array();
	if (isset($_POST['submit'])) {

		$name = isset($_POST['name'])?trim($_POST['name']): '';

		$email = isset($_POST['email'])?trim($_POST['email']): '';

	

		$subject = isset($_POST['subject'])?trim($_POST['subject']): '';
		$message = isset($_POST['message'])?trim($_POST['message']): '';

		if ($name == "" || $email == "" || $subject == "" || $message == "" ) {
			$error[] = urlencode("All fields are required");
		}else{
			
			$name = trimData($_POST['name']);
			$email = trimData($_POST['email']);
			
			$subject = trimData($_POST['subject']);
			$message = trimData($_POST['message']);

		}
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$error[] = urlencode("Invalid email format");
		}
		if(empty($error)){
			
			$name = mysql_prep($connect, $name);
			$email = mysql_prep($connect, $email);
			$subject = mysql_prep($connect, $subject);
			$message = mysql_prep($connect, $message);

			


			

			$check = "SELECT * FROM users WHERE email = '$email'";
			$check_result = 
			mysqli_query($connect, $check);
			if (mysqli_num_rows($check_result) == 0) {
				$exist = "user with email address does not exists";
				header("location: ../public/contact.php?error=".$exist);
			}else{
				$main_date = date("Y-m-d");
				$sql = "INSERT INTO contacts(name,email,subject,message,main_date) VALUES( '$name', '$email', '$subject', '$message', '$main_date')";
				$result = mysqli_query($connect, $sql);
				if($result){

				// $messsage1 = Swift_Message::newInstance()

				// //the subject of your mail
				// ->setSubject($subject)

				// //set from address(es)
				// ->setFrom(array($email => 'MySite'))

				// //to address(es)
				// ->setTop(array('support@mysite.com' => 'mysite'))

				// //Here you put the connect of your mail
				// ->setBody($message, 'text/html');

				// if(Swift_Mailer::newInstance(Swift_MailTransport::newInstance()) -> send($messsage1)){
				// 	$success = "email sent";
				// 	header('location: ../public/contact.php/success='.$success);
				// }else{
				// 	$error = "email sending error";
				// 	header('location: ../public/contact.php/error='.$error);
				// }	
					
					$success = "message sent";header("location: ../public/contact.php?success=".$success);
					
				
				}else{
					$failed = "message sending failed"; header("location: ../public/contact.php?error=".$failed);
				}
			}
		}else{
			header("location: ../public/contact.php?error=".join($error, urlencode('<br>')));
		}

	}

 ?>