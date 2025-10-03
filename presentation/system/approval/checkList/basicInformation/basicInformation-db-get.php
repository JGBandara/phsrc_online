
<?php
session_start();
$backwardSeparator = "../../../../../";
$thisFilePath =  $_SERVER['PHP_SELF'];
$userId 	= $_SESSION['loginId'];
$userCompanyId = $_SESSION['companyId'];
$userLocationId = $_SESSION['locationId'];

require "{$backwardSeparator}autoLoad.php";

require_once $backwardSeparator.'dataAccess/connector.php'; 
$requestType 	= $_REQUEST['requestType'];

// =======================================================
//         Load Details
// =======================================================

/*$den_lab_person           = isset($_REQUEST['txtdlName'])?trim($_REQUEST['txtdlName']):null;
$den_lab_technician         = isset($_REQUEST['txtdlTName'])?trim($_REQUEST['txtdlTName']):null;
$den_lab_qualifications     = isset($_REQUEST['txtQlifications'])?trim($_REQUEST['txtQlifications']):null;
$den_facility           = isset($_REQUEST['txtfaciAv'])?trim($_REQUEST['txtfaciAv']):null;
$den_dis_method           = isset($_REQUEST['txtwastDisposal'])?trim($_REQUEST['txtwastDisposal']):null;
$den_br           = isset($_REQUEST['txtbusinessReg'])?trim($_REQUEST['txtbusinessReg']):null;
*/

