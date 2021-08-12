<?php

$mailcontent = '
				<div class="container">
				<div class="row"
					<div>
						<h3 class="text-center">MYSITE</h3>
						<p>A trade request from <?=$firstname?> was sent to you<b><i><a href="https://www.mysite.com/public/notification.php">click to see trade request</a></i></b></p>
					</div>
				</div>
				</div>';

				$messsage = Swift_Message::newInstance()

				//the subject of your mail
				->setSubject("password Recovery")

				//set from address(es)
				->setFrom(array('support@mysite.com' => 'MySite'))

				//to address(es)
				->setTop(array($email1 => 'mysite'))

				//Here you put the connect of your mail
				->setBody($mailcontent, 'text/html');

				Swift_Mailer::newInstance(Swift_MailTransport::newInstance()) -> send($messsage)
?>