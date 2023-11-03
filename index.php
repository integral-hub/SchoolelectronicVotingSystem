<?php

    session_start(); 	
    if(isset($_SESSION['voter'])){
      header('location:home.php');
    
    }
  include "includes/conn.php";
	$id = 1;
		$sql = "SELECT * FROM starttime WHERE id ='$id'";
		$query = $conn->query($sql);
        while($row = $query->fetch_assoc()){
	
if ($row['start_status']==0) { 
	echo ("<script LANGUAGE='JavaScript'>
    window.location.href='../maintenance';
    </script>");
}else{ 
  
?>

<?php include "includes/header.php"; ?>
<body class="hold-transition login-page">
<div class="login-box">
  	<div class="login-logo">
  	
  		<b>Voters Login</b>
  	</div>
  	<div class="login-box-body">
    	<h4 class="login-box-msg" style="color: red">Sign in with your Matric/Form No.</h4>
    	

    	<form method="POST">
      		<div class="form-group has-feedback">
        		<input type="text" class="form-control" name="voter" placeholder="Matric/Form No." required>
        		<span class="glyphicon glyphicon-user form-control-feedback"></span>
      		</div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password" placeholder="Password" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
      		<div class="row">
    			<div class="col-xs-4">
          			<button type="submit" class="btn btn-primary btn-block btn-flat" name="login"><i class="fa fa-sign-in"></i> Sign In</button>

        		</div>
      		</div>
    	</form>
    	 </div>
       <h4><b><span style="color: red">New Voters?</span>  <a href="capture.php">Click Register</a></b></h4>
         
  
  
  	<?php
  	}}
  		if(isset($_SESSION['error'])){
  			echo "
  				<div class='callout callout-danger text-center mt20'>
			  		<p>".$_SESSION['error']."</p> 
			  	</div>
  			";
  			unset($_SESSION['error']);
  		}
  	?>
</div>
<?php
  


  if($_SERVER["REQUEST_METHOD"] == "POST"){

    $voter = $_POST['voter'];
    $password = $_POST['password'];
    $voter=stripslashes($voter);
    $password=stripslashes($password);

    $sql = "SELECT * FROM voters WHERE matric = '$voter'";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();

    if($query->num_rows < 1){
      $_SESSION['error'] = 'Cannot find voter with the ID';
    }
    else{
      if($password==$row['receiptno']){
        $_SESSION['voter'] = $row['id'];
      }
      else{
        $_SESSION['error'] = 'Incorrect password';
      }
    }
    
  }
 header('location:home.php');
  

?>

    
<?php  include "includes/scripts.php" ?>
</body>
</html>