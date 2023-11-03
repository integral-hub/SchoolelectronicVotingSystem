<?php
	include 'includes/session.php';
	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$sql = "SELECT * FROM voters WHERE id = $id";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();
	

if ($row['status']==1) {
		
		$sql = "UPDATE voters SET status = 0 WHERE id = '$id'";
		$updatevote = "UPDATE votes SET status ='1' WHERE voters_id = '$id'";
		if($conn->query($sql) && $conn->query($updatevote)){
			$_SESSION['error'] = 'Vote Nullified successfully';
		}
	}else{

		$sql = "UPDATE voters SET status = 1 WHERE id = '$id'";
		$updatevote = "UPDATE votes SET status ='0' WHERE voters_id = '$id'";
		if($conn->query($sql) && $conn->query($updatevote)){
			$_SESSION['success'] = 'Voter Updated successfully';
		}
		
	}

	
}
header('location: voters.php');
?>