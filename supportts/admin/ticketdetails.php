<?php session_start();
//error_reporting(0);
// Database Connection
include('includes/config.php');
//Validating Session
if(strlen($_SESSION['aid'])==0)
{ 
header('location:index.php');
}
else{

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
$tno=$_POST['ticketno'];
$tid=$_POST['ticketid'];
$tdesc=$_POST['tdesc'];
$tstatus=$_POST['ticketstatus'];
If($_SESSION['utype']==1):
$rby='Admin';
else:
$rby='Agent'; endif;  
$officialid=$_SESSION['aid'];
$document1=$_FILES["attachment"]["name"];
if($document1!=''){
$extension = substr($document1,strlen($document1)-4,strlen($document1));
$doc1=md5($document1).time().$extension;   
$mimetype = $_FILES['attachment']['type'];
if(!in_array($mimetype, array('image/jpeg', 'image/gif', 'image/png','application/pdf','application/vnd.openxmlformats-officedocument.wordprocessingml.document","application/msword'))) {
         echo '<script> alert("Invalid format of attachment. Please upload a valid format (.jpg, .jpeg, .png, .pdf,.doc)");</script>';

} else{
$docpath="../ticketdocs/".$tno;
move_uploaded_file($_FILES['attachment']['tmp_name'], $docpath.'/'. $doc1);

$query=mysqli_query($con,"insert into tbltickethistory(ticketID,ticketNo,ticketDescription,supportFile,remarkBy,officialId,ticketStatus) values('$tid','$tno','$tdesc','$doc1','$rby','$officialid','$tstatus')");
 //if query run successfully
if($query)
{
mysqli_query($con,"update tbltickets set ticketStatus='$tstatus' where id='$tid'");  
echo '<script>alert("Your Ticket details successfully updated")</script>';
unset( $_SESSION['token']); // unset session token after submiiting
echo "<script>window.location.href='all-tickets.php'</script>";
}
// If query not run
else
{
 echo '<script> alert("Something went wrong. please try again.");</script>';
}
} } else {

$query=mysqli_query($con,"insert into tbltickethistory(ticketID,ticketNo,ticketDescription,supportFile,remarkBy,officialId,ticketStatus) values('$tid','$tno','$tdesc','$doc1','$rby','$officialid','$tstatus')");
 //if query run successfully
if($query)
{
 mysqli_query($con,"update tbltickets set ticketStatus='$tstatus' where id='$tid'");   
echo '<script>alert("Your Ticket details successfully updated")</script>';
unset( $_SESSION['token']); // unset session token after submiiting
echo "<script>window.location.href='all-tickets.php'</script>";
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
  <title>Support Ticket System  | New Tickets</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
<?php include_once("includes/navbar.php");?>
  <!-- /.navbar -->

 <?php include_once("includes/sidebar.php");?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
           <?php $tid=intval($_GET['tid']);
            $tno=$_GET['tno']; ?>
            <h1>#<?php echo $tno;?> Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">New Tickets</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
        

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Tickets Details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                   <table id="" class="table table-bordered table-striped">

                  <tbody>
<?php 
$query=mysqli_query($con,"select * from tbltickets where id='$tid'");
$count=mysqli_num_rows($query);
if($count>0){
while($result=mysqli_fetch_array($query)){
//$tid=$result['id'];
?>

                  <tr>
                    <th width="180">Ticket No.</th>
                    <td><?php echo $result['ticketNo'];?></td>
                    <th>Creation Date</th>
                <td><?php $cdate=$result['creationDate'];
                  echo date("d-m-Y H:i:s", strtotime($cdate));?></td>
                  </tr>
                  <tr>
                    <th>Email Id</th>
                    <td><?php echo $result['emailId']?></td>
                    <th>Ticket Category</th>
                   <td><?php echo $result['ticketCategory']?></td>
                 </tr>
                 <tr>
                  <th>Ticket Category</th>
                   <td><?php echo $result['ticketSubject']?></td>
                   <th>Priority</th>
             <td><?php $priority=$result['priority'];
                   if($priority=='1'): ?>
<button type="button" class="btn btn-dark btn-xs">Urgent</button>
<?php  elseif($priority=='2'): ?>
<button type="button" class="btn btn-danger btn-xs">High</button>
<?php elseif($priority=='3'): ?>
<button type="button" class="btn btn-success btn-xs">Medium</button>
<?php elseif($priority=='4'): ?>
<button type="button" class="btn btn-warning btn-xs">Low</button>
             <?php endif;    ?></td>
                  </tr>
                  <tr>
             <th>Ticket Description</th>
                    <td colspan="3"><?php echo $result['ticketDescription']?></td>
        </tr>
    <tr>
                  <th>Final Status</th>
                   <td><?php $fstatus=$result['ticketStatus'];
                   if($fstatus==''): ?>
<button type="button" class="btn btn-secondary btn-xs">New Ticket</button>
<?php  elseif($fstatus=='In Process'): ?>
<button type="button" class="btn btn-info btn-xs"><?php echo htmlentities($fstatus);?></button>
<?php elseif($fstatus=='on Hold'): ?>
<button type="button" class="btn btn-warning btn-xs"><?php echo htmlentities($fstatus);?></button>
<?php elseif($fstatus=='Resolved'): ?>
<button type="button" class="btn btn-success btn-xs"><?php echo htmlentities($fstatus);?></button>
             <?php endif;    ?></td>
                   <th>Attached File (if any)</th>
                    <td><a href="../ticketdocs/<?php echo $result['ticketNo']?>/<?php echo $result['supportFile']?>" target="blank">Click Here</a></td>
                  </tr>

      </tbody>
    </table><br />
<!------Ticket History --------------->
<?php 
$ret=mysqli_query($con,"select * from tbltickethistory where ticketID='$tid'");
$num=mysqli_num_rows($ret);
if($num>0){
?>

         <table id="" class="table table-bordered table-striped">
          <tr>
            <th colspan="5" style="text-align:center; font-size:20px;">Ticket History</th>
          </tr>
          <tr>
            <th width="527">Ticket Updated Details</th>
            <th>Attached File (if any)</th>
            <th>Status</th>
            <th>Updated By</th>
            <th>Date</th>
          </tr>
          <?php while($row=mysqli_fetch_array($ret)){ ?>
            <tr>
<td><?php echo $row['ticketDescription']?></td>
<td> <?php if($row['supportFile']==''): echo "NA"; else:?>
<a href="../ticketdocs/<?php echo $row['ticketNo']?>/<?php echo $row['supportFile'];?>" target="blank">Click Here</a>
<?php endif;?>
</td>
     <td><?php $hstatus=$row['ticketStatus'];
                   if($hstatus==''): ?>
<button type="button" class="btn btn-secondary btn-xs">New Ticket</button>
<?php  elseif($hstatus=='In Process'): ?>
<button type="button" class="btn btn-info btn-xs"><?php echo htmlentities($hstatus);?></button>
<?php elseif($hstatus=='on Hold'): ?>
<button type="button" class="btn btn-warning btn-xs"><?php echo htmlentities($hstatus);?></button>
<?php elseif($hstatus=='Resolved'): ?>
<button type="button" class="btn btn-success btn-xs"><?php echo htmlentities($hstatus);?></button>
             <?php endif;    ?></td>

<td><?php echo $row['remarkBy']?></td>
  <td><?php $udate=$row['postingDate'];
                  echo date("d-m-Y H:i:s", strtotime($udate));?></td>
</tr>
           <?php } ?> 

         </table>
<?php } ?>
    <!----Action ----->
         <table id="" class="table table-bordered table-striped">

                  <tbody>
 
<form method="post" enctype="multipart/form-data">
<?php if($fstatus=='' || $fstatus=='In Process' || $fstatus=='on Hold'): ?>
  
    <input type="hidden" name="csrftoken" value="<?php echo htmlentities($_SESSION['token']); ?>" />
    <input type="hidden" value="<?php echo htmlentities($tno);?>" name="ticketno">
      <input type="hidden" value="<?php echo htmlentities($tid);?>" name="ticketid">
<tr>
  <th>Ticket Remark<span style="color:red">*</span> </th>
  <td colspan="3"> <textarea id="tdesc" name="tdesc" class="form-control" rows="5" required></textarea></td>
</tr>
<tr>
  <th>Attachment</th>
  <td colspan="3">       <input type="file" class="form-control" id="attachment" name="attachment"></td>
</tr>
<tr>
  <th>Ticket Status <span style="color:red">*</span></th>
  <td colspan="3"><select class="form-control" name="ticketstatus" id="ticketstatus" required>
    <option value="">Select</option>
    <option value="In Process">In Process</option>
    <option value="on Hold">on Hold</option>
    <option value="Resolved">Resolved</option>
</select>
  </td>
</tr>
<tr>
  <td></td>
  <td colspan="3"> <input type="submit" value="Update Ticket" name="submit" class="btn btn-success float-right"></td>
</tr>



<?php endif; ?>
</form>                  </tr>
         <?php } } else{ ?>
        <tr>
      <th colspan="3" style="color:red">No Record Found</th>
        </tr>
         <?php } ?>
             
                  </tbody>

                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php include_once('includes/footer.php');?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../plugins/jszip/jszip.min.js"></script>
<script src="../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>
<?php } ?>