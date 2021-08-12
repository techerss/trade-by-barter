<?php

	require_once('connection.php');
	require_once('functions.php');
if (isset($_POST['multiple'])) {
		$item_id = $_POST['id'];

		$allow = array('jpg',  'jpeg', 'png', 'gif');

		
		   
		   if($_FILES['file']['name'] !=['']){
		       $image_count = sizeof($_FILES['file']['name']);

		       for ($i=0; $i < $image_count; $i++) { 
		           $filename = $_FILES['file']['name'][$i];
		           $filetmp = $_FILES['file']['tmp_name'][$i];
		           $filesize = $_FILES['file']['size'][$i];

		           $fileext = explode('.', $filename);
		           $fileactualext = strtolower(end($fileext));

		           $pic = uniqid('',true). '.' .$fileactualext;
		           $location = 'multiple/'.$pic;

		           if (in_array($fileactualext, $allow)) {
		                if ($filesize < 800000) {
		                       $compressed = compressImage($filetmp, $location, 35);
		                      if($compressed){
		                      
		                      	
		                        $sql = "INSERT INTO multiple_pic(
		                            market_id, pic)VALUES(
		                            '$item_id','$pic')";
		                        $result = mysqli_query($connect, $sql);        
		                       }else{
		                              $failed = "Compression failed";
		                             header("location: ../public/multiple_upload.php?error=".$failed);
		                           }
		                }else {
		                     $failed = "file too large";
		                        header("location: ../public/multiple_upload.php?error=".$failed);
		                        }
		            }else {
		                $failed = "file uploaded is not an image";
		                header("location: ../public/multiple_upload.php?error=".$failed);
		              }
		         
		           
		       }$success = "image uploaded";
		        header("location: ../public/multiple_upload.php?success=".$success);
		   }else {
		    $failed = "please upload an image file";
		    header("location: ../public/multiple_upload.php?error=".$failed);
		   }
		

	
	}else{
		$failed = "failed";
		    header("location: ../public/multiple_upload.php?error=".$failed);
	}


?>