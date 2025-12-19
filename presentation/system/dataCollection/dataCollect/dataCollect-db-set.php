<?php
session_start();

$backwardSeparator = "../../../../../";
require "{$backwardSeparator}autoLoad.php";
include "{$backwardSeparator}dataAccess/serverAccessController.php";

$response = [];

$requestType = $_REQUEST['requestType'];
$id          = isset($_REQUEST['cboSearch']) ? $_REQUEST['cboSearch'] : null;

// ===============================
// HEADER FIELDS
// ===============================
$code        = isset($_REQUEST['txtCode']) ? trim($_REQUEST['txtCode']) : null;
$name        = isset($_REQUEST['txtName']) ? trim($_REQUEST['txtName']) : null;
$description = isset($_REQUEST['txtDescription']) ? trim($_REQUEST['txtDescription']) : null;
$status      = isset($_REQUEST['cboStatus']) ? trim($_REQUEST['cboStatus']) : null;

$companyId   = $_SESSION['companyId'];
$userId      = $_SESSION['loginId'];

// ===============================
// DETAIL ARRAYS
// ===============================
$opdType   = isset($_POST['opd']['type']) ? $_POST['opd']['type'] : [];
$opdTotal  = isset($_POST['opd']['total']) ? $_POST['opd']['total'] : [];

$etuType   = isset($_POST['etu']['type']) ? $_POST['etu']['type'] : [];
$etuTotal  = isset($_POST['etu']['total']) ? $_POST['etu']['total'] : [];

// ===============================
// FACILITY ARRAY
// ===============================
$facilityArr = isset($_POST['facility']) ? $_POST['facility'] : [];

try {

  $db->begin();

  // ==================================================
  // ADD
  // ==================================================
  if ($requestType == 'add') {

    if (!$intAddx) {
      throw new Exception("Permission Denied");
    }

    $sql = "
      INSERT INTO dc_monthly_data_header
      (dc_code, dc_name, dc_description, dc_status,
       dc_company_id, dc_created_by, dc_created_on)
      VALUES
      ('$code','$name','$description','$status',
       '$companyId','$userId',NOW())
    ";

    if (!$db->batchQuery($sql)) {
      throw new Exception($db->errormsg);
    }

    $entryId = $db->insertId;
  }

  // ==================================================
  // EDIT
  // ==================================================
  elseif ($requestType == 'edit') {

    if (!$intEditx) {
      throw new Exception("Permission Denied");
    }

    $entryId = $id;

    $sql = "
      UPDATE dc_monthly_data_header SET
        dc_code='$code',
        dc_name='$name',
        dc_description='$description',
        dc_status='$status',
        dc_last_modified_by='$userId',
        dc_last_modified_on=NOW()
      WHERE dc_id='$entryId'
      AND dc_company_id='$companyId'
    ";

    if (!$db->batchQuery($sql)) {
      throw new Exception($db->errormsg);
    }

    // CLEAN OLD DETAILS
    $db->batchQuery("DELETE FROM dc_monthly_data_opd WHERE dco_header_id='$entryId'");
    $db->batchQuery("DELETE FROM dc_monthly_data_etu WHERE dce_header_id='$entryId'");
  }

  // ==================================================
  // DELETE
  // ==================================================
  elseif ($requestType == 'delete') {

    if (!$intDeletex) {
      throw new Exception("Permission Denied");
    }

    $entryId = $id;

    $sql = "
      UPDATE dc_monthly_data_header SET
        dc_is_deleted=1,
        dc_deleted_by='$userId',
        dc_deleted_on=NOW()
      WHERE dc_id='$entryId'
      AND dc_company_id='$companyId'
    ";

    if (!$db->batchQuery($sql)) {
      throw new Exception($db->errormsg);
    }

    $db->commit();

    $response = [
      'type' => 'pass',
      'msg'  => 'Deleted Successfully',
      'id'   => $entryId
    ];

    echo json_encode($response);
    exit;
  }

  // ==================================================
  // OPD DETAILS
  // ==================================================
  for ($i = 0; $i < count($opdType); $i++) {
    if ($opdType[$i] == '') continue;

    $db->batchQuery("
      INSERT INTO dc_monthly_data_opd
      (dco_header_id, dco_type, dco_total, dco_company_id)
      VALUES
      ('$entryId','{$opdType[$i]}','{$opdTotal[$i]}','$companyId')
    ");
  }

  // ==================================================
  // ETU DETAILS
  // ==================================================
  for ($i = 0; $i < count($etuType); $i++) {
    if ($etuType[$i] == '') continue;

    $db->batchQuery("
      INSERT INTO dc_monthly_data_etu
      (dce_header_id, dce_type, dce_total, dce_company_id)
      VALUES
      ('$entryId','{$etuType[$i]}','{$etuTotal[$i]}','$companyId')
    ");
  }

  // ==================================================
  // FACILITY SAVE + AUDIT
  // ==================================================
  foreach ($facilityArr as $facCode => $newVal) {

    $chkSql = "
      SELECT dcf_is_available
      FROM dc_monthly_data_facility
      WHERE dcf_header_id='$entryId'
      AND dcf_fac_code='$facCode'
      AND dcf_company_id='$companyId'
    ";

    $rs = $db->batchQuery($chkSql);

    if ($row = mysqli_fetch_assoc($rs)) {

      if ($row['dcf_is_available'] != $newVal) {

        // AUDIT
        $db->batchQuery("
          INSERT INTO dc_facility_audit
          (dfa_header_id, dfa_fac_code, dfa_old_value, dfa_new_value,
           dfa_action, dfa_changed_on, dfa_changed_by)
          VALUES
          ('$entryId','$facCode','{$row['dcf_is_available']}',
           '$newVal','EDIT',NOW(),'$userId')
        ");

        // UPDATE
        $db->batchQuery("
          UPDATE dc_monthly_data_facility SET
            dcf_is_available='$newVal',
            dcf_modified_on=NOW(),
            dcf_modified_by='$userId'
          WHERE dcf_header_id='$entryId'
          AND dcf_fac_code='$facCode'
        ");
      }

    } else {

      // INSERT
      $db->batchQuery("
        INSERT INTO dc_monthly_data_facility
        (dcf_header_id, dcf_fac_code, dcf_is_available,
         dcf_company_id, dcf_created_on, dcf_created_by)
        VALUES
        ('$entryId','$facCode','$newVal',
         '$companyId',NOW(),'$userId')
      ");

      // AUDIT
      $db->batchQuery("
        INSERT INTO dc_facility_audit
        (dfa_header_id, dfa_fac_code, dfa_old_value, dfa_new_value,
         dfa_action, dfa_changed_on, dfa_changed_by)
        VALUES
        ('$entryId','$facCode','0','$newVal',
         'ADD',NOW(),'$userId')
      ");
    }
  }

  $db->commit();

  $response = [
    'type' => 'pass',
    'msg'  => 'Saved Successfully',
    'id'   => $entryId
  ];

} catch (Exception $e) {

  $db->rollback();

  $response = [
    'type' => 'fail',
    'msg'  => $e->getMessage()
  ];
}

echo json_encode($response);
?>
