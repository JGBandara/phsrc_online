<?php
session_start();

$backwardSeparator = "../../../../";
$thisFilePath =  $_SERVER['PHP_SELF'];
$userId 	= $_SESSION['loginId'];
$userCompanyId = $_SESSION['companyId'];
$userLocationId = $_SESSION['locationId'];

require "{$backwardSeparator}autoLoad.php";
require_once $backwardSeparator.'dataAccess/connector.php';

$requestType 	= $_REQUEST['requestType'];

if ($requestType === 'loadSearchCombo') {

 $sql = "SELECT dc_id, reg_no 
    FROM dc_monthly_data_header
    left join institute_registration on dc_reg_id=ins_application_id
    WHERE dc_company_id='$userCompanyId'
      AND dc_is_deleted=0
    ORDER BY dc_id
  ";

	$html = "<option vlaue=\"\"></option>";
	$result=$db->singleQuery($sql);
	while($row=mysqli_fetch_array($result)){
		
		$html .= "<option value=\"".$row['dc_id']."\">".$row['reg_no']."</option>";
		
		}
	echo $html;	
}

if ($requestType == 'loadInstiituteName') {
  $id = $_REQUEST['id'];
  $sql = "SELECT ins_application_id, reg_no, ins_institute_name
    FROM institute_registration
    WHERE ins_application_id='$id'
  ";
  $result=$db->singleQuery($sql);
	while($row=mysqli_fetch_array($result)){
    $response['institute_name'][]=$row['ins_institute_name'];
  }
  echo json_encode($response);
}

if ($requestType =='loadInstituteRegNo') {

    $year  = $_REQUEST['year'];
    $month = $_REQUEST['month'];

    $sql = "
        SELECT ir.ins_application_id, ir.reg_no
        FROM institute_registration ir
        WHERE ir.ins_application_id NOT IN (
            SELECT dmh.dc_reg_id
            FROM dc_monthly_data_header dmh
            WHERE dmh.dc_is_deleted = 0
              AND dmh.dc_year = '$year'
              AND dmh.dc_month = '$month'
        )
        ORDER BY ir.reg_no ASC
    ";

	$html = "<option value=\"\"></option>";
	$result=$db->singleQuery($sql);
	while($row=mysqli_fetch_array($result)){
		
		$html .= "<option value=\"".$row['ins_application_id']."\">".$row['reg_no']."</option>";
		
		}
	echo $html;	
		}


