<?php
      session_start();
    if(isset($_SESSION['voter'])){
      header('location:home.php');
    }
  require_once "includes/conn.php";
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
  		<b>Bio Data Capturing</b>
  	</div>
  
  	<div class="login-box-body">
    	<p class="login-box-msg">FIBSU ELECTION 2022</p>

    	<form action="voters_add.php" method="POST" enctype="multipart/form-data">
      		<div class="form-group has-feedback">
        		<input type="text" class="form-control" name="fname" maxlength="15" placeholder="First Name" required>
        		<span class="glyphicon glyphicon-user form-control-feedback"></span>
      		</div>
            <div class="form-group has-feedback">
            <input type="text" class="form-control" name="lname" maxlength="15" placeholder="SurName" required>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
            <div class="form-group has-feedback">
            <input type="text" class="form-control" name="dept" maxlength="30" placeholder="Department" required>
            <span class="glyphicon glyphicon-list-alt form-control-feedback"></span>
          </div>
            <div class="form-group has-feedback">
            <input type="text" class="form-control" name="matric" maxlength="14" placeholder="Matric/Registration No." required>
            <span class="glyphicon glyphicon-education form-control-feedback"></span>
          </div>
           <div class="form-group has-feedback">
            <input type="text" class="form-control" name="receiptno" maxlength="10" placeholder="FIBSU Receipt No." required>
            <span class="glyphicon glyphicon-barcode form-control-feedback"></span>
          </div>
          <p style="color: red"><b>First Requirement (Max File Size: 500kb)</b></p>
            <div class="form-group has-feedback">
            <input type="file" class="form-control" id="file" name="schfee" accept="image/*" required>
            <span class="glyphicon glyphicon-camera form-control-feedback"></span>
          </div>
          <p style="color: red"><b>Second Requirement (Max File Size: 500kb)</b></p>
           <div class="form-group has-feedback">
            <input type="file" class="form-control" id="file" name="fibsu" accept="image/*" required>
            <span class="glyphicon glyphicon-camera form-control-feedback"></span>
          </div>
      		<div class="row">
    			<div class="col-xs-4">
          			<button type="submit" class="btn btn-primary btn-block btn-flat" name="add"><i class="fa fa-registered"></i>  Register</button>

        		</div>
      		</div>
    	</form>
           <h4><b><span style="color: red">If your Bio-Data is already Captured!!!</span>  Click <a href="index.php">Login</a> Cast your Vote</b></h4>
  	</div>
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
	
<?php  include "includes/scripts.php" ?>
<script>
  var filesize=document.getElementById("file");
  filesize.onchange=function(){
    if (this.files[0].size>500000) {
      alert("File Upload too big");
      this.value"";

    };
  };
</script>
</body>
</html>