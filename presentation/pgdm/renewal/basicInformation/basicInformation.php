<?php
session_start();
$backwardSeparator = "../../../../";
$thisFilePath =  $_SERVER['PHP_SELF'];
$userId 	= $_SESSION['loginId'];
$userCompanyId = $_SESSION['companyId'];
$userLocationId = $_SESSION['locationId'];
//$projectName = substr($_SERVER['PHP_SELF'],0,strpos($_SERVER['PHP_SELF'],'/',1));

require "{$backwardSeparator}autoLoad.php";

include  "{$backwardSeparator}dataAccess/accessController.php";

$searchId = (isset($_REQUEST['id']))?$_REQUEST['id']:'';

?><!DOCTYPE html>
<html>
  <head>
    <title>Basic Information</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <?php include "{$backwardSeparator}header.php";?>    <!-- Bootstrap Color Picker 3.1.2-->
    <link href="<?php echo $backwardSeparator;?>vendor/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet">   
    <script type="application/javascript" >
      var searchId = '<?php echo $searchId ?>';
      var backwardSeparator = '<?php echo $backwardSeparator ?>';
    </script>
    <style type="text/css">
      .avatar-pic {
        width: 150px;
      }
      .Profile-input-file{
          height:180px;width:180px;
          position: absolute;
          top: -50px;
          z-index: 999;
          opacity: 0 !important;
      }
      
      /* Button used to open the contact form - fixed at the bottom of the page */
.open-button {
  background-color: #555;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 280px;
}

/* The popup form - hidden by default */
.form-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 15px;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}

/* Full-width input fields */
.form-container input[type=text], .form-container input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
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
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}
    </style>
  </head>
  <body id="page-top">
    <!-- Message Modal -->
    <?php include "{$backwardSeparator}messageModal.php";?>
    <!-- Page Wrapper -->
    <div id="wrapper">

      <!-- Sidebar -->
      <?php include "{$backwardSeparator}presentation/pgdm/menu.php";?>      <!-- End of Sidebar -->

      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

          <!-- Topbar -->
          <?php include "{$backwardSeparator}top.php";?>          <!-- End of Topbar -->

          <!-- Begin Page Content -->
          <div class="container-fluid">
            <form class="needs-validation" novalidate id="frm_basic_information" enctype="multipart/form-data">
              <div class="card">
                <div class="card-header">
                  Institute Basic Information
                </div>
                <div class="card-body">
                  <div class="form-group row">
                    <div class="col-sm-10">
                    <input type="text" class="form-control form-control-sm" name="txtSearch" id="txtSearch" value="PHSRC/PGP/">
                    </div><div class="col-sm-2"><button type="button" class="btn btn-warning" id="btnSearch" style="width: 100px;height:30px ">Search</button></div>
                </div>
                </div>
              </div>
              <br/>
              <div class="card">
                <div class="card-body">
                  <!--<?php include '../instituteTabs.php';?>-->
                 <div id="sendPg">
                    <div class="form-row">
                      <div class="col-sm-8">
                        <div class="form-row">
                          <div class="form-group col-sm-12">
                            <label for="txtName" class="col-form-label-sm">How do you want to receive the code to reset your password?</label>
                            
                      
                          </div>
                        </div>
                          
                          <fieldset class="form-group">
                          <div class="row">
                              
                              <div class="col-sm-8">
                                <div class="form-check form-control-sm form-check-inline">
                                  <input class="form-check-input" type="radio" name="optConfirmStatus" id="optConfirmStatus_1" value="1" checked>
                                  <label class="form-check-label" for="optConfirmStatus_1">Send code via SMS </label>
                                </div>
                                <div class="form-check form-control-sm form-check-inline">
<!--                                  <input class="form-check-input" type="radio" name="optConfirmStatus" id="optConfirmStatus_2" value="0">
                                  <label class="form-check-label" for="optConfirmStatus_2">Send code via Email&nbsp;&nbsp;&nbsp; </label>-->
                                  <button type="button" class="btn btn-success" id="btnSendCode" style="width: 100px; margin: 5px;"><i class="far fa-save"></i>&nbsp;Save</button>
                                </div>
                              </div>
                          </div>
                        </fieldset>


                        

                        
                      </div>

                    </div>


                    </div>
                  
                  <div id="codePg">
                    <div class="form-row">
                      <div class="col-sm-8">
                        <div class="form-row">
                          <div class="form-group col-sm-12">
                            <label for="txtName" class="col-form-label-sm">Enter Your Verification Code</label>
                            
                      
                          </div>
                        </div>
                          
                          <div class="form-row">
                          <div class="form-group col-sm-12">
                            <label for="txtName" class="col-form-label-sm">Remaining Time</label>
                            <label style="color:#FE3D5F;font-size:14px;text-align:left" id="lblRmTime" ></label>
                      
                          </div>
                        </div>
                          
                          <div class="form-row">
                          <div class="form-group col-sm-6">
                          
                            <input type="text" class="form-control form-control-sm" id="txtCode" name="txtCode" placeholder="# # # # # #">
                          </div>
                          <div class="form-group col-sm-6">
                            <button type="button" class="btn btn-success" id="btnConfirm" style="width: 100px; margin: 5px;"><i class="far fa-save"></i>&nbsp;Save</button>
                          </div>
                        </div>
 
                      </div>

                    </div>


                    </div>
                  
                  
                  
                  <div id="errpg">
                    <div class="form-row">
                      <div class="col-sm-8">
                        <div class="form-row">
                          <div class="form-group col-sm-12">
                              <label for="txtName" class="col-form-label-sm" style="color: #F00">Search Valid Registration Number.</label>
                            
                      
                          </div>
                        </div>
                      </div>

                    </div>


                    </div>
                  
                  
                  
                  
                <div class="card-footer">
                  <div class="form-group row">
                    <div class="col-sm-12 text-center">
                      
              		   <button type="button" class="btn btn-success" id="btnSave" style="width: 100px; margin: 5px;"><i class="far fa-save"></i>&nbsp;Save</button>
                      <button type="button" class="btn btn-info" id="btnClose" style="width: 100px; margin: 5px;"><i class="fas fa-times-circle"></i>&nbsp;Close</button>
                      <button type="button" class="btn btn-info" id="btnDocument" style="width: 100px; margin: 5px;"><i class="fa fa-angle-double-right"></i>&nbsp;Next</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

<?php include "{$backwardSeparator}footer.php";?> 
    <!-- Bootstrap Color Picker 3.1.2-->
    <script src="<?php echo $backwardSeparator;?>vendor/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>

    <!-- Custom scripts for This page-->
    <script src="basicInformation.js"></script>    
    <script>

//    ===================== snippet for profile picture change ============================ //

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.avatar-pic')
                        .attr('src', e.target.result)
                        .width(200)
                        .height(200);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

//    =================================== ends here ============================================ //
    </script>
  </body>
</html>

<html lang="en" >
<head>
  <meta charset="UTF-8">
  
  <link rel="stylesheet" href="<?php echo $backwardSeparator;?>css/popup/style.css">

</head>
<body>
<!-- partial:index.partial.html -->

<!--<div class="box">
	
</div>-->

<div id="popup1" class="overlay">
	<div class="popup">
            <h2><img src="../../../../img/warning.png"/>&nbsp;Message for renewal user</h2>
		<a class="close" href="#">&times;</a>
		<div class="content">
                    Before Renewal of the Registration update user mobile number on PHSRC database (Call <span style="color:  #078589 ">011-2672911</span>), If Already updated please ignore this message.<br/>
		</div>
	</div>
</div>
<!-- partial -->
  
</body>
</html>



