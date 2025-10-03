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
use presentation\hrm\masterData\classes\cls_hrm_employee_information;

$modelStatus = new cls_sys_status($db);
$modelProvince = new cls_sys_province($db);
$modelDistrict = new cls_sys_district($db);
$modelRecordKeeping= new cls_sys_record_keeping($db);
$modelOwner= new cls_ins_owner($db);
//$model = new cls_hrm_employee_residential($db);
?><!DOCTYPE html>
<html>
  <head>
    <title>Institute Staff Information</title>
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
            <form class="needs-validation" novalidate id="frm_staff_information">
              <div class="card">
                <div class="card-header">
                  Staff Information
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
        
                   <div id="divStaff">
                   <div class="form-row">
                    <legend class="col-form-label-sm col-sm-12 pt-0">The details of the medical staff including Doctors, Consultants engaged in the medical profession under this institution</legend>
                      <div class="form-group col-sm-12">
                        <label for="dtpJoinedDate" class="col-form-label-sm"><!--Province--></label>
                       <img src="../../../../img/butAddNew.JPG" onClick="insertRow('tblMainGrid1');" style="width: 120px;float:right" class="mouseover"/>
                        <table class="table table-hover col-sm-12" id="tblMainGrid1">

    <tr style="background-color:#9F9">
      <th scope="col">#</th>
      <th scope="col">Name of the specialists/Medical Officers/Others</th>
      <th scope="col">personnel and the category</th>
      <th scope="col">Place of permanent employment(Gov or Other)</th>
      <th scope="col">Whether full time or part time:</th>
     
    </tr>
  
 
    <tr class="mainRow" id="tblMainGrid1id1">
      <td ><img src="../../../../img/deletered.png" align="middle" class="delImg" onclick="return delRow(event)"></td>
      <td><textarea class="form-control form-control-sm txtMedName" id="txtMedName" name="txtMedName"  rows="1"></textarea></td>
      <td><textarea class="form-control form-control-sm txtCategory" id="txtCategory" name="txtCategory"  rows="1"></textarea></td>
      <td><textarea class="form-control form-control-sm txtPermanent" id="txtPermanent" name="txtPermanent" rows="1"></textarea></td>
      <td><select class="form-control form-control-sm cboType" id="cboType" name="cboType" placeholder="">
       <option>&nbsp;</option>
       <option value="fullTime">Full Time</option>
       <option value="partTime">Part Time</option>
      </select></td>
      
    </tr>
</table>
                      </div>
                    </div>
                        
                        
                       <div class="form-row">
                   <!-- <legend class="col-form-label-sm col-sm-12 pt-0">Communication</legend>-->
                      <div class="form-group col-sm-12">
                        <label for="txtQualifications" class="col-form-label-sm">Qualifications</label>
                        <!--<button type="button" class="btn btn-success" id="btnSave" style="width: 120px; margin: 5px;float:right"><i class="fa fa-plus" aria-hidden="true"></i>
&nbsp;Add Raw</button>--><img src="../../../../img/butAddNew.JPG" onClick="insertRow('tblMainGrid3');" style="width: 120px;float:right" class="mouseover"/>
                        <table class="table table-hover col-sm-12" id="tblMainGrid3">

    <tr style="background-color:#9F9">
      <th scope="col">#</th>
      <th scope="col">Name of the specialist/Medical Officer</th>
      <th scope="col">Qualifications</th>
      <th scope="col">Basic</th>
      <th scope="col">Post Graduation</th>
      <th scope="col">Year</th>
      <th scope="col">University</th>
      <th scope="col">Country</th>
      <th scope="col">SLMC Reg. No</th>
      <th scope="col">SLMC Reg. Date</th>
    </tr>
 
    <tr class="mainRow" id="tblMainGrid3id1">
      <td ><img src="../../../../img/deletered.png" align="middle" class="delImg" onclick="return delRow(event)"></td>
      <td><textarea class="form-control form-control-sm txtDocName" id="txtDocName" name="txtDocName" rows="1"></textarea></td>
      <td><textarea class="form-control form-control-sm txtQualification" id="txtQualification" name="txtQualification " rows="1"></textarea></td>
      <td><textarea class="form-control form-control-sm txtBasic" id="txtBasic" name="txtBasic" rows="1"></textarea></td>
      <td><textarea class="form-control form-control-sm txtPostGraduate" id="txtPostGraduate" name="txtPostGraduate" rows="1"></textarea></td>
      <td><textarea class="form-control form-control-sm txtYear" id="txtYear" name="txtYear" rows="1"></textarea></td>
      <td><textarea class="form-control form-control-sm txtUniversity" id="txtUniversity" name="txtUniversity" rows="1"></textarea></td>
      <td><textarea class="form-control form-control-sm txtCountry" id="txtCountry" name="txtCountry" rows="1"></textarea></td>
      <td><textarea class="form-control form-control-sm txtSlmcNo" id="txtSlmcNo" name="txtSlmcNo" rows="1"></textarea></td>
      <td><textarea class="form-control form-control-sm txtSlmcDate" id="txtSlmcDate" name="txtSlmcDate" rows="1"></textarea></td>
      
    </tr>

</table>
                      </div>
                      
                    </div> 
                    
                    
                   
                        
                        
                          <div class="form-row">
                   <!-- <legend class="col-form-label-sm col-sm-12 pt-0">Communication</legend>-->
                      <div class="form-group col-sm-12">
                        <label for="dtpJoinedDate" class="col-form-label-sm">Type of practice</label>
                        
                        <table class="table table-hover col-sm-12">
  <thead>
    <tr style="background-color:#FCF">
      <td scope="col">Group&nbsp;<input type="checkbox" class="form-control form-control-sm" id="checkGroup" name="checkGroup" placeholder=""></td>
      <td scope="col">Individual&nbsp;<input type="checkbox" class="form-control form-control-sm" id="checkIndividual" name="checkIndividual" placeholder=""></td>
      <td scope="col">Other&nbsp;<input type="checkbox" class="form-control form-control-sm" id="checkOther" name="checkOther" placeholder=""></td>
      
      
    </tr>
  </thead>
  
</table>
                      </div>
                      
                    </div> 
                        
                        
                     <div class="form-row">
                          <div class="form-group col-sm-6">
                            <label for="txtPracHours" class="col-form-label-sm">Hours of practice</label>
                            <input type="text" class="form-control form-control-sm" id="txtPracHours" name="txtPracHours" placeholder="">
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
    <script src="staffInformation.js"></script>    
  </body>
</html>



