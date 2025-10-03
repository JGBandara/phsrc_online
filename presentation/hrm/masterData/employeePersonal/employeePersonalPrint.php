<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-08
 */
//session_start();
//$mainPath = $_SESSION['MAIN_PATH'];
session_start();
$backwardSeparator = "../../../../";
$thisFilePath =  $_SERVER['PHP_SELF'];
$userId 	= $_SESSION['loginId'];
$userFullName 	= $_SESSION['loginFullName'];
$userCompanyId = $_SESSION['companyId'];
$userLocationId = $_SESSION['locationId'];

$script_start_time = microtime(true);

require "{$backwardSeparator}autoLoad.php";

//include  "{$backwardSeparator}dataAccess/connector.php";
include  "{$backwardSeparator}dataAccess/printAccessController.php";

$searchId = (isset($_REQUEST['id']))?$_REQUEST['id']:'';

use presentation\hrm\masterData\classes\cls_hrm_employee_personal;

$model = new cls_hrm_employee_personal($db);
?><!DOCTYPE html>
<html>
  <head>
    <title>Employee Personal</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <?php include "{$backwardSeparator}header.php";?>    <!-- Bootstrap Color Picker 3.1.2-->
    <link href="<?php echo $backwardSeparator;?>vendor/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet">   
    <?php include "{$backwardSeparator}css/reportCss.php";?>
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
      <?php include "{$backwardSeparator}presentation/hrm/menu.php";?>      <!-- End of Sidebar -->

      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

          <!-- Topbar -->
          <?php include "{$backwardSeparator}top.php";?>          <!-- End of Topbar -->

          <!-- Begin Page Content -->
          <div class="container-fluid">
            <table width="100%" cellpadding="0" cellspacing="0" id="tblReportPrint" class="printDoc">
              <tr>
                 
                <td style="padding: <?php echo $paddingTop;?> <?php echo $paddingRight;?> 0px <?php echo $paddingLeft;?>;">
                  <?php include "{$backwardSeparator}letterHead.php"; ?>
                </td>
                                
              </tr>
              <tr>
                  <td colspan="3"></td>
              </tr>
                <tr>
                   
                  <td style="padding: 0px <?php echo $paddingRight;?> 0px <?php echo $paddingLeft;?>; border-bottom: 2px solid #888;">
                    <div style="float: left;">
                      <strong style="font-size: 2em;">Employee Personal Information</strong>
                    </div>
                  </td>
                                  </tr>
                <tr>
                    <td colspan="3"></td>
                </tr>
                <tr>
                   
                  <td style="padding: 0px <?php echo $paddingRight;?> 0px <?php echo $paddingLeft;?>;">
                                    <div align="center">
                  <table width="100%" border="0" align="center" bgcolor="#FFFFFF">
                    <tr>
                      <td>
                        <table align="center" class="rptVerTable">
 
