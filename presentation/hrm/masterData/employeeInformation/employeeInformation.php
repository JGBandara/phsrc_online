<?php
session_start();
$backwardSeparator = "../../../../";
$thisFilePath =  $_SERVER['PHP_SELF'];
$userId 	= $_SESSION['loginId'];
$userCompanyId = $_SESSION['companyId'];
$userLocationId = $_SESSION['locationId'];

require "{$backwardSeparator}autoLoad.php";

include  "{$backwardSeparator}dataAccess/accessController.php";

$searchId = (isset($_REQUEST['id']))?$_REQUEST['id']:'';

use presentation\system\masterData\classes\cls_sys_status;
use presentation\hrm\masterData\classes\cls_hrm_employee_information;
$modelStatus = new cls_sys_status($db);
?><!DOCTYPE html>
<html>
  <head>
    <title>Employee Information</title>
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
      <?php include "{$backwardSeparator}presentation/hrm/menu.php";?>      <!-- End of Sidebar -->

      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

          <!-- Topbar -->
          <?php include "{$backwardSeparator}top.php";?>          <!-- End of Topbar -->

          <!-- Begin Page Content -->
          <div class="container-fluid">
            <form class="needs-validation" novalidate id="frmhrm_employee_information" enctype="multipart/form-data">
              <div class="card">
                <div class="card-header">
                  Employee Information
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
                  <?php include '../employeeTabs.php';?>
                  <div class="form-row">
                      <div class="col-sm-8">
                        <div class="form-row">
                          <div class="form-group col-sm-6">
                            <label for="txtNo" class="col-form-label-sm">Employee No</label>
                            <input type="text" class="form-control form-control-sm" id="txtNo" name="txtNo" placeholder="">
                          </div>
                          <div class="form-group col-sm-6">
                            <label for="txtCallingName" class="col-form-label-sm">Calling Name</label>
                            <input type="text" class="form-control form-control-sm" id="txtCallingName" name="txtCallingName" placeholder="">
                          </div>
                        </div>

                        <div class="form-row">
                          <div class="form-group col-sm-6">
                            <label for="txtEpfNo" class="col-form-label-sm">Epf No</label>
                            <input type="text" class="form-control form-control-sm" id="txtEpfNo" name="txtEpfNo" placeholder="">
                          </div>
                          
                        </div>
                        <fieldset class="form-group">
                          <div class="row">
                              <legend class="col-form-label-sm col-sm-4 pt-0">Confirm Status</legend>
                              <div class="col-sm-8">
                                <div class="form-check form-control-sm form-check-inline">
                                  <input class="form-check-input" type="radio" name="optConfirmStatus" id="optConfirmStatus_1" value="1" checked>
                                  <label class="form-check-label" for="optConfirmStatus_1">Yes</label>
                                </div>
                                <div class="form-check form-control-sm form-check-inline">
                                  <input class="form-check-input" type="radio" name="optConfirmStatus" id="optConfirmStatus_2" value="0">
                                  <label class="form-check-label" for="optConfirmStatus_2">No</label>
                                </div>
                              </div>
                          </div>
                        </fieldset>

                        <fieldset class="form-group">
                          <div class="row">
                            <legend class="col-form-label-sm col-sm-4 pt-0">Medical Status</legend>
                            <div class="col-sm-8">
                              <div class="form-check form-control-sm form-check-inline">
                                <input class="form-check-input" type="radio" name="optMedicalStatus" id="optMedicalStatus_1" value="1" checked>
                                <label class="form-check-label" for="optMedicalStatus_1">Yes</label>
                              </div>
                              <div class="form-check form-control-sm form-check-inline">
                                <input class="form-check-input" type="radio" name="optMedicalStatus" id="optMedicalStatus_2" value="0">
                                <label class="form-check-label" for="optMedicalStatus_2">No</label>
                              </div>
                            </div>
                          </div>
                        </fieldset>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-row">
                          <div class="file-field w-100">
                            <div class="mb-4 text-center">
                              <img src="<?php echo $backwardSeparator."img/profile/10_avatar-512.png";?>"
                                class="rounded-circle z-depth-1-half avatar-pic" alt="example placeholder avatar">
                            </div>
                            <div class="d-flex justify-content-center">
                              <div class="btn btn-mdb-color btn-rounded float-left">
                                <span>Add photo</span>
                                <input type="file" onchange="readURL(this);" accept="image/*" class="form-control form-input Profile-input-file" id="fileProfileImage" name="fileProfileImage">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
      
                    <div class="form-row">
                      <div class="form-group col-sm-4">
                        <label for="dtpJoinedDate" class="col-form-label-sm">Joined Date</label>
                        <input type="text" class="form-control form-control-sm datepicker_past" id="dtpJoinedDate" name="dtpJoinedDate" placeholder="">
                      </div>
                      <div class="form-group col-sm-4">
                        <label for="dtpPermanentDate" class="col-form-label-sm">Permanent Date</label>
                        <input type="text" class="form-control form-control-sm datepicker_past" id="dtpPermanentDate" name="dtpPermanentDate" placeholder="">
                      </div>
                      <div class="form-group col-sm-4">
                        <label for="dtpConfirmDate" class="col-form-label-sm">Confirm Date</label>
                        <input type="text" class="form-control form-control-sm datepicker_past" id="dtpConfirmDate" name="dtpConfirmDate" placeholder="">
                      </div>
                    </div>
        
                    <div class="form-row">
                      <div class="form-group col-sm-6">
                        <label for="dtpResignedDate" class="col-form-label-sm">Resigned Date</label>
                        <input type="text" class="form-control form-control-sm datepicker_past" id="dtpResignedDate" name="dtpResignedDate" placeholder="">
                      </div>
                      <div class="form-group col-sm-6">
                        <label for="dtpRetirementDate" class="col-form-label-sm">Retirement Date</label>
                        <input type="text" class="form-control form-control-sm datepicker_future" id="dtpRetirementDate" name="dtpRetirementDate" placeholder="">
                      </div>
                    </div>
                