if ($requestType == 'loadDetails') {
$id = $_REQUEST['id'];
$reg_id = $_REQUEST['reg_no'];
  $sql = "SELECT
      dc_id,
      dc_reg_id,
      dc_name,
      reg_no,
      dc_year,
      dc_month
    FROM dc_monthly_data_header
    left join institute_registration on dc_reg_id=ins_application_id
    WHERE dc_id='$id'
    AND dc_company_id='$userCompanyId'
    AND dc_is_deleted=0
  ";

  $result=$db->singleQuery($sql);
	while($row=mysqli_fetch_array($result)){

    $response['year'][]=$row['dc_year'];
    $response['name'][]=$row['dc_name'];
    $response['reg_no'][]=$row['reg_no'];
    $response['month'][]=$row['dc_month'];
  }

  $sql="SELECT dcf_id,dcf_header_id,dcf_is_available,dcf_fac_code
        FROM dc_monthly_data_facility
        WHERE dcf_header_id='$reg_id'
        AND dcf_company_id='$userCompanyId'";

$result=$db->singleQuery($sql);
  while($row=mysqli_fetch_array($result)){
    $response['dcf_fac_code'][]=$row['dcf_fac_code'];
    $response['dcf_is_available'][]=$row['dcf_is_available'];
  }
 
  // $sql = "
  //   SELECT dco_type, dco_total
  //   FROM dc_monthly_data_opd
  //   WHERE dco_header_id='$id'
  //   AND dco_company_id='$userCompanyId'
  // ";
  // $result=$db->singleQuery($sql);
	// while($row=mysqli_fetch_array($result)){
  //   $response['dco_type'][]=$row['dco_type'];
  //   $response['dco_total'][]=$row['dco_total'];
  // } 

  // $sql = "
  //   SELECT dce_type, dce_total
  //   FROM dc_monthly_data_etu
  //   WHERE dce_header_id='$id'
  //   AND dce_company_id='$userCompanyId'
  // ";

  // $result=$db->singleQuery($sql);
  // while($row=mysqli_fetch_array($result)){
  //   $response['dce_type'][]=$row['dce_type'];
  //   $response['dce_total'][]=$row['dce_total'];
  // }

  // // ---------------- FACILITIES (MASTER + ROLE) ----------------
  // $sql = "
  //   SELECT
  //     f.fac_code,
  //     f.fac_name,
  //     IFNULL(df.dcf_is_available,0) AS is_checked
  //   FROM mst_facility f
  //   INNER JOIN role_facility_permission rfp
  //     ON rfp.rfp_fac_code = f.fac_code
  //     AND rfp.rfp_role_id = '$userRoleId'
  //     AND rfp.rfp_can_view = 1
  //   LEFT JOIN dc_monthly_data_facility df
  //     ON df.dcf_fac_code = f.fac_code
  //     AND df.dcf_header_id = '$id'
  //     AND df.dcf_company_id = '$userCompanyId'
  //   WHERE f.fac_is_active=1
  //   AND f.fac_module='DATA_COLLECTION'
  //   AND f.fac_company_id='$userCompanyId'
  // ";

	// $result=$db->singleQuery($sql);
	// while($row=mysqli_fetch_array($result)){
  //   $response['fac_code'][]=$row['fac_code'];
  //   $response['fac_name'][]=$row['fac_name'];
  //   $response['is_checked'][]=$row['is_checked'];
  // }

  echo json_encode($response);
}

// ==================================================
// LOAD FACILITY UI ONLY (AJAX)
// ==================================================
if ($requestType == 'loadFacilities') {

  $sql = "
    SELECT
      f.fac_code,
      f.fac_name,
      IFNULL(df.dcf_is_available,0) AS is_checked
    FROM mst_facility f
    INNER JOIN role_facility_permission rfp
      ON rfp.rfp_fac_code = f.fac_code
      AND rfp.rfp_role_id = '$userRoleId'
      AND rfp.rfp_can_view = 1
    LEFT JOIN dc_monthly_data_facility df
      ON df.dcf_fac_code = f.fac_code
      AND df.dcf_header_id = '$id'
      AND df.dcf_company_id = '$userCompanyId'
    WHERE f.fac_is_active=1
    AND f.fac_module='DATA_COLLECTION'
    AND f.fac_company_id='$userCompanyId'
  ";
	$result=$db->singleQuery($sql);
	while($row=mysqli_fetch_array($result)){
    $response['fac_code'][]=$row['fac_code'];
    $response['fac_name'][]=$row['fac_name'];
    $response['is_checked'][]=$row['is_checked'];
  }

  echo json_encode($response);
}

