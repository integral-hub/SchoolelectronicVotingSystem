<?php
	include 'includes/session.php';

         if(isset($_POST['add'])){
		$id = 1;
		$sql = "SELECT * FROM starttime WHERE id ='$id'";
		$query = $conn->query($sql);
        while($row = $query->fetch_assoc()){
	
if ($row['start_status']==0) {
		
		$sql = "UPDATE starttime SET start_status=1 WHERE id = '$id'";
		if($conn->query($sql)){
		$_SESSION['success'] = 'Voting Start successfully';
		}}
else {

		$sql = "UPDATE starttime SET start_status=0 WHERE id = '$id'";
		if($conn->query($sql)){
		
			$_SESSION['error'] = 'Voting Stopped successfully';	
		}
		
	}

}}
	header('location: chart.php');

?>