<!--                    <div class="form-group row">
                      <label for="txtImageName" class="col-sm-2 col-form-label-sm">Image Name</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control form-control-sm" id="txtImageName" name="txtImageName" placeholder="">
                      </div>
                    </div>
      -->
                    <div class="form-group row">
                      <label for="txtRemarks" class="col-sm-2 col-form-label-sm">Remarks</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control form-control-sm" id="txtRemarks" name="txtRemarks" placeholder="">
                      </div>
                    </div>
      
                    <div class="form-group row">
                      <label for="cboStatus" class="col-sm-2 col-form-label-sm">Status</label>
                      <div class="col-sm-10">
                        <select class="form-control form-control-sm" id="cboStatus" name="cboStatus" placeholder="">
                          <?php 
                          $modelStatus->stat_id = [1,21];
                          $modelStatus->stat_company_id = $userCompanyId;
                          echo $modelStatus->combo(true);
                          ?>
                        </select>
                      </div>
                    </div>
                </div>
                <div class="card-footer">
                  <div class="form-group row">
                    <div class="col-sm-12 text-center">
                      <button type="button" class="btn btn-outline-secondary" id="btnClose" style="width: 100px; margin: 5px;">Close</button>
                      <button type="button" class="btn btn-outline-info" id="btnNew" style="width: 100px; margin: 5px;">New</button>
                      <button type="button" class="btn btn-outline-primary" id="btnList" style="width: 100px; margin: 5px;">List</button>
                      <button type="button" class="btn btn-outline-success" id="btnSave" style="width: 100px; margin: 5px;">Save</button>
                      <button type="button" class="btn btn-outline-info" id="btnPrint" style="width: 100px; margin: 5px;">Print</button>
                      <button type="button" class="btn btn-outline-primary" id="btnApprove" style="width: 100px; margin: 5px;">Approve</button>
                      <button type="button" class="btn btn-outline-warning" id="btnReject" style="width: 100px; margin: 5px;">Reject</button>
                      <button type="button" class="btn btn-outline-danger" id="btnDelete" style="width: 100px; margin: 5px;">Delete</button>
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
    <script src="employeeInformation.js"></script>    
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