if($requestType == 'loadChanneledType'){

  $sql = "SELECT chn_id,chn_code, chn_name FROM chn_mst_consultation WHERE chn_status=1 AND chn_company_id='$userCompanyId'";
	$html = "<option value=\"\"></option>";
	$result=$db->singleQuery($sql);
	while($row=mysqli_fetch_array($result)){

		$html .= "<option value=\"".$row['chn_id']."\">".$row['chn_code']." - ".$row['chn_name']."</option>";

		}
	echo $html;	
		}

  //   if($requestType == 'loadSurgeriesType'){
  // $sql = "SELECT srgy_id,srgy_code, srgy_name FROM srgy_mst_surgery WHERE srgy_status=1 AND srgy_company_id='$userCompanyId'";
  // $html = "<option value=\"\"></option>";

  if($requestType == 'loadDiseasesType'){
    $sql = "SELECT dc_id,dc_code, dc_name FROM dc_mst_diseases WHERE dc_status=1 AND dc_company_id='$userCompanyId'";
    $html = "<option value=\"\"></option>";
    $result=$db->singleQuery($sql);
    while($row=mysqli_fetch_array($result)){

      $html .= "<option value=\"".$row['dc_id']."\">".$row['dc_code']." - ".$row['dc_name']."</option>";

      }
    echo $html;	
  }

  if($requestType == 'loadVaccinesType'){
    $sql = "SELECT vc_id,vc_code, vc_name FROM vc_mst_vaccines WHERE vc_status=1 AND vc_company_id='$userCompanyId'";
    $html = "<option value=\"\"></option>";
    $result=$db->singleQuery($sql);
    while($row=mysqli_fetch_array($result)){

      $html .= "<option value=\"".$row['vc_id']."\">".$row['vc_code']." - ".$row['vc_name']."</option>";

      }
    echo $html;	
  }

  if($requestType == 'loadDeliveryType'){
    $sql = "SELECT dl_id,dl_code, dl_name FROM dl_mst_deliveries WHERE dl_status=1 AND dl_company_id='$userCompanyId'";
    $html = "<option value=\"\"></option>";
    $result=$db->singleQuery($sql);
    while($row=mysqli_fetch_array($result)){

      $html .= "<option value=\"".$row['dl_id']."\">".$row['dl_code']." - ".$row['dl_name']."</option>";

      }
    echo $html;	
  }

  if($requestType == 'loadLiveBirthsType'){
    $sql = "SELECT bt_id,bt_code, bt_name FROM bt_mst_birth_type WHERE bt_status=1 AND bt_company_id='$userCompanyId'";
    $html = "<option value=\"\"></option>";
    $result=$db->singleQuery($sql);
    while($row=mysqli_fetch_array($result)){

      $html .= "<option value=\"".$row['bt_id']."\">".$row['bt_code']." - ".$row['bt_name']."</option>";

      }
    echo $html;	
  }

  if($requestType == 'loadFamilyPlanningType'){
    $sql = "SELECT fp_id,fp_code, fp_name FROM fp_mst_method WHERE fp_status=1 AND fp_company_id='$userCompanyId'";
    $html = "<option value=\"\"></option>";
    $result=$db->singleQuery($sql);
    while($row=mysqli_fetch_array($result)){

      $html .= "<option value=\"".$row['fp_id']."\">".$row['fp_code']." - ".$row['fp_name']."</option>";

      }
    echo $html;	
  }
  if($requestType == 'loadLaboratoryTestsType'){
    $sql = "SELECT lt_id,lt_code, lt_name FROM lt_mst_tests WHERE lt_status=1 AND lt_company_id='$userCompanyId'";
    $html = "<option value=\"\"></option>";
    $result=$db->singleQuery($sql);
    while($row=mysqli_fetch_array($result)){

      $html .= "<option value=\"".$row['lt_id']."\">".$row['lt_code']." - ".$row['lt_name']."</option>";

      }
    echo $html;	
  }
  if($requestType == 'loadRadiologyTestsType'){
    $sql = "SELECT rd_id,rd_code, rd_name FROM rd_mst_radiology WHERE rd_status=1 AND rd_company_id='$userCompanyId'";
    $html = "<option value=\"\"></option>";
    $result=$db->singleQuery($sql);
    while($row=mysqli_fetch_array($result)){

      $html .= "<option value=\"".$row['rd_id']."\">".$row['rd_code']." - ".$row['rd_name']."</option>";

      }
    echo $html;	
  }
  // if($requestType == 'loadAdverseEventsType'){
  //   $sql = "SELECT ae_id,ae_code, ae_name FROM ae_mst_adverse_events WHERE ae_status=1 AND ae_company_id='$userCompanyId'";
  //   $html = "<option value=\"\"></option>";
  //   $result=$db->singleQuery($sql);
  //   while($row=mysqli_fetch_array($result)){

  //     $html .= "<option value=\"".$row['ae_id']."\">".$row['ae_code']." - ".$row['ae_name']."</option>";

  //     }
  //   echo $html;	
  // }
?>