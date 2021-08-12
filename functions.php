<?php
	require_once("connection.php");
	require_once("header.php");

	
	function trimData($data){
		$data = htmlspecialchars($data);
		$data = trim($data);
		$data = stripcslashes($data);

		return $data;
	}

	function password_encrypt($pass){
		$new_pass = sha1(md5(sha1(md5($pass))));

		return $new_pass;
	}


	function mysql_prep($connect, $string){
		$escape_string = mysqli_real_escape_string($connect, $string);

		return $escape_string;
	}
	function compressImage($source, $destination, $quality){
		// get image info

		$imageinfo = getimagesize($source);
		$mime = $imageinfo['mime'];

		//creata a new image from file

		switch ($mime) {
			case 'image/jpeg':
				$image = imagecreatefromjpeg($source);
				break;
			
			case 'image/png':
				$image = imagecreatefrompng($source);
				break;

			case 'image/gif':
				$image = imagecreatefromgif($source);
				break;
			default:
				$image = imagecreatefromjpeg($source);


		}

		// save image

		imagejpeg($image, $destination, $quality);

		// return compressed image
		return $destination;
	}
	?>
	<?php
	function indexmarket(){
	global $connect;
	 
                    if (isset($_SESSION['id'])){
                    	$id = $_SESSION['id'];
                    	 $sql = "SELECT * FROM category";
		                $result1 = mysqli_Query($connect, $sql);
		                while ($row = mysqli_fetch_assoc($result1)){
		                $cat_id = $row['cat_id'];
		                $cat_name = $row['cat_name'];
                    $sql = "SELECT * FROM market WHERE item_status = 1 AND user_id != $id  ORDER BY RAND() LIMIT 6";
                    $result1 = mysqli_Query($connect, $sql);
                    while ($row = mysqli_fetch_assoc($result1)){;
                    $marketid = $row['id'];
                    $item_name = $row['item_name'];
                    $user_id = $row['user_id'];
                    $cat_id = $row['cat_id'];
                    $item_duration = $row['item_duration'];
                    
                    $item_category = $row['item_category'];
                    $item_image = $row['item_image'];
                    $item_date = $row['item_date'];

             ?>
                    <div class="col-sm-4">
						<div class="card">
							<div class="card-header">
								<img src="../includes/market/<?=$item_image?>" alt="" class="img-fluid">
							</div>
							<div class="card-body">
								<label><a href="category_market.php?id=<?php echo base64_encode($cat_id)?>"><?=$item_category?></a></label>
								<p><?=$item_name?></p>
								<p><?=$item_duration?></p>
							</div>
						</div>
                    </div>
                <?php }?>
                <?php } ?>
                <?php }else{?>
                    <div class="row diffProp">
                <?php
                    $sql1 = "SELECT * FROM category";
                    	
                     $result = mysqli_Query($connect, $sql1);
		                while ($row = mysqli_fetch_assoc($result)){
		                $cat_id = $row['cat_id'];
		                $cat_name = $row['cat_name'];


                $sql = "SELECT * FROM market WHERE item_status = 1 ORDER BY RAND() LIMIT 1";
                $result1 = mysqli_Query($connect, $sql);
                while ($row = mysqli_fetch_assoc($result1)){;
                $marketid = $row['id'];
                $item_name = $row['item_name'];
                $user_id = $row['user_id'];
                $item_duration = $row['item_duration'];
                $item_location = $row['item_location'];
                $item_category = $row['item_category'];
                $item_image = $row['item_image'];
                $item_date = $row['item_date'];

             ?>
                    <div class="col-sm-4">
						<div class="card">
							<div class="card-header">
								<img src="../includes/market/<?=$item_image?>" alt="" class="img-fluid">
							</div>
							<div class="card-body">
								<label><a href="category_market.php?id=<?php echo base64_encode($cat_id)?>"><?=$item_category?></a></label>
								<p><?=$item_name?></p>
								<p><?=$item_location?></p>
							</div>
						</div>
                    </div>
                <?php }?>
            <?php }?>
				</div>
            <?php }
                    
    

	}
?>
<?php
	function session(){
		if (isset($_SESSION["id"])) {
	      
	    }else{
	        $error = "please login first";
	        header('location: ../public/login.php?error='.$error);
	    }  
    }


?>