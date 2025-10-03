<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-07
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

use presentation\system\masterData\classes\cls_sys_companies;

$model = new cls_sys_companies($db);
?><!DOCTYPE html>
<html>
  <head>
    <title>Company</title>
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
      <?php include "{$backwardSeparator}presentation/system/menu.php";?>      <!-- End of Sidebar -->

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
                      <strong style="font-size: 2em;">Company</strong>
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
$model->syc_company_id = $userCompanyId;
$model->syc_id = $searchId;
$model = $model->findModel();
?>
 
                          <tr>
                            <th>Code</th>
                            <td><?php echo $model->syc_code;?></td>
                          </tr>
     
                          <tr>
                            <th>Name</th>
                            <td><?php echo $model->syc_name;?></td>
                          </tr>
     
                          <tr>
                            <th>Country</th>
                            <td><?php echo $model->getCountry();?></td>
                          </tr>
     
                          <tr>
                            <th>Web Site</th>
                            <td><?php echo $model->syc_web_site;?></td>
                          </tr>
     
                          <tr>
                            <th>Remarks</th>
                            <td><?php echo $model->syc_remarks;?></td>
                          </tr>
     
                          <tr>
                            <th>Account No</th>
                            <td><?php echo $model->syc_account_no;?></td>
                          </tr>
     
                          <tr>
                            <th>Registration No</th>
                            <td><?php echo $model->syc_registration_no;?></td>
                          </tr>
     
                          <tr>
                            <th>Vat No</th>
                            <td><?php echo $model->syc_vat_no;?></td>
                          </tr>
     
                          <tr>
                            <th>Svat No</th>
                            <td><?php echo $model->syc_svat_no;?></td>
                          </tr>
     
                          <tr>
                            <th>Working Day Type</th>
                            <td><?php echo $model->syc_working_day_type;?></td>
                          </tr>
     
                          <tr>
                            <th>Base Currency</th>
                            <td><?php echo $model->getBaseCurrency();?></td>
                          </tr>
     
                          <tr>
                            <th>Tax Applicable</th>
                            <td><?php echo $model->getTaxApplicable();?></td>
                          </tr>
     
                          <tr>
                            <th>Nopay Consider</th>
                            <td><?php echo $model->getNoPayConsider();?></td>
                          </tr>
     
                          <tr>
                            <th>Menu Order</th>
                            <td><?php echo $model->syc_menu_order;?></td>
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



