<?php

session_start();
$backwardSeparator = "../../../../../";
$thisFilePath =  $_SERVER['PHP_SELF'];
$userId 	= $_SESSION['loginId'];
$userCompanyId = $_SESSION['companyId'];
$userLocationId = $_SESSION['locationId'];

require "{$backwardSeparator}autoLoad.php";

include "{$backwardSeparator}dataAccess/serverAccessController.php";
include "{$backwardSeparator}vendor/php-image-resize-master/lib/ImageResize.php";

//require_once $backwardSeparator.'dataAccess/connector.php';

use classes\cls_auto_number;
use classes\cls_approval;
use presentation\hrm\masterData\classes\cls_hrm_employee_information;

$model = new cls_hrm_employee_information($db);

$response = [];
$autoNoType = "employeeInformation";   
  
$requestType 	= $_REQUEST['requestType'];
$anStatus       = $_REQUEST['anStatus'];
$id             = $_REQUEST['cboSearch'];
$insTypeId   =$_REQUEST['insTypeId'];

//-----------------------Ambulance service---------------------
$txtambName           = isset($_REQUEST['txtambName'])?trim($_REQUEST['txtambName']):null;
$txtNoDoctor         = isset($_REQUEST['txtNoDoctor'])?trim($_REQUEST['txtNoDoctor']):null;
$txtNoNurs     = isset($_REQUEST['txtNoNurs'])?trim($_REQUEST['txtNoNurs']):null;
$txtnoAmbulance           = isset($_REQUEST['txtnoAmbulance'])?trim($_REQUEST['txtnoAmbulance']):null;
$txtnoModel           = isset($_REQUEST['txtnoModel'])?trim($_REQUEST['txtnoModel']):null;
$txtfacility           = isset($_REQUEST['txtfacility'])?trim($_REQUEST['txtfacility']):null;
$txtequipment           = isset($_REQUEST['txtequipment'])?trim($_REQUEST['txtequipment']):null;
$txtDriverAv           = isset($_REQUEST['txtDriverAv'])?trim($_REQUEST['txtDriverAv']):null;
$txtRMVreg           = isset($_REQUEST['txtRMVreg'])?trim($_REQUEST['txtRMVreg']):null;

//--------------------------dental lab---------------------------------------------------------------
$densu_surgeonname           = isset($_REQUEST['densu_surgeonname'])?trim($_REQUEST['densu_surgeonname']):null;
$densu_surgeonreg         = isset($_REQUEST['densu_surgeonreg'])?trim($_REQUEST['densu_surgeonreg']):null;
$densu_assisname     = isset($_REQUEST['densu_assisname'])?trim($_REQUEST['densu_assisname']):null;
$densu_surgeonfull           = isset($_REQUEST['densu_surgeonfull'])?trim($_REQUEST['densu_surgeonfull']):null;
$densu_prachours           = isset($_REQUEST['densu_prachours'])?trim($_REQUEST['densu_prachours']):null;
$densu_examBed           = isset($_REQUEST['densu_examBed'])?trim($_REQUEST['densu_examBed']):null;
$densu_tableChair           = isset($_REQUEST['densu_tableChair'])?trim($_REQUEST['densu_tableChair']):null;
$densu_washBasin           = isset($_REQUEST['densu_washBasin'])?trim($_REQUEST['densu_washBasin']):null;
$densu_weighingscale    = isset($_REQUEST['densu_weighingscale'])?trim($_REQUEST['densu_weighingscale']):null;
$densu_ventilation   = isset($_REQUEST['densu_ventilation'])?trim($_REQUEST['densu_ventilation']):null;
$densu_needles           = isset($_REQUEST['densu_needles'])?trim($_REQUEST['densu_needles']):null;
$densu_siringer           = isset($_REQUEST['densu_siringer'])?trim($_REQUEST['densu_siringer']):null;
$densu_mask           = isset($_REQUEST['densu_mask'])?trim($_REQUEST['densu_mask']):null;
$densu_gloves           = isset($_REQUEST['densu_gloves'])?trim($_REQUEST['densu_gloves']):null;
$densu_cups           = isset($_REQUEST['densu_cups'])?trim($_REQUEST['densu_cups']):null;
$densu_apron           = isset($_REQUEST['densu_apron'])?trim($_REQUEST['densu_apron']):null;
$densu_consumaterial    = isset($_REQUEST['densu_consumaterial'])?trim($_REQUEST['densu_consumaterial']):null;
$densu_prosthetic           = isset($_REQUEST['densu_prosthetic'])?trim($_REQUEST['densu_prosthetic']):null;
$densu_adeqwater           = isset($_REQUEST['densu_adeqwater'])?trim($_REQUEST['densu_adeqwater']):null;
$densu_hygenicdispos     = isset($_REQUEST['densu_hygenicdispos'])?trim($_REQUEST['densu_hygenicdispos']):null;
$densu_sysrecords           = isset($_REQUEST['densu_sysrecords'])?trim($_REQUEST['densu_sysrecords']):null;
$densu_patientwaiting = isset($_REQUEST['densu_patientwaiting'])?trim($_REQUEST['densu_patientwaiting']):null;
$densu_receptionarea   = isset($_REQUEST['densu_receptionarea'])?trim($_REQUEST['densu_receptionarea']):null;
$densu_surgeryarea           = isset($_REQUEST['densu_surgeryarea'])?trim($_REQUEST['densu_surgeryarea']):null;
$densu_adeqtoilt           = isset($_REQUEST['densu_adeqtoilt'])?trim($_REQUEST['densu_adeqtoilt']):null;
$densu_modexamBed           = isset($_REQUEST['densu_modexamBed'])?trim($_REQUEST['densu_modexamBed']):null;
$densu_modtableChair    = isset($_REQUEST['densu_modtableChair'])?trim($_REQUEST['densu_modtableChair']):null;
$densu_modwashBasin       = isset($_REQUEST['densu_modwashBasin'])?trim($_REQUEST['densu_modwashBasin']):null;
$densu_modweighingscale = isset($_REQUEST['densu_modweighingscale'])?trim($_REQUEST['densu_modweighingscale']):null;
$densu_modventilation  = isset($_REQUEST['densu_modventilation'])?trim($_REQUEST['densu_modventilation']):null;
$densu_modneedles           = isset($_REQUEST['densu_modneedles'])?trim($_REQUEST['densu_modneedles']):null;
$densu_modsiringer           = isset($_REQUEST['densu_modsiringer'])?trim($_REQUEST['densu_modsiringer']):null;
$densu_modmask           = isset($_REQUEST['densu_modmask'])?trim($_REQUEST['densu_modmask']):null;
$densu_modgloves           = isset($_REQUEST['densu_modgloves'])?trim($_REQUEST['densu_modgloves']):null;
$densu_modcups           = isset($_REQUEST['densu_modcups'])?trim($_REQUEST['densu_modcups']):null;
$densu_modapron           = isset($_REQUEST['densu_modapron'])?trim($_REQUEST['densu_modapron']):null;
$densu_modconsumaterial = isset($_REQUEST['densu_modconsumaterial'])?trim($_REQUEST['densu_modconsumaterial']):null;
$densu_modprosthetic   = isset($_REQUEST['densu_modprosthetic'])?trim($_REQUEST['densu_modprosthetic']):null;
$densu_modadeqwater        = isset($_REQUEST['densu_modadeqwater'])?trim($_REQUEST['densu_modadeqwater']):null;
$densu_modhygenicdispos = isset($_REQUEST['densu_modhygenicdispos'])?trim($_REQUEST['densu_modhygenicdispos']):null;
$densu_modsysrecords = isset($_REQUEST['densu_modsysrecords'])?trim($_REQUEST['densu_modsysrecords']):null;
$densu_autoclaves           = isset($_REQUEST['densu_autoclaves'])?trim($_REQUEST['densu_autoclaves']):null;
$densu_lightcure           = isset($_REQUEST['densu_lightcure'])?trim($_REQUEST['densu_lightcure']):null;
$densu_scalars           = isset($_REQUEST['densu_scalars'])?trim($_REQUEST['densu_scalars']):null;
$densu_airrotors           = isset($_REQUEST['densu_airrotors'])?trim($_REQUEST['densu_airrotors']):null;
$densu_xrayfaci           = isset($_REQUEST['densu_xrayfaci'])?trim($_REQUEST['densu_xrayfaci']):null;
$densu_amalgamators   = isset($_REQUEST['densu_amalgamators'])?trim($_REQUEST['densu_amalgamators']):null;
$densu_intracam           = isset($_REQUEST['densu_intracam'])?trim($_REQUEST['densu_intracam']):null;
$densu_refrigerator    = isset($_REQUEST['densu_refrigerator'])?trim($_REQUEST['densu_refrigerator']):null;
$densu_storagefaci    = isset($_REQUEST['densu_storagefaci'])?trim($_REQUEST['densu_storagefaci']):null;
$densu_excelneedles   = isset($_REQUEST['densu_excelneedles'])?trim($_REQUEST['densu_excelneedles']):null;
$densu_excelsiringer     = isset($_REQUEST['densu_excelsiringer'])?trim($_REQUEST['densu_excelsiringer']):null;
$densu_excelmask     = isset($_REQUEST['densu_excelmask'])?trim($_REQUEST['densu_excelmask']):null;
$densu_excelgloves           = isset($_REQUEST['densu_excelgloves'])?trim($_REQUEST['densu_excelgloves']):null;
$densu_excelcups           = isset($_REQUEST['densu_excelcups'])?trim($_REQUEST['densu_excelcups']):null;
$densu_excelapron           = isset($_REQUEST['densu_excelapron'])?trim($_REQUEST['densu_excelapron']):null;
$densu_excelrestorative = isset($_REQUEST['densu_excelrestorative'])?trim($_REQUEST['densu_excelrestorative']):null;
$densu_excelprosthetic = isset($_REQUEST['densu_excelprosthetic'])?trim($_REQUEST['densu_excelprosthetic']):null;

