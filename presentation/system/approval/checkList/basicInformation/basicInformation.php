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
//$model = new cls_hrm_employee_information($db);
?><!DOCTYPE html>
<html>
  <head>
    <title>Basic Information</title>
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
    <style type="text/css">
      .avatar-pic {
        width: 150px;
      }
      .Profile-input-file{
          height:180px;width:180px;
          position: absolute;
          top: 0px;
          z-index: 999;
          opacity: 0 !important;
      }
    </style>
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
            <form class="needs-validation" novalidate id="frm_basic_information" enctype="multipart/form-data">
              <div class="card">
                <div class="card-header">
                  Check List
                </div>
                <div class="card-body">
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <select class="form-control form-control-sm" onkeyup="filterSelect()" id="cboSearch" name="cboSearch" placeholder="Search..">
                      </select>
                    </div>
                </div>
                </div>
              </div>
              <br/>
              <div class="card">
                <div class="card-body">
                  <?php include '../instituteTabs.php';?>
                 <div id="personal">
                    <div class="form-row">
                      <div class="col-sm-12">

                        <div class="form-row col-sm-12" id="instype_id">
                          <div class="form-group col-md-3">Institute type id </div>
                          <div class="form-group col-md-3">&nbsp;</div>
                          <div class="form-group col-md-3"> &nbsp;</div>
                          <div class="form-group col-md-3">&nbsp;<input type="text" id="insTypeId" class="form-group"  name="insTypeId" disabled/></div>
                        </div>

        <!-----------Ambulance servicess-->
        <div style="" id="ambser">
          <div class="form-row">
            <div class="form-group col-md-3">Name of the person operating the Ambulance Service</div>
            <div class="form-group col-md-3">:&nbsp;
              <input type="text" id="txtambName" class="form-group" name="txtambName"/>
            </div>
            <div class="form-group col-md-3">Number of Doctors available </div>
            <div class="form-group col-md-3">:&nbsp;
              <input type="text" id="txtNoDoctor" class="form-group" name="txtNoDoctor"/>
            </div>
          </div>
        
          <div class="form-row">
            <div class="form-group col-md-3">Number of Nurses available </div>
            <div class="form-group col-md-3">:&nbsp;
              <input type="text" id="txtNoNurs" class="form-group" name="txtNoNurs"/>
            </div>
            <div class="form-group col-md-3">Number of Ambulances </div>
            <div class="form-group col-md-3">:&nbsp;
              <input type="text" id="txtnoAmbulance" class="form-group" name="txtnoAmbulance"/>
            </div>
          </div>
 
          <div class="form-row">
            <div class="form-group col-md-3">Model</div>
            <div class="form-group col-md-3">:&nbsp;
              <input type="text" id="txtnoModel" class="form-group" name="txtnoModel"/>
            </div>
            <div class="form-group col-md-3">&nbsp;</div>
            <div class="form-group col-md-3">&nbsp;
              <label class="textStyle" id="txtPaymentDate"></label>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-3">Facilities available</div>
            <div class="form-group col-md-3">:&nbsp;
              <input type="text" id="txtfacility" class="form-group" name="txtfacility"/>
            </div>
            <div class="form-group col-md-3">Equipment available </div>
            <div class="form-group col-md-3">&nbsp;
              <input type="text" id="txtequipment" class="form-group" name="txtequipment"/>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-3">Number of Drivers available</div>
            <div class="form-group col-md-3">:&nbsp;
              <input type="text" id="txtDriverAv" class="form-group" name="txtDriverAv"/>
            </div>
            <div class="form-group col-md-3">Extracts of the RMV registration</div>
            <div class="form-group col-md-3">&nbsp;
              <input type="text" id="txtRMVreg" class="form-group" name="txtRMVreg"/>
            </div>
          </div>
        </div> 
        
        <!--end ambulance-->
 
           

        
    
        
                        
          <!--end dental lab-->                   
      <!-- ------------------------laboratory---------------- --------------------------------------------------------->       
          <div  id="mdLab">
            <div class="form-row">
              <div class="form-group col-md-3">Name of the person operating the Laboratory </div>
              <div class="form-group col-md-3">&nbsp;</div>
              <div class="form-group col-md-3"> &nbsp;</div>
              <div class="form-group col-md-3">&nbsp;<input type="text" id="lab_person" class="form-group"  name="lab_person"/></div>
            </div>
                  
            <div class="form-row">
              <div class="form-group col-md-3">Name of the Pathologist </div>
              <div class="form-group col-md-3">:&nbsp;<input type="text" id="lab_pathologis" class="form-group"  name="lab_pathologis"/></div>
              <div class="form-group col-md-3"> Sri Lanka Medical Council (SLMC) registration no </div>
              <div class="form-group col-md-3">:&nbsp;<input type="text" id="lab_path_reg" class="form-group"  name="lab_path_reg"/></div>
            </div>
          
            <div class="form-row">
              <div class="form-group col-md-3">Whether Full Time/ Part Time </div>
              <div class="form-group col-md-3">:&nbsp;<input type="text" id="lab_pathWh" class="form-group" name="lab_pathWh"/></div>
              <div class="form-group col-md-3"> &nbsp;</div>
              <div class="form-group col-md-3">:&nbsp;
                <label class="textStyle" id="txtPaymentDate"></label>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-3">Name of the Microbiologist</div>
              <div class="form-group col-md-3">:&nbsp;<input type="text" id="lab_NameMicro" class="form-group" name="lab_NameMicro"/></div>
              <div class="form-group col-md-3"> Sri Lanka Medical Council (SLMC) registration no</div>
              <div class="form-group col-md-3">&nbsp;
                <input type="text" id="lab_micSlmc" class="form-group" name="lab_micSlmc"/>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-3">Whether Full Time/ Part Time</div>
              <div class="form-group col-md-3">:&nbsp;
                <input type="text" id="lab_micWh" class="form-group" name="lab_micWh"/></div><div class="form-group col-md-3"> &nbsp;
                </div>
                <div class="form-group col-md-3">&nbsp;</div>
              </div>

            <div class="form-row">
              <div class="form-group col-md-3">Name of the Chemical Pathologist</div>
              <div class="form-group col-md-3">:&nbsp;
                <input type="text" id="lab_nameChemi" class="form-group" name="lab_nameChemi"/>
              </div>
              <div class="form-group col-md-3"> Sri Lanka Medical Council (SLMC) registration no</div>
              <div class="form-group col-md-3">&nbsp;
                <input type="text" id="lab_cemSlmc" class="form-group" name="lab_cemSlmc"/>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-3">Whether Full Time/ Part Time</div>
              <div class="form-group col-md-3">:&nbsp;
                <input type="text" id="lab_cemWh" class="form-group" name="lab_cemWh"/>
              </div>
              <div class="form-group col-md-3"> &nbsp;</div>
              <div class="form-group col-md-3">&nbsp;</div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-3">Internal and External Quality Controlling</div>
              <div class="form-group col-md-3">:&nbsp;
                <input type="text" id="lab_qtyControl" class="form-group" name="lab_qtyControl"/>
              </div>
              <div class="form-group col-md-3">Facilities available </div>
              <div class="form-group col-md-3">:&nbsp;
                <input type="text" id="lab_faciCemi" class="form-group" name="lab_faciCemi"/>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-3">Method of Clinical Waste Disposal</div>
              <div class="form-group col-md-3">:&nbsp;
                <input type="text" id="lab_disposal" class="form-group" name="lab_disposal"/></div><div class="form-group col-md-3"> &nbsp;
              </div>
              <div class="form-group col-md-3">&nbsp;</div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-3">Business registration no. </div>
              <div class="form-group col-md-3">:&nbsp;
                <input type="text" id="lab_cembisReg" class="form-group" name="lab_cembisReg"/>
              </div>
              <div class="form-group col-md-3">&nbsp;</div>
              <div class="form-group col-md-3">&nbsp;</div>
            </div>
          </div>
          <!---------------------end laboratory--------->

          <!---------------Dental Lab----------------------------->          
          <div style="" id="densu">
            
            <div class="form-row">
              <div class="form-group col-md-3">Name of the Dental Surgeon maintaining the Dental Institute</div>
              <div class="form-group col-md-3">:&nbsp;
                <input type="text" id="densu_surgeonname" class="form-group" name="densu_surgeonname"/>
              </div>
              <div class="form-group col-md-3">(SLMC) registration no</div>
              <div class="form-group col-md-3">:&nbsp;
                <input type="text" id="densu_surgeonreg" class="form-group" name="densu_surgeonreg"/>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-3">Name of the Dental Surgeon Assistant</div>
              <div class="form-group col-md-3">:&nbsp;
                <input type="text" id="densu_assisname" class="form-group" name="densu_assisname"/>
              </div>
              <div class="form-group col-md-3">Whether Full time or Part time</div>
              <div class="form-group col-md-3">:&nbsp;
                <input type="text" id="densu_surgeonfull" class="form-group" name="densu_surgeonfull"/>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-3">Hours of Practice</div>
              <div class="form-group col-md-3">:&nbsp;
                <input type="text" id="densu_prachours" class="form-group" name="densu_prachours"/>
              </div>
              <div class="form-group col-md-3">&nbsp;</div>
              <div class="form-group col-md-3">&nbsp;
                <label class="textStyle" id="txtPaymentDate"></label>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-3"><b>Basic Level</b></div>
              <div class="form-group col-md-3">&nbsp;</div>
              <div class="form-group col-md-3">&nbsp;</div>
              <div class="form-group col-md-3">&nbsp;
                <label class="textStyle" id="txtPaymentDate"></label>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <div class="card">
                  <div class="card-body">
                    <table class="table table-hover table-bordered small" id="tblstaffManagemnt">
                      <thead class="">
                        <tr>
                          <th style="width: 100%;" colspan="2">Equipments</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td align='center' class='p-1'>Examination bed</td>
                          <td class='p-1'><input type="text" id="densu_examBed" name="densu_examBed"/></td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>Table and chairs</td>
                          <td class='p-1'>
                            <input type="text" id="densu_tableChair" name="densu_tableChair"/>
                          </td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>Wash basin</td>
                          <td class='p-1'>
                            <input type="text" id="densu_washBasin" name="densu_washBasin"/>
                          </td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>Weighing scale</td>
                          <td class='p-1'>
                            <input type="text" id="densu_weighingscale" name="densu_weighingscale"/>
                          </td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>Adequate ventilation and illumination</td>
                          <td class='p-1'>
                            <input type="text" id="densu_ventilation" name="densu_ventilation"/>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>  
              </div>
              <div class="form-group col-md-6">
                <div class="card">
                  <div class="card-body">
                    <table class="table table-hover table-bordered small" id="tblstaffManagemnt">
                      <thead class="">
                        <tr>
                          <th style="width: 100%;" colspan="2">Disposables and Accessories</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td align='center' class='p-1'>Needles</td>
                          <td class='p-1'><input type="text" id="densu_needles" name="densu_needles"/></td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>Syringes</td>
                          <td class='p-1'><input type="text" id="densu_siringer" name="densu_siringer"/></td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>Masks</td>
                          <td class='p-1'><input type="text" id="densu_mask" name="densu_mask"/></td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>Gloves</td>
                          <td class='p-1'><input type="text" id="densu_gloves" name="densu_gloves"/></td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>Cups</td>
                          <td class='p-1'><input type="text" id="densu_cups" name="densu_cups"/></td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>Aprons</td>
                          <td class='p-1'><input type="text" id="densu_apron" name="densu_apron"/></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>  
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <div class="card">
                  <div class="card-body">
                    <table class="table table-hover table-bordered small" id="tblstaffManagemnt">
                      <thead class="">
                        <tr>
                          <th style="width: 100%;" colspan="2">Consumables</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td align='center' class='p-1'>Materials for basic restorative</td>
                          <td class='p-1'>
                            <input type="text" id="densu_consumaterial" name="densu_consumaterial"/>
                          </td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>Prosthetic and surgical procedures</td>
                          <td class='p-1'>
                            <input type="text" id="densu_prosthetic" name="densu_prosthetic"/>
                          </td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>Adequate water and electricity facilities</td>
                          <td class='p-1'>
                            <input type="text" id="densu_adeqwater" name="densu_adeqwater"/>
                          </td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>Hygienic waste disposal</td>
                          <td class='p-1'>
                            <input type="text" id="densu_hygenicdispos" name="densu_hygenicdispos"/>
                          </td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>System of record keeping</td>
                          <td class='p-1'>
                            <input type="text" id="densu_sysrecords" name="densu_sysrecords"/>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>  
              </div>
              <div class="form-group col-md-6">
              <div class="form-group col-md-3">&nbsp;</div>
              <div class="form-group col-md-3">&nbsp;</div>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-3"><b>Moderate Level</b></div>
              <div class="form-group col-md-3">&nbsp;</div>
              <div class="form-group col-md-3">&nbsp;</div>
              <div class="form-group col-md-3">&nbsp;
                <label class="textStyle" id="txtPaymentDate"></label>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <div class="card">
                  <div class="card-body">
                    <table class="table table-hover table-bordered small" id="tblstaffManagemnt">
                      <thead class="">
                        <tr>
                          <th style="width: 100%;" colspan="2"></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td align='center' class='p-1'>Patient waiting area (Minimum eight chairs)</td>
                          <td class='p-1'>
                            <input type="text" id="densu_patientwaiting" name="densu_patientwaiting"/>
                          </td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>Reception area with adequate ventilation and  illumination</td>
                          <td class='p-1'>
                            <input type="text" id="densu_receptionarea" name="densu_receptionarea"/>
                          </td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>Surgery area (Minimum 250 Sq.ft.)</td>
                          <td class='p-1'>
                            <input type="text" id="densu_surgeryarea" name="densu_surgeryarea"/>
                          </td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>Adequate toilet facilities</td>
                          <td class='p-1'>
                            <input type="text" id="densu_adeqtoilt" name="densu_adeqtoilt"/>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>  
              </div>
              <div class="form-group col-md-6">
                <div class="card">
                  <div class="card-body">
                    <table class="table table-hover table-bordered small" id="tblstaffManagemnt">
                      <thead class="">
                        <tr>
                          <th style="width: 100%;" colspan="2">Equipments</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td align='center' class='p-1'>Examination bed</td>
                          <td class='p-1'><input type="text" id="densu_modexamBed" name="densu_modexamBed"/></td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>Table and chairs</td>
                          <td class='p-1'>
                            <input type="text" id="densu_modtableChair" name="densu_modtableChair"/>
                          </td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>Wash basin</td>
                          <td class='p-1'>
                            <input type="text" id="densu_modwashBasin" name="densu_modwashBasin"/>
                          </td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>Weighing scale</td>
                          <td class='p-1'>
                            <input type="text" id="densu_modweighingscale" name="densu_modweighingscale"/>
                          </td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>Adequate ventilation and illumination</td>
                          <td class='p-1'>
                            <input type="text" id="densu_modventilation" name="densu_modventilation"/>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>  
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <div class="card">
                  <div class="card-body">
                  <table class="table table-hover table-bordered small" id="tblstaffManagemnt">
                      <thead class="">
                        <tr>
                          <th style="width: 100%;" colspan="2">Disposables and Accessories</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td align='center' class='p-1'>Needles</td>
                          <td class='p-1'><input type="text" id="densu_modneedles" name="densu_modneedles"/></td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>Syringes</td>
                          <td class='p-1'><input type="text" id="densu_modsiringer" name="densu_modsiringer"/></td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>Masks</td>
                          <td class='p-1'><input type="text" id="densu_modmask" name="densu_modmask"/></td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>Gloves</td>
                          <td class='p-1'><input type="text" id="densu_modgloves" name="densu_modgloves"/></td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>Cups</td>
                          <td class='p-1'><input type="text" id="densu_modcups" name="densu_modcups"/></td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>Aprons</td>
                          <td class='p-1'><input type="text" id="densu_modapron" name="densu_modapron"/></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>  
              </div>
              <div class="form-group col-md-6">
                <div class="card">
                  <div class="card-body">
                    <table class="table table-hover table-bordered small" id="tblstaffManagemnt">
                      <thead class="">
                        <tr>
                          <th style="width: 100%;" colspan="2">Consumables</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td align='center' class='p-1'>Materials for basic restorative</td>
                          <td class='p-1'>
                            <input type="text" id="densu_modconsumaterial" name="densu_modconsumaterial"/>
                          </td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>Prosthetic and surgical procedures</td>
                          <td class='p-1'>
                            <input type="text" id="densu_modprosthetic" name="densu_modprosthetic"/>
                          </td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>Adequate water and electricity facilities</td>
                          <td class='p-1'>
                            <input type="text" id="densu_modadeqwater" name="densu_modadeqwater"/>
                          </td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>Hygienic waste disposal</td>
                          <td class='p-1'>
                            <input type="text" id="densu_modhygenicdispos" name="densu_modhygenicdispos"/>
                          </td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>System of record keeping</td>
                          <td class='p-1'>
                            <input type="text" id="densu_modsysrecords" name="densu_modsysrecords"/>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>  
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-3"><b>Excellent Level</b></div>
              <div class="form-group col-md-3">&nbsp;</div>
              <div class="form-group col-md-3">&nbsp;</div>
              <div class="form-group col-md-3">&nbsp;
                <label class="textStyle" id="txtPaymentDate"></label>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <div class="card">
                  <div class="card-body">
                    <table class="table table-hover table-bordered small" id="tblstaffManagemnt">
                      <thead class="">
                        <tr>
                          <th style="width: 100%;" colspan="2">Equipments</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td align='center' class='p-1'>Autoclaves</td>
                          <td class='p-1'>
                            <input type="text" id="densu_autoclaves" name="densu_autoclaves"/>
                          </td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>Light cure</td>
                          <td class='p-1'>
                            <input type="text" id="densu_lightcure" name="densu_lightcure"/>
                          </td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>Scalars</td>
                          <td class='p-1'>
                            <input type="text" id="densu_scalars" name="densu_scalars"/>
                          </td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>Air Rotors</td>
                          <td class='p-1'>
                            <input type="text" id="densu_airrotors" name="densu_airrotors"/>
                          </td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>X-ray facilities</td>
                          <td class='p-1'>
                            <input type="text" id="densu_xrayfaci" name="densu_xrayfaci"/>
                          </td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>Amalgamators</td>
                          <td class='p-1'>
                            <input type="text" id="densu_amalgamators" name="densu_amalgamators"/>
                          </td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>Intraoral cameras</td>
                          <td class='p-1'>
                            <input type="text" id="densu_intracam" name="densu_intracam"/>
                          </td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>Refrigerator</td>
                          <td class='p-1'>
                            <input type="text" id="densu_refrigerator" name="densu_refrigerator"/>
                          </td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>Storage facilities</td>
                          <td class='p-1'>
                            <input type="text" id="densu_storagefaci" name="densu_storagefaci"/>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>  
              </div>
              <div class="form-group col-md-6">
                <div class="card">
                  <div class="card-body">
                    <table class="table table-hover table-bordered small" id="tblstaffManagemnt">
                      <thead class="">
                        <tr>
                          <th style="width: 100%;" colspan="2">Disposables and Accessories</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td align='center' class='p-1'>Needles</td>
                          <td class='p-1'>
                            <input type="text" id="densu_excelneedles" name="densu_excelneedles"/>
                          </td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>Syringes</td>
                          <td class='p-1'>
                            <input type="text" id="densu_excelsiringer" name="densu_excelsiringer"/>
                          </td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>Masks</td>
                          <td class='p-1'>
                            <input type="text" id="densu_excelmask" name="densu_excelmask"/>
                          </td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>Gloves</td>
                          <td class='p-1'>
                            <input type="text" id="densu_excelgloves" name="densu_excelgloves"/>
                          </td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>Cups</td>
                          <td class='p-1'>
                            <input type="text" id="densu_excelcups" name="densu_excelcups"/>
                          </td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>Aprons</td>
                          <td class='p-1'>
                            <input type="text" id="densu_excelapron" name="densu_excelapron"/>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>  
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <div class="card">
                  <div class="card-body">
                    <table class="table table-hover table-bordered small" id="tblstaffManagemnt">
                      <thead class="">
                        <tr>
                          <th style="width: 100%;" colspan="2">Consumables</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td align='center' class='p-1'>Level of restorative</td>
                          <td class='p-1'>
                            <input type="text" id="densu_excelrestorative" name="densu_excelrestorative"/>
                          </td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>Prosthetic and surgical materials</td>
                          <td class='p-1'>
                            <input type="text" id="densu_excelprosthetic" name="densu_excelprosthetic"/>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>  
              </div>
              <div class="form-group col-md-6">
              <div class="form-group col-md-3">&nbsp;</div>
              <div class="form-group col-md-3">&nbsp;</div>
              </div>
            </div>

          
          </div>
        
