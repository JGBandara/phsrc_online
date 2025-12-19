<?php
session_start();

$backwardSeparator = "../../../../../";
require "{$backwardSeparator}autoLoad.php";
include "{$backwardSeparator}dataAccess/serverAccessController.php";

$response = [];

$requestType = isset($_REQUEST['requestType']) ? $_REQUEST['requestType'] : '';
$id          = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';

$userId      = $_SESSION['loginId'];
$userCompanyId = $_SESSION['companyId'];
$userRoleId  = $_SESSION['roleId']; // IMPORTANT for role-based facilities

// ==================================================
// LOAD SEARCH COMBO
// ==================================================
if ($requestType == 'loadSearchCombo') {

  $sql = "
    SELECT dc_id, dc_code
    FROM dc_monthly_data_header
    WHERE dc_company_id='$userCompanyId'
    AND dc_is_deleted=0
    ORDER BY dc_code
  ";

  $rs = $db->batchQuery($sql);

  echo "<option value=''>-- Select --</option>";
  while ($row = mysqli_fetch_assoc($rs)) {
    echo "<option value='{$row['dc_id']}'>{$row['dc_code']}</option>";
  }
  exit;
}

// ==================================================
// LOAD HEADER + DETAILS + FACILITIES
// ==================================================
if ($requestType == 'loadDetails') {

  // ---------------- HEADER ----------------
  $sql = "
    SELECT
      dc_id,
      dc_code,
      dc_name,
      dc_description,
      dc_status
    FROM dc_monthly_data_header
    WHERE dc_id='$id'
    AND dc_company_id='$userCompanyId'
    AND dc_is_deleted=0
  ";

  $rs = $db->batchQuery($sql);
  if (!$header = mysqli_fetch_assoc($rs)) {
    echo json_encode(['type'=>'fail','msg'=>'Record not found']);
    exit;
  }

  $response = $header;

  // ---------------- OPD DETAILS ----------------
  $sql = "
    SELECT dco_type, dco_total
    FROM dc_monthly_data_opd
    WHERE dco_header_id='$id'
    AND dco_company_id='$userCompanyId'
  ";
  $rs = $db->batchQuery($sql);

  $opd = [];
  while ($row = mysqli_fetch_assoc($rs)) {
    $opd[] = $row;
  }
  $response['opd'] = $opd;

  // ---------------- ETU DETAILS ----------------
  $sql = "
    SELECT dce_type, dce_total
    FROM dc_monthly_data_etu
    WHERE dce_header_id='$id'
    AND dce_company_id='$userCompanyId'
  ";
  $rs = $db->batchQuery($sql);

  $etu = [];
  while ($row = mysqli_fetch_assoc($rs)) {
    $etu[] = $row;
  }
  $response['etu'] = $etu;

  // ---------------- FACILITIES (MASTER + ROLE) ----------------
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

  $rs = $db->batchQuery($sql);

  $facilities = [];
  while ($row = mysqli_fetch_assoc($rs)) {
    $facilities[] = $row;
  }

  $response['facilities'] = $facilities;

  echo json_encode($response);
  exit;
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

  $rs = $db->batchQuery($sql);

  $data = [];
  while ($row = mysqli_fetch_assoc($rs)) {
    $data[] = $row;
  }

  echo json_encode($data);
  exit;
}
?>