//---------------------------------labotorary---------------------------------------------------
$medl_person         = isset($_REQUEST['lab_person'])?trim($_REQUEST['lab_person']):null;
$medl_pathologist         = isset($_REQUEST['lab_pathologis'])?trim($_REQUEST['lab_pathologis']):null;
$medi_path_reg     = isset($_REQUEST['lab_path_reg'])?trim($_REQUEST['lab_path_reg']):null;
$medi_path_whether           = isset($_REQUEST['lab_pathWh'])?trim($_REQUEST['lab_pathWh']):null;
$medi_microbiologist           = isset($_REQUEST['lab_NameMicro'])?trim($_REQUEST['lab_NameMicro']):null;
$medi_micro_reg           = isset($_REQUEST['lab_micSlmc'])?trim($_REQUEST['lab_micSlmc']):null;
$medi_micro_whether         = isset($_REQUEST['lab_micWh'])?trim($_REQUEST['lab_micWh']):null;
$medi_chem_pathologist         = isset($_REQUEST['lab_nameChemi'])?trim($_REQUEST['lab_nameChemi']):null;
$medi_chem_path_reg     = isset($_REQUEST['lab_cemSlmc'])?trim($_REQUEST['lab_cemSlmc']):null;
$medi_whether           = isset($_REQUEST['lab_cemWh'])?trim($_REQUEST['lab_cemWh']):null;
$medi_qlity           = isset($_REQUEST['lab_qtyControl'])?trim($_REQUEST['lab_qtyControl']):null;
$medi_facility           = isset($_REQUEST['lab_faciCemi'])?trim($_REQUEST['lab_faciCemi']):null;
$medi_disposal           = isset($_REQUEST['lab_disposal'])?trim($_REQUEST['lab_disposal']):null;
$medi_br           = isset($_REQUEST['lab_cembisReg'])?trim($_REQUEST['lab_cembisReg']):null;

//------------------------Medical Centers----------------------------

