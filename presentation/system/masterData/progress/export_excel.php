<?php
session_start();
$backwardSeparator = "../../../../";
$thisFilePath =  $_SERVER['PHP_SELF'];
$userId = $_SESSION['loginId'];
require "{$backwardSeparator}autoLoad.php";
require_once $backwardSeparator.'dataAccess/connector.php';

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=institute_report_" . date('Y-m-d') . ".xls");
header("Pragma: no-cache");
header("Expires: 0");

// Start table with title
$output = "
<table border='1' cellpadding='5' cellspacing='0' style='border-collapse: collapse; font-family: Arial, sans-serif; width:100%;'>
  <tr>
    <th colspan='6' style='background-color:#333; color:white; font-size:16pt; padding:10px; text-align:center;'>Institute Payment Report</th>
  </tr>
  <tr style='background-color:#4CAF50; color:white; font-weight:bold; text-align:center;'>
    <th>Institute Name</th>
    <th>Registration No</th>
    <th>Category</th>
    <th>Registration Fee (LKR)</th>
    <th>Status</th>
    <th>Date</th>
  </tr>
";

$query = "
  SELECT 
    institute_registration.ins_application_id,   
    institute_registration.ins_type_id,   
    institute_registration.reg_no,   
    DATE(institute_payment_detail.payment_detail_created_on) AS payment_date,   
    institute_payment_detail.payment_type,   
    institute_payment_detail.payment_reg_fee,   
    CASE 
        WHEN institute_payment_detail.payment_is_approval IN (1) THEN 'Recommended By The PDHS'
        WHEN institute_payment_detail.payment_is_approval IN (2, 12, 9) THEN 'Rejected'
        WHEN institute_payment_detail.payment_is_approval IN (10) THEN 'Officer Checked'
        WHEN institute_payment_detail.payment_is_approval IN (11) THEN 'Inspection Officer Checked'
        WHEN institute_payment_detail.payment_is_approval IN (0) THEN 'Pending'
        ELSE 'Unknown'
    END AS payment_is_approval,   
    institute_registration.ins_institute_name,   
    man_institute_main.cat_name   
FROM 
    institute_registration   
INNER JOIN 
    institute_payment_detail 
    ON institute_registration.ins_application_id = institute_payment_detail.payment_detail_institute_id   
INNER JOIN 
    man_institute_main 
    ON institute_registration.ins_type_id = man_institute_main.main_cat_id 
INNER JOIN 
    sys_user_location 
    ON institute_registration.ins_province_id = sys_user_location.syo_location_id
INNER JOIN 
    sys_users 
    ON sys_user_location.syo_user_id = sys_users.syu_id
WHERE sys_users.syu_id='$userId' AND sys_user_location.syo_is_deleted='0'
ORDER BY institute_payment_detail.payment_date DESC
";

$result = $db->singleQuery($query);
$rowCount = 0;
$totalFee = 0;

while($row = mysqli_fetch_array($result)) {
    $rowColor = ($rowCount % 2 == 0) ? '#f9f9f9' : '#ffffff'; // alternating row colors
    $paymentFee = number_format($row['payment_reg_fee'], 2);
    $totalFee += $row['payment_reg_fee'];
    $paymentDate = date('d-m-Y', strtotime($row['payment_date']));

    // Conditional status color
    switch($row['payment_is_approval']) {
        case 'Recommended By The PDHS':
            $statusColor = '#28a745'; // green
            break;
        case 'Rejected':
            $statusColor = '#dc3545'; // red
            break;
        case 'Pending':
            $statusColor = '#fd7e14'; // orange
            break;
        case 'Officer Checked':
        case 'Inspection Officer Checked':
            $statusColor = '#007bff'; // blue
            break;
        default:
            $statusColor = '#6c757d'; // gray
    }

    $output .= "
    <tr style='background-color:{$rowColor}; text-align:center;'>
        <td style='text-align:left;'>{$row['ins_institute_name']}</td>
        <td>{$row['reg_no']}</td>
        <td>{$row['cat_name']}</td>
        <td style='text-align:right;'>{$paymentFee}</td>
        <td style='color:white; background-color:{$statusColor}; font-weight:bold;'>{$row['payment_is_approval']}</td>
        <td>{$paymentDate}</td>
    </tr>
    ";
    $rowCount++;
}

// Footer with total fees
$output .= "
<tr style='font-weight:bold; background-color:#333; color:white;'>
    <td colspan='3' style='text-align:right;'>Total Fees:</td>
    <td style='text-align:right;'>" . number_format($totalFee, 2) . "</td>
    <td colspan='2'></td>
</tr>
";

$output .= "</table>";

echo $output;
exit;
?>
