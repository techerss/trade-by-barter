<?php
	require_once('../SwiftMailer/vendor/autoload.php');
	require_once('connection.php');

	$error = array();
	if(isset($_POST['reset'])){
		$email = isset($_POST['email2'])?trim($_POST['email2']): '';

		if($email == ""){
			$error[] = urlencode('field required');
		}
		if(empty($error)){
			$sql = 'SELECT * FROM users WHERE email  = "$email" AND deleted = 1';
			$result = mysqli_query($connect, $sql);
			if(mysqli_num_rows($result) > 0){
				$data = mysqli_fetch_array($result);

				$mailcontent = '
				<div class="container">
				<div class="row"
					<div>
						<h3 class="text-center">MYSITE</h3>
						<p>we recievd a request to reset your password, if this was you, click the link <b><i><a href="https://www.mysite.com/public/passwordreset.php?email='.$email.'">password reset</a></i></b> to reset password or ignore and nothing will happen to your account.</p>
					</div>
				</div>
				</div>';

				$messsage = Swift_Message::newInstance()

				//the subject of your mail
				->setSubject("password Recovery")

				//set from address(es)
				->setFrom(array('support@mysite.com' => 'MySite'))

				//to address(es)
				->setTop(array($email => 'mysite'))

				//Here you put the connect of your mail
				->setBody($mailcontent, 'text/html');

				if(Swift_Mailer::newInstance(Swift_MailTransport::newInstance()) -> send($messsage)){
					$success = "check our mail";
					header('location: ../public/forgot.php/success='.$success);
				}else{
					$error = "check your mail";
					header('location: ../public/forgot.php/error='.$error);
				}
			}else{
				$failed = "Email does not exist";
				header('location: ../public/forgot.php?error='.$failed);
			}
		}
	}












?>