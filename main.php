<?php
session_start();
$backwardSeparator = "";
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

  <title>Online Registration</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
   <link rel="stylesheet" href="<?php echo $backwardSeparator;?>css/popup/style.css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.css" rel="stylesheet">
  <link href="css/hover.css" rel="stylesheet">
  
  <style type="text/css">
    .hover-zoomin img{
      width: 100px;
      max-width: 100px;
      min-width: 100px;
      max-height: 100px;
      min-height: 100px;
      height: 100px;
    }
    .logo {
      display: block;
      text-indent: -9999px;
      width: 40px;
      height: 40px;
      background:url(img/core/phsrc_gif.gif);
      background-size: 30px 38px;
      background-color: white;
    }
  </style>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="main.php">
        <!--<div class="sidebar-brand-icon rotate-n-15 logo">-->
        <div class="sidebar-brand-icon rotate-n-15 rounded-circle logo">
<!--          <img src="img/core/tree.svg" alt="Coconut Cultivation Board"/>-->
        </div>
        <div class="sidebar-brand-text mx-3">ONLINE REGISTRATION</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Home -->
      <li class="nav-item active">
        <a class="nav-link" href="main.php">
          <i class="fas fa-fw fa-home"></i>
          <span>Home</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>
      
      <li class="nav-item active">
        <a class="nav-link" >
            Private Health Services Regulatory Council.<br/><span style="text-align:justify">Ministry of Health</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" >
           <span style="text-align:justify">ACT No 21 of 2006</span></a>
      </li>
      
      <li class="nav-item active">
        <a class="nav-link" >
            <span style="text-align:justify">PHSRC<br/>No. 2A , CBM House ,<br/>4th Floor , Lake Drive ,<br/>Colombo 08</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" >
            <span style="text-align:justify">+94 011 2672 911 / 2672 912<br/><br/>+94 011 2672 913 <br/>phsrc2015@gmail.com</span></a>
      </li>
<div class="sidebar-heading">
        
        <br>
        
      </div>
    </ul>
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
				 <!-- Private Hospitals, Nursing Homes And maternity Homes. -->
            <div class="col-xl-4 col-md-6 col-sm-12 mb-4 hover-zoomin">
              <a class="card border-left-orange shadow py-5" href="presentation/phnh/index.php">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-lg text-center font-weight-bold text-gray mb-1">Private Hospitals, Nursing Homes And maternity Homes.</div>
                    </div>
                    <div class="col-auto">
                      <img class="rounded-circle border-orange border-2" style="border:5px solid black;" src="img/core/phnh.jpg" alt=""/>
                      <!--<i class="fas fa-users fa-2x text-gray-300"></i>-->
                    </div>
                  </div>
                </div>
              </a>
            </div>
            
            <!-- Medical Centers / Screening Centers  / Day Care Medical Centers / Channel Consultations -->
            <div class="col-xl-4 col-md-6 col-sm-12 mb-4 hover-zoomin">
              <a class="card border-left-blue shadow py-5" href="presentation/mcdc/index.php">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-lg text-center font-weight-bold text-gray mb-1">Medical Centers / Screening Centers  / Day Care Medical Centers / Channel Consultations</div>
                    </div>
                    <div class="col-auto">
                      <img class="rounded-circle border-blue border-2" style="border:5px solid black;" src="img/core/mcdc.jpg" alt=""/>
                      <!--<i class="fas fa-users fa-2x text-gray-300"></i>-->
                    </div>
                  </div>
                </div>
              </a>
            </div>
            
            <!-- Private Medical Laboratories -->
            <div class="col-xl-4 col-md-6 col-sm-12 mb-4 hover-zoomin">
              <a class="card border-left-lightgreen  shadow py-5" href="presentation/pml/index.php">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-lg text-center font-weight-bold text-gray mb-1">Private Medical Laboratories</div>
                    </div>
                    <div class="col-auto">
                      <img class="rounded-circle border-lightgreen border-2" style="border:5px solid black;" src="img/core/pml.jpg" alt=""/>
                      <!--<i class="fas fa-users fa-2x text-gray-300"></i>-->
                    </div>
                  </div>
                </div>
              </a>
            </div>
           
          </div>
          
          
          
          
           <div class="row">