$mdc_owner          = isset($_REQUEST['mdc_owner'])?trim($_REQUEST['mdc_owner']):null;
$mdc_nameMediDire   = isset($_REQUEST['mdc_nameMediDire'])?trim($_REQUEST['mdc_nameMediDire']):null;
$mdc_mdReg          = isset($_REQUEST['mdc_mdReg'])?trim($_REQUEST['mdc_mdReg']):null;
$mdc_fultimeDoc     = isset($_REQUEST['mdc_fultimeDoc'])?trim($_REQUEST['mdc_fultimeDoc']):null;
$mdc_parttimeDoc    = isset($_REQUEST['mdc_parttimeDoc'])?trim($_REQUEST['mdc_parttimeDoc']):null;
$mdc_nurseinchrge = isset($_REQUEST['mdc_nurseinchrge'])?trim($_REQUEST['mdc_nurseinchrge']):null;
$mdc_nurseReg   = isset($_REQUEST['mdc_nurseReg'])?trim($_REQUEST['mdc_nurseReg']):null;
$mdc_nurse    = isset($_REQUEST['mdc_nurse'])?trim($_REQUEST['mdc_nurse']):null;
$mdc_businessReg   = isset($_REQUEST['mdc_businessReg'])?trim($_REQUEST['mdc_businessReg']):null;
$mdc_consultRoom   = isset($_REQUEST['mdc_consultRoom'])?trim($_REQUEST['mdc_consultRoom']):null;
$mdc_checkNursingHome  = isset($_REQUEST['mdc_checkNursingHome'])?trim($_REQUEST['mdc_checkNursingHome']):null;
$mdc_examBed  = isset($_REQUEST['mdc_examBed'])?trim($_REQUEST['mdc_examBed']):null;
$mdc_tableChair    = isset($_REQUEST['mdc_tableChair'])?trim($_REQUEST['mdc_tableChair']):null;
$mdc_washBasin  = isset($_REQUEST['mdc_washBasin'])?trim($_REQUEST['mdc_washBasin']):null;
$mdc_weighingscale   = isset($_REQUEST['mdc_weighingscale'])?trim($_REQUEST['mdc_weighingscale']):null;
$mdc_ventilation  = isset($_REQUEST['mdc_ventilation'])?trim($_REQUEST['mdc_ventilation']):null;
$mdc_sanitaryFac  = isset($_REQUEST['mdc_sanitaryFac'])?trim($_REQUEST['mdc_sanitaryFac']):null;
$mdc_waventilation   = isset($_REQUEST['mdc_waventilation'])?trim($_REQUEST['mdc_waventilation']):null;
$mdc_smexamBed    = isset($_REQUEST['mdc_smexamBed'])?trim($_REQUEST['mdc_smexamBed']):null;
$mdc_floorarea          = isset($_REQUEST['mdc_floorarea'])?trim($_REQUEST['mdc_floorarea']):null;
$mdc_saniFac  = isset($_REQUEST['mdc_saniFac'])?trim($_REQUEST['mdc_saniFac']):null;
$mdc_scarmChair   = isset($_REQUEST['mdc_scarmChair'])?trim($_REQUEST['mdc_scarmChair']):null;
$mdc_scbed = isset($_REQUEST['mdc_scbed'])?trim($_REQUEST['mdc_scbed']):null;
$mdc_scwasteDisposal   = isset($_REQUEST['mdc_scwasteDisposal'])?trim($_REQUEST['mdc_scwasteDisposal']):null;
$mdc_scToiletFac = isset($_REQUEST['mdc_scToiletFac'])?trim($_REQUEST['mdc_scToiletFac']):null;
$mdc_scadeqIllum   = isset($_REQUEST['mdc_scadeqIllum'])?trim($_REQUEST['mdc_scadeqIllum']):null;
$mdc_xrayRoom   = isset($_REQUEST['mdc_xrayRoom'])?trim($_REQUEST['mdc_xrayRoom']):null;
$mdc_squarArea  = isset($_REQUEST['mdc_squarArea'])?trim($_REQUEST['mdc_squarArea']):null;
$mdc_room  = isset($_REQUEST['mdc_room'])?trim($_REQUEST['mdc_room']):null;
$mdc_roomsquare  = isset($_REQUEST['mdc_roomsquare'])?trim($_REQUEST['mdc_roomsquare']):null;
$mdc_armchair  = isset($_REQUEST['mdc_armchair'])?trim($_REQUEST['mdc_armchair']):null;
$mdc_eqbeds = isset($_REQUEST['mdc_eqbeds'])?trim($_REQUEST['mdc_eqbeds']):null;
$mdc_swdis = isset($_REQUEST['mdc_swdis'])?trim($_REQUEST['mdc_swdis']):null;
$mdc_toifac   = isset($_REQUEST['mdc_toifac'])?trim($_REQUEST['mdc_toifac']):null;
$mdc_adill = isset($_REQUEST['mdc_adill'])?trim($_REQUEST['mdc_adill']):null;
$mdc_cssdroom  = isset($_REQUEST['mdc_cssdroom'])?trim($_REQUEST['mdc_cssdroom']):null;
$mdc_cssdsquare     = isset($_REQUEST['mdc_cssdsquare'])?trim($_REQUEST['mdc_cssdsquare']):null;
$mdc_numbermedi      = isset($_REQUEST['mdc_numbermedi'])?trim($_REQUEST['mdc_numbermedi']):null;
$mdc_vehitype       = isset($_REQUEST['mdc_vehitype'])?trim($_REQUEST['mdc_vehitype']):null;
$mdc_numbervehi        = isset($_REQUEST['mdc_numbervehi'])?trim($_REQUEST['mdc_numbervehi']):null;
$mdc_wdis       = isset($_REQUEST['mdc_wdis'])?trim($_REQUEST['mdc_wdis']):null;


//------------------------private hosapital----------------------------

