<?php

session_start();
$backwardSeparator = "../../../../../";
$thisFilePath =  $_SERVER['PHP_SELF'];
$userId 	= $_SESSION['loginId'];
$userCompanyId = $_SESSION['companyId'];
$userLocationId = $_SESSION['locationId'];
//$projectName = substr($_SERVER['PHP_SELF'],0,strpos($_SERVER['PHP_SELF'],'/',1));

require "{$backwardSeparator}autoLoad.php";

include  "{$backwardSeparator}dataAccess/accessController.php";

$instituteId = (isset($_REQUEST['id']))?$_REQUEST['id']:'';
$instituteNo = (isset($_REQUEST['no']))?$_REQUEST['no']:'';

use presentation\system\masterData\classes\cls_sys_province;
use presentation\system\masterData\classes\cls_sys_district;
use presentation\system\masterData\classes\cls_sys_record_keeping;
use presentation\system\masterData\classes\cls_ins_owner;
use presentation\system\masterData\classes\cls_sys_status;
use presentation\hrm\masterData\classes\cls_hrm_employee_information;

$modelStatus = new cls_sys_status($db);
$modelProvince = new cls_sys_province($db);
$modelDistrict = new cls_sys_district($db);
$modelRecordKeeping= new cls_sys_record_keeping($db);
$modelOwner= new cls_ins_owner($db);
//$model = new cls_hrm_employee_information($db);
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
      var instituteId = '<?php echo $instituteId ?>';
      var instituteNo = '<?php echo $$instituteNo ?>';
      var backwardSeparator = '<?php echo $backwardSeparator ?>';
    </script>
    <style type="text/css">
      .avatar1-pic {
        width: 150px;
        height:200px
      }
      .Profile-input-file{
          height:180px;width:180px;
          position: absolute;
          top: 0px;
          z-index: 999;
          opacity: 0 !important;
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
                    <div class="col-sm-12">
                      <select class="form-control form-control-sm" id="cboSearch" name="cboSearch" placeholder="">
                      </select>
                    </div>
                </div>
                </div>
              </div>
              <br/>
              <div class="card">
                <div class="card-body">
                  <?php include '../instituteTabs.php';?>
                 <div id="personal">
                    <div class="form-row" >
                      <div class="col-sm-8">
                        <div class="form-row">
                          <div class="form-group col-sm-12">
                            <label for="txtName" class="col-form-label-sm">Name of the person who is operating or maintaining the institution </label>
                            <input type="text" class="form-control form-control-sm" id="txtName" name="txtName" placeholder="">
                      
                          </div>
                        </div>

                        <div class="form-row">
                          <div class="form-group col-sm-6">
                            <label for="lblOfficeAddr" class="col-form-label-sm">Address(Official)</label>
                           <textarea class="form-control form-control-sm" id="txtOfficeAddress" name="txtOfficeAddress"></textarea>
                          </div>
                          <div class="form-group col-sm-6">
                            <label for="txtAddress" class="col-form-label-sm">Address(Private)</label>
                            <!--<input type="text" class="form-control form-control-sm" id="txtFingerPrintNo" name="txtFingerPrintNo" placeholder="">--><textarea class="form-control form-control-sm" id="txtAddress" name="txtAddress"></textarea>
                          </div>
                        </div>
                        
                        <div class="form-row">
                          <div class="form-group col-sm-6">
                            <label for="txtRelIns" class="col-form-label-sm">The relationship with the institution </label>
                            <input type="text" class="form-control form-control-sm" id="txtRelIns" name="txtRelIns" placeholder="">
                          </div>
                          
                        </div>
                        
                        
                        <div class="form-row">
                          <div class="form-group col-sm-6">
                            <label for="txtInsName" class="col-form-label-sm">Name of the institution </label>
                            <input type="text" class="form-control form-control-sm" id="txtInsName" name="txtInsName" placeholder="">
                          </div>
                          <div class="form-group col-sm-6">
                            <label for="txtInsAddress" class=" col-form-label-sm">Institute Address </label>
                            <!--<input type="text" class="form-control form-control-sm" id="txtFingerPrintNo" name="txtFingerPrintNo" placeholder="">--><textarea class="form-control form-control-sm" id="txtInsAddress" name="txtInsAddress"></textarea>
                          </div>
                        </div>
                        
                        <div class="form-row">
                          <div class="form-group col-sm-6">
                            <label for="txtTelephone" class="col-form-label-sm">Telephone</label>
                            <input type="text" class="form-control form-control-sm" id="txtTelephone" name="txtTelephone" placeholder="eg -: 011 2 xxxxx">
                          </div>
                            
                            <div class="form-group col-sm-6">
                            <label for="forMobile" class="col-form-label-sm">Mobile Number()</label>
                            <input type="number" class="form-control form-control-sm" id="txtMobile" name="txtMobile" placeholder="07x xxxxxxx">
                          </div>
                          
                        </div>
                        
                        
                        <div class="form-row">
                          <div class="form-group col-sm-6">
                            <label for="txtWebsite" class="col-form-label-sm">Website</label>
                            <input type="text" class="form-control form-control-sm" id="txtWebsite" name="txtWebsite" placeholder="eg -: www.phsrc.lk">
                          </div>
                            <div class="form-group col-sm-6">
                            <label for="txtEmail" class=" col-form-label-sm">E-mail</label>
                            <!--<input type="text" class="form-control form-control-sm" id="txtFingerPrintNo" name="txtFingerPrintNo" placeholder="">--><input type="text" class="form-control form-control-sm" id="txtEmail" name="txtEmail" placeholder="eg -: xxxxxx@gmail.com">
                          </div>
                          
                        </div>
                        

                        
                      </div>
                      <div class="col-sm-4">
                        <div class="form-row">
                          <div class="file-field w-100">
                            <div class="mb-4 text-center">
                              <!--<img src="<?php echo $backwardSeparator."img/core/dental_su.jpg";?>"
                                class="rounded-circle z-depth-1-half avatar-pic1" alt="example placeholder avatar">-->
                            </div>
                            
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="form-row" id="location">
                    <legend class="col-form-label-sm col-sm-12 pt-0">Location of the institution</legend>
                      <div class="form-group col-sm-6">
                        <label for="cboProvince" class="col-form-label-sm">Province</label>
                        <select class="form-control form-control-sm" id="cboProvince" name="cboProvince" placeholder="">
                         <?php 
                         
                        $modelProvince->syv_is_deleted = 0;
  						echo $modelProvince->combo(true);
                          ?>
                        </select>
                      </div>
                      <div class="form-group col-sm-6">
                        <label for="cboDistrict" class="col-form-label-sm">District</label>
                        <select class="form-control form-control-sm" id="cboDistrict" name="cboDistrict" placeholder="">
                         <?php 
                         
                        $modelDistrict->syd_is_deleted = 0;
  						echo $modelDistrict->combo(true);
                          ?>
                        </select>
                      </div>
                      
                    </div>

                    <div class="form-row hideOnline">
                      <div class="form-group col-sm-6">
                        <label for="txtRelIns" class="col-form-label-sm">Upload Institute Profile</label>
                        <input type="file" onchange="readURL(this);" accept="image/*" class="form-control form-input col-sm-6 Profile-input-file" id="fileProfileImage" name="fileProfileImage">
                      </div>
                    </div>
                        
                    <div class="form-row hideOnlineSlip">
                      <div class="form-group col-sm-12">
                        <img src="" class="avatar1-pic" alt="Institute Profile">
                      </div>
                    </div>

                    </div>
                <div class="card-footer">
                  <div class="form-group row">
                    <div class="col-sm-12 text-center">
                       <button type="button" class="btn btn-warning" id="btnNew" style="width: 100px; margin: 5px;"><i class="fas fa-align-justify"></i>&nbsp;New</button>
              		   <button type="button" class="btn btn-success" id="btnSave" style="width: 100px; margin: 5px;"><i class="far fa-save"></i>&nbsp;Save</button>
                   	   <button type="button" class="btn btn-danger" id="btnDelete" style="width: 100px; margin: 5px;"><i class="fas fa-trash-alt"></i>&nbsp;Delete</button>
                      <button type="button" class="btn btn-info" id="btnClose" style="width: 100px; margin: 5px;"><i class="fas fa-times-circle"></i>&nbsp;Close</button>
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
                $('.avatar1-pic')
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



