<?php
	include "includes/conn.php";

	if(isset($_POST['add'])){
		$firstname = $_POST['fname'];
		$lastname = $_POST['lname'];
		$dept = $_POST['dept'];
		$matric = $_POST['matric'];
		$receiptno = $_POST['receiptno'];
		$stat=1;
		$firstname = stripslashes($firstname);
		$lastname = stripslashes($lastname);
		$dept = stripslashes($dept);
		$matric = stripslashes($matric);
		$receiptno = stripslashes($receiptno);

  //Schfee
	$file2= addslashes(file_get_contents($_FILES['schfee']['tmp_name']));
	$image_name2= addslashes($_FILES['schfee']['name']);
	$image_size2= filesize($_FILES['schfee']['tmp_name']);
	$newname2=$lastname.'-'.$firstname.$matric;
$ext2=pathinfo($_FILES['schfee']['name'], PATHINFO_EXTENSION);
	//fibsu
	$file3= addslashes(file_get_contents($_FILES['fibsu']['tmp_name']));
	$image_name3= addslashes($_FILES['fibsu']['name']);
	$image_size3= filesize($_FILES['fibsu']['tmp_name']);
	$newname3=$lastname.'-'.$firstname.$receiptno;
$ext3=pathinfo($_FILES['fibsu']['name'], PATHINFO_EXTENSION);
$max=500000;
	$dir="votersdoc/".$newname2;
			if (!is_dir($dir)) {
		
			mkdir($dir, 0755);
}

//new filename
			$newnames2=$newname2.'.'.$ext2;
			$newnames3=$newname3.'.'.$ext3;
			//end
	if(($image_size2<=$max) && ($image_size3<=$max)){		

		$verifysql = "SELECT * FROM voters WHERE matric = '$matric' or receiptno='$receiptno'";
		$query = $conn->query($verifysql);

		if($query->num_rows < 1){
		
		$sql = "INSERT INTO voters (firstname, lastname, dept, matric, receiptno, fibsupics, feepics, status) VALUES ('$firstname', '$lastname', '$dept', '$matric', '$receiptno', '$newnames2', '$newnames3','$stat')";
             }else{
			echo ("<script LANGUAGE='JavaScript'>
    alert('Bio-Data Cannot Be Processed, Registration Data Already $image_size2  Exist in Database');
    window.location.href='index.php';
    </script>");
		}
		if($conn->query($sql)){
		
			//sch fee upload
			move_uploaded_file($_FILES['schfee']['tmp_name'], $dir."/" . $newnames2);	
			//fibsu upload
           move_uploaded_file($_FILES['fibsu']['tmp_name'], $dir."/" . $newnames3);	
      

			echo ("<script LANGUAGE='JavaScript'>
    alert('Bio-Data Recorded Successfully');
    window.location.href='index.php';
    </script>");
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}else{
			echo ("<script LANGUAGE='JavaScript'>
				alert('File Size : $image_size2 or $image_size3, More Than: 500KB');
			window.location.href='capture.php';
			</script>");
		}

	}

?>