$phos_ownerame      = isset($_REQUEST['phos_ownerame'])?trim($_REQUEST['phos_ownerame']):null;
$phos_nameceo    = isset($_REQUEST['phos_nameceo'])?trim($_REQUEST['phos_nameceo']):null;
$phos_namemd      = isset($_REQUEST['phos_namemd'])?trim($_REQUEST['phos_namemd']):null;
$phos_mdreg     = isset($_REQUEST['phos_mdreg'])?trim($_REQUEST['phos_mdreg']):null;
$phos_numberftdoc     = isset($_REQUEST['phos_numberftdoc'])?trim($_REQUEST['phos_numberftdoc']):null;
$phos_namenursdirect     = isset($_REQUEST['phos_namenursdirect'])?trim($_REQUEST['phos_namenursdirect']):null;
$phos_numbernurse    = isset($_REQUEST['phos_numbernurse'])?trim($_REQUEST['phos_numbernurse']):null;
$phos_udaappnumber     = isset($_REQUEST['phos_udaappnumber'])?trim($_REQUEST['phos_udaappnumber']):null;
$phos_nursinghomedate  = isset($_REQUEST['phos_nursinghomedate'])?trim($_REQUEST['phos_nursinghomedate']):null;
$phos_consltroom   = isset($_REQUEST['phos_consltroom'])?trim($_REQUEST['phos_consltroom']):null;
$phos_squareroom          = isset($_REQUEST['phos_squareroom'])?trim($_REQUEST['phos_squareroom']):null;
$phos_exambed          = isset($_REQUEST['phos_exambed'])?trim($_REQUEST['phos_exambed']):null;
$phos_tablechair          = isset($_REQUEST['phos_tablechair'])?trim($_REQUEST['phos_tablechair']):null;
$phos_washbasin          = isset($_REQUEST['phos_washbasin'])?trim($_REQUEST['phos_washbasin']):null;
$phos_weighningscale     = isset($_REQUEST['phos_weighningscale'])?trim($_REQUEST['phos_weighningscale']):null;
$phos_ventillu          = isset($_REQUEST['phos_ventillu'])?trim($_REQUEST['phos_ventillu']):null;
$phos_waitingperson        = isset($_REQUEST['phos_waitingperson'])?trim($_REQUEST['phos_waitingperson']):null;
$phos_waitingventi          = isset($_REQUEST['phos_waitingventi'])?trim($_REQUEST['phos_waitingventi']):null;
$phos_sampleexambed   = isset($_REQUEST['phos_sampleexambed'])?trim($_REQUEST['phos_sampleexambed']):null;
$phos_floorarea  = isset($_REQUEST['phos_floorarea'])?trim($_REQUEST['phos_floorarea']):null;
$phos_adeqsanit   = isset($_REQUEST['phos_adeqsanit'])?trim($_REQUEST['phos_adeqsanit']):null;
$phos_armchair   = isset($_REQUEST['phos_armchair'])?trim($_REQUEST['phos_armchair']):null;
$phos_bed          = isset($_REQUEST['phos_bed'])?trim($_REQUEST['phos_bed']):null;
$phos_swdisposal    = isset($_REQUEST['phos_swdisposal'])?trim($_REQUEST['phos_swdisposal']):null;
$phos_toifac          = isset($_REQUEST['phos_toifac'])?trim($_REQUEST['phos_toifac']):null;
$phos_adeqillu     = isset($_REQUEST['phos_adeqillu'])?trim($_REQUEST['phos_adeqillu']):null;
$phos_slmcpathologi = isset($_REQUEST['phos_slmcpathologi'])?trim($_REQUEST['phos_slmcpathologi']):null;
$phos_slmcmicroi = isset($_REQUEST['phos_slmcmicroi'])?trim($_REQUEST['phos_slmcmicroi']):null;
$phos_qualitycont     = isset($_REQUEST['phos_qualitycont'])?trim($_REQUEST['phos_qualitycont']):null;
$phos_xrayRoom    = isset($_REQUEST['phos_xrayRoom'])?trim($_REQUEST['phos_xrayRoom']):null;
$phos_squarArea   = isset($_REQUEST['phos_squarArea'])?trim($_REQUEST['phos_squarArea']):null;
$phos_wards    = isset($_REQUEST['phos_wards'])?trim($_REQUEST['phos_wards']):null;
$phos_singleroom   = isset($_REQUEST['phos_singleroom'])?trim($_REQUEST['phos_singleroom']):null;
$phos_doubleroom          = isset($_REQUEST['phos_doubleroom'])?trim($_REQUEST['phos_doubleroom']):null;
$phos_opt   = isset($_REQUEST['phos_opt'])?trim($_REQUEST['phos_opt']):null;
$phos_oparmchair          = isset($_REQUEST['phos_oparmchair'])?trim($_REQUEST['phos_oparmchair']):null;
$phos_opbed          = isset($_REQUEST['phos_opbed'])?trim($_REQUEST['phos_opbed']):null;
$phos_opswdisposal = isset($_REQUEST['phos_opswdisposal'])?trim($_REQUEST['phos_opswdisposal']):null;
$phos_optoifac          = isset($_REQUEST['phos_optoifac'])?trim($_REQUEST['phos_optoifac']):null;
$phos_medium  = isset($_REQUEST['phos_medium'])?trim($_REQUEST['phos_medium']):null;
$phos_mdarmchair     = isset($_REQUEST['phos_mdarmchair'])?trim($_REQUEST['phos_mdarmchair']):null;
$phos_mdbed          = isset($_REQUEST['phos_mdbed'])?trim($_REQUEST['phos_mdbed']):null;
$phos_mdswdisposal    = isset($_REQUEST['phos_mdswdisposal'])?trim($_REQUEST['phos_mdswdisposal']):null;
$phos_mdtoifac = isset($_REQUEST['phos_mdtoifac'])?trim($_REQUEST['phos_mdtoifac']):null;
$phos_scrubingar   = isset($_REQUEST['phos_scrubingar'])?trim($_REQUEST['phos_scrubingar']):null;
$phos_recovery    = isset($_REQUEST['phos_recovery'])?trim($_REQUEST['phos_recovery']):null;
$phos_cssd  = isset($_REQUEST['phos_cssd'])?trim($_REQUEST['phos_cssd']):null;
$phos_lbroom      = isset($_REQUEST['phos_lbroom'])?trim($_REQUEST['phos_lbroom']):null;
$phos_emertrolly  = isset($_REQUEST['phos_emertrolly'])?trim($_REQUEST['phos_emertrolly']):null;
$phos_spotlamp  = isset($_REQUEST['phos_spotlamp'])?trim($_REQUEST['phos_spotlamp']):null;
$phos_stethoscope   = isset($_REQUEST['phos_stethoscope'])?trim($_REQUEST['phos_stethoscope']):null;
$phos_surginstrmnt  = isset($_REQUEST['phos_surginstrmnt'])?trim($_REQUEST['phos_surginstrmnt']):null;
$phos_adjtoilet  = isset($_REQUEST['phos_adjtoilet'])?trim($_REQUEST['phos_adjtoilet']):null;
$phos_wastdispos   = isset($_REQUEST['phos_wastdispos'])?trim($_REQUEST['phos_wastdispos']):null;
$phos_etunit     = isset($_REQUEST['phos_etunit'])?trim($_REQUEST['phos_etunit']):null;
$phos_facilities  = isset($_REQUEST['phos_facilities'])?trim($_REQUEST['phos_facilities']):null;
$phos_laryngoscope   = isset($_REQUEST['phos_laryngoscope'])?trim($_REQUEST['phos_laryngoscope']):null;
$phos_icuunit   = isset($_REQUEST['phos_icuunit'])?trim($_REQUEST['phos_icuunit']):null;
$phos_icuarmchair    = isset($_REQUEST['phos_icuarmchair'])?trim($_REQUEST['phos_icuarmchair']):null;
$phos_icubed    = isset($_REQUEST['phos_icubed'])?trim($_REQUEST['phos_icubed']):null;
$phos_icuswdisposal   = isset($_REQUEST['phos_icuswdisposal'])?trim($_REQUEST['phos_icuswdisposal']):null;
$phos_icutoifac  = isset($_REQUEST['phos_icutoifac'])?trim($_REQUEST['phos_icutoifac']):null;
$phos_dsname   = isset($_REQUEST['phos_dsname'])?trim($_REQUEST['phos_dsname']):null;
$phos_dsregno    = isset($_REQUEST['phos_dsregno'])?trim($_REQUEST['phos_dsregno']):null;
$phos_dsassistant     = isset($_REQUEST['phos_dsassistant'])?trim($_REQUEST['phos_dsassistant']):null;
$phos_dswaitingarea   = isset($_REQUEST['phos_dswaitingarea'])?trim($_REQUEST['phos_dswaitingarea']):null;
$phos_dssurgeryarea  = isset($_REQUEST['phos_dssurgeryarea'])?trim($_REQUEST['phos_dssurgeryarea']):null;
$phos_dstoiltfac    = isset($_REQUEST['phos_dstoiltfac'])?trim($_REQUEST['phos_dstoiltfac']):null;
$phos_dsarmchair  = isset($_REQUEST['phos_dsarmchair'])?trim($_REQUEST['phos_dsarmchair']):null;
$phos_dsbed = isset($_REQUEST['phos_dsbed'])?trim($_REQUEST['phos_dsbed']):null;
$phos_dsswdisposal  = isset($_REQUEST['phos_dsswdisposal'])?trim($_REQUEST['phos_dsswdisposal']):null;
$phos_dstoifac   = isset($_REQUEST['phos_dstoifac'])?trim($_REQUEST['phos_dstoifac']):null;
$phos_disposable  = isset($_REQUEST['phos_disposable'])?trim($_REQUEST['phos_disposable']):null;
$phos_consumable   = isset($_REQUEST['phos_consumable'])?trim($_REQUEST['phos_consumable']):null;
$phos_drugstorein   = isset($_REQUEST['phos_drugstorein'])?trim($_REQUEST['phos_drugstorein']):null;
$phos_drugstoreout   = isset($_REQUEST['phos_drugstoreout'])?trim($_REQUEST['phos_drugstoreout']):null;
$phos_ambservices     = isset($_REQUEST['phos_ambservices'])?trim($_REQUEST['phos_ambservices']):null;
$phos_pantry  = isset($_REQUEST['phos_pantry'])?trim($_REQUEST['phos_pantry']):null;
$phos_parking  = isset($_REQUEST['phos_parking'])?trim($_REQUEST['phos_parking']):null;
$phos_wastdis          = isset($_REQUEST['phos_wastdis'])?trim($_REQUEST['phos_wastdis']):null;




//$cboProvince           = $_REQUEST['cboProvince'];
//$cboDistrict           = $_REQUEST['cboDistrict'];

$companyId           = isset($userCompanyId)?$userCompanyId:null;
$createdBy           = isset($userId)?$userId:null;
$lastModifiedBy           = isset($userId)?$userId:null;
$deletedBy           = isset($userId)?$userId:null;
//$details = json_decode($_REQUEST['detailList'], true);

