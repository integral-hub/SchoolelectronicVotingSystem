<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Voters List
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Voters</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            
            <div class="box-body">

               <p> <button class="btn btn-primary btn-flat" onclick="ExportToExcel('xlsx')">Export table to excel</button>
                </p><br>

              <table id="example1" class="table table-bordered">
                <thead>
                  <th class="hidden"></th>
                  <th>ID</th>
                  <th>Full name</th>
                  <th>Matric No.</th>
                  <th>Department</th>
                  <th>FIBSU Receipt No.</th>
                  <th>School Fee Image</th>
                  <th>Receipt Image</th>
                  <th>Status</th>
                </thead>
                <tbody>
                  <?php
                  $ct=0;
                    $sql = "SELECT * FROM voters";
                      $query = $conn->query($sql);
                      while($row = $query->fetch_assoc()){
                        $dir=$row['lastname'].'-'.$row['firstname'].$row['matric']."/";
                        $status=$row['status'];
                      $fibsu = (!empty($row['fibsupics'])) ? '../votersdoc/'.$dir.$row['fibsupics'] : '../images/profile.jpg';
                      $fee = (!empty($row['feepics'])) ? '../votersdoc/'.$dir.$row['feepics'] : '../images/profile.jpg';
                      $ct+=1;
                      echo "
                        <tr>
                          <td class='hidden'></td>
                          <td>$ct</td>
                           <td>".$row['lastname']." ".$row['firstname']."</td>
                            <td>".$row['matric']."</td>
                          <td>".$row['dept']."</td>
                          <td>".$row['receiptno']."</td>
                          <td>
                          <a href='$fibsu' target='_blank' data-id='".$row['id']."'> <img src='".$fibsu."' width='40px' height='40px'></a>
                          </td>
                            <td>
        
                            <a href='$fee' target='_blank' data-id='".$row['id']."'> <img src='".$fee."' width='40px' height='40px'></a>
                          </td>
                          <td>";
                          if ($status==1){
                                       echo "         
                            <button class='btn btn-success btn-sm edit btn-flat' data-id='".$row['id']."'> DEVALIDATE</button>";
                            }else{
                              echo "
                             <button class='btn btn-danger btn-sm edit btn-flat' data-id='".$row['id']."'> VALIDATE</button>
                          </td>
                        </tr>
                      ";
                    }}
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>
    
  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/vverify_modal.php'; ?>
  <?php include 'includes/voters_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  $(document).on('click', '.edit', function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.delete', function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.photo', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.platform', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
  });

});

function getRow(id){
  $.ajax({
   type: 'POST',
    url: 'voters_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.id').val(response.id);
      $('#edit_firstname').val(response.firstname);
      $('#edit_lastname').val(response.lastname);
      $('#edit_password').val(response.password);
      $('.fullname').html(response.firstname+' '+response.lastname);
    }
  });
}
</script>
<script>function ExportToExcel(type, fn, dl) {
       var elt = document.getElementById('example1');
       var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
       return dl ?
         XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
         XLSX.writeFile(wb, fn || ('MySheetName.' + (type || 'xlsx')));</script>
         <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
</body>
</body>
</html>
