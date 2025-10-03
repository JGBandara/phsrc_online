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
      <?php include "{$backwardSeparator}presentation/fpds/menu.php";?>      <!-- End of Sidebar -->

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
                    <legend class="col-form-label-sm col-sm-12 pt-0">Details of the Dental Surgeons and other staff attached to the institution as at the date of application</legend>
                      <div class="form-group col-sm-12">
                        <label for="dtpJoinedDate" class="col-form-label-sm"><!--Province--></label>
                       <!-- <button type="button" class="btn btn-success" id="btnSave" onClick="insertRow('tblMainGrid1');" style="width: 120px; margin: 5px;float:right"><i class="fa fa-plus" aria-hidden="true"></i>
&nbsp;Add Raw</button>--><img src="../../../../img/butAddNew.JPG" onClick="insertRow('tblMainGrid1');" style="width: 120px;float:right" class="mouseover"/>
                        <table class="table table-hover col-sm-12" id="tblMainGrid1">

    <tr style="background-color:#9F9">
      <th scope="col">#</th>
      <th scope="col">Name of the Dental Surgeon/ Others</th>
      <th scope="col">Private</th>
      <th scope="col">Work place</th>
      <th scope="col">Private practice (I)</th>
      <th scope="col">Private practice (II)</th>
    </tr>
  
 
    <tr class="mainRow" id="tblMainGrid1id1">
      <td ><img src="../../../../img/deletered.png" align="middle" class="delImg" onclick="return delRow(event)"></td>
      <td><textarea class="form-control form-control-sm txtSurgeonName" id="txtSurgeonName" name="txtSurgeonName"  rows="1"></textarea></td>
      <td><textarea class="form-control form-control-sm txtPrivet" id="txtPrivet" name="txtPrivet"  rows="1"></textarea></td>
      <td><textarea class="form-control form-control-sm txtWorkPlace" id="txtWorkPlace" name="txtWorkPlace" rows="1"></textarea></td>
      <td><textarea class="form-control form-control-sm txtPrivetPracI" id="txtPrivetPracI" name="txtPrivetPracI" rows="1"></textarea></td>
      <td><textarea class="form-control form-control-sm txtPrivetPracII" id="txtPrivetPracII" name="txtPrivetPracII" rows="1"></textarea></td>
    </tr>
</table>
                      </div>
                    </div>
                    
                    
                   <div class="form-row">
                   <!-- <legend class="col-form-label-sm col-sm-12 pt-0">Communication</legend>-->
                      <div class="form-group col-sm-12">
                        <label for="txtCommunication" class="col-form-label-sm">Communication</label>
                        <!--<button type="button" class="btn btn-success" id="btnSave" style="width: 120px; margin: 5px;float:right"><i class="fa fa-plus" aria-hidden="true"></i>
&nbsp;Add Raw</button>--><img src="../../../../img/butAddNew.JPG" onClick="insertRow('tblMainGrid2');" style="width: 120px;float:right" class="mouseover"/>
                        <table class="table table-hover col-sm-12" id="tblMainGrid2">
    <tr style="background-color:#9F9">
      <th scope="col">#</th>
      <th scope="col">Name of the Dental Surgeon/ Others</th>
      <th scope="col">General Tel. No:</th>
      <th scope="col">Fax No:</th>
      <th scope="col">Mobile No:</th>
      <th scope="col">E-mail No:</th>
    </tr>

    <tr class="mainRow" id="tblMainGrid2id1">
      <td ><img src="../../../../img/deletered.png" align="middle" class="delImg" onclick="return delRow(event)"></td>
      <td><textarea class="form-control form-control-sm txtDenSergeonName" id="txtDenSergeonName" name="txtDenSergeonName" rows="1"></textarea></td>
      <td><input type="text" class="form-control form-control-sm txtGeneralTel" id="txtGeneralTel" name="txtGeneralTel" placeholder=""></td>
      <td><input type="text" class="form-control form-control-sm txtFaxNo" id="txtFaxNo" name="txtFaxNo" placeholder=""></td>
      <td><input type="text" class="form-control form-control-sm txtMobileNo" id="txtMobileNo" name="txtMobileNo" placeholder=""></td>
      <td><input type="text" class="form-control form-control-sm txtEmail" id="txtEmail" name="txtEmail" placeholder=""></td>
    </tr>
    
 
