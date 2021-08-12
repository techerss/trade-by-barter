<?php
	 require_once("connection.php");

	 $output = '';

	 $query = "SELECT * FROM market WHERE item_status = 1 AND active = 1 AND item_name LIKE '%".$_POST['keyword']."%' ";


	 $result = mysqli_query($connect, $query);
	 if(mysqli_num_rows($result) > 0){
	 	$output.= ' <div class="container items"><br><br> <h3> Search Result : </h3> <div class="row text-center market-container">';

	 	
	 	while($row = mysqli_fetch_assoc($result)){
	 		$item_name = $row['item_name'];
	 		$item_image =$row['item_image'];
	 		$marketid = $row['id'];
                
	 		

	 		$output.=' 
			<a href="singlemarket-item.php?id='.base64_encode($marketid).'">
                <div class="col-sm-3">
                    <img src="../includes/market/'.$item_image.'" alt="" class="img-fluid" width="100%">
					<div class="tradeDetails">
						<p><a href="singlemarket-item.php?id='.base64_encode($marketid).'">'.$item_name.'</a></p>
					</div>
                </div>
			</a>';

	 	}
	 	$output.= ' </div></div>';
	 	 
	 	echo "$output";
	 }else{
	 	echo '<br><br><p align="center"> No Result Found </p>';
	 }




?>