<?php

session_start();
$backwardSeparator = "../../";
$thisFilePath =  $_SERVER['PHP_SELF'];
$userId 	= $_SESSION['loginId'];
$userCompanyId = $_SESSION['companyId'];
$userLocationId = $_SESSION['locationId'];

include  "dataAccess/accessController.php";

if($_REQUEST['submit']=="Test"){
  session_unset(); 
        session_destroy(); 
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>ONLINE REGISTRATION</title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo $backwardSeparator;?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="<?php echo $backwardSeparator;?>css/sb-admin-2.css" rel="stylesheet">
  <link href="<?php echo $backwardSeparator;?>css/hover.css" rel="stylesheet">
<style>
       /* Button used to open the contact form - fixed at the bottom of the page */
.open-button {
  background-color: #005407;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 250px;
  border-radius:10px;
}

/* The popup form - hidden by default */
.form-popup {
  display: none;
  position: fixed;
  bottom: 0;
  border-radius:10px;
  right: 15px;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 270px;
  padding: 10px;
  border-radius:10px;
  background-color: white;
}

/* Full-width input fields */
.form-container input[type=text], .form-container input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 5px 0;
  border: none;
  background: #f1f1f1;
}

/* When the inputs get focus, do something */
.form-container input[type=text]:focus, .form-container input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/login button */
.form-container .btn {
  background-color: #04AA6D;
  color: white;
  padding: 8px 10px;
  border: none;
  border-radius:10px;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: #c20729;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}
  </style>
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php include 'menu.php';?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php include "{$backwardSeparator}top.php";?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Content Row -->
          <div class="row">

            <!-- System Administration -->
            <div class="col-xl-10 col-md-10 mb-0 hover-zoomin">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-auto">
                    <div class="text-lg text-left font-weight-bold text-heder-text mb-1">Full Time Private Dental Surgeries</div>
                  </div>
                  <div class="col-auto">
                  <center><img class="rounded-circle border-red border-2" style="border:5px solid black;width:100px;height:100px" src="../../img/core/dental_su.jpg" alt="" /></center>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->
<iframe src="../../Document/Full_time_Dental_Surgeries.pdf" frameborder="0" height="350px" width="100%"></iframe>
      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; <?php echo date('Y') ?> : Sri Lanka Telecom[Services] Limited. All Rights Reserved</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="<?php echo $backwardSeparator;?>logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>
<button class="open-button" onclick="openForm()">For More Details</button>

 <div class="form-popup" id="myForm">
  <form action="" class="form-container">
      <h4 style="color: #04AA6D"><b>Contact Us..</b></h4>
      <label><center> <img src="../../img/callgl.png"/></center> </label>
      <label><b>Mrs. Chethya Aravindi</b></label><br/>

    <label><b>011-2672911</b></label>

    
    <input  type="button" class="btn cancel" onclick="closeForm()" value="Close">
  </form>
</div> 
<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>
  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo $backwardSeparator;?>vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo $backwardSeparator;?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo $backwardSeparator;?>vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo $backwardSeparator;?>js/sb-admin-2.min.js"></script>

</body>

</html>
