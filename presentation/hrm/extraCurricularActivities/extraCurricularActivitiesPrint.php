<?php
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-23
 */
//session_start();
//$mainPath = $_SESSION['MAIN_PATH'];
session_start();
$backwardSeparator = "../../../";
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

use presentation\hrm\classes\cls_hrm_trn_extra_curricular_activities;

$model = new cls_hrm_trn_extra_curricular_activities($db);
?><!DOCTYPE html>
<html>
  <head>
    <title> Extra Curricular Activities</title>
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
          <div class="container-fluid" id="tblReportPrint">
            <div class="row border-dark border-bottom border-2" style="padding: <?php echo $paddingTop;?> <?php echo $paddingRight;?> 0px <?php echo $paddingLeft;?>;">
              <div class="col-sm-12">
                 
                  <?php include "{$backwardSeparator}letterHead.php"; ?>
                                
              </div>
            </div>
            <div class="row border-dark border-bottom border-2 mb-2" style="padding: 0px <?php echo $paddingRight;?> 0px <?php echo $paddingLeft;?>;">
              <div class="col-sm-12">
                   
                      <strong style="font-size: 2em;"> Extra Curricular Activities</strong>
                </div>
            </div>
 
<?php
// Get details
$model->eca_company_id = $userCompanyId;
$model->eca_id = $searchId;
$model = $model->findModel();
?>
 
            <div class="row">
              <div class="col-sm-3 p-2 bg-dark text-white border-white border-bottom">Employee No</div>
              <div class="col-sm-9 p-2"><?php echo $model->getEmployeeInformation()->emi_no;?></div>
            </div>
            <div class="row">
              <div class="col-sm-3 p-2 bg-dark text-white border-white border-bottom">Calling Name</div>
              <div class="col-sm-9 p-2"><?php echo $model->getEmployeeInformation()->emi_calling_name;?></div>
            </div>
     
            <div class="row">
              <div class="col-sm-3 p-2 bg-dark text-white border-white border-bottom"><?php echo $model->attributeLabels()['eca_category'];?></div>
              <div class="col-sm-9 p-2"><?php echo $model->eca_category;?></div>
            </div>
     
            <div class="row">
              <div class="col-sm-3 p-2 bg-dark text-white border-white border-bottom"><?php echo $model->attributeLabels()['eca_type'];?></div>
              <div class="col-sm-9 p-2"><?php echo $model->eca_type;?></div>
            </div>
     
            <div class="row">
              <div class="col-sm-3 p-2 bg-dark text-white border-white border-bottom"><?php echo $model->attributeLabels()['eca_achievement'];?></div>
              <div class="col-sm-9 p-2"><?php echo $model->eca_achievement;?></div>
            </div>
     
            <div class="row">
              <div class="col-sm-3 p-2 bg-dark text-white border-white border-bottom"><?php echo $model->attributeLabels()['eca_date'];?></div>
              <div class="col-sm-9 p-2"><?php echo $model->eca_date;?></div>
            </div>
     
            <div class="row">
              <div class="col-sm-3 p-2 bg-dark text-white border-white border-bottom"><?php echo $model->attributeLabels()['eca_remarks'];?></div>
              <div class="col-sm-9 p-2"><?php echo $model->eca_remarks;?></div>
            </div>
     
            <div class="row">
              <div class="col-sm-3 p-2 bg-dark text-white border-white border-bottom"><?php echo $model->attributeLabels()['eca_status'];?></div>
              <div class="col-sm-9 p-2"><?php echo $model->getStatus();?></div>
            </div>
     
            <div class="row">
              <div class="col-sm-3 p-2 bg-dark text-white border-white border-bottom"><?php echo $model->attributeLabels()['eca_is_deleted'];?></div>
              <div class="col-sm-9 p-2"><?php echo $model->getIsDeleted();?></div>
            </div>
     
            <div class="row">
              <div class="col-sm-3 p-2 bg-dark text-white border-white border-bottom"><?php echo $model->attributeLabels()['eca_company_id'];?></div>
              <div class="col-sm-9 p-2"><?php echo $model->getCompany();?></div>
            </div>
     
            <div class="row">
              <div class="col-sm-3 p-2 bg-dark text-white border-white border-bottom"><?php echo $model->attributeLabels()['eca_created_by'];?></div>
              <div class="col-sm-9 p-2"><?php echo $model->getCreatedBy();?></div>
            </div>
     
            <div class="row">
              <div class="col-sm-3 p-2 bg-dark text-white border-white border-bottom"><?php echo $model->attributeLabels()['eca_created_on'];?></div>
              <div class="col-sm-9 p-2"><?php echo $model->getCreatedOn();?></div>
            </div>
     
            <div class="row">
              <div class="col-sm-3 p-2 bg-dark text-white border-white border-bottom"><?php echo $model->attributeLabels()['eca_last_modified_by'];?></div>
              <div class="col-sm-9 p-2"><?php echo $model->getLastModifiedBy();?></div>
            </div>
     
            <div class="row">
              <div class="col-sm-3 p-2 bg-dark text-white border-white border-bottom"><?php echo $model->attributeLabels()['eca_last_modified_on'];?></div>
              <div class="col-sm-9 p-2"><?php echo $model->getLastModifiedOn();?></div>
            </div>
     
            <div class="row">
              <div class="col-sm-3 p-2 bg-dark text-white border-white border-bottom"><?php echo $model->attributeLabels()['eca_deleted_by'];?></div>
              <div class="col-sm-9 p-2"><?php echo $model->getDeletedBy();?></div>
            </div>
     
            <div class="row">
              <div class="col-sm-3 p-2 bg-dark text-white border-white border-bottom"><?php echo $model->attributeLabels()['eca_deleted_on'];?></div>
              <div class="col-sm-9 p-2"><?php echo $model->getDeletedOn();?></div>
            </div>
                              
            <div class="row border-dark border-top border-2 mt-2">
                <div class="col-sm-12 p-2" align="center" class="normalfntMid" style="padding: 0px   ;" colspan="2">
                  <span class="normalfntRight" style="float: right;">Printed On: <?php echo date("Y/m/d H:i:s") ?></span>
                  <span class="normalfnt" style="float: left;">Printed By:  <?php echo $userFullName ?></span>
                </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                  <input type="button" value="Print" class="printBtn" onclick="printDoc('tblReportPrint')"/>
                  <span class="loadTime">Time taken to load : <?php echo number_format((microtime(true)-$script_start_time),3);?></span>
              </div>
            </div>
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