</table>
                      </div>
                      
                    </div> 
                    

                    <div class="form-row">
                          <div class="form-group col-sm-6">
                            <label for="txtSLMC" class="col-form-label-sm">SLMC Registration No</label>
                            <input type="text" class="form-control form-control-sm" id="txtSLMC" name="txtSLMC" placeholder="">
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
      <th scope="col">Name of the Dental Surgeon/ Others</th>
      <th scope="col">Qualifications</th>
      <th scope="col">Basic</th>
      <th scope="col">Post Graduation</th>
      <th scope="col">Year</th>
      <th scope="col">University</th>
      <th scope="col">Country</th>
    </tr>
 
    <tr class="mainRow" id="tblMainGrid3id1">
      <td ><img src="../../../../img/deletered.png" align="middle" class="delImg" onclick="return delRow(event)"></td>
      <td><textarea class="form-control form-control-sm txtSurgName" id="txtSurgName" name="txtSurgName" rows="1"></textarea></td>
      <td><input type="text" class="form-control form-control-sm txtQualification" id="txtQualification" name="txtQualification " placeholder=""></td>
      <td><input type="text" class="form-control form-control-sm txtBasic" id="txtBasic" name="txtBasic" placeholder=""></td>
      <td><input type="text" class="form-control form-control-sm txtPostGraduate" id="txtPostGraduate" name="txtPostGraduate" placeholder=""></td>
      <td><input type="text" class="form-control form-control-sm txtYear" id="txtYear" name="txtYear" placeholder=""></td>
      <td><input type="text" class="form-control form-control-sm txtUniversity" id="txtUniversity" name="txtUniversity" placeholder=""></td>
      <td><input type="text" class="form-control form-control-sm txtCountry" id="txtCountry" name="txtCountry" placeholder=""></td>
      
    </tr>

</table>
                      </div>
                      
                    </div> 
                    
                    
                    <div class="form-row">
                          <div class="form-group col-sm-6">
                            <label for="cboGovOfficer" class="col-form-label-sm">Government officer or not (If yes name of the institution and the post held by the officer currently)</label>
                            <select class="form-control form-control-sm" id="cboGovOfficer" name="cboGovOfficer" placeholder="">
                            <option></option>
                            <option value="Y">Yes</option>
                            <option value="N">No</option>
                          <!--<?php 
                          $modelStatus->stat_id = [1,21];
                          $modelStatus->stat_company_id = $userCompanyId;
                          echo $modelStatus->combo(true);
                          ?>-->
                        </select>
                          </div>
                          
                          <div class="form-group col-sm-6">
                            <label for="txtGovInstitute" class="col-form-label-sm">Government officer or not (If yes name of the institution and the post held by the officer currently)</label>
                            <input type="text" class="form-control form-control-sm" id="txtGovInstitute" name="txtGovInstitute" placeholder="">
                          </div>
                         
                        </div>
                        
                        
                          <div class="form-row">
                   <!-- <legend class="col-form-label-sm col-sm-12 pt-0">Communication</legend>-->
                      <div class="form-group col-sm-12">
                        <label for="dtpJoinedDate" class="col-form-label-sm">Type of practice</label>
                        
                        <table class="table table-hover col-sm-12">
  <thead>
    <tr style="background-color:#FCF">
      <td scope="col">Full time&nbsp;<input type="checkbox" class="form-control form-control-sm" id="checkFullTime" name="checkFullTime" placeholder=""></td>
      <td scope="col">Group&nbsp;<input type="checkbox" class="form-control form-control-sm" id="checkGroup" name="checkGroup" placeholder=""></td>
      <td scope="col">Individual&nbsp;<input type="checkbox" class="form-control form-control-sm" id="checkIndividual" name="checkIndividual" placeholder=""></td>
      <td scope="col">Private Hospital/ Nursing Home&nbsp;<input type="checkbox" class="form-control form-control-sm" id="checkNursingHome" name="checkNursingHome" placeholder=""></td>
      <td scope="col">Private Dental Practitioner&nbsp;<input type="checkbox" class="form-control form-control-sm" id="checkPrivetDental" name="checkPrivetDental" placeholder=""></td>
      
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
                     
              		   <button type="button" class="btn btn-success" id="btnSave" style="width: 100px; margin: 5px;"><i class="far fa-save"></i>&nbsp;Save</button>
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



