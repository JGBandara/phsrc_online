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
$userCompanyId = $_SESSION['companyId'];
$userLocationId = $_SESSION['locationId'];
$employeeId = $_SESSION['employeeId'];
$profileImage = $_SESSION['profileImage'];
//$projectName = substr($_SERVER['PHP_SELF'],0,strpos($_SERVER['PHP_SELF'],'/',1));

require "{$backwardSeparator}autoLoad.php";

include  "{$backwardSeparator}dataAccess/accessController.php";

$searchId = (isset($_REQUEST['id']))?$_REQUEST['id']:'';
  
use presentation\hrm\masterData\classes\cls_hrm_employee_information;
use presentation\hrm\masterData\classes\cls_hrm_employee_personal;
use presentation\hrm\masterData\classes\cls_hrm_employee_bank_account;
use presentation\hrm\masterData\classes\cls_hrm_employee_dependence;
use presentation\hrm\masterData\classes\cls_hrm_employee_residential;
use presentation\hrm\masterData\classes\cls_hrm_employee_emergency;

$information = new cls_hrm_employee_information($db);
$personal = new cls_hrm_employee_personal($db);
$bankAccount = new cls_hrm_employee_bank_account($db);
$dependence = new cls_hrm_employee_dependence($db);
$residential = new cls_hrm_employee_residential($db);
$emergency = new cls_hrm_employee_emergency($db);

$emergency->eme_id = $employeeId;
$emergency = $emergency->findModel();

$bankAccount->ema_employee_id = $employeeId;
$bankAccounts = $bankAccount->getModels();

$dependence->emd_employee_id = $employeeId;
$dependences = $dependence->getModels();

$information->emi_id = $employeeId;
$information = $information->findModel();

$personal->emp_id = $employeeId;
$personal = $personal->findModel();

