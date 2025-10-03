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
?><!DOCTYPE html>
<html>
  <head>
    <title>Institute Information</title>
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
      <?php include "{$backwardSeparator}presentation/mcdc/menu.php";?>      <!-- End of Sidebar -->

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
                            <label for="cboRecKeeping" class="col-form-label-sm">Date of Establishment</label>
                            <input type="text" class="form-control form-control-sm datepicker_past" id="txtEstDate" name="txtEstDate" placeholder="">
                          </div>
                          
                          <div class="form-group col-sm-6">
                            <label for="txtSpecAvailability" class="col-form-label-sm">Company/ Business registration no.-</label>
                            <input type="text" class="form-control form-control-sm" id="txtBR" name="txtBR" placeholder="">
                          </div>
                         
                        </div>
                        
                        <div class="form-row">
                          <div class="form-group col-sm-6">
                            <label for="cboLabFacility" class="col-form-label-sm">BOI registration</label>
                            <input type="text" class="form-control form-control-sm" id="txtBOI" name="txtBOI" placeholder="">
                          </div>
                          
                          
                         
                        </div>
                        
                        <div class="form-row">
                          <div class="form-group col-sm-6">
                            <table class="table table-hover col-sm-12" id="tblMainGrid2">
    <tr style="background-color:#9CF">
      <th scope="col" colspan="2">Type of the institution –</th>
    </tr>
    
    <tr><td colspan="2"><select class="form-control form-control-sm" name="cboInsType" id="cboInsType">
                <option value=""></option>
                <option value="Medical Center">Medical Center</option>
                <option value="Screening Center">Screening Center</option>
                <option value="Day care Medical Center">Day care Medical Center</option>
                 <option value="Day care Medical Center">Channel Consultation</option>
                <option value="Other">Other</option>
            </select></td></tr>
   
    <tr><td>Other</td><td><input type="text" class="form-control form-control-sm" id="txtInsOther" name="txtInsOther"></td></tr>
   
    </table>
                          
                          
                          
                          </div>
                          
                          <div class="form-group col-sm-6">
                            <table class="table table-hover col-sm-12" id="tblMainGrid2">
    <tr style="background-color:#9CF">
      <th scope="col" colspan="2">Ownership status –</th>
    </tr>
    <tr><td colspan="2"><select class="form-control form-control-sm" name="cboOwnership" id="cboOwnership">
                  <option value=""></option>
                 <?php   $sql = "SELECT
						ownership_id,
						ownership
						FROM
						tbl_owner
						ORDER BY ownership_id DESC
						";
						$result=$db->singleQuery($sql);
						while($row=mysqli_fetch_array($result))
						{
							echo "<option value=\"".$row['ownership_id']."\">".$row['ownership']." </option>";
						}
          ?>
                
            </select></td></tr>
    <tr><td>Other</td><td><input type="text" class="form-control form-control-sm" id="txtOwnOther" name="txtOwnOther"></td></tr>
     
    </table>
                          
                          
                          
                          </div>
                         
                        </div>
                        
                        
                        <div class="form-row">
                          <div class="form-group col-sm-6">
                            
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



