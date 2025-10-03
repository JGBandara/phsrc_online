<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-09
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

use presentation\hrm\masterData\classes\cls_hrm_employee_residential;

$model = new cls_hrm_employee_residential($db);
?><!DOCTYPE html>
<html>
  <head>
    <title>Employee Residential</title>
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
                      <strong style="font-size: 2em;">Employee Residential Information</strong>
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
$model->emr_company_id = $userCompanyId;
$model->emr_id = $searchId;
$model = $model->findModel();
?>
 
                          <tr>
                            <th>Id</th>
                            <td><?php echo $model->emr_id;?></td>
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
                            <th>Permanent Address</th>
                            <td><?php echo $model->emr_permanent_address;?></td>
                          </tr>
     
                          <tr>
                            <th>Permanent Street</th>
                            <td><?php echo $model->emr_permanent_street;?></td>
                          </tr>
     
                          <tr>
                            <th>Permanent City</th>
                            <td><?php echo $model->emr_permanent_city;?></td>
                          </tr>
     
                          <tr>
                            <th>Permanent Postal Code</th>
                            <td><?php echo $model->emr_permanent_postal_code;?></td>
                          </tr>
     
                          <tr>
                            <th>Permanent Telephone</th>
                            <td><?php echo $model->emr_permanent_telephone;?></td>
                          </tr>
     
                          <tr>
                            <th>Permanent Mobile No</th>
                            <td><?php echo $model->emr_permanent_mobile_no;?></td>
                          </tr>
     
                          <tr>
                            <th>Permanent Email</th>
                            <td><?php echo $model->emr_permanent_email;?></td>
                          </tr>
     
                          <tr>
                            <th>Permanent Country</th>
                            <td><?php echo $model->getPermanentCountry();?></td>
                          </tr>
     
                          <tr>
                            <th>Permanent Province</th>
                            <td><?php echo $model->getPermanentProvince();?></td>
                          </tr>
     
                          <tr>
                            <th>Permanent District</th>
                            <td><?php echo $model->getPermanentDistrict();?></td>
                          </tr>
     
                          <tr>
                            <th>Permanent DS Division</th>
                            <td><?php echo $model->getPermanentDsDivision();?></td>
                          </tr>
     
                          <tr>
                            <th>Permanent Electorate</th>
                            <td><?php echo $model->emr_permanent_electorate;?></td>
                          </tr>
     
                          <tr>
                            <th>Current Address</th>
                            <td><?php echo $model->emr_current_address;?></td>
                          </tr>
     
                          <tr>
                            <th>Current Street</th>
                            <td><?php echo $model->emr_current_street;?></td>
                          </tr>
     
                          <tr>
                            <th>Current City</th>
                            <td><?php echo $model->emr_current_city;?></td>
                          </tr>
     
                          <tr>
                            <th>Current Postal Code</th>
                            <td><?php echo $model->emr_current_postal_code;?></td>
                          </tr>
     
                          <tr>
                            <th>Current Telephone General Line</th>
                            <td><?php echo $model->emr_current_telephone_general_line;?></td>
                          </tr>
     
                          <tr>
                            <th>Current Telephone Direct Line</th>
                            <td><?php echo $model->emr_current_telephone_direct_line;?></td>
                          </tr>
     
                          <tr>
                            <th>Current Mobile No</th>
                            <td><?php echo $model->emr_current_mobile_no;?></td>
                          </tr>
     
                          <tr>
                            <th>Current Fax</th>
                            <td><?php echo $model->emr_current_fax;?></td>
                          </tr>
     
                          <tr>
                            <th>Current Email</th>
                            <td><?php echo $model->emr_current_email;?></td>
                          </tr>
     
                          <tr>
                            <th>Current Country</th>
                            <td><?php echo $model->getCurrentCountry();?></td>
                          </tr>
     
                          <tr>
                            <th>Current Province</th>
                            <td><?php echo $model->getCurrentProvince();?></td>
                          </tr>
     
                          <tr>
                            <th>Current District</th>
                            <td><?php echo $model->getCurrentDistrict();?></td>
                          </tr>
     
                          <tr>
                            <th>Current DS Division</th>
                            <td><?php echo $model->getCurrentDsDivision();?></td>
                          </tr>
     
                          <tr>
                            <th>Current Electorate</th>
                            <td><?php echo $model->emr_current_electorate;?></td>
                          </tr>
     
                          <tr>
                            <th>Remarks</th>
                            <td><?php echo $model->emr_remarks;?></td>
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