if($requestType=='loadDetails'){
  $id = $_REQUEST['id'];

  $sql1 = "SELECT ins_type_id FROM institute_registration WHERE ins_application_id=$id";

  $result1=$db->singleQuery($sql1);
	while($row1=mysqli_fetch_array($result1)){

    $response['ins_type_id']=$row1['ins_type_id'];
  }

  $sql="SELECT
  institute_check_list.ins_type_id,
  institute_check_list.ins_id,
  institute_check_list.txtambName,
  institute_check_list.txtNoDoctor,
  institute_check_list.txtNoNurs,
  institute_check_list.txtnoAmbulance,
  institute_check_list.txtnoModel,
  institute_check_list.txtfacility,
  institute_check_list.txtequipment,
  institute_check_list.txtDriverAv,
  institute_check_list.txtRMVreg,
  institute_check_list.den_lab_person,
  institute_check_list.den_lab_technician,
  institute_check_list.den_lab_qualifications,
  institute_check_list.den_facility,
  institute_check_list.den_dis_method,
  institute_check_list.den_br,
  institute_check_list.medl_person,
  institute_check_list.medl_pathologist,
  institute_check_list.medi_path_reg,
  institute_check_list.medi_path_whether,
  institute_check_list.medi_microbiologist,
  institute_check_list.medi_micro_reg,
  institute_check_list.medi_micro_whether,
  institute_check_list.medi_chem_pathologist,
  institute_check_list.medi_chem_path_reg,
  institute_check_list.medi_whether,
  institute_check_list.medi_qlity,
  institute_check_list.medi_facility,
  institute_check_list.medi_disposal,
  institute_check_list.medi_br,
  institute_check_list.mdc_owner,
  institute_check_list.mdc_nameMediDire,
  institute_check_list.mdc_mdReg,
  institute_check_list.mdc_fultimeDoc,
  institute_check_list.mdc_parttimeDoc,
  institute_check_list.mdc_nurseinchrge,
  institute_check_list.mdc_nurseReg,
  institute_check_list.mdc_nurse,
  institute_check_list.mdc_businessReg,
  institute_check_list.mdc_consultRoom,
  institute_check_list.mdc_checkNursingHome,
  institute_check_list.mdc_examBed,
  institute_check_list.mdc_tableChair,
  institute_check_list.mdc_washBasin,
  institute_check_list.mdc_weighingscale,
  institute_check_list.mdc_ventilation,
  institute_check_list.mdc_sanitaryFac,
  institute_check_list.mdc_waventilation,
  institute_check_list.mdc_smexamBed,
  institute_check_list.mdc_floorarea,
  institute_check_list.mdc_saniFac,
  institute_check_list.mdc_scarmChair,
  institute_check_list.mdc_scbed,
  institute_check_list.mdc_scwasteDisposal,
  institute_check_list.mdc_scToiletFac,
  institute_check_list.mdc_scadeqIllum,
  institute_check_list.mdc_xrayRoom,
  institute_check_list.mdc_squarArea,
  institute_check_list.mdc_room,
  institute_check_list.mdc_roomsquare,
  institute_check_list.mdc_armchair,
  institute_check_list.mdc_eqbeds,
  institute_check_list.mdc_swdis,
  institute_check_list.mdc_toifac,
  institute_check_list.mdc_adill,
  institute_check_list.mdc_cssdroom,
  institute_check_list.mdc_cssdsquare,
  institute_check_list.mdc_numbermedi,
  institute_check_list.mdc_vehitype,
  institute_check_list.mdc_numbervehi,
  institute_check_list.mdc_wdis,
  institute_check_list.phos_ownerame,
  institute_check_list.phos_nameceo,
  institute_check_list.phos_namemd,
  institute_check_list.phos_mdreg,
  institute_check_list.phos_numberftdoc,
  institute_check_list.phos_namenursdirect,
  institute_check_list.phos_numbernurse,
  institute_check_list.phos_udaappnumber,
  institute_check_list.phos_nursinghomedate,
  institute_check_list.phos_consltroom,
  institute_check_list.phos_squareroom,
  institute_check_list.phos_exambed,
  institute_check_list.phos_tablechair,
  institute_check_list.phos_washbasin,
  institute_check_list.phos_weighningscale,
  institute_check_list.phos_ventillu,
  institute_check_list.phos_waitingperson,
  institute_check_list.phos_waitingventi,
  institute_check_list.phos_sampleexambed,
  institute_check_list.phos_floorarea,
  institute_check_list.phos_adeqsanit,
  institute_check_list.phos_armchair,
  institute_check_list.phos_bed,
  institute_check_list.phos_swdisposal,
  institute_check_list.phos_toifac,
  institute_check_list.phos_adeqillu,
  institute_check_list.phos_slmcpathologi,
  institute_check_list.phos_slmcmicroi,
  institute_check_list.phos_qualitycont,
  institute_check_list.phos_xrayRoom,
  institute_check_list.phos_squarArea,
  institute_check_list.phos_wards,
  institute_check_list.phos_singleroom,
  institute_check_list.phos_doubleroom,
  institute_check_list.phos_opt,
  institute_check_list.phos_oparmchair,
  institute_check_list.phos_opbed,
  institute_check_list.phos_opswdisposal,
  institute_check_list.phos_optoifac,
  institute_check_list.phos_medium,
  institute_check_list.phos_mdarmchair,
  institute_check_list.phos_mdbed,
  institute_check_list.phos_mdswdisposal,
  institute_check_list.phos_mdtoifac,
  institute_check_list.phos_scrubingar,
  institute_check_list.phos_recovery,
  institute_check_list.phos_cssd,
  institute_check_list.phos_lbroom,
  institute_check_list.phos_emertrolly,
  institute_check_list.phos_spotlamp,
  institute_check_list.phos_stethoscope,
  institute_check_list.phos_surginstrmnt,
  institute_check_list.phos_adjtoilet,
  institute_check_list.phos_wastdispos,
  institute_check_list.phos_etunit,
  institute_check_list.phos_facilities,
  institute_check_list.phos_laryngoscope,
  institute_check_list.phos_icuunit,
  institute_check_list.phos_icuarmchair,
  institute_check_list.phos_icubed,
  institute_check_list.phos_icuswdisposal,
  institute_check_list.phos_icutoifac,
  institute_check_list.phos_dsname,
  institute_check_list.phos_dsregno,
  institute_check_list.phos_dsassistant,
  institute_check_list.phos_dswaitingarea,
  institute_check_list.phos_dssurgeryarea,
  institute_check_list.phos_dstoiltfac,
  institute_check_list.phos_dsarmchair,
  institute_check_list.phos_dsbed,
  institute_check_list.phos_dsswdisposal,
  institute_check_list.phos_dstoifac,
  institute_check_list.phos_disposable,
  institute_check_list.phos_consumable,
  institute_check_list.phos_drugstorein,
  institute_check_list.phos_drugstoreout,
  institute_check_list.phos_ambservices,
  institute_check_list.phos_pantry,
  institute_check_list.phos_parking,
  institute_check_list.phos_wastdis,
  institute_check_list.densu_surgeonname,
  institute_check_list.densu_surgeonreg,
  institute_check_list.densu_assisname,
  institute_check_list.densu_surgeonfull,
  institute_check_list.densu_prachours,
  institute_check_list.densu_examBed,
  institute_check_list.densu_tableChair,
  institute_check_list.densu_washBasin,
  institute_check_list.densu_weighingscale,
  institute_check_list.densu_ventilation,
  institute_check_list.densu_needles,
  institute_check_list.densu_siringer,
  institute_check_list.densu_mask,
  institute_check_list.densu_gloves,
  institute_check_list.densu_cups,
  institute_check_list.densu_apron,
  institute_check_list.densu_consumaterial,
  institute_check_list.densu_prosthetic,
  institute_check_list.densu_adeqwater,
  institute_check_list.densu_hygenicdispos,
  institute_check_list.densu_sysrecords,
  institute_check_list.densu_patientwaiting,
  institute_check_list.densu_receptionarea,
  institute_check_list.densu_surgeryarea,
  institute_check_list.densu_adeqtoilt,
  institute_check_list.densu_modexamBed,
  institute_check_list.densu_modtableChair,
  institute_check_list.densu_modwashBasin,
  institute_check_list.densu_modweighingscale,
  institute_check_list.densu_modventilation,
  institute_check_list.densu_modneedles,
  institute_check_list.densu_modsiringer,
  institute_check_list.densu_modmask,
  institute_check_list.densu_modgloves,
  institute_check_list.densu_modcups,
  institute_check_list.densu_modapron,
  institute_check_list.densu_modconsumaterial,
  institute_check_list.densu_modprosthetic,
  institute_check_list.densu_modadeqwater,
  institute_check_list.densu_modhygenicdispos,
  institute_check_list.densu_modsysrecords,
  institute_check_list.densu_autoclaves,
  institute_check_list.densu_lightcure,
  institute_check_list.densu_scalars,
  institute_check_list.densu_airrotors,
  institute_check_list.densu_xrayfaci,
  institute_check_list.densu_amalgamators,
  institute_check_list.densu_intracam,
  institute_check_list.densu_refrigerator,
  institute_check_list.densu_storagefaci,
  institute_check_list.densu_excelneedles,
  institute_check_list.densu_excelsiringer,
  institute_check_list.densu_excelmask,
  institute_check_list.densu_excelgloves,
  institute_check_list.densu_excelcups,
  institute_check_list.densu_excelapron,
  institute_check_list.densu_excelrestorative,
  institute_check_list.densu_excelprosthetic,
  institute_check_list.ins_status,
  institute_check_list.ins_is_deleted,
  institute_check_list.ins_company_id,
  institute_check_list.ins_created_by,
  institute_check_list.ins_created_on,
  institute_check_list.ins_last_modified_by,
  institute_check_list.ins_last_modified_on,
  institute_check_list.ins_deleted_by,
  institute_check_list.ins_deleted_on,
  institute_check_list.list_id
  FROM
  institute_check_list
  where institute_check_list.ins_id=$id";
	$result=$db->singleQuery($sql);
	while($row=mysqli_fetch_array($result)){
		
		$response['ins_application_id']=$row['ins_application_id'];
//-----------------------Ambulance service---------------------
    $response['txtambName']=$row['txtambName'];
		$response['txtNoDoctor']=$row['txtNoDoctor'];
		$response['txtNoNurs']=$row['txtNoNurs'];
		$response['txtnoAmbulance']=$row['txtnoAmbulance'];
		$response['txtnoModel']=$row['txtnoModel'];
		$response['txtfacility']=$row['txtfacility'];
		$response['txtequipment']=$row['txtequipment'];
		$response['txtDriverAv']=$row['txtDriverAv'];
		$response['txtRMVreg']=$row['txtRMVreg'];

//--------------------------dental lab---------------------------------------------------------------
    $response['densu_surgeonname']=$row['densu_surgeonname'];
		$response['densu_surgeonreg']=$row['densu_surgeonreg'];
		$response['densu_assisname']=$row['densu_assisname'];
		$response['densu_surgeonfull']=$row['densu_surgeonfull'];
		$response['densu_prachours']=$row['densu_prachours'];
		$response['densu_examBed']=$row['densu_examBed'];
    $response['densu_tableChair']=$row['densu_tableChair'];
    $response['densu_washBasin']=$row['densu_washBasin'];
    $response['densu_weighingscale']=$row['densu_weighingscale'];
    $response['densu_ventilation']=$row['densu_ventilation'];
    $response['densu_needles']=$row['densu_needles'];
    $response['densu_siringer']=$row['densu_siringer'];
    $response['densu_mask']=$row['densu_mask'];
    $response['densu_gloves']=$row['densu_gloves'];
    $response['densu_cups']=$row['densu_cups'];
    $response['densu_apron']=$row['densu_apron'];
    $response['densu_consumaterial']=$row['densu_consumaterial'];
    $response['densu_prosthetic']=$row['densu_prosthetic'];
    $response['densu_adeqwater']=$row['densu_adeqwater'];
    $response['densu_hygenicdispos']=$row['densu_hygenicdispos'];
    $response['densu_sysrecords']=$row['densu_sysrecords'];
    $response['densu_patientwaiting']=$row['densu_patientwaiting'];
    $response['densu_receptionarea']=$row['densu_receptionarea'];
    $response['densu_surgeryarea']=$row['densu_surgeryarea'];
    $response['densu_adeqtoilt']=$row['densu_adeqtoilt'];
    $response['densu_modexamBed']=$row['densu_modexamBed'];
    $response['densu_modtableChair']=$row['dendensu_modtableChair_br'];
    $response['densu_modwashBasin']=$row['densu_modwashBasin'];
    $response['densu_modweighingscale']=$row['densu_modweighingscale'];
    $response['densu_modventilation']=$row['densu_modventilation'];
    $response['densu_modneedles']=$row['densu_modneedles'];
    $response['densu_modsiringer']=$row['densu_modsiringer'];
    $response['densu_modmask']=$row['densu_modmask'];
    $response['densu_modgloves']=$row['densu_modgloves'];
    $response['densu_modcups']=$row['densu_modcups'];
    $response['densu_modapron']=$row['densu_modapron'];
    $response['densu_modconsumaterial']=$row['densu_modconsumaterial'];
    $response['densu_modprosthetic']=$row['densu_modprosthetic'];
    $response['densu_modadeqwater']=$row['densu_modadeqwater'];
    $response['densu_modhygenicdispos']=$row['densu_modhygenicdispos'];
    $response['densu_modsysrecords']=$row['densu_modsysrecords'];
    $response['densu_autoclaves']=$row['densu_autoclaves'];
    $response['densu_lightcure']=$row['densu_lightcure'];
    $response['densu_scalars']=$row['densu_scalars'];
    $response['densu_airrotors']=$row['densu_airrotors'];
    $response['densu_xrayfaci']=$row['densu_xrayfaci'];
    $response['densu_amalgamators']=$row['densu_amalgamators'];
    $response['densu_intracam']=$row['densu_intracam'];
    $response['densu_refrigerator']=$row['densu_refrigerator'];
    $response['densu_storagefaci']=$row['densu_storagefaci'];
    $response['densu_excelneedles']=$row['densu_excelneedles'];
    $response['densu_excelsiringer']=$row['densu_excelsiringer'];
    $response['densu_excelmask']=$row['densu_excelmask'];
    $response['densu_excelgloves']=$row['densu_excelgloves'];
    $response['densu_excelcups']=$row['densu_excelcups'];
    $response['densu_excelapron']=$row['densu_excelapron'];
    $response['densu_excelrestorative']=$row['densu_excelrestorative'];
    $response['densu_excelprosthetic']=$row['densu_excelprosthetic'];

//---------------------------------labotorary---------------------------------------------------
    $response['medl_person']         = $row['medl_person'];
    $response['medl_pathologist']    = $row['medl_pathologist'];
    $response['medi_path_reg']       = $row['medi_path_reg'];
    $response['medi_path_whether']   = $row['medi_path_whether'];
    $response['medi_microbiologist'] = $row['medi_microbiologist'];
    $response['medi_micro_reg']      = $row['medi_micro_reg'];
    $response['medi_micro_whether']  = $row['medi_micro_whether'];
    $response['medi_chem_pathologist']  = $row['medi_chem_pathologist'];
    $response['medi_chem_path_reg']     = $row['medi_chem_path_reg'];
    $response['medi_whether']           = $row['medi_whether'];
    $response['medi_qlity']             = $row['medi_qlity'];
    $response['medi_facility']          = $row['medi_facility'];
    $response['medi_disposal']          = $row['medi_disposal'];
    $response['medi_br']           = $row['medi_br'];

//------------------------Medical Centers----------------------------

    $response['mdc_owner']          = $row['mdc_owner'];
    $response['mdc_nameMediDire']   = $row['mdc_nameMediDire'];
    $response['mdc_mdReg']          = $row['mdc_mdReg'];
    $response['mdc_fultimeDoc']     = $row['mdc_fultimeDoc'];
    $response['mdc_parttimeDoc']    = $row['mdc_parttimeDoc'];
    $response['mdc_nurseinchrge'] = $row['mdc_nurseinchrge'];
    $response['mdc_nurseReg']   = $row['mdc_nurseReg'];
    $response['mdc_nurse']    = $row['mdc_nurse'];
    $response['mdc_businessReg']   = $row['mdc_businessReg'];
    $response['mdc_consultRoom']   = $row['mdc_consultRoom'];
    $response['mdc_checkNursingHome']  = $row['mdc_checkNursingHome'];
    $response['mdc_examBed']  = $row['mdc_examBed'];
    $response['mdc_tableChair']    = $row['mdc_tableChair'];
    $response['mdc_washBasin']  = $row['mdc_washBasin'];
    $response['mdc_weighingscale']   = $row['mdc_weighingscale'];
    $response['mdc_ventilation']  = $row['mdc_ventilation'];
    $response['mdc_sanitaryFac']  = $row['mdc_sanitaryFac'];
    $response['mdc_waventilation']   = $row['mdc_waventilation'];
    $response['mdc_smexamBed']    = $row['mdc_smexamBed'];
    $response['mdc_floorarea']          = $row['mdc_floorarea'];
    $response['mdc_saniFac']  = $row['mdc_saniFac'];
    $response['mdc_scarmChair']   = $row['mdc_scarmChair'];
    $response['mdc_scbed'] = $row['mdc_scbed'];
    $response['mdc_scwasteDisposal']   = $row['mdc_scwasteDisposal'];
    $response['mdc_scToiletFac'] = $row['mdc_scToiletFac'];
    $response['mdc_scadeqIllum']   = $row['mdc_scadeqIllum'];
    $response['mdc_xrayRoom']   = $row['mdc_xrayRoom'];
    $response['mdc_squarArea']  = $row['mdc_squarArea'];
    $response['mdc_room']  = $row['mdc_room'];
    $response['mdc_roomsquare']  = $row['mdc_roomsquare'];
    $response['mdc_armchair']  = $row['mdc_armchair'];
    $response['mdc_eqbeds'] = $row['mdc_eqbeds'];
    $response['mdc_swdis'] = $row['mdc_swdis'];
    $response['mdc_toifac']   = $row['mdc_toifac'];
    $response['mdc_adill'] = $row['mdc_adill'];
    $response['mdc_cssdroom']  = $row['mdc_cssdroom'];
    $response['mdc_cssdsquare']     = $row['mdc_cssdsquare'];
    $response['mdc_numbermedi']      = $row['mdc_numbermedi'];
    $response['mdc_vehitype']       = $row['mdc_vehitype'];
    $response['mdc_numbervehi']        = $row['mdc_numbervehi'];
    $response['mdc_wdis']       = $row['mdc_wdis'];

    //------------------------private hosapital----------------------------

    $response['phos_ownerame']      = $row['phos_ownerame'];
    $response['phos_nameceo']    = $row['phos_nameceo'];
    $response['phos_namemd']     = $row['phos_namemd'];
    $response['phos_mdreg']     = $row['phos_mdreg'];
    $response['phos_numberftdoc']     = $row['phos_numberftdoc'];
    $response['phos_namenursdirect']     = $row['phos_namenursdirect'];
    $response['phos_numbernurse']    = $row['phos_numbernurse'];
    $response['phos_udaappnumber']     = $row['phos_udaappnumber'];
    $response['phos_nursinghomedate']  = $row['phos_nursinghomedate'];
    $response['phos_consltroom']   = $row['phos_consltroom'];
    $response['phos_squareroom']          = $row['phos_squareroom'];
    $response['phos_exambed']          = $row['phos_exambed'];
    $response['phos_tablechair']          = $row['phos_tablechair'];
    $response['phos_washbasin']          = $row['phos_washbasin'];
    $response['phos_weighningscale']     = $row['phos_weighningscale'];
    $response['phos_ventillu']          = $row['phos_ventillu'];
    $response['phos_waitingperson']        = $row['phos_waitingperson'];
    $response['phos_waitingventi']          = $row['phos_waitingventi'];
    $response['phos_sampleexambed']   = $row['phos_sampleexambed'];
    $response['phos_floorarea']  = $row['phos_floorarea'];
    $response['phos_adeqsanit']   = $row['phos_adeqsanit'];
    $response['phos_armchair']   = $row['phos_armchair'];
    $response['phos_bed']          = $row['phos_bed'];
    $response['phos_swdisposal']    = $row['phos_swdisposal'];
    $response['phos_toifac']          = $row['phos_toifac'];
    $response['phos_adeqillu']     = $row['phos_adeqillu'];
    $response['phos_slmcpathologi'] = $row['phos_slmcpathologi'];
    $response['phos_slmcmicroi'] = $row['phos_slmcmicroi'];
    $response['phos_qualitycont']     = $row['phos_qualitycont'];
    $response['phos_xrayRoom']    = $row['phos_xrayRoom'];
    $response['phos_squarArea']   = $row['phos_squarArea'];
    $response['phos_wards']    = $row['phos_wards'];
    $response['phos_singleroom']   = $row['phos_singleroom'];
    $response['phos_doubleroom']          = $row['phos_doubleroom'];
    $response['phos_opt']   = $row['phos_opt'];
    $response['phos_oparmchair']          = $row['phos_oparmchair'];
    $response['phos_opbed']          = $row['phos_opbed'];
    $response['phos_opswdisposal'] = $row['phos_opswdisposal'];
    $response['phos_optoifac']          = $row['phos_optoifac'];
    $response['phos_medium']  = $row['phos_medium'];
    $response['phos_mdarmchair']     = $row['phos_mdarmchair'];
    $response['phos_mdbed']          = $row['phos_mdbed'];
    $response['phos_mdswdisposal']    = $row['phos_mdswdisposal'];
    $response['phos_mdtoifac'] = $row['phos_mdtoifac'];
    $response['phos_scrubingar']   = $row['phos_scrubingar'];
    $response['phos_recovery']    = $row['phos_recovery'];
    $response['phos_cssd']  = $row['phos_cssd'];
    $response['phos_lbroom']      = $row['phos_lbroom'];
    $response['phos_emertrolly']  = $row['phos_emertrolly'];
    $response['phos_spotlamp']  = $row['phos_spotlamp'];
    $response['phos_stethoscope']   = $row['phos_stethoscope'];
    $response['phos_surginstrmnt']  = $row['phos_surginstrmnt'];
    $response['phos_adjtoilet']  = $row['phos_adjtoilet'];
    $response['phos_wastdispos']   = $row['phos_wastdispos'];
    $response['phos_etunit']     = $row['phos_etunit'];
    $response['phos_facilities']  = $row['phos_facilities'];
    $response['phos_laryngoscope']   = $row['phos_laryngoscope'];
    $response['phos_icuunit']   = $row['phos_icuunit'];
    $response['phos_icuarmchair']    = $row['phos_icuarmchair'];
    $response['phos_icubed']    = $row['phos_icubed'];
    $response['phos_icuswdisposal']   = $row['phos_icuswdisposal'];
    $response['phos_icutoifac']  = $row['phos_icutoifac'];
    $response['phos_dsname']   = $row['phos_dsname'];
    $response['phos_dsregno']    = $row['phos_dsregno'];
    $response['phos_dsassistant']     = $row['phos_dsassistant'];
    $response['phos_dswaitingarea']   = $row['phos_dswaitingarea'];
    $response['phos_dssurgeryarea']  = $row['phos_dssurgeryarea'];
    $response['phos_dstoiltfac']    = $row['phos_dstoiltfac'];
    $response['phos_dsarmchair']  = $row['phos_dsarmchair'];
    $response['phos_dsbed'] = $row['phos_dsbed'];
    $response['phos_dsswdisposal']  = $row['phos_dsswdisposal'];
    $response['phos_dstoifac']   = $row['phos_dstoifac'];
    $response['phos_disposable']  = $row['phos_disposable'];
    $response['phos_consumable']   = $row['phos_consumable'];
    $response['phos_drugstorein']   = $row['phos_drugstorein'];
    $response['phos_drugstoreout']   = $row['phos_drugstoreout'];
    $response['phos_ambservices']     = $row['phos_ambservices'];
    $response['phos_pantry']  = $row['phos_pantry'];
    $response['phos_parking']  = $row['phos_parking'];
    $response['phos_wastdis']          = $row['phos_wastdis'];

		}

  echo json_encode($response);
  
}
elseif($requestType=='loadSearchCombo'){
  $sql="SELECT
ins_application_id,
ins_institute_name,
ins_is_deleted
FROM
institute_registration
where ins_is_deleted='0' 
          order by ins_application_id asc";
		  $html = "<option vlaue=\"\"></option>";
	$result=$db->singleQuery($sql);
	while($row=mysqli_fetch_array($result)){
		
		$html .= "<option value=\"".$row['ins_application_id']."\">".$row['ins_institute_name']."</option>";
		
		}
	echo $html;		  
		  
}
elseif($requestType=='loadPartial'){
  try{
    $recordId = $_REQUEST['record_id'];
    $model->emi_id = $recordId;
    $model->emi_company_id = $userCompanyId;
    $model = $model->findModel();
    ob_start();
//    echo "janaka";
    include "./employeeInformationPartialView.php";
    $value = ob_get_clean();
    $response['content'] 	= $value;
    $response['type'] 	= 'pass';
    $response['msg'] 	= 'Saved successfully.';
    
  }catch(Exception $e){
    $response['type'] 	= 'fail';
    $response['msg'] 		= $e->getMessage().$noReference;
    $response['q'] 		= $sql;                
  }
  echo json_encode($response);
}
?>