// =======================================================
//         Insert
// =======================================================
if($requestType=='add'){
  try{
    $db->begin();      
    if(!$intAddx){
      throw new exception('Permission is Denied ...');
    }
    // Number Generation *******************************************
    if($anStatus == "Auto"){
//      $clsAutoNo = new cls_auto_number($db, $userCompanyId, $userLocationId);
//      $autoNo = $clsAutoNo->getAutoNo($autoNoType);
//      $noReference	= $clsAutoNo->encodeNo($autoNo,"Em");
    }
    elseif($amStatus == "Manual"){
     // $noReference	= $no;
    }
    //echo ('done');
    if($insTypeId==1){

      $sql = "select * from institute_check_list where ins_id='$id' ";
      $result = $db->batchQuery($sql);
      if($row = mysqli_fetch_row($result)){

        //echo ("ok");
       $sql="update institute_check_list
            set phos_ownerame = '$phos_ownerame',
            phos_nameceo = '$phos_nameceo',
            phos_namemd = '$phos_namemd',
            phos_mdreg = '$phos_mdreg',
            phos_numberftdoc = '$phos_numberftdoc',
            phos_namenursdirect = '$phos_namenursdirect',
            phos_numbernurse = '$phos_numbernurse',
            phos_udaappnumber = '$phos_udaappnumber',
            phos_nursinghomedate = '$phos_nursinghomedate',
            phos_consltroom = '$phos_consltroom',
            phos_squareroom = '$phos_squareroom',
            phos_exambed = '$phos_exambed',
            phos_tablechair = '$phos_tablechair',
            phos_washbasin = '$phos_washbasin',
            phos_weighningscale = '$phos_weighningscale',
            phos_ventillu = '$phos_ventillu',
            phos_waitingperson = '$phos_waitingperson',
            phos_waitingventi = '$phos_waitingventi',
            phos_sampleexambed = '$phos_sampleexambed',
            phos_floorarea = '$phos_floorarea',
            phos_adeqsanit = '$phos_adeqsanit',
            phos_armchair = '$phos_armchair',
            phos_bed = '$phos_bed',
            phos_swdisposal = '$phos_swdisposal',
            phos_toifac = '$phos_toifac',
            phos_adeqillu = '$phos_adeqillu',
            phos_slmcpathologi = '$phos_slmcpathologi',
            phos_slmcmicroi = '$phos_slmcmicroi',
            phos_qualitycont = '$phos_qualitycont',
            phos_xrayRoom = '$phos_xrayRoom',
            phos_squarArea = '$phos_squarArea',
            phos_wards = '$phos_wards',
            phos_singleroom = '$phos_singleroom',
            phos_doubleroom = '$phos_doubleroom',
            phos_opt = '$phos_opt',
            phos_oparmchair = '$phos_oparmchair',
            phos_opbed = '$phos_opbed',
            phos_opswdisposal = '$phos_opswdisposal',
            phos_optoifac = '$phos_optoifac',
            phos_medium = '$phos_medium',
            phos_mdarmchair = '$phos_mdarmchair',
            phos_mdbed = '$phos_mdbed',
            phos_mdswdisposal = '$phos_mdswdisposal',
            phos_mdtoifac = '$phos_mdtoifac',
            phos_scrubingar = '$phos_scrubingar',
            phos_recovery = '$phos_recovery',
            phos_cssd = '$phos_cssd',
            phos_lbroom = '$phos_lbroom',
            phos_emertrolly = '$phos_emertrolly',
            phos_spotlamp = '$phos_spotlamp',
            phos_stethoscope = '$phos_stethoscope',
            phos_surginstrmnt = '$phos_surginstrmnt',
            phos_adjtoilet = '$phos_adjtoilet',
            phos_wastdispos = '$phos_wastdispos',
            phos_etunit = '$phos_etunit',
            phos_facilities = '$phos_facilities',
            phos_laryngoscope = '$phos_laryngoscope',
            phos_icuunit = '$phos_icuunit',
            phos_icuarmchair = '$phos_icuarmchair',
            phos_icubed = '$phos_icubed',
            phos_icuswdisposal = '$phos_icuswdisposal',
            phos_icutoifac = '$phos_icutoifac',
            phos_dsname = '$phos_dsname',
            phos_dsregno = '$phos_dsregno',
            phos_dsassistant = '$phos_dsassistant',
            phos_dswaitingarea = '$phos_dswaitingarea',
            phos_dssurgeryarea = '$phos_dssurgeryarea',
            phos_dstoiltfac = '$phos_dstoiltfac',
            phos_dsarmchair = '$phos_dsarmchair',
            phos_dsbed = '$phos_dsbed',
            phos_dsswdisposal = '$phos_dsswdisposal',
            phos_dstoifac = '$phos_dstoifac',
            phos_disposable = '$phos_disposable',
            phos_consumable = '$phos_consumable',
            phos_drugstorein = '$phos_drugstorein',
            phos_drugstoreout = '$phos_drugstoreout',
            phos_ambservices = '$phos_ambservices',
            phos_pantry = '$phos_pantry',
            phos_parking = '$phos_parking',
            phos_wastdis = '$phos_wastdis',
            ins_last_modified_on = now()
                      where ins_id='$id'";


      }else{

        $sql= "insert into institute_check_list (ins_type_id,ins_id,phos_ownerame,phos_nameceo,phos_namemd,phos_mdreg,phos_numberftdoc,phos_namenursdirect,phos_numbernurse,phos_udaappnumber,phos_nursinghomedate,
        phos_consltroom,phos_squareroom,phos_exambed,phos_tablechair,phos_washbasin,phos_weighningscale,phos_ventillu,phos_waitingperson,phos_waitingventi,phos_sampleexambed,phos_floorarea,
        phos_adeqsanit,phos_armchair,phos_bed,phos_swdisposal,phos_toifac,phos_adeqillu,phos_slmcpathologi,phos_slmcmicroi,phos_qualitycont,phos_xrayRoom,phos_squarArea,phos_wards,phos_singleroom,
        phos_doubleroom,phos_opt,phos_oparmchair,phos_opbed,phos_opswdisposal,phos_optoifac,phos_medium,phos_mdarmchair,phos_mdbed,phos_mdswdisposal,phos_mdtoifac,phos_scrubingar,phos_recovery,
        phos_cssd,phos_lbroom,phos_emertrolly,phos_spotlamp,phos_stethoscope,phos_surginstrmnt,phos_adjtoilet,phos_wastdispos,phos_etunit,phos_facilities,phos_laryngoscope,phos_icuunit,phos_icuarmchair,
        phos_icubed,phos_icuswdisposal,phos_icutoifac,phos_dsname,phos_dsregno,phos_dsassistant,phos_dswaitingarea,phos_dssurgeryarea,phos_dstoiltfac,phos_dsarmchair,phos_dsbed,phos_dsswdisposal,
        phos_dstoifac,phos_disposable,phos_consumable,phos_drugstorein,phos_drugstoreout,phos_ambservices,phos_pantry,phos_parking,phos_wastdis,ins_company_id,ins_created_by,ins_created_on)
              values ('$insTypeId','$id','$phos_ownerame','$phos_nameceo','$phos_namemd','$phos_mdreg','$phos_numberftdoc','$phos_namenursdirect','$phos_numbernurse','$phos_udaappnumber','$phos_nursinghomedate','$phos_consltroom','$phos_squareroom','$phos_exambed','$phos_tablechair','$phos_washbasin','$phos_weighningscale','$phos_ventillu','$phos_waitingperson','$phos_waitingventi','$phos_sampleexambed','$phos_floorarea','$phos_adeqsanit','$phos_armchair','$phos_bed','$phos_swdisposal','$phos_toifac','$phos_adeqillu','$phos_slmcpathologi','$phos_slmcmicroi','$phos_qualitycont','$phos_xrayRoom','$phos_squarArea','$phos_wards','$phos_singleroom','$phos_doubleroom','$phos_opt','$phos_oparmchair','$phos_opbed','$phos_opswdisposal','$phos_optoifac','$phos_medium','$phos_mdarmchair','$phos_mdbed','$phos_mdswdisposal','$phos_mdtoifac','$phos_scrubingar','$phos_recovery','$phos_cssd','$phos_lbroom','$phos_emertrolly','$phos_spotlamp','$phos_stethoscope','$phos_surginstrmnt','$phos_adjtoilet','$phos_wastdispos','$phos_etunit','$phos_facilities','$phos_laryngoscope','$phos_icuunit','$phos_icuarmchair','$phos_icubed','$phos_icuswdisposal','$phos_icutoifac','$phos_dsname','$phos_dsregno','$phos_dsassistant','$phos_dswaitingarea','$phos_dssurgeryarea','$phos_dstoiltfac','$phos_dsarmchair','$phos_dsbed','$phos_dsswdisposal','$phos_dstoifac','$phos_disposable','$phos_consumable','$phos_drugstorein','$phos_drugstoreout','$phos_ambservices','$phos_pantry','$phos_parking','$phos_wastdis','$userCompanyId','$userId',now())";
      }
    }else if($insTypeId==2){

      $sql = "select * from institute_check_list where ins_id='$id' ";
      $result = $db->batchQuery($sql);
      if($row = mysqli_fetch_row($result)){

        $sql="update institute_check_list
            set mdc_owner = '$mdc_owner',
            mdc_nameMediDire = '$mdc_nameMediDire',
            mdc_mdReg = '$mdc_mdReg',
            mdc_fultimeDoc = '$mdc_fultimeDoc',
            mdc_parttimeDoc = '$mdc_parttimeDoc',
            mdc_nurseinchrge = '$mdc_nurseinchrge',
            mdc_nurseReg = '$mdc_nurseReg',
            mdc_nurse = '$mdc_nurse',
            mdc_businessReg = '$mdc_businessReg',
            mdc_consultRoom = '$mdc_consultRoom',
            mdc_checkNursingHome = '$mdc_checkNursingHome',
            mdc_examBed = '$mdc_examBed',
            mdc_tableChair = '$mdc_tableChair',
            mdc_washBasin = '$mdc_washBasin',
            mdc_weighingscale = '$mdc_weighingscale',
            mdc_ventilation = '$mdc_ventilation',
            mdc_sanitaryFac = '$mdc_sanitaryFac',
            mdc_waventilation = '$mdc_waventilation',
            mdc_smexamBed = '$mdc_smexamBed',
            mdc_floorarea = '$mdc_floorarea',
            mdc_saniFac = '$mdc_saniFac',
            mdc_scarmChair = '$mdc_scarmChair',
            mdc_scbed = '$mdc_scbed',
            mdc_scwasteDisposal = '$mdc_scwasteDisposal',
            mdc_scToiletFac = '$mdc_scToiletFac',
            mdc_scadeqIllum = '$mdc_scadeqIllum',
            mdc_xrayRoom = '$mdc_xrayRoom',
            mdc_squarArea = '$mdc_squarArea',
            mdc_room = '$mdc_room',
            mdc_roomsquare = '$mdc_roomsquare',
            mdc_armchair = '$mdc_armchair',
            mdc_eqbeds = '$mdc_eqbeds',
            mdc_swdis = '$mdc_swdis',
            mdc_toifac = '$mdc_toifac',
            mdc_adill = '$mdc_adill',
            mdc_cssdroom = '$mdc_cssdroom',
            mdc_cssdsquare = '$mdc_cssdsquare',
            mdc_numbermedi = '$mdc_numbermedi',
            mdc_vehitype = '$mdc_vehitype',
            mdc_numbervehi = '$mdc_numbervehi',
            mdc_wdis = '$mdc_wdis',
            ins_last_modified_on = now()
                      where ins_id='$id'";

      }else{

        echo $sql="insert into institute_check_list (ins_type_id,ins_id,mdc_owner,
        mdc_nameMediDire,mdc_mdReg,mdc_fultimeDoc,mdc_parttimeDoc,mdc_nurseinchrge,mdc_nurseReg,mdc_nurse,mdc_businessReg,mdc_consultRoom,mdc_checkNursingHome,mdc_examBed,
        mdc_tableChair,mdc_washBasin,mdc_weighingscale,mdc_ventilation,mdc_sanitaryFac,mdc_waventilation,mdc_smexamBed,mdc_floorarea,mdc_saniFac,mdc_scarmChair,mdc_scbed,mdc_scwasteDisposal,
        mdc_scToiletFac,mdc_scadeqIllum,mdc_xrayRoom,mdc_squarArea,mdc_room,mdc_roomsquare,mdc_armchair,mdc_eqbeds,mdc_swdis,mdc_toifac,mdc_adill,mdc_cssdroom,mdc_cssdsquare,mdc_numbermedi,
        mdc_vehitype,mdc_numbervehi,mdc_wdis,ins_company_id,ins_created_by,ins_created_on)
        values ('$insTypeId','$id','$mdc_owner','$mdc_nameMediDire','$mdc_mdReg','$mdc_fultimeDoc','$mdc_parttimeDoc','$mdc_nurseinchrge','$mdc_nurseReg','$mdc_nurse','$mdc_businessReg','$mdc_consultRoom','$mdc_checkNursingHome','$mdc_examBed','$mdc_tableChair','$mdc_washBasin','$mdc_weighingscale','$mdc_ventilation','$mdc_sanitaryFac','$mdc_waventilation','$mdc_smexamBed','$mdc_floorarea','$mdc_saniFac','$mdc_scarmChair','$mdc_scbed','$mdc_scwasteDisposal','$mdc_scToiletFac','$mdc_scadeqIllum','$mdc_xrayRoom','$mdc_squarArea','$mdc_room','$mdc_roomsquare','$mdc_armchair','$mdc_eqbeds','$mdc_swdis','$mdc_toifac','$mdc_adill','$mdc_cssdroom','$mdc_cssdsquare','$mdc_numbermedi','$mdc_vehitype','$mdc_numbervehi','$mdc_wdis','$userCompanyId','$userId',now())";
      }

    }else if($insTypeId==3){
        //echo $id;

      $sql = "select * from institute_check_list where ins_id='$id' ";
      $result = $db->batchQuery($sql);
      if($row = mysqli_fetch_row($result)){

        $sql="update institute_check_list
            set medl_person = '$medl_person',
            medl_pathologist = '$medl_pathologist',
            medi_path_reg ='$medi_path_reg',
            medi_path_whether = '$medi_path_whether',
            medi_microbiologist = '$medi_microbiologist',
            medi_micro_reg = '$medi_micro_reg',
            medi_micro_whether = '$medi_micro_whether',
            medi_chem_pathologist = '$medi_chem_pathologist',
            medi_chem_path_reg = '$medi_chem_path_reg',
            medi_whether = '$medi_whether',
            medi_qlity = '$medi_qlity',
            medi_facility = '$medi_facility',
            medi_disposal = '$medi_disposal',
            medi_br = '$medi_br',
            ins_last_modified_on = now()
                      where ins_id='$id'";

      }else{

        $sql="insert into institute_check_list (ins_type_id,ins_id,medl_person,medl_pathologist,medi_path_reg,medi_path_whether,medi_microbiologist,medi_micro_reg,medi_micro_whether,medi_chem_pathologist,medi_chem_path_reg,medi_whether,medi_qlity,medi_facility,medi_disposal,medi_br,ins_company_id,ins_created_by,ins_created_on) values ('$insTypeId','$id','$medl_person','$medl_pathologist','$medi_path_reg','$medi_path_whether','$medi_microbiologist','$medi_micro_reg','$medi_micro_whether','$medi_chem_pathologist','$medi_chem_path_reg','$medi_whether','$medi_qlity','$medi_facility','$medi_disposal','$medi_br','$userCompanyId','$userId',now())";

      }

       //echo $sql;

      }else if($insTypeId==4){
        //echo $id;

      $sql = "select * from institute_check_list where ins_id='$id' ";
      $result = $db->batchQuery($sql);
      if($row = mysqli_fetch_row($result)){

        $sql="update institute_check_list
            set txtambName = '$txtambName',
            txtNoDoctor = '$txtNoDoctor',
            txtNoNurs ='$txtNoNurs',
            txtnoAmbulance = '$txtnoAmbulance',
            txtnoModel = '$txtnoModel',
            txtfacility = '$txtfacility',
            txtequipment = '$txtequipment',
            txtDriverAv = '$txtDriverAv',
            txtRMVreg = '$txtRMVreg',
            ins_last_modified_on = now()
                      where ins_id='$id'";

      }else{

        $sql="insert into institute_check_list (ins_type_id,ins_id,txtambName,txtNoDoctor,txtNoNurs,txtnoAmbulance,txtnoModel,txtfacility,txtequipment,txtDriverAv,txtRMVreg,ins_company_id,ins_created_by,ins_created_on) values ('$insTypeId','$id','$txtambName','$txtNoDoctor','$txtNoNurs','$txtnoAmbulance','$txtnoModel','$txtfacility','$txtequipment','$txtDriverAv','$txtRMVreg','$userCompanyId','$userId',now())";

      }

       //echo $sql;

      }else if($insTypeId==7){
        //echo $id;

      $sql = "select * from institute_check_list where ins_id='$id' ";
      $result = $db->batchQuery($sql);
      if($row = mysqli_fetch_row($result)){

        $sql="update institute_check_list
            set densu_surgeonname = '$densu_surgeonname',
            densu_surgeonreg = '$densu_surgeonreg',
            densu_assisname ='$densu_assisname',
            densu_surgeonfull = '$densu_surgeonfull',
            densu_prachours = '$densu_prachours',
            densu_examBed = '$densu_examBed',
            densu_tableChair = '$densu_tableChair',
            densu_washBasin = '$densu_washBasin',
            densu_weighingscale = '$densu_weighingscale',
            densu_ventilation = '$densu_ventilation',
            densu_needles = '$densu_needles',
            densu_siringer = '$densu_siringer',
            densu_mask = '$densu_mask',
            densu_gloves = '$densu_gloves',
            densu_cups = '$densu_cups',
            densu_apron = '$densu_apron',
            densu_consumaterial = '$densu_consumaterial',
            densu_prosthetic = '$densu_prosthetic',
            densu_adeqwater = '$densu_adeqwater',
            densu_hygenicdispos = '$densu_hygenicdispos',
            densu_sysrecords = '$densu_sysrecords',
            densu_patientwaiting = '$densu_patientwaiting',
            densu_receptionarea = '$densu_receptionarea',
            densu_surgeryarea = '$densu_surgeryarea',
            densu_adeqtoilt = '$densu_adeqtoilt',
            densu_modexamBed = '$densu_modexamBed',
            densu_modtableChair = '$densu_modtableChair',
            densu_modwashBasin = '$densu_modwashBasin',
            densu_modweighingscale = '$densu_modweighingscale',
            densu_modventilation = '$densu_modventilation',
            densu_modneedles = '$densu_modneedles',
            densu_modsiringer = '$densu_modsiringer',
            densu_modmask = '$densu_modmask',
            densu_modgloves = '$densu_modgloves',
            densu_modcups = '$densu_modcups',
            densu_modapron = '$densu_modapron',
            densu_modconsumaterial = '$densu_modconsumaterial',
            densu_modprosthetic = '$densu_modprosthetic',
            densu_modadeqwater = '$densu_modadeqwater',
            densu_modhygenicdispos = '$densu_modhygenicdispos',
            densu_modsysrecords = '$densu_modsysrecords',
            densu_autoclaves = '$densu_autoclaves',
            densu_lightcure = '$densu_lightcure',
            densu_scalars = '$densu_scalars',
            densu_airrotors = '$densu_airrotors',
            densu_xrayfaci = '$densu_xrayfaci',
            densu_amalgamators = '$densu_amalgamators',
            densu_intracam = '$densu_intracam',
            densu_refrigerator = '$densu_refrigerator',
            densu_storagefaci = '$densu_storagefaci',
            densu_excelneedles = '$densu_excelneedles',
            densu_excelsiringer = '$densu_excelsiringer',
            densu_excelmask = '$densu_excelmask',
            densu_excelgloves = '$densu_excelgloves',
            densu_excelcups = '$densu_excelcups',
            densu_excelapron = '$densu_excelapron',
            densu_excelrestorative = '$densu_excelrestorative',
            densu_excelprosthetic = '$densu_excelprosthetic',
            ins_last_modified_on = now()
                      where ins_id='$id'";

      }else{

        $sql="insert into institute_check_list (ins_type_id,ins_id,densu_surgeonname,densu_surgeonreg,densu_assisname,densu_surgeonfull,densu_prachours,densu_examBed,densu_tableChair,densu_washBasin,densu_weighingscale,densu_ventilation,densu_needles,densu_siringer,densu_mask,densu_gloves,densu_cups,densu_apron,densu_consumaterial,densu_prosthetic,densu_adeqwater,densu_hygenicdispos,densu_sysrecords,densu_patientwaiting,densu_receptionarea,densu_surgeryarea,densu_adeqtoilt,densu_modexamBed,densu_modtableChair,densu_modwashBasin,densu_modweighingscale,densu_modventilation,densu_modneedles,densu_modsiringer,densu_modmask,densu_modgloves,densu_modcups,densu_modapron,densu_modconsumaterial,densu_modprosthetic,densu_modadeqwater,densu_modhygenicdispos,densu_modsysrecords,densu_autoclaves,densu_lightcure,densu_scalars,densu_airrotors,densu_xrayfaci,densu_amalgamators,densu_intracam,densu_refrigerator,densu_storagefaci,densu_excelneedles,densu_excelsiringer,densu_excelmask,densu_excelgloves,densu_excelcups,densu_excelapron,densu_excelrestorative,densu_excelprosthetic,ins_company_id,ins_created_by,ins_created_on) values ('$insTypeId','$id','$densu_surgeonname','$densu_surgeonreg','$densu_assisname','$densu_surgeonfull','$densu_prachours','$densu_examBed','$densu_tableChair','$densu_washBasin','$densu_weighingscale','$densu_ventilation','$densu_needles','$densu_siringer','$densu_mask','$densu_gloves','$densu_cups','$densu_apron','$densu_consumaterial','$densu_prosthetic','$densu_adeqwater','$densu_hygenicdispos','$densu_sysrecords','$densu_patientwaiting','$densu_receptionarea','$densu_surgeryarea','$densu_adeqtoilt','$densu_modexamBed','$densu_modtableChair','$densu_modwashBasin','$densu_modweighingscale','$densu_modventilation','$densu_modneedles','$densu_modsiringer','$densu_modmask','$densu_modgloves','$densu_modcups','$densu_modapron','$densu_modconsumaterial','$densu_modprosthetic','$densu_modadeqwater','$densu_modhygenicdispos','$densu_modsysrecords','$densu_autoclaves','$densu_lightcure','$densu_scalars','$densu_airrotors','$densu_xrayfaci','$densu_amalgamators','$densu_intracam','$densu_refrigerator','$densu_storagefaci','$densu_excelneedles','$densu_excelsiringer','$densu_excelmask','$densu_excelgloves','$densu_excelcups','$densu_excelapron','$densu_excelrestorative','$densu_excelprosthetic','$userCompanyId','$userId',now())";

      }

       //echo $sql;

      }

        //Add data to transaction header*******************************************
    
                
    $finalResult = $db->batchQuery($sql);
    $entryId = $db->insertId;           
    
    // Upload Image
   /* if($_FILES['fileProfileImage']['size'] <> 0)
	{
		$uploadPath = $_FILES['fileProfileImage']['name'];
        $newImgName = saveFile($_FILES['fileProfileImage'], $entryId);
	}*/

    
    // ============================   Approval Entry    ================
