<?php session_start();
include_once('admin/includes/config.php');
//Genrating CSRF Token
if (empty($_SESSION['token'])) {
$_SESSION['token'] = bin2hex(random_bytes(32));
}

// Code for Inserting Data 
if(isset($_POST['submit']))
{
//Verifying CSRF Token
if(!empty($_POST['csrftoken'])) {
if(hash_equals($_SESSION['token'], $_POST['csrftoken'])) {
//Getting Post Values
$fname=$_POST['fullname'];
$emailid=$_POST['emailid'];
$catt=$_POST['category'];
$tsub=$_POST['tsubject'];
$tdesc=$_POST['tdesc'];
$priority=$_POST['priority'];
//Getting Complain Number
$query=mysqli_query($con,"SELECT MAX(id) as ticketno FROM tbltickets");             
while($row =mysqli_fetch_array($query)){
$tno=$row['ticketno'];
}
$tcnogen=date('Y').date('m').'-';
$tcno=$tcnogen.'000'.$tno+1;

// Document 1 
$document1=$_FILES["attachment"]["name"];
$extension = substr($document1,strlen($document1)-4,strlen($document1));
$doc1=md5($document1).time().$extension;   
$mimetype = $_FILES['attachment']['type'];
if(!in_array($mimetype, array('image/jpeg', 'image/gif', 'image/png','application/pdf','application/vnd.openxmlformats-officedocument.wordprocessingml.document","application/msword'))) {
         echo '<script> alert("Invalid format of attachment. Please upload a valid format (.jpg, .jpeg, .png, .pdf,.doc)");</script>';

} else{
//$ticketno=date('Y').date('m').'000'.$tcno+1;   
if(!is_dir("ticketdocs/".$tcno)):
mkdir("ticketdocs/".$tcno,0777); endif;
$docpath="ticketdocs/".$tcno;
move_uploaded_file($_FILES['attachment']['tmp_name'], $docpath.'/'. $doc1);

mysqli_query($con,"insert into tbltickets(ticketNo,fullName,emailId,ticketCategory,ticketSubject,ticketDescription,supportFile,priority) values('$tcno','$fname','$emailid','$catt','$tsub','$tdesc','$doc1','$priority')");
 //if query run successfully
if($query)
{
echo '<script>alert("Your Ticket is submitted and your Ticket Number is "+"'.$tcno.'")</script>';
unset( $_SESSION['token']); // unset session token after submiiting
echo "<script>window.location.href='search-ticket.php'</script>";
}
// If query not run
else
{
 echo '<script> alert("Something went wrong. please try again.");</script>';
}


} 

}}}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Support Ticket System  | Create Ticket</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
</head>
<body>
<!-- Site wrapper -->
<div>
  <!-- Navbar -->
<?php include_once('inc/header.php');?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->


  <!-- Content Wrapper. Contains page content -->
  <div style="margin:2%">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create Ticket</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Create Ticket</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">General</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">

<form name="ticket" method="post" enctype="multipart/form-data">
<input type="hidden" name="csrftoken" value="<?php echo htmlentities($_SESSION['token']); ?>" />
    <div class="row">
                  <div class="col-md-6">
              <div class="form-group">
                <label for="inputName">Name</label>
                <input type="text" id="fullname" name="fullname" required class="form-control">
              </div>
            </div>
            <div class="col-md-6">

               <div class="form-group">
                <label for="inputStatus">Email id</label>
                <input type="email" id="emailid" name="emailid" required class="form-control">
              </div>
            </div></div>


                <div class="row">

  <div class="col-md-6">
               <div class="form-group">
                <label for="inputStatus">Category</label>
                <select id="category" name="category" required class="form-control custom-select">
                  <option value="">Select one</option>
                  <?php $query=mysqli_query($con,"select categoryName,id from tblcategory");
                  while($row=mysqli_fetch_array($query)){
                  ?>
                  <option value="<?php echo htmlentities($row['categoryName'])?>"><?php echo htmlentities($row['categoryName'])?></option>
                <?php } ?>
                </select>
              </div>
            </div>

                  <div class="col-md-6">
              <div class="form-group">
                <label for="inputName">Subject</label>
                <input type="text" id="tsubject" name="tsubject" class="form-control" required>
              </div>
            </div>
          
          </div>
          <div class="form-group">
                <label for="inputDescription">Ticket Description</label>
              <textarea id="summernote" name="tdesc" required rows="8"></textarea>
              </div>

                <div class="row">
      <div class="col-md-6">
              <div class="form-group">
                <label for="inputName">Attachment</label>
              <input type="file" class="form-control" id="attachment" name="attachment" required>
              </div>
            </div>

  <div class="col-md-6">
               <div class="form-group">
                <label for="inputStatus">Priority</label>
         <select class="form-control" id="priority" name="priority" required>
                    <option value="">Select Priority</option>
                                            <option value="1">Urgent</option>
                                            <option value="2">High</option>
                                            <option value="3">Medium</option>
                                            <option value="4">Low</option>
                                    </select>
              </div>
            </div>

            
          
          </div>

   <div class="row">
        <div class="col-12">
          <input type="reset"  class="btn btn-secondary">
          <input type="submit" value="Create new Ticket" name="submit" class="btn btn-success float-right">
        </div>
      </div>

</form>

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
              </div>
   
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include_once('inc/footer.php');?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<script>
  $(function () {
    // Summernote
    $('#summernote').summernote()

    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
      mode: "htmlmixed",
      theme: "monokai"
    });
  })
</script>
</body>
</html>
