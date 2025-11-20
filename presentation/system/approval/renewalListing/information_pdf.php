<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Institute Full Details</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .section-title { font-size: 18px; font-weight: bold; margin-top: 25px; color:#0d6efd; }
        table { width:100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border:1px solid #000; padding:6px; }
        th { background:#f1f1f1; font-weight:bold; }
    </style>
</head>
<body>

<center><h2>Institute Registration Details</h2></center>

<!-- BASIC INFORMATION -->
<div class="section-title">Basic Information</div>
<table>
    <tbody>
        <tr><th>Application ID</th><td><?= $row['application_id'] ?></td></tr>
        <tr><th>Registration Number</th><td><?= $row['registration_no'] ?></td></tr>
        <tr><th>Institute Name</th><td><?= $row['institute_name'] ?></td></tr>
        <tr><th>Institute Type</th><td><?= $row['institute_type'] ?></td></tr>
        <tr><th>Category</th><td><?= $row['category'] ?></td></tr>
        <tr><th>Ownership Type</th><td><?= $row['ownership_type'] ?></td></tr>
        <tr><th>Owner Name</th><td><?= $row['owner_name'] ?></td></tr>
        <tr><th>Owner NIC</th><td><?= $row['owner_nic'] ?></td></tr>
        <tr><th>Owner Contact No</th><td><?= $row['owner_phone'] ?></td></tr>
        <tr><th>Owner Email</th><td><?= $row['owner_email'] ?></td></tr>
        <tr><th>Institute Address</th><td><?= $row['institute_address'] ?></td></tr>
        <tr><th>District</th><td><?= $row['district'] ?></td></tr>
        <tr><th>City</th><td><?= $row['city'] ?></td></tr>
        <tr><th>Postal Code</th><td><?= $row['postal_code'] ?></td></tr>
        <tr><th>Contact No 1</th><td><?= $row['contact_1'] ?></td></tr>
        <tr><th>Contact No 2</th><td><?= $row['contact_2'] ?></td></tr>
        <tr><th>Email</th><td><?= $row['email'] ?></td></tr>
        <tr><th>Website</th><td><?= $row['website'] ?></td></tr>
        <tr><th>Medium of Studies</th><td><?= $row['medium'] ?></td></tr>
        <tr><th>Establishment Year</th><td><?= $row['est_year'] ?></td></tr>
        <tr><th>Status</th><td><?= $row['status'] ?></td></tr>
        <tr><th>Created Date</th><td><?= $row['created_date'] ?></td></tr>
        <tr><th>Last Updated</th><td><?= $row['updated_date'] ?></td></tr>
        <tr><th>Remarks</th><td><?= $row['remarks'] ?></td></tr>
    </tbody>
</table>

<!-- STAFF INFORMATION -->
<div class="section-title">Staff Information</div>
<table>
    <thead>
        <tr>
            <th>#</th><th>Name</th><th>Designation</th><th>Qualification</th><th>NIC</th>
            <th>Gender</th><th>DOB</th><th>Contact</th><th>Email</th>
            <th>Type</th><th>Experience</th><th>Appt. Date</th><th>Address</th><th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php $i=1; foreach($staffList as $s){ ?>
        <tr>
            <td><?= $i++ ?></td>
            <td><?= $s['name'] ?></td>
            <td><?= $s['designation'] ?></td>
            <td><?= $s['qualification'] ?></td>
            <td><?= $s['nic'] ?></td>
            <td><?= $s['gender'] ?></td>
            <td><?= $s['dob'] ?></td>
            <td><?= $s['contact'] ?></td>
            <td><?= $s['email'] ?></td>
            <td><?= $s['work_type'] ?></td>
            <td><?= $s['experience'] ?></td>
            <td><?= $s['appointment_date'] ?></td>
            <td><?= $s['address'] ?></td>
            <td><?= $s['status'] ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<!-- FACILITIES -->
<div class="section-title">Facilities</div>
<table>
    <thead>
        <tr>
            <th>#</th><th>Beds</th><th>Rooms</th><th>Wards</th>
            <th>Facility Type</th><th>Value</th><th>Description</th>
        </tr>
    </thead>
    <tbody>
        <?php $i=1; foreach($facilities as $f){ ?>
        <tr>
            <td><?= $i++ ?></td>
            <td><?= $f['beds'] ?></td>
            <td><?= $f['rooms'] ?></td>
            <td><?= $f['wards'] ?></td>
            <td><?= $f['facility_name'] ?></td>
            <td><?= $f['facility_value'] ?></td>
            <td><?= $f['description'] ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<!-- PAYMENT DETAILS -->
<div class="section-title">Payment Details</div>
<table>
    <tbody>
        <tr><th>Payment ID</th><td><?= $payment['payment_id'] ?></td></tr>
        <tr><th>Application ID</th><td><?= $payment['app_id'] ?></td></tr>
        <tr><th>Payment Type</th><td><?= $payment['payment_type'] ?></td></tr>
        <tr><th>Purpose</th><td><?= $payment['purpose'] ?></td></tr>
        <tr><th>Amount</th><td><?= $payment['amount'] ?></td></tr>
        <tr><th>Bank</th><td><?= $payment['bank'] ?></td></tr>
        <tr><th>Branch</th><td><?= $payment['branch'] ?></td></tr>
        <tr><th>Reference No</th><td><?= $payment['ref_no'] ?></td></tr>
        <tr><th>Payment Date</th><td><?= $payment['date'] ?></td></tr>
        <tr><th>Remarks</th><td><?= $payment['remarks'] ?></td></tr>
    </tbody>
</table>

</body>
</html>