//    $clsApprove = new cls_approval($db, $userCompanyId, $userLocationId, $userId);
//    $clsApprove->newApprovalEntry($autoNoType, $entryId, $noReference, true);
    if($finalResult){                    
        $response['type'] 	= 'pass';
        $response['msg'] 	= 'Saved successfully.';
        $response['no'] 	= $noReference; 
        $response['id'] 	= $entryId;
        $db->commit();
        // commit auto number
//        $clsAutoNo->setAutoNoCommit($autoNoType, $autoNo);
    }
    else{                    
        $response['type'] 		= 'fail';
        $response['msg'] 		= $db->errormsg;
        $response['q'] 			= $sql;
        $db->rollback();//roalback
        // rollback auto number
//        $clsAutoNo->setAutoNoRollback($autoNoType, $autoNo);
    }
            
  }catch(Exception $e){

    $db->rollback();//roalback
    // rollback auto number
//    $clsAutoNo->setAutoNoRollback($autoNoType, $autoNo);

    $response['type'] 		= 'fail';
    $response['msg'] 		= $e->getMessage().$noReference;
    $response['q'] 			= $sql;                
  }
  
} // End If - Insert
// =======================================================
//         Update
// =======================================================
/*if($requestType=='edit'){
  try{
    $db->begin();  
    if(!$intEditx){
      throw new exception('Permission is Denied ...');
    }
  // $sql = "select * from institute_check_list where ins_id='$id' ";
    //$result = $db->batchQuery($sql);
    //while($row = mysqli_fetch_row($result)){
    //if($row = mysqli_fetch_row($result)){
      //echo("ok");
      //echo $insTypeId;
      //echo $id;

      if($insTypeId==1){
        //echo $insTypeId;
        //echo $id;
        /*echo*/
         /*$sql1="update institute_check_list
            set phos_ownerame = '$phos_ownerame',
            phos_nameceo = '$phos_nameceo',
            phos_namemd = '$phos_namemd',
            phos_mdreg = '$phos_mdreg',
                      where ins_id='$id'";

      }*/
			
      //Update data to transaction header*******************************************
   
      
    
    
    //$finalResult = $db->batchQuery($sql1);
	//$entryId=$id;
    
    // ============================   Approval Entry    ================
