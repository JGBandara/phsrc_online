<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Institute Details</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        .section-title {
            font-size: 20px;
            font-weight: bold;
            margin-top: 30px;
            color: #0d6efd;
        }
        th { background: #f1f1f1; }
        table { margin-bottom: 30px; }
    </style>
</head>
<body>

<div class="container mt-4">

    <!-- ================= BASIC INFORMATION ================= -->
    <div class="section-title"><i class="fa fa-info-circle"></i> Basic Information</div>
    <table class="table table-bordered">
        <tbody>
              <tr>
            <th style="width:30%">Application ID</th>
            <td id="appId"></td>
        </tr>
        <tr>
            <th>Registration Number</th>
            <td id="regNo"></td>
        </tr>
        <tr>
            <th>Institute Name</th>
            <td id="instName"></td>
        </tr>
        <tr>
            <th>Institute Type</th>
            <td id="instType"></td>
        </tr>
        <tr>
            <th>Category</th>
            <td id="instCategory"></td>
        </tr>
        <tr>
            <th>Ownership Type</th>
            <td id="ownershipType"></td>
        </tr>
        <tr>
            <th>Owner Name</th>
            <td id="ownerName"></td>
        </tr>
        <tr>
            <th>Owner NIC</th>
            <td id="ownerNic"></td>
        </tr>
        <tr>
            <th>Owner Contact No</th>
            <td id="ownerPhone"></td>
        </tr>
        <tr>
            <th>Owner Email</th>
            <td id="ownerEmail"></td>
        </tr>
        <tr>
            <th>Institute Address</th>
            <td id="instAddress"></td>
        </tr>
        <tr>
            <th>District</th>
            <td id="instDistrict"></td>
        </tr>
        <tr>
            <th>City</th>
            <td id="instCity"></td>
        </tr>
        <tr>
            <th>Postal Code</th>
            <td id="instPostal"></td>
        </tr>
        <tr>
            <th>Contact Number 1</th>
            <td id="instPhone1"></td>
        </tr>
        <tr>
            <th>Contact Number 2</th>
            <td id="instPhone2"></td>
        </tr>
        <tr>
            <th>Email</th>
            <td id="instEmail"></td>
        </tr>
        <tr>
            <th>Website</th>
            <td id="instWebsite"></td>
        </tr>
        <tr>
            <th>Medium of Studies</th>
            <td id="medium"></td>
        </tr>
        <tr>
            <th>Establishment Year</th>
            <td id="establishedYear"></td>
        </tr>
        <tr>
            <th>Institute Status</th>
            <td id="instStatus"></td>
        </tr>
        <tr>
            <th>Created Date</th>
            <td id="createdDate"></td>
        </tr>
        <tr>
            <th>Last Updated</th>
            <td id="updatedDate"></td>
        </tr>
        <tr>
            <th>Remarks</th>
            <td id="remarks"></td>
        </tr>
        </tbody>
    </table>
    <!-- ================= STAFF INFORMATION ================= -->
<div class="section-title"><i class="fa fa-users"></i> Staff Information</div>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th style="width:5%">#</th>
            <th style="width:15%">Staff Name</th>
            <th style="width:12%">Designation</th>
            <th style="width:12%">Qualification</th>
            <th style="width:12%">NIC</th>
            <th style="width:10%">Gender</th>
            <th style="width:10%">DOB</th>
            <th style="width:10%">Contact No</th>
            <th style="width:15%">Email</th>
            <th style="width:10%">Working Type</th>
            <th style="width:10%">Experience (Years)</th>
            <th style="width:10%">Appointment Date</th>
            <th style="width:15%">Permanent Address</th>
            <th style="width:10%">Status</th>
        </tr>
    </thead>
    <tbody id="staffDetails">
       
    </tbody>
</table>

    <!-- ================= INSTITUTE INFORMATION ================= -->
<div class="section-title"><i class="fa fa-university"></i> Institute Details</div>

<table class="table table-bordered">
    <tbody>
        <tr>
            <th style="width:30%">Institute Type</th>
            <td id="insType"></td>
        </tr>
        <tr>
            <th>Institute Category</th>
            <td id="insCategory"></td>
        </tr>
        <tr>
            <th>Institute Ownership</th>
            <td id="ownershipType"></td>
        </tr>
        <tr>
            <th>Owner Name</th>
            <td id="ownerName"></td>
        </tr>
        <tr>
            <th>Owner Address</th>
            <td id="ownerAddress"></td>
        </tr>
        <tr>
            <th>Owner Mobile No</th>
            <td id="ownerMobile"></td>
        </tr>
        <tr>
            <th>Owner Email</th>
            <td id="ownerEmail"></td>
        </tr>
        <tr>
            <th>Institute Phone</th>
            <td id="insPhone"></td>
        </tr>
        <tr>
            <th>Institute Email</th>
            <td id="insEmail"></td>
        </tr>
        <tr>
            <th>Institute Website</th>
            <td id="insWebsite"></td>
        </tr>
        <tr>
            <th>Institute Address (Physical)</th>
            <td id="insAddress"></td>
        </tr>
        
        <tr>
            <th>Institute Status</th>
            <td id="insStatus"></td>
        </tr>
        <tr>
            <th>Remarks / Notes</th>
            <td id="insRemarks"></td>
        </tr>
    </tbody>
</table>

   <!-- ================= FACILITIES INFORMATION ================= -->
<div class="section-title"><i class="fa fa-building"></i> Facilities</div>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th style="width:5%">#</th>
            <th style="width:15%">Total no: of inpatient beds</th>
            <th style="width:12%">Total no: of rooms</th>
            <th style="width:12%">Total no: of wards</th>
            <th style="width:18%">Facility Type / Name</th>
            <th style="width:14%">value</th>
            <th style="width:14%">Description</th>
        </tr>
    </thead>
    <tbody id="facilityDetails">
     
    </tbody>
</table>

    <!-- ================= PAYMENT DETAILS ================= -->
<div class="section-title"><i class="fa fa-credit-card"></i> Payment Details</div>

<table class="table table-bordered">
    <tbody>
        <tr>
            <th style="width:30%">Payment ID</th>
            <td id="paymentId"></td>
        </tr>
        <tr>
            <th>Application ID</th>
            <td id="paymentAppId"></td>
        </tr>
        <tr>
            <th>Payment Type</th>
            <td id="paymentType"></td>
        </tr>
        <tr>
            <th>Purpose / Description</th>
            <td id="paymentPurpose"></td>
        </tr>
        <tr>
            <th>Payment Amount</th>
            <td id="paymentAmount"></td>
        </tr>
        <tr>
            <th>Bank</th>
            <td id="bankName"></td>
        </tr>
        <tr>
            <th>Branch</th>
            <td id="bankBranch"></td>
        </tr>
        <tr>
            <th>Reference No / Slip No</th>
            <td id="refNo"></td>
        </tr>
        <tr>
            <th>Payment Date</th>
            <td id="paymentDate"></td>
        </tr>
        <tr>
            <th>Payment Slip</th>
            <td id="paymentSlip">
                <!-- sample clickable link -->
                <!-- <a href="#" target="_blank" class="btn btn-sm btn-primary">View Slip</a> -->
            </td>
        </tr>
        <tr>
            <th>Remarks</th>
            <td id="paymentRemarks"></td>
        </tr>
    </tbody>
</table>

</div>
</body>
</html>
