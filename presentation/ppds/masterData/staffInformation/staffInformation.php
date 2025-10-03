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
      <?php include "{$backwardSeparator}presentation/ppds/menu.php";?>      <!-- End of Sidebar -->

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
                    <legend class="col-form-label-sm col-sm-12 pt-0">The details of the medical staff including Doctors, Consultants engaged in the profession under this institution</legend>
                      <div class="form-group col-sm-12">
                        <label for="dtpJoinedDate" class="col-form-label-sm"><!--Province--></label>
                       <!-- <button type="button" class="btn btn-success" id="btnSave" onClick="insertRow('tblMainGrid1');" style="width: 120px; margin: 5px;float:right"><i class="fa fa-plus" aria-hidden="true"></i>
&nbsp;Add Raw</button>--><img src="../../../../img/butAddNew.JPG" onClick="insertRow('tblMainGrid1');" style="width: 120px;float:right" class="mouseover"/>
                        <table class="table table-hover col-sm-12" id="tblMainGrid1">

    <tr style="background-color:#9CF">
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Qulifications</th>
      <th scope="col">Institute</th>
      <th scope="col">Country</th>
      <th scope="col">PostGraduate</th>
      <th scope="col">Speciality</th>
      <th scope="col">SLMC No</th>
    </tr>
  
 
    <tr class="mainRow" id="tblMainGrid1id1">
      <td ><img src="../../../../img/deletered.png" align="middle" class="delImg" onclick="return delRow(event)"></td>
      <td><textarea class="form-control form-control-sm Name" id="txtDocName" name="txtDocName"  rows="1"></textarea></td>
      <td><textarea class="form-control form-control-sm Qulifications" id="txtQulifications" name="txtQulifications"  rows="1"></textarea></td>
      <td><textarea class="form-control form-control-sm Institute" id="txtInstitute" name="txtInstitute" rows="1"></textarea></td>
      <td><textarea class="form-control form-control-sm Country" id="txtCountry" name="txtCountry" rows="1"></textarea></td>
      <td><textarea class="form-control form-control-sm PostGraduate" id="txtPostGraduate" name="txtPostGraduate" rows="1"></textarea></td>
      <td><textarea class="form-control form-control-sm Speciality" id="txtSpeciality" name="txtSpeciality" rows="1"></textarea></td>
      <td><input class="form-control form-control-sm Registerd" id="txtRegisterd" name="txtRegisterd"/></td>
    </tr>
</table>
                      </div>
                    </div>
                    
                    
                   <div class="form-row">
                   <!-- <legend class="col-form-label-sm col-sm-12 pt-0">Communication</legend>-->
                      <div class="form-group col-sm-12">
                        <label for="txtCommunication" class="col-form-label-sm">Managment Information</label>
                        <!--<button type="button" class="btn btn-success" id="btnSave" style="width: 120px; margin: 5px;float:right"><i class="fa fa-plus" aria-hidden="true"></i>
&nbsp;Add Raw</button>--><img src="../../../../img/butAddNew.JPG" onClick="insertRow('tblMainGrid2');" style="width: 120px;float:right" class="mouseover"/>
                        <table class="table table-hover col-sm-12" id="tblMainGrid2">
    <tr style="background-color:#9CF">
      <th scope="col">#</th>
      <th scope="col">Position</th>
      <th scope="col">Name</th>
      <th scope="col">Contact detail</th>
      <th scope="col">Other Information</th>
    </tr>

    <tr class="mainRow" id="tblMainGrid2id1">
      <td ><img src="../../../../img/deletered.png" align="middle" class="delImg" onclick="return delRow(event)"></td>
      <td><select class="form-control form-control-sm Position"  name="cboPosition" id="cboPosition"><option></option>
      <?php 
	  $sql="select position_id,position_name from tbl_position";
				$result = $db->singleQuery($sql);
				while($row=mysqli_fetch_array($result)){
				echo '<option value="'.$row['position_id'].'">'.$row['position_name'].'</option>';
				}
	  
	  ?>
      </select></td>
      <td><input type="text" class="form-control form-control-sm Name" id="txtName" name="txtName" placeholder=""></td>
      <td><input type="text" class="form-control form-control-sm Contact" id="txtContact" name="txtContact" placeholder=""></td>
      <td><input type="text" class="form-control form-control-sm Information" id="txtInformation" name="txtInformation" placeholder=""></td>
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
                        </select>
                          </div>
                          
                          <div class="form-group col-sm-6">
                            <label for="txtGovInstitute" class="col-form-label-sm">Government officer or not (If yes name of the institution and the post held by the officer currently)</label>
                            <input type="text" class="form-control form-control-sm" id="txtGovInstitute" name="txtGovInstitute" placeholder="">
                          </div>
                         
                        </div>
                        
                        
<!--                          <div class="form-row">
                  
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
                      
                    </div> -->
                        
                        
                     <!--<div class="form-row">
                          <div class="form-group col-sm-6">
                            <label for="txtPracHours" class="col-form-label-sm">Hours of practice</label>
                            <input type="text" class="form-control form-control-sm" id="txtPracHours" name="txtPracHours" placeholder="">
                          </div>   
                        </div>-->
                        
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