<?php
// Get details
$model->emp_company_id = $userCompanyId;
$model->emp_id = $searchId;
$model = $model->findModel();
?>
 
                          <tr>
                            <th>Id</th>
                            <td><?php echo $model->emp_id;?></td>
                          </tr>
     
                          <tr>
                            <th>Employee No</th>
                            <td><?php echo $model->getEmployeeInformation()->emi_no;?></td>
                          </tr>
     
                          <tr>
                            <th>Calling Name</th>
                            <td><?php echo $model->getEmployeeInformation()->emi_calling_name;?></td>
                          </tr>
     
                          <tr>
                            <th>Initials</th>
                            <td><?php echo $model->emp_initials;?></td>
                          </tr>
     
                          <tr>
                            <th>Middle Name</th>
                            <td><?php echo $model->emp_middle_name;?></td>
                          </tr>
     
                          <tr>
                            <th>Surname</th>
                            <td><?php echo $model->emp_surname;?></td>
                          </tr>
     
                          <tr>
                            <th>Name Denoted By Initials</th>
                            <td><?php echo $model->emp_name_denoted_by_initials;?></td>
                          </tr>
     
                          <tr>
                            <th>Full Name</th>
                            <td><?php echo $model->emp_full_name;?></td>
                          </tr>
     
                          <tr>
                            <th>Other Name</th>
                            <td><?php echo $model->emp_other_name;?></td>
                          </tr>
     
                          <tr>
                            <th>NIC No</th>
                            <td><?php echo $model->emp_nic_no;?></td>
                          </tr>
     
                          <tr>
                            <th>NIC Issue Date</th>
                            <td><?php echo $model->emp_nic_issue_date;?></td>
                          </tr>
     
                          <tr>
                            <th>Nationality</th>
                            <td><?php echo $model->emp_nationality;?></td>
                          </tr>
     
                          <tr>
                            <th>Race</th>
                            <td><?php echo $model->emp_race;?></td>
                          </tr>
     
                          <tr>
                            <th>Religion</th>
                            <td><?php echo $model->emp_religion;?></td>
                          </tr>
     
                          <tr>
                            <th>Gender</th>
                            <td><?php echo $model->getGender();?></td>
                          </tr>
     
                          <tr>
                            <th>Date Of Birth</th>
                            <td><?php echo $model->emp_date_of_birth;?></td>
                          </tr>
     
                          <tr>
                            <th>Blood Group</th>
                            <td><?php echo $model->emp_blood_group;?></td>
                          </tr>
     
                          <tr>
                            <th>Marital Status</th>
                            <td><?php echo $model->getMaritalStatus();?></td>
                          </tr>
     
                          <tr>
                            <th>Married Date</th>
                            <td><?php echo $model->emp_married_date;?></td>
                          </tr>
     
                          <tr>
                            <th>Passport No</th>
                            <td><?php echo $model->emp_passport_no;?></td>
                          </tr>
     
                          <tr>
                            <th>Passport Type</th>
                            <td><?php echo $model->getPassportType();?></td>
                          </tr>
     
                          <tr>
                            <th>Passport Issue Date</th>
                            <td><?php echo $model->emp_passport_issue_date;?></td>
                          </tr>
     
                          <tr>
                            <th>Passport Issue Place</th>
                            <td><?php echo $model->emp_passport_issue_place;?></td>
                          </tr>
     
                          <tr>
                            <th>Passport Expiry Date</th>
                            <td><?php echo $model->emp_passport_expiry_date;?></td>
                          </tr>
     
                          <tr>
                            <th>Passport Countries</th>
                            <td><?php echo $model->emp_passport_countries;?></td>
                          </tr>
     
                          <tr>
                            <th>Driving License No</th>
                            <td><?php echo $model->emp_driving_license_no;?></td>
                          </tr>
     
                          <tr>
                            <th>Driving License Issue Date</th>
                            <td><?php echo $model->emp_driving_license_issue_date;?></td>
                          </tr>
     
                          <tr>
                            <th>Driving License Expiry Date</th>
                            <td><?php echo $model->emp_driving_license_expiry_date;?></td>
                          </tr>
     
                          <tr>
                            <th>Driving License Vehicle Class</th>
                            <td><?php echo $model->emp_driving_license_vehicle_class;?></td>
                          </tr>
     
                          <tr>
                            <th>Remarks</th>
                            <td><?php echo $model->emp_remarks;?></td>
                          </tr>
     
                          <tr>
                            <th>Status</th>
                            <td><?php echo $model->getStatus();?></td>
                          </tr>
     
                          <tr>
                            <th>Is Deleted</th>
                            <td><?php echo $model->getIsDeleted();?></td>
                          </tr>
     
                          <tr>
                            <th>Company</th>
                            <td><?php echo $model->getCompany();?></td>
                          </tr>
     
                          <tr>
                            <th>Created By</th>
                            <td><?php echo $model->getCreatedBy();?></td>
                          </tr>
     
                          <tr>
                            <th>Created On</th>
                            <td><?php echo $model->getCreatedOn();?></td>
                          </tr>
     
                          <tr>
                            <th>Last Modified By</th>
                            <td><?php echo $model->getLastModifiedBy();?></td>
                          </tr>
     
                          <tr>
                            <th>Last Modified On</th>
                            <td><?php echo $model->getLastModifiedOn();?></td>
                          </tr>
     
                          <tr>
                            <th>Deleted By</th>
                            <td><?php echo $model->getDeletedBy();?></td>
                          </tr>
     
                          <tr>
                            <th>Deleted On</th>
                            <td><?php echo $model->getDeletedOn();?></td>
                          </tr>
                              
                          <tr>
                            <td>&nbsp;</td>
                          </tr>
                          <tr height="40">
                              <td align="center" class="normalfntMid" style="padding: 0px   ;" colspan="2">
                                <span class="normalfntRight" style="float: right;">Printed On: <?php echo date("Y/m/d H:i:s") ?></span>
                                <span class="normalfnt" style="float: left;">Printed By:  <?php echo $userFullName ?></span>
                              </td>
                          </tr>
                      </table>
                      </div>
                      </td>
                    </tr>
                  </table>
                  <input type="button" value="Print" class="printBtn" onclick="printDoc('tblReportPrint')"/>
                  <span class="loadTime">Time taken to load : <?php echo number_format((microtime(true)-$script_start_time),3);?></span>
                  </div>
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
<?php include "{$backwardSeparator}footer.php";?> 
    <!-- Bootstrap Color Picker 3.1.2-->
    <script src="<?php echo $backwardSeparator;?>vendor/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
    
    <!-- Common Script -->
    <script src="<?php echo $backwardSeparator;?>js/common.js"></script>
    
    <!-- Reports -->
    <script src="<?php echo $backwardSeparator;?>js/reports.js"></script>
    
  </body>
</html>



