<?php
// Start session safely
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if data received
if (!isset($_POST['excelData'])) {
    echo "No data received for Excel export";
    exit;
}

$excelData = json_decode($_POST['excelData'], true);

// Force browser to download as Excel
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Filtered_Report.xls");
header("Pragma: no-cache");
header("Expires: 0");

// Start Excel table structure
echo "<table border='1' cellpadding='5' cellspacing='0' style='border-collapse: collapse; font-family: Arial, sans-serif;'>";
echo "<tr>
        <th colspan='6' style='background-color:#333; color:white; font-size:16pt; text-align:center; padding:10px;'>Institute Payment Report</th>
      </tr>";

// Table headers
echo "<tr>
        <th style='background-color:#4CAF50; color:white; font-weight:bold; text-align:center;'>Institute Name</th>
        <th style='background-color:#4CAF50; color:white; font-weight:bold; text-align:center;'>Reg Type</th>
        <th style='background-color:#4CAF50; color:white; font-weight:bold; text-align:center;'>Category</th>
        <th style='background-color:#4CAF50; color:white; font-weight:bold; text-align:center;'>Date</th>
        <th style='background-color:#4CAF50; color:white; font-weight:bold; text-align:center;'>Registration Fee (LKR)</th>
        <th style='background-color:#4CAF50; color:white; font-weight:bold; text-align:center;'>Status</th>
      </tr>";

// Initialize total
$totalFee = 0;

if (!empty($excelData)) {
    $rowCount = 0;
    foreach ($excelData as $row) {
        $rowColor = ($rowCount % 2 === 0) ? '#f9f9f9' : '#ffffff'; // Alternating row colors
        $regFee = is_numeric($row[4]) ? number_format($row[4], 2) : $row[3];
        $totalFee += is_numeric($row[4]) ? $row[4] : 0;

        // Status colors
        $statusColor = '#6c757d'; // default grey
        switch(strtolower($row[5])) {
            case 'approved':
            case 'recommended by the pdhs':
                $statusColor = '#28a745'; // green
                break;
            case 'rejected':
                $statusColor = '#dc3545'; // red
                break;
            case 'pending':
                $statusColor = '#fd7e14'; // orange
                break;
            case 'checked':
            case 'inspection officer checked':
                $statusColor = '#007bff'; // blue
                break;
        }

        echo "<tr style='background-color:{$rowColor}; text-align:center;'>
                <td style='text-align:left;'>{$row[0]}</td>
                <td>{$row[1]}</td>
                <td>{$row[2]}</td>
                <td style='text-align:right;'>{$row[3]}</td>
                <td>{$regFee}</td>
                <td style='color:white; background-color:{$statusColor}; font-weight:bold;'>{$row[5]}</td>
              </tr>";
        $rowCount++;
    }

    // Total row
    echo "<tr >
            <td  style='font-weight:bold; background-color:#333; color:white; text-align:right;' colspan='4'>Total Fees:</td>
            <td style='font-weight:bold; background-color:#333; color:white; text-align:right;'>".number_format($totalFee, 2)."</td>
            <td  style='font-weight:bold; background-color:#333; color:white; text-align:right;'></td>
          </tr>";
}
// Provincial fee 50%
$provincialFee = $totalFee * 0.50;



// Provincial 50% fee row
echo "<tr>
        <td style='font-weight:bold; background-color:#555; color:white; text-align:right;' colspan='4'>Provincial Fees (50%):</td>
        <td style='font-weight:bold; background-color:#555; color:white; text-align:right;'>".number_format($provincialFee, 2)."</td>
        <td style='font-weight:bold; background-color:#555; color:white; text-align:right;'></td>
      </tr>";



echo "</table>";
exit;
?>