//    $clsApprove = new cls_approval($db, $userCompanyId, $userLocationId, $userId);
//    $clsApprove->newApprovalEntry($autoNoType, $entryId, $noReference, true);
    /*if($finalResult){                    
        $response['type'] 	= 'pass';
        $response['msg'] 	= 'Update successfully.';
        $response['no'] 	= $noReference; 
        $response['id'] 	= $entryId;
        $db->commit();*/
        // commit auto number
//        $clsAutoNo->setAutoNoCommit($autoNoType, $autoNo);
    /*}
    else{                    
        $response['type'] 		= 'fail';
        $response['msg'] 		= $db->errormsg;
        $response['q'] 			= $sql1;
        $db->rollback();//roalback
        // rollback auto number
//        $clsAutoNo->setAutoNoRollback($autoNoType, $autoNo);
    }
            
  }catch(Exception $e){

    $db->rollback();//roalback
    // rollback auto number
//    $clsAutoNo->setAutoNoRollback($autoNoType, $autoNo);

    $response['type'] 		= 'fail';
    $response['msg'] 		= $e->getMessage().$noReference;
    $response['q'] 			= $sql1;                
  }
  
}*/// End If - Update
// =======================================================
//         Delete
// =======================================================
if($requestType=='delete'){
  try{
    $db->begin();      
    if(!$intDeletex){
      throw new exception('Permission is Denied ...');
    }
    
    $sql="update `hrm_employee_information`
          set
            emi_is_deleted = '1',
            emi_deleted_on = '". time()."',
            emi_deleted_by = '$userId'
          where emi_id='$id' and emi_company_id='$userCompanyId'";
                
    $finalResult = $db->batchQuery($sql);
    $entryId = $id;           
    
    if($finalResult){                    
        $response['type'] 	= 'pass';
        $response['msg'] 	= 'Saved successfully.';
        $response['id'] 	= $entryId;
        $db->commit();
    }
    else{                    
        $response['type'] 		= 'fail';
        $response['msg'] 		= $db->errormsg;
        $response['q'] 			= $sql;
        $db->rollback();//roalback
    }
            
  }catch(Exception $e){

    $db->rollback();//roalback

    $response['type'] 	= 'fail';
    $response['msg'] 		= $e->getMessage().$noReference;
    $response['q'] 		= $sql;                
  }
  
} // End If - Delete

