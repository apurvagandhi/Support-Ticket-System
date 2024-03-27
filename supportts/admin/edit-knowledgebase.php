<?php session_start();
// Database Connection
include('includes/config.php');
//Validating Session
if(strlen($_SESSION['aid'])==0)
  { 
header('location:index.php');
}
else{
// Code for update KnowledgeBase
if(isset($_POST['submit'])){

 $kbid=intval($_GET['kbid']); 
//Getting Post Values  
$cname=$_POST['catname'];
$title=$_POST['title'];
$description=$_POST['description'];
$addedby=$_SESSION['aid'];
$query=mysqli_query($con,"update  tblknowledgebase set categoryName='$cname',titleName='$title',description='$description'");
if($query){
echo "<script>alert('Knowledgebase updated successfully.');</script>";
echo "<script type='text/javascript'> document.location = 'manage-knowledgebase.php'; </script>";
} else {
echo "<script>alert('Something went wrong. Please try again.');</script>";
}
}


  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Support Ticket System   | Edit knowledgeBase</title>

  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">

  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="../plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="../plugins/bs-stepper/css/bs-stepper.min.css">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="../plugins/dropzone/min/dropzone.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
<?php include_once("includes/navbar.php");?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
 <?php include_once("includes/sidebar.php");?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit KnowledgeBase</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Edit KnowledgeBase</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-10">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">KnowledgeBase Details</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form  method="post" enctype="multipart/form-data">
                <div class="card-body">
<?php $kbid=intval($_GET['kbid']);
$query=mysqli_query($con,"select AdminName,titleName,description,postingDate,categoryName,tblknowledgebase.id from tblknowledgebase
left join tbladmin on tbladmin.ID=tblknowledgebase.addedBy where tblknowledgebase.id='$kbid'");
$cnt=1;
while($result=mysqli_fetch_array($query)){
?>
 <div class="form-group">
                    <label for="exampleInputFullname">Category</label>
                   <select id="catname" name="catname" required class="form-control custom-select">
                  <option value="<?php echo $result['categoryName']?>"><?php echo $result['categoryName']?></option>
                  <?php $query1=mysqli_query($con,"select categoryName,id from tblcategory");
                  while($row1=mysqli_fetch_array($query1)){
                  ?>
                  <option value="<?php echo htmlentities($row1['categoryName'])?>"><?php echo htmlentities($row1['categoryName'])?></option>
                <?php } ?>
                </select>
                  </div>

<!--Title--->
   <div class="form-group">
                    <label for="exampleInputFullname">Title</label>
                    <input type="text" class="form-control" value="<?php echo htmlentities($result['titleName'])?>" id="title" name="title" placeholder="Enter the title" required>
                  </div>

                     <div class="form-group">
                    <label for="exampleInputFullname">Description</label>
                    <textarea  class="form-control" id="description" name="description" rows="8" placeholder="Enter the title" required><?php echo htmlentities($result['description'])?></textarea>
                  </div>


<?php } ?>



  <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="submit" id="submit">Update</button>
                </div>
      
                </div>
                <!-- /.card-body -->
          
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (left) -->








    
              </form>
       
  
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php include_once('includes/footer.php');?>

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- bs-custom-file-input -->
<script src="../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- Page specific script -->
<script src="../plugins/select2/js/select2.full.min.js"></script>
<script>
$(function () {
  bsCustomFileInput.init();
});
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
});
</script>
</body>
</html>
<?php } ?>