$residential->emr_id = $employeeId;
$residential = $residential->findModel();
//$model = new cls_hrm_employee_personal($db);
?><!DOCTYPE html>
<html>
  <head>
    <title>Employee Profile</title>
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
            <form class="needs-validation" novalidate id="frmhrm_employee_personal">
              <div class="card">
                <div class="card-header">
                  Employee Profile
                </div>
              </div>
              <br/>
              <div class="card">
                <div class="card-body">
                  <div class="form-row">
                    <div class="col-sm-6">
                      
                      <div class="form-row">
                        <div class="form-group col-sm-4">
                          <label class="col-form-label-sm w-100 p-1"><?php echo $information->attributeLabels()['emi_calling_name']?></label>
                        </div>
                        <div class="form-group col-sm-8">
                          <label  class="col-form-label-sm w-100 p-1"><?php echo $information->emi_calling_name;?></label>
                        </div>
                      </div>
                      
                      <div class="form-row">
                        <div class="form-group col-sm-4">
                          <label class="col-form-label-sm w-100 p-1"><?php echo $personal->attributeLabels()['emp_full_name']?></label>
                        </div>
                        <div class="form-group col-sm-8">
                          <label  class="col-form-label-sm w-100 p-1"><?php echo $personal->emp_full_name;?></label>
                        </div>
                      </div>
                      
                      <div class="form-row">
                        <div class="form-group col-sm-4">
                          <label class="col-form-label-sm w-100 p-1"><?php echo $personal->attributeLabels()['emp_initials']?></label>
                        </div>
                        <div class="form-group col-sm-8">
                          <label  class="col-form-label-sm w-100 p-1"><?php echo $personal->emp_initials;?></label>
                        </div>
                      </div>
                      
                      <div class="form-row">
                        <div class="form-group col-sm-4">
                          <label class="col-form-label-sm w-100 p-1"><?php echo $personal->attributeLabels()['emp_surname']?></label>
                        </div>
                        <div class="form-group col-sm-8">
                          <label  class="col-form-label-sm w-100 p-1"><?php echo $personal->emp_surname;?></label>
                        </div>
                      </div>
                      
                      <div class="form-row">
                        <div class="form-group col-sm-4">
                          <label class="col-form-label-sm w-100 p-1"><?php echo $personal->attributeLabels()['emp_middle_name']?></label>
                        </div>
                        <div class="form-group col-sm-8">
                          <label  class="col-form-label-sm w-100 p-1"><?php echo $personal->emp_middle_name;?></label>
                        </div>
                      </div>
                      
                    </div>
                    <div class="col-sm-6 justify-content-center text-center">
                        <img class="rounded-circle" src="<?php echo $backwardSeparator."img/profile/".$profileImage;?>"/>
                    </div>
                  </div>
                  <!--=====================================-->
                  <div class="form-row">
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1"><?php echo $personal->attributeLabels()['emp_name_denoted_by_initials']?></label>
                    </div>
                    <div class="form-group col-sm-10">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $personal->emp_name_denoted_by_initials;?></label>
                    </div>
                  </div>
                  
                  <div class="form-row">
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1"><?php echo $personal->attributeLabels()['emp_other_name']?></label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $personal->emp_other_name;?></label>
                    </div>
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1"><?php echo $personal->attributeLabels()['emp_nationality']?></label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $personal->emp_nationality;?></label>
                    </div>
                  </div>
                  
                  <div class="form-row">
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1"><?php echo $personal->attributeLabels()['emp_religion']?></label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $personal->emp_religion;?></label>
                    </div>
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1"><?php echo $personal->attributeLabels()['emp_race']?></label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $personal->emp_race;?></label>
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1"><?php echo $personal->attributeLabels()['emp_date_of_birth']?></label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $personal->emp_date_of_birth;?></label>
                    </div>
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1"><?php echo $personal->attributeLabels()['emp_gender']?></label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $personal->getGender();?></label>
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1"><?php echo $personal->attributeLabels()['emp_maritial_status_id']?></label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $personal->getMaritalStatus();?></label>
                    </div>
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1"><?php echo $personal->attributeLabels()['emp_married_date']?></label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $personal->emp_married_date;?></label>
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1"><?php echo $personal->attributeLabels()['emp_nic_no']?></label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $personal->emp_nic_no;?></label>
                    </div>
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1"><?php echo $personal->attributeLabels()['emp_nic_issue_date']?></label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $personal->emp_nic_issue_date;?></label>
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1"><?php echo $personal->attributeLabels()['emp_blood_group']?></label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $personal->emp_blood_group;?></label>
                    </div>
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1"><?php echo $personal->attributeLabels()['emp_status']?></label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $personal->getStatus();?></label>
                    </div>
                  </div>

    <!--=====================================================================-->              
    <!--==========    Residential        ==================-->              
    <!--=====================================================================-->              
                  <div class="form-row">
                    <div class="col text-info"><hr></div>
                    <div class="col-auto text-info">Current Address</div>
                    <div class="col text-info"><hr></div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1">Address</label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $residential->emr_current_address;?></label>
                    </div>
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1">Street</label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $residential->emr_current_street;?></label>
                    </div>
                  </div>
    
                  <div class="form-row">
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1">City</label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $residential->emr_current_city;?></label>
                    </div>
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1">Country</label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $residential->getCurrentCountry();?></label>
                    </div>
                  </div>
    
                  <div class="form-row">
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1">Postal Code</label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $residential->emr_current_postal_code;?></label>
                    </div>
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1">Electorate</label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $residential->emr_current_electorate;?></label>
                    </div>
                  </div>
    
                  <div class="form-row">
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1">DS Division</label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $residential->getCurrentDsDivision();?></label>
                    </div>
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1">District</label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $residential->getCurrentDistrict();?></label>
                    </div>
                  </div>
    
                  <div class="form-row">
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1">Province</label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $residential->getCurrentProvince();?></label>
                    </div>
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1">Email</label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $residential->emr_current_email;?></label>
                    </div>
                  </div>
    
                  <div class="form-row">
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1">Direct Line</label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $residential->emr_current_telephone_direct_line;?></label>
                    </div>
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1">General Line</label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $residential->emr_current_telephone_general_line;?></label>
                    </div>
                  </div>
    
                  <div class="form-row">
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1">Mobile</label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $residential->emr_current_mobile_no;?></label>
                    </div>
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1">Fax</label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $residential->emr_current_fax;?></label>
                    </div>
                  </div>
    
                  <div class="form-row">
                    <div class="col text-info"><hr></div>
                    <div class="col-auto text-info">Permanent Address</div>
                    <div class="col text-info"><hr></div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1">Address</label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $residential->emr_permanent_address;?></label>
                    </div>
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1">Street</label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $residential->emr_permanent_street;?></label>
                    </div>
                  </div>
    
                  <div class="form-row">
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1">City</label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $residential->emr_permanent_city;?></label>
                    </div>
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1">Country</label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $residential->getPermanentCountry();?></label>
                    </div>
                  </div>
    
                  <div class="form-row">
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1">Postal Code</label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $residential->emr_permanent_postal_code;?></label>
                    </div>
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1">Electorate</label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $residential->emr_permanent_electorate;?></label>
                    </div>
                  </div>
    
                  <div class="form-row">
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1">DS Division</label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $residential->getPermanentDsDivision();?></label>
                    </div>
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1">District</label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $residential->getPermanentDistrict();?></label>
                    </div>
                  </div>
    
                  <div class="form-row">
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1">Province</label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $residential->getPermanentProvince();?></label>
                    </div>
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1">Email</label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $residential->emr_permanent_email;?></label>
                    </div>
                  </div>
    
                  <div class="form-row">
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1">Telephone</label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $residential->emr_permanent_telephone;?></label>
                    </div>
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1">Mobile</label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $residential->emr_permanent_mobile_no;?></label>
                    </div>
                  </div>
        
    <!--=====================================================================-->              
    <!--==========    Passport        ==================-->              
    <!--=====================================================================-->              
                  <div class="form-row">
                        <div class="col text-info"><hr></div>
                        <div class="col-auto text-info">Passport</div>
                        <div class="col text-info"><hr></div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1"><?php echo $personal->attributeLabels()['emp_passport_type']?></label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $personal->getPassportType();?></label>
                    </div>
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1"><?php echo $personal->attributeLabels()['emp_passport_no']?></label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $personal->emp_passport_no;?></label>
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1"><?php echo $personal->attributeLabels()['emp_passport_issue_date']?></label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $personal->emp_passport_issue_date;?></label>
                    </div>
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1"><?php echo $personal->attributeLabels()['emp_passport_issue_place']?></label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $personal->emp_passport_issue_place;?></label>
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1"><?php echo $personal->attributeLabels()['emp_passport_countries']?></label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $personal->emp_passport_countries;?></label>
                    </div>
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1"><?php echo $personal->attributeLabels()['emp_passport_expiry_date']?></label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $personal->emp_passport_expiry_date;?></label>
                    </div>
                  </div>
                  
    <!--=====================================================================-->              
    <!--==========    Driving License        ==================-->              
    <!--=====================================================================-->              
                  <div class="form-row">
                        <div class="col text-info"><hr></div>
                        <div class="col-auto text-info">Driving License</div>
                        <div class="col text-info"><hr></div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1"><?php echo $personal->attributeLabels()['emp_driving_license_no']?></label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $personal->emp_driving_license_no;?></label>
                    </div>
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1"><?php echo $personal->attributeLabels()['emp_driving_license_vehicle_class']?></label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $personal->emp_driving_license_vehicle_class;?></label>
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1"><?php echo $personal->attributeLabels()['emp_driving_license_issue_date']?></label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $personal->emp_driving_license_issue_date;?></label>
                    </div>
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1"><?php echo $personal->attributeLabels()['emp_driving_license_expiry_date']?></label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $personal->emp_driving_license_expiry_date;?></label>
                    </div>
                  </div>
    <!--=====================================================================-->              
    <!--==========    Emergency         ==================-->              
    <!--=====================================================================-->              
                  <div class="form-row">
                        <div class="col text-info"><hr></div>
                        <div class="col-auto text-info">Emergency Contact</div>
                        <div class="col text-info"><hr></div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1"><?php echo $emergency->attributeLabels()['eme_full_name']?></label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $emergency->eme_full_name;?></label>
                    </div>
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1"><?php echo $emergency->attributeLabels()['eme_emergency_contact']?></label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $emergency->eme_emergency_contact;?></label>
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1"><?php echo $emergency->attributeLabels()['eme_mobile_no']?></label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $emergency->eme_mobile_no;?></label>
                    </div>
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1"><?php echo $emergency->attributeLabels()['eme_relationship']?></label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $emergency->eme_relationship;?></label>
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1"><?php echo $emergency->attributeLabels()['eme_home_address']?></label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $emergency->eme_home_address;?></label>
                    </div>
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1"><?php echo $emergency->attributeLabels()['eme_home_telephone']?></label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $emergency->eme_home_telephone;?></label>
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1"><?php echo $emergency->attributeLabels()['eme_office_address']?></label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $emergency->eme_office_address;?></label>
                    </div>
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1"><?php echo $emergency->attributeLabels()['eme_office_telephone']?></label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $emergency->eme_office_telephone;?></label>
                    </div>
                  </div>
    <!--=====================================================================-->              
    <!--==========    Dependence         ==================-->              
    <!--=====================================================================-->              
                  <div class="form-row">
                        <div class="col text-info"><hr></div>
                        <div class="col-auto text-info">Dependence</div>
                        <div class="col text-info"><hr></div>
                  </div>
                  <?php  foreach ($dependences as $dependence) {?>
                  <div class="form-row">
                    <div class="form-group col-sm-2 bg-gray-100">
                      <label class="col-form-label-sm w-100 p-1"><?php echo $dependence->attributeLabels()['emd_full_name']?></label>
                    </div>
                    <div class="form-group col-sm-10 bg-gray-100">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $dependence->emd_full_name;?></label>
                    </div>
                  </div>
    
                  <div class="form-row">
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1"><?php echo $dependence->attributeLabels()['emd_date_of_birth']?></label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $dependence->emd_date_of_birth;?></label>
                    </div>
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1"><?php echo $dependence->attributeLabels()['emd_mobile']?></label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $dependence->emd_mobile;?></label>
                    </div>
                  </div>
    
                  <div class="form-row">
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1"><?php echo $dependence->attributeLabels()['emd_nic_no']?></label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $dependence->emd_nic_no;?></label>
                    </div>
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1"><?php echo $dependence->attributeLabels()['emd_telephone']?></label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $dependence->emd_telephone;?></label>
                    </div>
                  </div>
    
                  <div class="form-row">
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1"><?php echo $dependence->attributeLabels()['emd_entitled_death_donation']?></label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $dependence->getEntitledDeathDonation();?></label>
                    </div>
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1"><?php echo $dependence->attributeLabels()['emd_entitled_medical_benifits']?></label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $dependence->getEntitledMedicalBenefits();?></label>
                    </div>
                  </div>
    
                  <div class="form-row">
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1"><?php echo $dependence->attributeLabels()['emd_living']?></label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $dependence->getLiving();?></label>
                    </div>
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1"><?php echo $dependence->attributeLabels()['emd_marital_status_id']?></label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $dependence->getMaritalStatus();?></label>
                    </div>
                  </div>
    
                  <div class="form-row">
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1"><?php echo $dependence->attributeLabels()['emd_provident_fund_nominee']?></label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $dependence->getProvidentFundNominee();?></label>
                    </div>
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1"><?php echo $dependence->attributeLabels()['emd_same_office']?></label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $dependence->getSameOffice();?></label>
                    </div>
                  </div>
    
                  <div class="form-row">
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1"><?php echo $dependence->attributeLabels()['emd_permanent_address']?></label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $dependence->emd_permanent_address;?></label>
                    </div>
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1"><?php echo $dependence->attributeLabels()['emd_working_address']?></label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $dependence->emd_working_address;?></label>
                    </div>
                  </div>
    
                  <div class="form-row">
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1"><?php echo $dependence->attributeLabels()['emd_working_telephone']?></label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $dependence->emd_working_telephone;?></label>
                    </div>
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1"><?php echo $dependence->attributeLabels()['emd_work_type']?></label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $dependence->getWorkType();?></label>
                    </div>
                  </div>

                    
                  <?php }?>
    <!--=====================================================================-->              
    <!--==========    Dependence         ==================-->              
    <!--=====================================================================-->              
                  <div class="form-row">
                        <div class="col text-info"><hr></div>
                        <div class="col-auto text-info">Bank Accounts</div>
                        <div class="col text-info"><hr></div>
                  </div>
                  <?php  foreach ($bankAccounts as $bankAccount) {?>
                  <div class="form-row">
                    <div class="form-group col-sm-2 bg-gray-100">
                      <label class="col-form-label-sm w-100 p-1"><?php echo $bankAccount->attributeLabels()['ema_account_no']?></label>
                    </div>
                    <div class="form-group col-sm-10 bg-gray-100">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $bankAccount->ema_account_no;?></label>
                    </div>
                  </div>
    
                  <div class="form-row">
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1"><?php echo $bankAccount->attributeLabels()['ema_bank_id']?></label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $bankAccount->getBank();?></label>
                    </div>
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1"><?php echo $bankAccount->attributeLabels()['ema_branch_id']?></label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $bankAccount->getBranch();?></label>
                    </div>
                  </div>
    
                  <div class="form-row">
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1"><?php echo $bankAccount->attributeLabels()['ema_account_holder']?></label>
                    </div>
                    <div class="form-group col-sm-10">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $bankAccount->ema_account_holder;?></label>
                    </div>
                  </div>
    
                  <div class="form-row">
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1"><?php echo $bankAccount->attributeLabels()['ema_account_type']?></label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $bankAccount->getAccountType();?></label>
                    </div>
                    <div class="form-group col-sm-2">
                      <label class="col-form-label-sm w-100 p-1"><?php echo $bankAccount->attributeLabels()['ema_amount']?></label>
                    </div>
                    <div class="form-group col-sm-4">
                      <label  class="col-form-label-sm w-100 p-1"><?php echo $bankAccount->ema_amount;?></label>
                    </div>
                  </div>
    
                  <?php }?>
    <!--=====================================================================-->              
    <!--==========    Personal End        ==================-->              
    <!--=====================================================================-->              
                </div>
                <div class="card-footer">
                  <div class="form-group row">
                    <div class="col-sm-12 text-center">
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
    
  </body>
</html>



