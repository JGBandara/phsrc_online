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

//$employeeId = (isset($_REQUEST['id']))?$_REQUEST['id']:'';
$searchId = (isset($_REQUEST['id']))?$_REQUEST['id']:'';
  
use presentation\system\masterData\classes\cls_sys_status;
use presentation\hrm\masterData\classes\cls_hrm_employee_bank_account;
use presentation\hrm\masterData\classes\cls_hrm_employee_information;
use presentation\system\masterData\classes\cls_sys_bank;
$modelStatus = new cls_sys_status($db);
$model = new cls_hrm_employee_bank_account($db);
$modelEmployeeInfomation = new cls_hrm_employee_information($db);
$modelBank = new cls_sys_bank($db);
?><!DOCTYPE html>
<html>
  <head>
    <title>Institute Facility</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <?php include "{$backwardSeparator}header.php";?>    <!-- Bootstrap Color Picker 3.1.2-->
    <link href="<?php echo $backwardSeparator;?>vendor/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet">   
    <script type="application/javascript" >
      var searchId = '<?php echo $searchId ?>';
      var employeeId = '<?php echo $employeeId ?>';
      var backwardSeparator = '<?php echo $backwardSeparator ?>';
    </script>
  </head>
  <body id="page-top">
    <!-- Message Modal -->
    <?php include "{$backwardSeparator}messageModal.php";?>
    <!-- Page Wrapper -->
    <div id="wrapper">

      <!-- Sidebar -->
      <?php include "{$backwardSeparator}presentation/opmi/menu.php";?>      <!-- End of Sidebar -->

      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

          <!-- Topbar -->
          <?php include "{$backwardSeparator}top.php";?>          <!-- End of Topbar -->

          <!-- Begin Page Content -->
          <div class="container-fluid">
            <form class="needs-validation" novalidate id="frm_institute_facility">
              <div class="card">
                <div class="card-header">
                  Institute Facilities
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


                  <div class="form-row">
                          <!-- <div class="form-group col-sm-4">
                            <label for="lblOfficeAddr" class="col-form-label-sm">Total no: of inpatient beds</label>
                            <input type="text" class="form-control form-control-sm" id="txtNoBed" name="txtNoBed" placeholder="">
                          </div> -->
                          <div class="form-group col-sm-4">
                            <label for="txtAddress" class="col-form-label-sm">Total No. of rooms</label>
                            <input type="text" class="form-control form-control-sm" id="txtNoRoom" name="txtNoRoom" placeholder="">
                          </div>
                          <div class="form-group col-sm-4">
                            <label for="txtAddress" class="col-form-label-sm">Total No. of Wards</label>
                            <input type="text" class="form-control form-control-sm" id="txtNoWard" name="txtNoWard" placeholder="">
                          </div>
                        </div>                 
                   <div class="form-row" id="facility">
                   <!-- <legend class="col-form-label-sm col-sm-12 pt-0">Communication</legend>-->
                      <div class="form-group col-sm-12">
                        <label for="dtpJoinedDate" class="col-form-label-sm">Equipment and Facilities available to provide service</label>
                        <!--<button type="button" class="btn btn-success" id="btnSave" style="width: 120px; margin: 5px;float:right"><i class="fa fa-plus" aria-hidden="true"></i>
&nbsp;Add Raw</button>--><img src="../../../../img/butAddNew.JPG" onClick="insertRow('tblMainGrid1');" style="width: 120px;float:right" class="mouseover"/>
                        <table class="table table-hover col-sm-12" id="tblMainGrid1">
    <tr style="background-color:#9CF">
      <th scope="col">#</th>
      <th scope="col">Facility</th>
      <th scope="col">Value</th>
      <th scope="col">Discription</th>
    </tr>

    <tr class="mainRow" id="tblMainGrid1id1">
      <td ><img src="../../../../img/deletered.png" align="middle" class="delImg" onclick="return delRow(event)"></td>
      <td><select class="form-control form-control-sm cbofacility" id="cbofacility" name="cbofacility" placeholder="" >
     			 <option></option>
                          <?php 
                          $sql="select
				facility_id,facility_name
				from tbl_facility
				where status='1'";
				$result = $db->singleQuery($sql);
				while($row=mysqli_fetch_array($result)){
				echo '<option value="'.$row['facility_id'].'">'.$row['facility_name'].'</option>';
				}
                          ?>
                        </select></td>
      <td><input type="text" class="form-control form-control-sm txtValue" id="txtValue" name="txtValue"  placeholder=""></td>
      <td><input type="text" class="form-control form-control-sm txtDiscription" id="txtDiscription" name="txtDiscription" placeholder=""></td>
     
    </tr>

</table>
                      </div>
                      
                    </div> 
                    
                    
                      <div class="form-row">
                          <div class="form-group col-sm-6">
                            <label for="lblOfficeAddr" class="col-form-label-sm">License obtained from the Atomic Energy Authority for Radiology Service</label>
                            <select name="cboAtomicEnergy" id="cboAtomicEnergy" class="form-control form-control-sm">
                            <option>&nbsp;</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                            </select>
                          </div>
                          
                          <div class="form-group col-sm-6">
                            <label for="txtLicense" class="col-form-label-sm">The number of such license</label>
                            <input type="text" class="form-control form-control-sm" id="txtNoLicense" name="txtNoLicense" placeholder="">
                          </div>
                        </div>
                        
                        
                        <div class="form-row">
                          <div class="form-group col-sm-6">
                            <label for="lblOfficeAddr" class="col-form-label-sm">Method of clinical waste disposal</label>
                            <input type="text" class="form-control form-control-sm" id="txtclinicalDis" name="txtclinicalDis" placeholder="">
                          </div>
                          
                          <div class="form-group col-sm-6">
                            <label for="txtLicense" class="col-form-label-sm">Method of sterilization of instruments and dressings</label>
                            <input type="text" class="form-control form-control-sm" id="txtInsDress" name="txtInsDress" placeholder="">
                          </div>
                        </div>
                    
                    
                    	 <div class="form-row">
                          <div class="form-group col-sm-6">
                            <label for="lblOfficeAddr" class="col-form-label-sm">Emergency kit</label>
                            <select name="cboEmgKit" id="cboEmgKit" class="form-control form-control-sm">
                            <option>&nbsp;</option>
                            <option value="available">available</option>
                            <option value="No">No</option>
                            </select>
                          </div>
                        </div>
         
                <div class="card-footer">
                  <div class="form-group row">
                    <div class="col-sm-12 text-center">
                      
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
    <script src="instituteFacility.js"></script>    
  </body>
</html>