<!-- Private Ambulance Services -->
            <div class="col-xl-4 col-md-6 col-sm-12 mb-4 hover-zoomin">
              <a class="card border-left-green shadow py-5" href="presentation/pas/index.php">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-lg text-center font-weight-bold text-gray mb-1">Private Ambulance Services</div>
                    </div>
                    <div class="col-auto">
                      <img class="rounded-circle border-green border-2" style="border:5px solid black;" src="img/core/as.jpg" alt=""/>
                      <!--<i class="fas fa-users fa-2x text-gray-300"></i>-->
                    </div>
                  </div>
                </div>
              </a>
            </div>
            
            <!-- System Administration -->
            <div class="col-xl-4 col-md-6 col-sm-12 mb-4 hover-zoomin">
              <a class="card border-left-yellow shadow py-5" href="presentation/fpdm/index.php">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-lg text-center font-weight-bold text-gray mb-1">Full Time Private General Practice/ Dispensaries/Medical Clinic</div>
                    </div>
                    <div class="col-auto">
                      <img class="rounded-circle border-yellow border-2" style="border:5px solid black;" src="img/core/ful_time.jpg" alt=""/>
                      <!--<i class="fas fa-users fa-2x text-gray-300"></i>-->
                    </div>
                  </div>
                </div>
              </a>
            </div>
            
             <!-- Part Time Private General Practice/Dispensaries/Medical clinics -->
            <div class="col-xl-4 col-md-6 col-sm-12 mb-4 hover-zoomin">
              <a class="card border-left-purple shadow py-5" href="presentation/pgdm/index.php">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-lg text-center font-weight-bold text-gray mb-1">Part Time Private General Practice/Dispensaries/Medical Clinics</div>
                    </div>
                    <div class="col-auto">
                      <img class="rounded-circle border-purple border-2" style="border:5px solid black;" src="img/core/part_time.jpg" alt=""/>
                      <!--<i class="fas fa-users fa-2x text-gray-300"></i>-->
                    </div>
                  </div>
                </div>
              </a>
            </div>
            
          </div>






 <div class="row">

		 <!-- Full Time Private Dental Surgeries -->
            <div class="col-xl-4 col-md-6 col-sm-12 mb-4 hover-zoomin">
              <a class="card border-left-red shadow py-5" href="presentation/fpds/index.php">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-lg text-center font-weight-bold text-gray mb-1">Full Time Private Dental Surgeries</div>
                    </div>
                    <div class="col-auto">
                      <img class="rounded-circle border-red border-2" style="border:5px solid black;" src="img/core/fds.jpg" alt=""/>
                      <!--<i class="fas fa-users fa-2x text-gray-300"></i>-->
                    </div>
                  </div>
                </div>
              </a>
            </div>
            
            
			 <!-- Part Time Private Dental Surgeries -->
            <div class="col-xl-4 col-md-6 col-sm-12 mb-4 hover-zoomin">
              <a class="card border-left-warning shadow py-5" href="presentation/ppds/index.php">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-lg text-center font-weight-bold text-gray mb-1">Part Time Private Dental Surgeries</div>
                    </div>
                    <div class="col-auto">
                      <img class="rounded-circle border-warning border-2" style="border:5px solid black;" src="img/core/part_time_den.jpg" alt=""/>
                      <!--<i class="fas fa-users fa-2x text-gray-300"></i>-->
                    </div>
                  </div>
                </div>
              </a>
            </div>
            
            <!-- Full Time Medical Specialist Practices -->
            <div class="col-xl-4 col-md-6 col-sm-12 mb-4 hover-zoomin">
              <a class="card border-left-primary shadow py-5" href="presentation/fmsp/index.php">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-lg text-center font-weight-bold text-gray mb-1">Full Time Medical Specialist Practices</div>
                    </div>
                    <div class="col-auto">
                      <img class="rounded-circle border-primary border-2" style="border:5px solid black;" src="img/core/full_time_medi_specialist.jpg" alt=""/>
                      <!--<i class="fas fa-users fa-2x text-gray-300"></i>-->
                    </div>
                  </div>
                </div>
              </a>
            </div>
           
          </div>



 <div class="row">

           <!-- Part Time Medical Specialist Practices -->
            <div class="col-xl-4 col-md-6 col-sm-12 mb-4 hover-zoomin">
              <a class="card border-left-lightred shadow py-5" href="presentation/pmsp/index.php">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-lg text-center font-weight-bold text-gray mb-1">Part Time Medical Specialist Practices</div>
                    </div>
                    <div class="col-auto">
                      <img class="rounded-circle border-lightred border-2" style="border:5px solid black;" src="img/core/part_time_medi_specialist.jpg" alt=""/>
                      <!--<i class="fas fa-users fa-2x text-gray-300"></i>-->
                    </div>
                  </div>
                </div>
              </a>
            </div>
            
            <!-- Other Private Medical Institutions -->
            <div class="col-xl-4 col-md-6 col-sm-12 mb-4 hover-zoomin">
              <a class="card border-left-success shadow py-5" href="presentation/opmi/index.php">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-lg text-center font-weight-bold text-gray mb-1">Other Private Medical Institutions</div>
                    </div>
                    <div class="col-auto">
                      <img class="rounded-circle border-success border-2" style="border:5px solid black;" src="img/core/pvet_institute.jpg" alt=""/>
                      <!--<i class="fas fa-users fa-2x text-gray-300"></i>-->
                    </div>
                  </div>
                </div>
              </a>
            </div>
            
            
            <!-- System Administration -->
            
            
             <div class="col-xl-4 col-md-6 col-sm-12 mb-4 hover-zoomin">
            
                
                 
                    
                    <div class="col-auto">
                     <a class=" py-5" href="presentation/system/index.php">   <img class="rounded-circle " style="border:;" src="img/core/admin.png" alt="" align="right"/></a>
                      <!--<i class="fas fa-users fa-2x text-gray-300"></i>-->
                    
                  
                </div>
              
            </div>
            
            <!-- System Administration -->
           
          </div>


        </div>
        <!-- /.container-fluid -->

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
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script>
  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

<?php include "{$backwardSeparator}footer.php";?> 
<div id="popup1" class="overlay">
	<div class="popup">
           
		<a class="close" href="#">&times;</a>
		<div class="content">
                    <center> <img src="img/mainImg.jpg" height="70%"></br><H2 style="color:Red"><b></b></H2></center>
		</div>
	</div>
</div>
</body>

</html>
<script type="text/javascript">
  $(document).ready(function(){
      window.location.href = "#popup1";
    $.validator.setDefaults({
      errorClass: "sethsiriERP",
      errorElement: "em",
    });
  });
</script>