<!--end dental lab-->   
          <!----Medical Centers----->
          <div  id="mdCent">
            <div class="form-row">
              <div class="form-group col-md-3">Name of the Owner </div>
              <div class="form-group col-md-3">&nbsp;</div>
              <div class="form-group col-md-3">&nbsp;</div>
              <div class="form-group col-md-3">
                &nbsp;
                <input type="text" id="mdc_owner" class="form-group" name="mdc_owner"/>
              </div>
            </div>
            
            <div class="form-row">
              <div class="form-group col-md-3">Name of the Medical Director</div>
              <div class="form-group col-md-3">:&nbsp;
                <input type="text" id="mdc_nameMediDire" class="form-group" name="mdc_nameMediDire"/>
              </div>
              <div class="form-group col-md-3">(SLMC) registration no</div>
              <div class="form-group col-md-3">:&nbsp;
                <input type="text" id="mdc_mdReg" class="form-group" name="mdc_mdReg"/>
              </div>
            </div>
          
            <div class="form-row">
              <div class="form-group col-md-3">Number of Full Time Doctors </div>
              <div class="form-group col-md-3">:&nbsp;
                <input type="text" id="mdc_fultimeDoc" class="form-group" name="mdc_fultimeDoc"/>
              </div>
              <div class="form-group col-md-3">Number of Part Time Doctors</div>
              <div class="form-group col-md-3">:&nbsp;
                <input type="text" id="mdc_parttimeDoc" class="form-group" name="mdc_parttimeDoc"/>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-3">Number of the Nurse In-Charge </div>
              <div class="form-group col-md-3">:&nbsp;
                <input type="text" id="mdc_nurseinchrge" class="form-group" name="mdc_nurseinchrge"/>
              </div>
              <div class="form-group col-md-3">(SLMC) registration no</div>
              <div class="form-group col-md-3">:&nbsp;
                <input type="text" id="mdc_nurseReg" class="form-group" name="mdc_nurseReg"/>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-3">Number of Nurses </div>
              <div class="form-group col-md-3">:&nbsp;
                <input type="text" id="mdc_nurse" class="form-group" name="mdc_nurse"/>
              </div>
              <div class="form-group col-md-3">Company Business Registration Number</div>
              <div class="form-group col-md-3">:&nbsp;
                <input type="text" id="mdc_businessReg" class="form-group" name="mdc_businessReg"/>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <div class="card">
                  <div class="card-body">
                    <table class="table table-hover table-bordered small" id="tblstaffManagemnt">
                      <thead class="">
                        <tr>
                          <th style="width: 100%;" colspan="2">Consultation Rooms</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td align='center' class='p-1'>Number of consultation rooms</td>
                          <td class='p-1'><input type="text" id="mdc_consultRoom" name="mdc_consultRoom"/></td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>Square area of the each room </td>
                          <td class='p-1'><input type="text" id="mdc_checkNursingHome" name="mdc_checkNursingHome"/></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>  
              </div>
              <div class="form-group col-md-6">
                <div class="card">
                  <div class="card-body">
                    <table class="table table-hover table-bordered small" id="tblstaffManagemnt">
                      <thead class="">
                        <tr>
                          <th style="width: 100%;" colspan="2">Equipments</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td align='center' class='p-1'>Examination bed</td>
                          <td class='p-1'><input type="text" id="mdc_examBed" name="mdc_examBed"/></td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>Table and chairs</td>
                          <td class='p-1'><input type="text" id="mdc_tableChair" name="mdc_tableChair"/></td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>Wash basin</td>
                          <td class='p-1'><input type="text" id="mdc_washBasin" name="mdc_washBasin"/></td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>Weighing scale</td>
                          <td class='p-1'><input type="text" id="mdc_weighingscale" name="mdc_weighingscale"/></td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>Adequate ventilation and illumination</td>
                          <td class='p-1'><input type="text" id="mdc_ventilation" name="mdc_ventilation"/></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>  
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <div class="card">
                  <div class="card-body">
                    <table class="table table-hover table-bordered small" id="tblstaffManagemnt">
                      <thead class="">
                        <tr>
                          <th style="width: 100%;" colspan="2">Waiting Area</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td align='center' class='p-1'>Seating facilities for minimum of 10 persons per consultation room with sanitary facilities</td>
                          <td class='p-1'><input type="text" id="mdc_sanitaryFac" name="mdc_sanitaryFac"/></td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>Adequate ventilation and illumination </td>
                          <td class='p-1'><input type="text" id="mdc_waventilation" name="mdc_waventilation"/></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>  
              </div>
              <div class="form-group col-md-6">
                <div class="card">
                  <div class="card-body">
                    <table class="table table-hover table-bordered small" id="tblstaffManagemnt">
                      <thead class="">
                        <tr>
                          <th style="width: 100%;" colspan="2">Sample Collection Room</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td align='center' class='p-1'>Examination bed</td>
                          <td class='p-1'><input type="text" id="mdc_smexamBed" name="mdc_smexamBed"/></td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>Floor area</td>
                          <td class='p-1'><input type="text" id="mdc_floorarea" name="mdc_floorarea"/></td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>Adequate sanitary facilities</td>
                          <td class='p-1'><input type="text" id="mdc_saniFac" name="mdc_saniFac"/></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>  
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <div class="card">
                  <div class="card-body">
                    <table class="table table-hover table-bordered small" id="tblstaffManagemnt">
                      <thead class="">
                        <tr>
                          <th style="width: 100%;" colspan="2">Equipments</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td align='center' class='p-1'>Arm chair</td>
                          <td class='p-1'><input type="text" id="mdc_scarmChair" name="mdc_scarmChair"/></td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>Bed</td>
                          <td class='p-1'><input type="text" id="mdc_scbed" name="mdc_scbed"/></td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>Safe waste disposal</td>
                          <td class='p-1'><input type="text" id="mdc_scwasteDisposal" name="mdc_scwasteDisposal"/></td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>Toilet facilities</td>
                          <td class='p-1'><input type="text" id="mdc_scToiletFac" name="mdc_scToiletFac"/></td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>Adequate illumination</td>
                          <td class='p-1'><input type="text" id="mdc_scadeqIllum" name="mdc_scadeqIllum"/></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>  
              </div>
              <div class="form-group col-md-6">
                <div class="card">
                  <div class="card-body">
                    <table class="table table-hover table-bordered small" id="tblstaffManagemnt">
                      <thead class="">
                        <tr>
                          <th style="width: 100%;" colspan="2">X-Ray Rooms</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td align='center' class='p-1'>Number of X-ray rooms</td>
                          <td class='p-1'><input type="text" id="mdc_xrayRoom" name="mdc_xrayRoom"/></td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>Square area of the each room </td>
                          <td class='p-1'><input type="text" id="mdc_squarArea" name="mdc_squarArea"/></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>  
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <div class="card">
                  <div class="card-body">
                    <table class="table table-hover table-bordered small" id="tblstaffManagemnt">
                      <thead class="">
                        <tr>
                          <th style="width: 100%;" colspan="2">Emergency Treatment Unit</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td align='center' class='p-1'>Number of rooms</td>
                          <td class='p-1'><input type="text" id="mdc_room" name="mdc_room"/></td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>Square area of the each room </td>
                          <td class='p-1'><input type="text" id="mdc_roomsquare" name="mdc_roomsquare"/></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>  
              </div>
              <div class="form-group col-md-6">
                <div class="card">
                  <div class="card-body">
                    <table class="table table-hover table-bordered small" id="tblstaffManagemnt">
                      <thead class="">
                        <tr>
                          <th style="width: 100%;" colspan="2">Equipments</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td align='center' class='p-1'>Arm chair</td>
                          <td class='p-1'><input type="text" id="mdc_armchair" name="mdc_armchair"/></td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>Bed</td>
                          <td class='p-1'><input type="text" id="mdc_eqbeds" name="mdc_eqbeds"/></td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>Safe waste disposal</td>
                          <td class='p-1'><input type="text" id="mdc_swdis" name="mdc_swdis"/></td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>Toilet facilities</td>
                          <td class='p-1'><input type="text" id="mdc_toifac" name="mdc_toifac"/></td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>Adequate illumination</td>
                          <td class='p-1'><input type="text" id="mdc_adill" name="mdc_adill"/></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>  
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <div class="card">
                  <div class="card-body">
                    <table class="table table-hover table-bordered small" id="tblstaffManagemnt">
                      <thead class="">
                        <tr>
                          <th style="width: 100%;" colspan="2">C.S.S.D</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td align='center' class='p-1'>Number of rooms</td>
                          <td class='p-1'><input type="text" id="mdc_cssdroom" name="mdc_cssdroom"/></td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>Square area of the each room </td>
                          <td class='p-1'><input type="text" id="mdc_cssdsquare" name="mdc_cssdsquare"/></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>  
              </div>
              <div class="form-group col-md-6">
                <div class="card">
                  <div class="card-body">
                    <table class="table table-hover table-bordered small" id="tblstaffManagemnt">
                      <thead class="">
                        <tr>
                          <th style="width: 100%;" colspan="2">Indoor Pharmacy</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td align='center' class='p-1'>Number medicines</td>
                          <td class='p-1'><input type="text" id="mdc_numbermedi" name="mdc_numbermedi"/></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>  
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <div class="card">
                  <div class="card-body">
                    <table class="table table-hover table-bordered small" id="tblstaffManagemnt">
                      <thead class="">
                        <tr>
                          <th style="width: 100%;" colspan="2">Parking</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td align='center' class='p-1'>Vehicle Type</td>
                          <td class='p-1'><input type="text" id="mdc_vehitype" name="mdc_vehitype"/></td>
                        </tr>
                        <tr>
                          <td align='center' class='p-1'>Numer of Vehicles</td>
                          <td class='p-1'><input type="text" id="mdc_numbervehi" name="mdc_numbervehi"/></td>
                        </tr>
                        </tbody>
                    </table>
                  </div>
                </div>  
              </div>
              <div class="form-group col-md-6">
                <div class="card">
                  <div class="card-body">
                    <table class="table table-hover table-bordered small" id="tblstaffManagemnt">
                      <thead class="">
                        <tr>
                          <th style="width: 100%;" colspan="2">Waste Disposal</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td align='center' class='p-1'>Waste Disposal</td>
                          <td class='p-1'><input type="text" id="mdc_wdis" name="mdc_wdis"/></td>
                        </tr>
                      </tbody>
                    </table>
                </div>
              </div>
            </div>
              
          </div>
        </div>
          <!----end Medical Centers----->

          <!------------------------------------------ ---------------Private Hospitals-------------------------------------------->                          
        <div style="" id="phos">
          <div class="form-row">
            <div class="form-group col-md-3">Name of the Owner </div>
            <div class="form-group col-md-3">:&nbsp;
              <input type="text" id="phos_ownerame" class="form-group" name="phos_ownerame"/>
            </div>
            <div class="form-group col-md-3">Name of the Chief Executive Officer</div>
            <div class="form-group col-md-3">:&nbsp;
              <input type="text" id="phos_nameceo" class="form-group" name="phos_nameceo"/>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-3">Name of the Medical Director</div>
            <div class="form-group col-md-3">:&nbsp;
              <input type="text" id="phos_namemd" class="form-group" name="phos_namemd"/>
            </div>
            <div class="form-group col-md-3">(SLMC) registration no</div>
            <div class="form-group col-md-3">:&nbsp;
              <input type="text" id="phos_mdreg" class="form-group" name="phos_mdreg"/>
            </div>
          </div>
          
          <div class="form-row">
            <div class="form-group col-md-3">Number of Full Time Doctors </div>
            <div class="form-group col-md-3">:&nbsp;
              <input type="text" id="phos_numberftdoc" class="form-group" name="phos_numberftdoc"/>
            </div>
            <div class="form-group col-md-3">Name of the Nursing Director</div>
            <div class="form-group col-md-3">:&nbsp;
              <input type="text" id="phos_namenursdirect" class="form-group" name="phos_namenursdirect"/>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-3">Number of Nurses</div>
            <div class="form-group col-md-3">:&nbsp;
              <input type="text" id="phos_numbernurse" class="form-group" name="phos_numbernurse"/>
            </div>
            <div class="form-group col-md-3">UDA approval number</div>
            <div class="form-group col-md-3">:&nbsp;
              <input type="text" id="phos_udaappnumber" class="form-group" name="phos_udaappnumber"/>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-3">Date of Establishment</div>
            <div class="form-group col-md-3">:&nbsp;
              <input type="text" id="phos_nursinghomedate" class="form-group" name="phos_nursinghomedate"/>
            </div>
          </div>

          
              
          <div class="form-row">
            <div class="form-group col-md-6">
              <div class="card">
                <div class="card-body">
                  <table class="table table-hover table-bordered small" id="tblstaffManagemnt">
                    <thead class="">
                      <tr>
                        <th style="width: 100%;" colspan="2">Consultation Rooms</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td align='center' class='p-1'>Number of consultation rooms</td>
                        <td class='p-1'><input type="text" id="phos_consltroom" name="phos_consltroom"/></td>
                      </tr>
                      <tr>
                        <td align='center' class='p-1'>Square area of the each room </td>
                        <td class='p-1'><input type="text" id="phos_squareroom" name="phos_squareroom"/><td>      
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>  
            </div>
            <div class="form-group col-md-6">
              <div class="card">
                <div class="card-body">
                  <table class="table table-hover table-bordered small" id="tblstaffManagemnt">
                    <thead class="">
                      <tr>
                        <th style="width: 100%;" colspan="2">Equipments</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td align='center' class='p-1'>Examination bed</td>
                        <td class='p-1'><input type="text" id="phos_exambed" name="phos_exambed"/></td>
                      </tr>
                      <tr>
                        <td align='center' class='p-1'>Table and chairs</td>
                        <td class='p-1'><input type="text" id="phos_tablechair" name="phos_tablechair"/></td>
                      </tr>
                      <tr>
                        <td align='center' class='p-1'>Wash basin</td>
                        <td class='p-1'><input type="text" id="phos_washbasin" name="phos_washbasin"/></td>
                      </tr>
                      <tr>
                        <td align='center' class='p-1'>Weighing scale</td>
                        <td class='p-1'><input type="text" id="phos_weighningscale" name="phos_weighningscale"/></td>
                      </tr>
                      <tr>
                        <td align='center' class='p-1'>Adequate ventilation and illumination</td>
                        <td class='p-1'><input type="text" id="phos_ventillu" name="phos_ventillu"/></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>  
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <div class="card">
                <div class="card-body">
                  <table class="table table-hover table-bordered small" id="tblstaffManagemnt">
                    <thead class="">
                      <tr>
                        <th style="width: 100%;" colspan="2">Waiting Area</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td align='center' class='p-1'>Seating facilities for minimum of 10 persons per consultation room with sanitary facilities</td>
                        <td class='p-1'><input type="text" id="phos_waitingperson" name="phos_waitingperson"/></td>
                      </tr>
                      <tr>
                        <td align='center' class='p-1'>Adequate ventilation and illumination </td>
                        <td class='p-1'><input type="text" id="phos_waitingventi" name="phos_waitingventi"/></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>  
            </div>
            <div class="form-group col-md-6">
              <div class="card">
                <div class="card-body">
                  <table class="table table-hover table-bordered small" id="tblstaffManagemnt">
                    <thead class="">
                      <tr>
                        <th style="width: 100%;" colspan="2">Sample Collection Room</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td align='center' class='p-1'>Examination bed</td>
                        <td class='p-1'><input type="text" id="phos_sampleexambed" name="phos_sampleexambed"/></td>
                      </tr>
                      <tr>
                        <td align='center' class='p-1'>Floor area</td>
                        <td class='p-1'><input type="text" id="phos_floorarea" name="phos_floorarea"/></td>
                      </tr>
                      <tr>
                        <td align='center' class='p-1'>Adequate sanitary facilities</td>
                        <td class='p-1'><input type="text" id="phos_adeqsanit" name="phos_adeqsanit"/></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>  
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <div class="card">
                <div class="card-body">
                  <table class="table table-hover table-bordered small" id="tblstaffManagemnt">
                    <thead class="">
                      <tr>
                        <th style="width: 100%;" colspan="2">Equipments</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td align='center' class='p-1'>Arm chair</td>
                        <td class='p-1'><input type="text" id="phos_armchair" name="phos_armchair"/></td>
                      </tr>
                      <tr>
                        <td align='center' class='p-1'>Bed</td>
                        <td class='p-1'><input type="text" id="phos_bed" name="phos_bed"/></td>
                      </tr>
                      <tr>
                        <td align='center' class='p-1'>Safe waste disposal</td>
                        <td class='p-1'><input type="text" id="phos_swdisposal" name="phos_swdisposal"/></td>
                      </tr>
                      <tr>
                        <td align='center' class='p-1'>Toilet facilities</td>
                        <td class='p-1'><input type="text" id="phos_toifac" name="phos_toifac"/></td>
                      </tr>
                      <tr>
                        <td align='center' class='p-1'>Adequate illumination</td>
                        <td class='p-1'><input type="text" id="phos_adeqillu" name="phos_adeqillu" /></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>  
            </div>
            <div class="form-group col-md-6">
              <div class="card">
                <div class="card-body">
                  <table class="table table-hover table-bordered small" id="tblstaffManagemnt">
                    <thead class="">
                      <tr>
                        <th style="width: 100%;" colspan="2">Laboratory Facilities</th>
                      </tr>
                    </thead>
                  <tbody>
                    <tr>
                      <td align='center' class='p-1'>Name of the Pathologist Sri Lanka Medical Council (SLMC) registration no. Whether Full Time/ Part Time </td>
                      <td class='p-1'><input type="text" id="phos_slmcpathologi" name="phos_slmcpathologi"/></td>
                    </tr>
                    <tr>
                      <td align='center' class='p-1'>Name of the Microbiologist Sri Lanka Medical Council(SLMC) registration no. Whether Full Time/ Part Time </td>
                      <td class='p-1'><input type="text" id="phos_slmcmicroi" name="phos_slmcmicroi"/></td>
                    </tr>
                    <tr>
                      <td align='center' class='p-1'>Internal and external quality controlling </td>
                      <td class='p-1'><input type="text" id="phos_qualitycont" name="phos_qualitycont"/></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <div class="form-row col-md-12">
            <div class="form-group col-md-6">
              <div class="card">
                <div class="card-body">
                  <table class="table table-hover table-bordered small" id="tblstaffManagemnt">
                    <thead class="">
                      <tr>
                        <th style="width: 100%;" colspan="2">X-Ray Room</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td align='center' class='p-1'>Number of X-ray rooms</td>
                        <td class='p-1'><input type="text" id="phos_xrayRoom" name="phos_xrayRoom"/></td>
                      </tr>
                      <tr>
                        <td align='center' class='p-1'>Square area of the each room </td>
                        <td class='p-1'><input type="text" id="phos_squarArea" name="phos_squarArea"/></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>  
            </div>
            <div class="form-group col-md-6">
              <div class="card">
                <div class="card-body">
                  <table class="table table-hover table-bordered small" id="tblstaffManagemnt">
                    <thead class="">
                      <tr>
                        <th style="width: 100%;" colspan="2">Indoor Facilities</th>
                      </tr>
                    </thead>
                  <tbody>
                    <tr>
                      <td align='center' class='p-1'>Ward</td>
                      <td class='p-1'><input type="text" id="phos_wards" name="phos_wards"/></td>
                    </tr>
                    <tr>
                      <td align='center' class='p-1'>Single Room</td>
                      <td class='p-1'><input type="text" id="phos_singleroom" name="phos_singleroom"/></td>
                    </tr>
                    <tr>
                      <td align='center' class='p-1'>Double Room</td>
                      <td class='p-1'><input type="text" id="phos_doubleroom" name="phos_doubleroom"/></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <div class="form-row col-md-12">
            <div class="form-group col-md-6">
              <div class="card">
                <div class="card-body">
                  <table class="table table-hover table-bordered small" id="tblstaffManagemnt">
                    <thead class="">
                      <tr>
                        <th style="width: 100%;" colspan="2">Operating Theater</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td align='center' class='p-1'>Number of Operating Theaters</td>
                        <td class='p-1'><input type="text" id="phos_opt" name="phos_opt"/></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>  
            </div>
            <div class="form-group col-md-6">
              <div class="card">
                <div class="card-body">
                  <table class="table table-hover table-bordered small" id="tblstaffManagemnt">
                    <thead class="">
                      <tr>
                        <th style="width: 100%;" colspan="2">Equipments</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td align='center' class='p-1'>Arm chair</td>
                        <td class='p-1'><input type="text" id="phos_oparmchair" name="phos_oparmchair"/></td>
                      </tr>
                      <tr>
                        <td align='center' class='p-1'>Bed</td>
                        <td class='p-1'><input type="text" id="phos_opbed" name="phos_opbed"/></td>
                      </tr>
                      <tr>
                        <td align='center' class='p-1'>Safe waste disposal</td>
                        <td class='p-1'><input type="text" id="phos_opswdisposal" name="phos_opswdisposal"/></td>
                      </tr>
                      <tr>
                        <td align='center' class='p-1'>Toilet facilities</td>
                        <td class='p-1'><input type="text" id="phos_optoifac" name="phos_optoifac"/></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <div class="form-row col-md-12">
            <div class="form-group col-md-6">
              <div class="card">
                <div class="card-body">
                  <table class="table table-hover table-bordered small" id="tblstaffManagemnt">
                    <thead class="">
                      <tr>
                        <th style="width: 100%;" colspan="2">Medium/ Major</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td align='center' class='p-1'>Medium/ Major</td>
                        <td class='p-1'><input type="text" id="phos_medium" name="phos_medium"/></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>  
            </div>
            <div class="form-group col-md-6">
              <div class="card">
                <div class="card-body">
                  <table class="table table-hover table-bordered small" id="tblstaffManagemnt">
                    <thead class="">
                      <tr>
                        <th style="width: 100%;" colspan="2">Equipments</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td align='center' class='p-1'>Arm chair</td>
                        <td class='p-1'><input type="text" id="phos_mdarmchair" name="phos_mdarmchair"/></td>
                      </tr>
                      <tr>
                        <td align='center' class='p-1'>Bed</td>
                        <td class='p-1'><input type="text" id="phos_mdbed" name="phos_mdbed"/></td>
                      </tr>
                      <tr>
                        <td align='center' class='p-1'>Safe waste disposal</td>
                        <td class='p-1'><input type="text" id="phos_mdswdisposal" name="phos_mdswdisposal"/></td>
                      </tr>
                      <tr>
                        <td align='center' class='p-1'>Toilet facilities</td>
                        <td class='p-1'><input type="text" id="phos_mdtoifac" name="phos_mdtoifac"/></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <div class="form-row col-md-12">
            <div class="form-group col-md-6">
              <div class="card">
                <div class="card-body">
                  <table class="table table-hover table-bordered small" id="tblstaffManagemnt">
                    <thead class="">
                      <tr>
                        <th style="width: 100%;" colspan="2">Scrubbing Area</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td align='center' class='p-1'>Scrubbing Area</td>
                        <td class='p-1'><input type="text" id="phos_scrubingar" name="phos_scrubingar"/></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>  
            </div>
            <div class="form-group col-md-6">
              <div class="card">
                <div class="card-body">
                  <table class="table table-hover table-bordered small" id="tblstaffManagemnt">
                    <thead class="">
                      <tr>
                        <th style="width: 100%;" colspan="2">Recovery</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td align='center' class='p-1'>Recovery</td>
                        <td class='p-1'><input type="text" id="phos_recovery" name="phos_recovery"/></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <div class="form-row col-md-12">
            <div class="form-group col-md-6">
              <div class="card">
                <div class="card-body">
                  <table class="table table-hover table-bordered small" id="tblstaffManagemnt">
                    <thead class="">
                      <tr>
                        <th style="width: 100%;" colspan="2">C.S.S.D</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td align='center' class='p-1'>CSSD</td>
                        <td class='p-1'><input type="text" id="phos_cssd" name="phos_cssd"/></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>  
            </div>
            <div class="form-group col-md-6">
              <div class="card">
                <div class="card-body">
                  <table class="table table-hover table-bordered small" id="tblstaffManagemnt">
                    <thead class="">
                      <tr>
                        <th style="width: 100%;" colspan="2">Labour Room</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td align='center' class='p-1'>Labour Room</td>
                        <td class='p-1'><input type="text" id="phos_lbroom" name="phos_lbroom"/></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <div class="form-row col-md-12">
            <div class="form-group col-md-6">
              <div class="card">
                <div class="card-body">
                <table class="table table-hover table-bordered small" id="tblstaffManagemnt">
                    <thead class="">
                      <tr>
                        <th style="width: 100%;" colspan="2">Equipments</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td align='center' class='p-1'>Emergency trolley with supplies</td>
                        <td class='p-1'><input type="text" id="phos_emertrolly" name="phos_emertrolly"/></td>
                      </tr>
                      <tr>
                        <td align='center' class='p-1'>Spot lamp</td>
                        <td class='p-1'><input type="text" id="phos_spotlamp" name="phos_spotlamp"/></td>
                      </tr>
                      <tr>
                        <td align='center' class='p-1'>Pinard stethoscope</td>
                        <td class='p-1'><input type="text" id="phos_stethoscope" name="phos_stethoscope"/></td>
                      </tr>
                      <tr>
                        <td align='center' class='p-1'>Necessary surgical instruments</td>
                        <td class='p-1'><input type="text" id="phos_surginstrmnt" name="phos_surginstrmnt"/></td>
                      </tr>
                      <tr>
                        <td align='center' class='p-1'>Adjoining toilet</td>
                        <td class='p-1'><input type="text" id="phos_adjtoilet" name="phos_adjtoilet"/></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>  
            </div>
            <div class="form-group col-md-6">
              <div class="card">
                <div class="card-body">
                  <table class="table table-hover table-bordered small" id="tblstaffManagemnt">
                    <thead class="">
                      <tr>
                        <th style="width: 100%;" colspan="2">Waste Disposal</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td align='center' class='p-1'>Waste Disposal</td>
                        <td class='p-1'><input type="text" id="phos_wastdispos" name="phos_wastdispos"/></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <div class="form-row col-md-12">
            <div class="form-group col-md-6">
              <div class="card">
                <div class="card-body">
                  <table class="table table-hover table-bordered small" id="tblstaffManagemnt">
                    <thead class="">
                      <tr>
                        <th style="width: 100%;" colspan="2">Emergency Treatment Unit</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td align='center' class='p-1'>Emergency Treatment Unit</td>
                        <td class='p-1'><input type="text" id="phos_etunit" name="phos_etunit"/></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="form-group col-md-6">
              <div class="card">
                <div class="card-body">
                <table class="table table-hover table-bordered small" id="tblstaffManagemnt">
                    <thead class="">
                      <tr>
                        <th style="width: 100%;" colspan="2">Equipments</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td align='center' class='p-1'>Necessary facilities and equipment for resuscitation</td>
                        <td class='p-1'><input type="text" id="phos_facilities" name="phos_facilities"/></td>
                      </tr>
                      <tr>
                        <td align='center' class='p-1'>Laryngoscope</td>
                        <td class='p-1'><input type="text" id="phos_laryngoscope" name="phos_laryngoscope"/></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>  
            </div>
          </div>

          <div class="form-row col-md-12">
            <div class="form-group col-md-6">
              <div class="card">
                <div class="card-body">
                  <table class="table table-hover table-bordered small" id="tblstaffManagemnt">
                    <thead class="">
                      <tr>
                        <th style="width: 100%;" colspan="2">ICU/ High Dependency Unit</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td align='center' class='p-1'>ICU/ High Dependency Unit</td>
                        <td class='p-1'><input type="text" id="phos_icuunit" name="phos_icuunit"/></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="form-group col-md-6">
              <div class="card">
                <div class="card-body">
                <table class="table table-hover table-bordered small" id="tblstaffManagemnt">
                    <thead class="">
                      <tr>
                        <th style="width: 100%;" colspan="2">Equipments</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td align='center' class='p-1'>Arm chair</td>
                        <td class='p-1'><input type="text" id="phos_icuarmchair" name="phos_icuarmchair"/></td>
                      </tr>
                      <tr>
                        <td align='center' class='p-1'>Bed</td>
                        <td class='p-1'><input type="text" id="phos_icubed" name="phos_icubed"/></td>
                      </tr>
                      <tr>
                        <td align='center' class='p-1'>Safe waste disposal</td>
                        <td class='p-1'><input type="text" id="phos_icuswdisposal" name="phos_icuswdisposal"/></td>
                      </tr>
                      <tr>
                        <td align='center' class='p-1'>Toilet facilities</td>
                        <td class='p-1'><input type="text" id="phos_icutoifac" name="phos_icutoifac"/></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>  
            </div>
          </div>

          <div class="form-row col-md-12">
            <div class="form-group col-md-6">
              <div class="card">
                <div class="card-body">
                  <table class="table table-hover table-bordered small" id="tblstaffManagemnt">
                    <thead class="">
                      <tr>
                        <th style="width: 100%;" colspan="2">Dental Surgery</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td align='center' class='p-1'>Name of the Dental Surgeon</td>
                        <td class='p-1'><input type="text" id="phos_dsname" name="phos_dsname"/></td>
                      </tr>
                      <tr>
                        <td align='center' class='p-1'>BSri Lanka Medical Council (SLMC) registration no.ed</td>
                        <td class='p-1'><input type="text" id="phos_dsregno" name="phos_dsregno"/></td>
                      </tr>
                      <tr>
                        <td align='center' class='p-1'>Name of the Dental Surgery Assistant</td>
                        <td class='p-1'><input type="text" id="phos_dsassistant" name="phos_dsassistant"/></td>
                      </tr>
                      <tr>
                        <td align='center' class='p-1'>Patient waiting area</td>
                        <td class='p-1'><input type="text" id="phos_dswaitingarea" name="phos_dswaitingarea"/></td>
                      </tr>
                      <tr>
                        <td align='center' class='p-1'>Surgery area</td>
                        <td class='p-1'><input type="text" id="phos_dssurgeryarea" name="phos_dssurgeryarea"/></td>
                      </tr>
                      <tr>
                        <td align='center' class='p-1'>Adequate toilet facilities</td>
                        <td class='p-1'><input type="text" id="phos_dstoiltfac" name="phos_dstoiltfac"/></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="form-group col-md-6">
              <div class="card">
                <div class="card-body">
                <table class="table table-hover table-bordered small" id="tblstaffManagemnt">
                    <thead class="">
                      <tr>
                        <th style="width: 100%;" colspan="2">Equipments</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td align='center' class='p-1'>Arm chair</td>
                        <td class='p-1'><input type="text" id="phos_dsarmchair" name="phos_dsarmchair"/></td>
                      </tr>
                      <tr>
                        <td align='center' class='p-1'>Bed</td>
                        <td class='p-1'><input type="text" id="phos_dsbed" name="phos_dsbed"/></td>
                      </tr>
                      <tr>
                        <td align='center' class='p-1'>Safe waste disposal</td>
                        <td class='p-1'><input type="text" id="phos_dsswdisposal" name="phos_dsswdisposal"/></td>
                      </tr>
                      <tr>
                        <td align='center' class='p-1'>Toilet facilities</td>
                        <td class='p-1'><input type="text" id="phos_dstoifac" name="phos_dstoifac"/></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>  
            </div>
          </div>

          <div class="form-row col-md-12">
            <div class="form-group col-md-6">
              <div class="card">
                <div class="card-body">
                  <table class="table table-hover table-bordered small" id="tblstaffManagemnt">
                    <thead class="">
                      <tr>
                        <th style="width: 100%;" colspan="2">Disposables and Accessories</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td align='center' class='p-1'>Disposables and Accessories</td>
                        <td class='p-1'><input type="text" id="phos_disposable" name="phos_disposable"/></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="form-group col-md-6">
              <div class="card">
                <div class="card-body">
                <table class="table table-hover table-bordered small" id="tblstaffManagemnt">
                    <thead class="">
                      <tr>
                        <th style="width: 100%;" colspan="2">Consumables</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td align='center' class='p-1'>Consumables</td>
                        <td class='p-1'><input type="text" id="phos_consumable" name="phos_consumable"/></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>  
            </div>
          </div>

          <div class="form-row col-md-12">
            <div class="form-group col-md-6">
              <div class="card">
                <div class="card-body">
                  <table class="table table-hover table-bordered small" id="tblstaffManagemnt">
                    <thead class="">
                      <tr>
                        <th style="width: 100%;" colspan="2">Indoor Pharmacy</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td align='center' class='p-1'>Drug Store</td>
                        <td class='p-1'><input type="text" id="phos_drugstorein" name="phos_drugstorein"/></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="form-group col-md-6">
              <div class="card">
                <div class="card-body">
                <table class="table table-hover table-bordered small" id="tblstaffManagemnt">
                    <thead class="">
                      <tr>
                        <th style="width: 100%;" colspan="2">Out door Pharmacy</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td align='center' class='p-1'>Drug Store</td>
                        <td class='p-1'><input type="text" id="phos_drugstoreout" name="phos_drugstoreout"/></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>  
            </div>
          </div>

          <div class="form-row col-md-12">
            <div class="form-group col-md-6">
              <div class="card">
                <div class="card-body">
                  <table class="table table-hover table-bordered small" id="tblstaffManagemnt">
                    <thead class="">
                      <tr>
                        <th style="width: 100%;" colspan="2">Ambulance Services</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td align='center' class='p-1'>Ambulance Services</td>
                        <td class='p-1'><input type="text" id="phos_ambservices" name="phos_ambservices"/></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="form-group col-md-6">
              <div class="card">
                <div class="card-body">
                <table class="table table-hover table-bordered small" id="tblstaffManagemnt">
                    <thead class="">
                      <tr>
                        <th style="width: 100%;" colspan="2">Kitchen</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td align='center' class='p-1'>Pantry</td>
                        <td class='p-1'><input type="text" id="phos_pantry" name="phos_pantry"/></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>  
            </div>
          </div>

          <div class="form-row col-md-12">
            <div class="form-group col-md-6">
              <div class="card">
                <div class="card-body">
                  <table class="table table-hover table-bordered small" id="tblstaffManagemnt">
                    <thead class="">
                      <tr>
                        <th style="width: 100%;" colspan="2">Parking</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td align='center' class='p-1'>Parking</td>
                        <td class='p-1'><input type="text" id="phos_parking" name="phos_parking"/></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="form-group col-md-6">
              <div class="card">
                <div class="card-body">
                <table class="table table-hover table-bordered small" id="tblstaffManagemnt">
                    <thead class="">
                      <tr>
                        <th style="width: 100%;" colspan="2">Waste Disposal</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td align='center' class='p-1'>Waste Disposal</td>
                        <td class='p-1'><input type="text" id="phos_wastdis" name="phos_wastdis"/></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>  
            </div>
          </div>
          <!---Card ends-->

        </div> 
    </div>
        <!----------------end Private hospitals-------------------------- -----------------------------------------------------------> 
        
      </div>
                                 
    

