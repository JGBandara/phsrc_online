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
  
use presentation\system\masterData\classes\cls_sys_province;
use presentation\system\masterData\classes\cls_sys_district;
use presentation\system\masterData\classes\cls_sys_record_keeping;
use presentation\system\masterData\classes\cls_ins_owner;
use presentation\system\masterData\classes\cls_sys_status;

$modelStatus = new cls_sys_status($db);
$modelProvince = new cls_sys_province($db);
$modelDistrict = new cls_sys_district($db);
$modelRecordKeeping= new cls_sys_record_keeping($db);
$modelOwner= new cls_ins_owner($db);
?><!DOCTYPE html>
<html>
  <head>
    <title>Employee Emergency</title>
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
  </head>
  <body id="page-top">
    <!-- Message Modal -->
    <?php include "{$backwardSeparator}messageModal.php";?>
    <!-- Page Wrapper -->
    <div id="wrapper">

      <!-- Sidebar -->
      <?php include "{$backwardSeparator}presentation/fpdm/menu.php";?>      <!-- End of Sidebar -->

      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

          <!-- Topbar -->
          <?php include "{$backwardSeparator}top.php";?>          <!-- End of Topbar -->

          <!-- Begin Page Content -->
          <div class="container-fluid">
            <form class="needs-validation" novalidate id="frm_institute_information">
              <div class="card">
                <div class="card-header">
                  Institution Information
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
      
                   <div id="divInstitute">
                    <div class="form-row">
                          <div class="form-group col-sm-6">
                            <label for="cboRecKeeping" class="col-form-label-sm">Method of record keeping</label>
                            <select class="form-control form-control-sm" id="cboRecKeeping" name="cboRecKeeping" placeholder="">
                          <?php 
                         
                        $modelRecordKeeping->record_is_Deleted = 0;
  						echo $modelRecordKeeping->combo(true);
                          ?>
                        </select>
                          </div>
                          
                          <div class="form-group col-sm-6">
                            <label for="txtSpecAvailability" class="col-form-label-sm">Availability of visiting specialists</label>
                            <input type="text" class="form-control form-control-sm" id="txtSpecAvailability" name="txtSpecAvailability" placeholder="">
                          </div>
                         
                        </div>
                        
                        <div class="form-row">
                          
                          
                          <div class="form-group col-sm-6">
                            <label for="txtXray" class="col-form-label-sm">If so the number of the license issued by the Atomic Energy Authority</label>
                            <input type="text" class="form-control form-control-sm" id="txtXray" name="txtXray" placeholder="">
                          </div>
                         
                        </div>
                        
                        <div class="form-row">
                          <div class="form-group col-sm-6">
                            <label for="cboEmgKit" class="col-form-label-sm">Emergency kit available or not</label>
                            <select class="form-control form-control-sm" id="cboEmgKit" name="cboEmgKit" placeholder="">
                          <option>&nbsp;</option>
                          <option value="Y">Available</option>
                          <option value="N">Not</option>
                        </select>
                          </div>
                          
                          <div class="form-group col-sm-6">
                            <label for="cboIfOtherFacility" class="col-form-label-sm">Any other facilities (specify):</label>
                            <select class="form-control form-control-sm" id="cboIfOtherFacility" name="cboIfOtherFacility" placeholder="">
                          <option>&nbsp;</option>
                          <option value="Y">Available</option>
                          <option value="O">Offered</option>
                        </select>
                          </div>
                         
                        </div>
                        
                        
                        <div class="form-row">
                          <div class="form-group col-sm-6">
                            <label for="cboOwnership" class="col-form-label-sm">Ownership:</label>
                            <select class="form-control form-control-sm" id="cboOwnership" name="cboOwnership" placeholder="">
                          <?php 
                          
                          $modelOwner->ownership_is_Deleted = 0;
                          echo $modelOwner->combo(true);
                          ?>
                        </select>
                          </div>
                          
                         
                        </div>
                        
                        <div class="form-row">
                          <div class="form-group col-sm-6">
                            <label for="cboPracticing" class="col-form-label-sm">Practicing as a,</label>
                            <select class="form-control form-control-sm" id="cboPracticing" name="cboPracticing" placeholder="">
                          <option>&nbsp;</option>
                          <option value="1">General Practitioner</option>
                          <option value="2">Specialist</option>
                        </select>
                          </div>
                          
                          <div class="form-group col-sm-6">
                            <label for="txtLblSpeciality" class="col-form-label-sm">If so, what is your speciality?</label>
                             <input type="text" class="form-control form-control-sm" id="txtSpeciality" name="txtSpeciality" placeholder="">
                          </div>
                         
                        </div>
                        
                        
                        <div class="form-row">
                          <div class="form-group col-sm-6">
                            <label for="txtDisposalMethod" class="col-form-label-sm">Clinical waste disposal method</label>
                             <input type="text" class="form-control form-control-sm" id="txtDisposalMethod" name="txtDisposalMethod" placeholder="">
                          </div>
                          
                          <div class="form-group col-sm-6">
                            <label for="txtStiMethod" class="col-form-label-sm">Method of sterilization of instruments & dressings</label>
                             <input type="text" class="form-control form-control-sm" id="txtStiMethod" name="txtStiMethod" placeholder="">
                          </div>
                         
                        </div>
                        
                        <div class="form-row">
                          <div class="form-group col-sm-6">
                            <label for="cboPracticing" class="col-form-label-sm">Availability of an appointment system</label>
                            <select class="form-control form-control-sm" id="cboAvAppoimentSystem" name="cboAvAppoimentSystem" placeholder="">
                          <option>&nbsp;</option>
                          <option value="Yes">Yes</option>
                          <option value="No">No</option>
                        </select>
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
            </div>
          </form>
        </div>
      </div>
    </div>
<?php include "{$backwardSeparator}footer.php";?> 
    <!-- Bootstrap Color Picker 3.1.2-->
    <script src="<?php echo $backwardSeparator;?>vendor/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
    
    <!-- Custom scripts for This page-->
    <script src="instituteInformation.js"></script>    
  </body>
</html>