echo json_encode($response);   
function saveFile($file,$id){
  global $db;
  global $backwardSeparator;
  global $finalResult;
  $size =  $file["size"] / 1028 / 1028;
  $fType = $file["type"];
  $imgName  = basename($file['name']);
  $ext = pathinfo($imgName, PATHINFO_EXTENSION);
  $newImgName       = $id.'.'.$ext;
  if ($size <=10 && ($fType == "image/gif" || $fType == "image/jpeg" || $fType == "image/jpg" || $fType == "image/pjpeg" || $fType == "image/x-png" || $fType == "image/png")){
    if ($file["error"] > 0){
      throw new Exception('File Upload Error.');
    }
    else{
      $target1 = $backwardSeparator."img/profile/" . $newImgName;
      $target2 = $backwardSeparator."img/profile/40/" . $newImgName;
      $target3 = $backwardSeparator."img/profile/32/" . $newImgName;
      move_uploaded_file($file["tmp_name"],$target1);
      // Resize Image
      $image = new Gumlet\ImageResize($target1);
      //$image->scale(10);
      $image->resizeToShortSide(256,true);
      $image->crop(256, 256);
      $image->save($target1);
      $image->resizeToShortSide(40);
      $image->crop(40, 40);
      $image->save($target2);
      $image->resizeToShortSide(32);
      $image->crop(32, 32);
      $image->save($target3);

      // save Image Name in DB
      $sql = "update `hrm_employee_information`
          set
            emi_image_name='$newImgName'
          where emi_id='$id'";
      $finalResult = $finalResult && $db->batchQuery($sql);
    }
  }
  else{
    throw new Exception('Invalid File Type or Size.');
  }
  return $newImgName;
}
?>