<!---footer-->
    
        <div class="card-footer">
          <div class="form-group row">
            <div class="col-sm-12 text-center">
              <!--<button type="button" class="btn btn-warning" id="btnNew" style="width: 100px; margin: 5px;"><i class="fas fa-align-justify"></i>&nbsp;New</button>-->
              <button type="button" class="btn btn-success" id="btnSave" style="width: 100px; margin: 5px;"><i class="far fa-save"></i>&nbsp;Save</button>
              <button type="button" class="btn btn-danger" id="btnDelete" style="width: 100px; margin: 5px;"><i class="fas fa-trash-alt"></i>&nbsp;Delete</button>
              <button type="button" class="btn btn-info" id="btnClose" style="width: 100px; margin: 5px;"><i class="fas fa-times-circle"></i>&nbsp;Close</button>
            </div>
          </div>
        </div>

      <!---end footer-->
    
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
        <script src="basicInformation.js"></script>    
        <script>

          //    ===================== snippet for profile picture change ============================ //

          function readURL(input) {
              if (input.files && input.files[0]) {
                  var reader = new FileReader();
                  reader.onload = function (e) {
                      $('.avatar-pic')
                              .attr('src', e.target.result)
                              .width(200)
                              .height(200);
                  };
                  reader.readAsDataURL(input.files[0]);
              }
          }

          //    =================================== ends here ============================================ //
        </script>
        <script>
   var originalOptions = [];

window.onload = function () {
  var select = document.getElementById("cboSearch");
  originalOptions = Array.from(select.options).map(opt => opt.text);
};

function filterSelect() {
  var text = document.getElementById("txtSearch").value.toLowerCase();
  var select = document.getElementById("cboSearch");

  select.innerHTML = "";

  originalOptions.forEach(function(item) {
    if (item.toLowerCase().startsWith(text)) {
      var option = document.createElement("option");
      option.text = item;
      select.add(option);
    }
  });
}


        </script>
  </body>
</html>



