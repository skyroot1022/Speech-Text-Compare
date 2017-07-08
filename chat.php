<?php
   include 'db.php';
   $query ="SELECT * FROM chat ORDER BY id DESC";
   $run=$conn->query($query);
			 
	while( $row = $run->fetch(PDO::FETCH_ASSOC) ){
	?>
		   
	<div id="chat_data">
	<span style="color:green;"><?php echo $row['name']; ?></span> :
    <span style="color:brown;"><?php echo $row['msg'];  ?></span>
	<span style="float:right;"><?php echo formatDate($row['date']); ?></span>
	</div>
 <?php } ?>