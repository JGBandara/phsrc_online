<?php
session_start();
$backwardSeparator = "../../../../";
$thisFilePath =  $_SERVER['PHP_SELF'];
$userId 	= $_SESSION['loginId'];
$userCompanyId = $_SESSION['companyId'];
$uservaccinesId = $_SESSION['vaccinesId'];
//$projectName = substr($_SERVER['PHP_SELF'],0,strpos($_SERVER['PHP_SELF'],'/',1));

require "{$backwardSeparator}autoLoad.php";

include  "{$backwardSeparator}dataAccess/accessController.php";

$searchId = (isset($_REQUEST['id']))?isset($_REQUEST['id']):'';
  
use presentation\system\masterData\classes\cls_sys_status;
use presentation\system\masterData\classes\cls_sys_vaccines;
$modelStatus = new cls_sys_status($db);
//$model = new cls_sys_vaccines($db);
?><!DOCTYPE html>
<html>
<head>
    <title>Monthly Data Collection</title>
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

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        .section-title {
            font-size: 16px;
            font-weight: bold;
            padding: 8px;
            color: white;
        }
        .green { background: #24ABBF; }
        .yellow { background: #FFEB3B; color:black; }
        .blue { background:#03A9F4; }
        .orange { background:#FF9800; }
        table td, table th { vertical-align: middle !important; }
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
            <form class="needs-validation" novalidate id="frmsys_birth_type">
              <div class="card">
                <div class="card-header">
                 Monthly Data Collection
                </div>
                <div class="card-body">
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <select class="form-control form-control-sm" id="cboSearch" name="cboSearch" placeholder="">
                      </select>
                    </div>
                </div>
                </div>
              </div>
              <br/>
    <div class="card mb-3">
        <div class="card-body">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label-sm">Year</label>
                <div class="col-sm-4"><input type="text" id='txtYear' class="form-control form-control-sm"></div>

                <label class="col-sm-2 col-form-label-sm">Month</label>
                <div class="col-sm-4"><input type="text" id='txtMonth' class="form-control form-control-sm"></div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label-sm">Institution</label>
                <div class="col-sm-4"><input type="text" id='txtInstitute' class="form-control form-control-sm"></div>

                <label class="col-sm-2 col-form-label-sm">PHSRC Reg No</label>
                <div class="col-sm-4"><input type="text" id='txtRegNo' class="form-control form-control-sm"></div>
            </div>
        </div>
    </div>

    <!-- SECTION 01: Facility Types -->

<div class="section-title green">Facility Types (Tick / Fill)</div>

<div class="card mb-3">
    <div class="card-body p-2">
        <table class="table table-bordered table-sm align-middle">

            <tr>
                <td>Private Hospitals / Nursing Homes / Maternity Homes</td>
                <td style="width: 40px; text-align:center;">
                    <input type="checkbox" id='txtPv' class="form-check-input facilityTick">
                </td>
            </tr>

            <tr>
                <td>Medical Specialist Practices (Full / Part time)</td>
                <td style="text-align:center;">
                    <input type="checkbox" id='txtMs' class="form-check-input facilityTick">
                </td>
            </tr>

            <tr>
                <td>Private General Practices / Clinics (Full / Part time)</td>
                <td style="text-align:center;">
                    <input type="checkbox" id='txtPg' class="form-check-input facilityTick">
                </td>
            </tr>

            <tr>
                <td>Medical Centres / Screening Centres / Channel Consultation</td>
                <td style="text-align:center;">
                    <input type="checkbox" id='txtMc' class="form-check-input facilityTick">
                </td>
            </tr>

            <tr>
                <td>Private Dental Surgeries (Full / Part time)</td>
                <td style="text-align:center;">
                    <input type="checkbox" id='txtPd' class="form-check-input facilityTick">
                </td>
            </tr>

            <tr>
                <td>Private Ambulance Services</td>
                <td style="text-align:center;">
                    <input type="checkbox" id='txtPa' class="form-check-input facilityTick">
                </td>
            </tr>

            <tr>
                <td>Private Laboratories (Large / Medium / Small)</td>
                <td style="text-align:center;">
                    <input type="checkbox" id='txtPl' class="form-check-input facilityTick">
                </td>
            </tr>

            <tr>
                <td>Other Institutions</td>
                <td style="text-align:center;">
                    <input type="checkbox" id='txtOi' class="form-check-input facilityTick">
                </td>
            </tr>

        </table>
    </div>
</div>


    <!-- SECTION 02: PERFORMANCE -->
    <div class="section-title green">Performance (Type / Total)</div>

    <!-- REUSABLE TABLE COMPONENT -->
    <!-- FUNCTION TO RENDER TABLE BLOCK -->
    <!-- I WILL GENERATE ALL SECTIONS BELOW -->

    <!-- ######################### -->
    <!-- PERFORMANCE SECTION TABLES -->
    <!-- ######################### -->

    <!-- 1. General OPD Visits -->
    <?php /* PHP COMMENTS ALLOWED */ ?>
    <div class="card mb-3">
        <div class="card-header"><b>General OPD Visits</b></div>
        <div class="card-body">
            <table class="table table-bordered table-sm" id="tblOPD">
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Total Count</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
            <button type="button" class="btn btn-sm btn-primary add-row" data-table="tblOPD">+ Add Row</button>
        </div>
    </div>

    <!-- 2. Emergency / ETU Admissions -->
    <div class="card mb-3">
        <div class="card-header"><b>Emergency Care / ETU Admissions</b></div>
        <div class="card-body">
            <table class="table table-bordered table-sm" id="tblETU">
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Total Count</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
            <button type="button" class="btn btn-sm btn-primary add-row" data-table="tblETU">+ Add Row</button>
        </div>
    </div>

    <!-- 3. Chanelled Consultations -->
   

    <!-- 4. Admissions -->
    <div class="card mb-3">
        <div class="card-header"><b>Admissions</b></div>
        <div class="card-body">
            <table class="table table-bordered table-sm" id="tblAdmissions">
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Total Count</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
            <button type="button" class="btn btn-sm btn-primary add-row" data-table="tblAdmissions">+ Add Row</button>
        </div>
    </div>
<div class="section-title green">Performance</div>

<div class="card mb-3">
    <div class="card-body p-2">
        <table class="table table-bordered table-sm align-middle">
            <thead>
                <tr class="table-success">
                    <th style="width: 70%">Activity</th>
                    <th style="width: 30%">Total</th>
                </tr>
            </thead>
            <tbody>
                <tr><td>General OPD Visits</td><td><input type="number" class="form-control form-control-sm" name="opd_visits"></td></tr>
                <tr><td>Emergency Care / ETU Admissions</td><td><input type="number" class="form-control form-control-sm" name="etu_admissions"></td></tr>
               <tr>
                    <td colspan="2">
                      <div class="card mb-3">
                        <div class="card-header"><b>Chanelled Consultations</b></div>
                            <div class="card-body">
                                <table class="table table-bordered table-sm" id="tblChanel">
                                    <thead>
                                        <tr>
                                            <th>Type</th>
                                            <th>Total Count</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                <tbody></tbody>
                                </table>
            <button type="button" class="btn btn-sm btn-primary add-row" data-table="tblChanel">+ Add Row</button>
        </div>
    </div>
                    </td>
                </tr>
                <tr><td>Admissions</td><td><input type="number" class="form-control form-control-sm" name="admissions" id="admissions"></td></tr>
                <tr><td>Live Discharges</td><td><input type="number" class="form-control form-control-sm" name="live_discharges" id="live_discharges"></td></tr>
                <tr><td>Out-Transfers</td><td><input type="number" class="form-control form-control-sm" name="out_transfers" id="out_transfers"></td></tr>
                <tr><td>Deaths</td><td><input type="number" class="form-control form-control-sm" name="deaths" id="deaths"></td></tr>
                <tr><td>ICU Admissions</td><td><input type="number" class="form-control form-control-sm" name="icu_admissions" id="icu_admissions"></td></tr>
                <tr><td>Major Surgeries <span class="text-muted">(Types)</span></td><td><input type="number" class="form-control form-control-sm" name="major_surgeries" id="major_surgeries"></td></tr>
                <tr><td>Minor Surgeries</td><td><input type="number" class="form-control form-control-sm" name="minor_surgeries" id="minor_surgeries"></td></tr>
                <tr><td>OPD Procedures</td><td><input type="number" class="form-control form-control-sm" name="opd_procedures" id="opd_procedures"></td></tr>
                <tr><td>OPD Dressings</td><td><input type="number" class="form-control form-control-sm" name="opd_dressings" id="opd_dressings"></td></tr>
                <tr><td>Notifiable diseases <span class="text-muted">(Type)</span></td><td><input type="number" class="form-control form-control-sm" name="notifiable_diseases" id="notifiable_diseases"></td></tr>
                <tr><td>Vaccines / Immunizations <span class="text-muted">(Type)</span></td><td><input type="number" class="form-control form-control-sm" name="vaccines" id="vaccines"></td></tr>
                <tr><td>Deliveries <span class="text-muted">(Type)</span></td><td><input type="number" class="form-control form-control-sm" name="deliveries" id="deliveries"></td></tr>
                <tr><td>Live Births <span class="text-muted">(Type)</span></td><td><input type="number" class="form-control form-control-sm" name="live_births" id="live_births"></td></tr>
                <tr><td>PBU / SCBU Admissions</td><td><input type="number" class="form-control form-control-sm" name="pbu_scbu_admissions" id="pbu_scbu_admissions"></td></tr>
                <tr><td>Neonatal / Infant Deaths</td><td><input type="number" class="form-control form-control-sm" name="neonatal_infant_deaths" id="neonatal_infant_deaths"></td></tr>
                <tr><td>Maternal Deaths</td><td><input type="number" class="form-control form-control-sm" name="maternal_deaths" id="maternal_deaths"></td></tr>
                <tr><td>Family Planning Events <span class="text-muted">(Type)</span></td><td><input type="number" class="form-control form-control-sm" name="family_planning_events" id="family_planning_events"></td></tr>
                <tr><td>Physiotherapy events</td><td><input type="number" class="form-control form-control-sm" name="physiotherapy_events" id="physiotherapy_events"></td></tr>
                <tr><td>Occupational Therapy events</td><td><input type="number" class="form-control form-control-sm" name="occupational_therapy" id="occupational_therapy"></td></tr>
                <tr><td>Dental Extractions</td><td><input type="number" class="form-control form-control-sm" name="dental_extractions" id="dental_extractions"></td></tr>
                <tr><td>OMF / Dental surgeries</td><td><input type="number" class="form-control form-control-sm" name="omf_dental_surgeries" id="omf_dental_surgeries"></td></tr>
                <tr><td>Blood / products Transfusions</td><td><input type="number" class="form-control form-control-sm" name="blood_transfusions" id="blood_transfusions"></td></tr>
                <tr><td>Laboratory tests <span class="text-muted">(Type)</span></td><td><input type="number" class="form-control form-control-sm" name="laboratory_tests" id="laboratory_tests"></td></tr>
                <tr><td>Radiology tests <span class="text-muted">(Type)</span></td><td><input type="number" class="form-control form-control-sm" name="radiology_tests" id="radiology_tests"></td></tr>
                <tr><td>Angiograms</td><td><input type="number" class="form-control form-control-sm" name="angiograms" id="angiograms"></td></tr>
                <tr><td>Stentings / Primary PCI</td><td><input type="number" class="form-control form-control-sm" name="stentings" id="stentings"></td></tr>
                <tr><td>Incidence of adverse events <span class="text-muted">(Type)</span></td><td><input type="number" class="form-control form-control-sm" name="adverse_events" id="adverse_events"></td></tr>

            </tbody>
        </table>
    </div>
</div>

    <!-- Continue similar blocks for:
    ✔ Live Discharges
    ✔ Out-Transfers
    ✔ Deaths
    ✔ ICU Admissions
    ✔ Major Surgeries
    ✔ Minor Surgeries
    ✔ OPD Procedures
    ✔ OPD Dressings
    ✔ Notifiable Diseases
    ✔ Vaccines
    ✔ Deliveries
    ✔ Radiology Tests
    ✔ Laboratory Tests
    ✔ Family Planning Events
    ✔ Adverse Events
    -->

    <!-- INFRASTRUCTURE SECTION -->
   <div class="section-title yellow">Infrastructure and Digital Technology Facilities</div>

<div class="card mb-3">
    <div class="card-body p-2">
        <table class="table table-bordered table-sm align-middle">
            <thead>
                <tr class="table-warning">
                    <th style="width: 70%">Type</th>
                    <th style="width: 30%">Total</th>
                </tr>
            </thead>
            <tbody>

                <tr>
                    <td>Running Ambulances</td>
                    <td><input type="number" class="form-control form-control-sm" name="running_ambulances" id="running_ambulances"></td>
                </tr>

                <tr>
                    <td>Telemedicine services offered – consultations via telehealth</td>
                    <td><input type="number" class="form-control form-control-sm" name="telemedicine_services" id="telemedicine_services"></td>
                </tr>

                <tr>
                    <td>Electronic Health Records (EHR) generated</td>
                    <td><input type="number" class="form-control form-control-sm" name="ehr_generated" id="ehr_generated"></td>
                </tr>

            </tbody>
        </table>
    </div>
</div>

<div class="section-title blue">Medical equipment / facility availability (sophisticated)</div>

<div class="card mb-3">
    <div class="card-body p-2">
        <table class="table table-bordered table-sm align-middle">
            <thead>
                <tr class="table-primary">
                    <th style="width: 70%">Type</th>
                    <th style="width: 30%">Total</th>
                </tr>
            </thead>
            <tbody>

                <tr>
                    <td>Patient Beds</td>
                    <td><input type="number" class="form-control form-control-sm" name="patient_beds" id="patient_beds"></td>
                </tr>

                <tr>
                    <td>ICU beds</td>
                    <td><input type="number" class="form-control form-control-sm" name="icu_beds" id="icu_beds"></td>
                </tr>

                <tr>
                    <td>OT Tables</td>
                    <td><input type="number" class="form-control form-control-sm" name="ot_tables" id="ot_tables"></td>
                </tr>

                <tr>
                    <td>CT Scanners</td>
                    <td><input type="number" class="form-control form-control-sm" name="ct_scanners" id="ct_scanners"></td>
                </tr>

                <tr>
                    <td>MRI Scanners</td>
                    <td><input type="number" class="form-control form-control-sm" name="mri_scanners" id="mri_scanners"></td>
                </tr>

                <tr>
                    <td>US Scanners</td>
                    <td><input type="number" class="form-control form-control-sm" name="us_scanners" id="us_scanners"></td>
                </tr>

                <tr>
                    <td>Xray Machines</td>
                    <td><input type="number" class="form-control form-control-sm" name="xray_machines" id="xray_machines"></td>
                </tr>

                <tr>
                    <td>Ventilators</td>
                    <td><input type="number" class="form-control form-control-sm" name="ventilators" id="ventilators"></td>
                </tr>

                <tr>
                    <td>Dialysis beds</td>
                    <td><input type="number" class="form-control form-control-sm" name="dialysis_beds" id="dialysis_beds"></td>
                </tr>

                <tr>
                    <td>Dental Chairs</td>
                    <td><input type="number" class="form-control form-control-sm" name="dental_chairs" id="dental_chairs"></td>
                </tr>

            </tbody>
        </table>
    </div>
</div>

<div class="section-title orange">HRH Availability</div>

<div class="card mb-3">
    <div class="card-body p-2">
        <table class="table table-bordered table-sm align-middle">
            <thead>
                <tr class="table-warning">
                    <th style="width: 70%">Type</th>
                    <th style="width: 30%">Total</th>
                </tr>
            </thead>
            <tbody>

                <tr>
                    <td>Medical Consultants (Full-time / Resident)</td>
                    <td><input type="number" class="form-control form-control-sm" name="medical_consultant_ft" id="medical_consultant_ft"></td>
                </tr>

                <tr>
                    <td>Medical Consultants (Visiting)</td>
                    <td><input type="number" class="form-control form-control-sm" name="medical_consultant_visiting" id="medical_consultant_visiting"></td>
                </tr>

                <tr>
                    <td>Medical Officers (Permanent)</td>
                    <td><input type="number" class="form-control form-control-sm" name="medical_officer_permanent" id="medical_officer_permanent"></td>
                </tr>

                <tr>
                    <td>Medical Officers (Locum Basis)</td>
                    <td><input type="number" class="form-control form-control-sm" name="medical_officer_locum" id="medical_officer_locum"></td>
                </tr>

                <tr>
                    <td>SLMC / SLNC Registered Nurses</td>
                    <td><input type="number" class="form-control form-control-sm" name="registered_nurses" id="registered_nurses"></td>
                </tr>

                <tr>
                    <td>PHSRC Listed Nurses</td>
                    <td><input type="number" class="form-control form-control-sm" name="phsrc_nurses" id="phsrc_nurses"></td>
                </tr>

                <tr>
                    <td>Other Nurses / Nurse trainees</td>
                    <td><input type="number" class="form-control form-control-sm" name="other_nurses" id="other_nurses"></td>
                </tr>

                <tr>
                    <td>MLT – Full time / Part time</td>
                    <td><input type="number" class="form-control form-control-sm" name="mlt" id="mlt"></td>
                </tr>

                <tr>
                    <td>Physiotherapist – Full time / Part time</td>
                    <td><input type="number" class="form-control form-control-sm" name="physiotherapist" id="physiotherapist"></td>
                </tr>

                <tr>
                    <td>Other staff</td>
                    <td><input type="number" class="form-control form-control-sm" name="other_staff" id="other_staff"></td>
                </tr>

            </tbody>
        </table>
    </div>
</div>

    <!-- Continue same for ICU beds, OT Tables, MRI, CT, US etc. -->

    <!-- STAFF AVAILABILITY SECTION -->
    <div class="section-title orange mt-4">Staff Availability</div>

    <div class="card mb-3">
        <div class="card-header"><b>Medical Consultants (Full-time / Resident)</b></div>
        <div class="card-body">
            <table class="table table-bordered table-sm" id="tblConsultants">
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Number</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
            <button type="button" class="btn btn-sm btn-primary add-row" data-table="tblConsultants">+ Add Row</button>
        </div>
    </div>

</div>

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script>
// Function: Add Row to Any Table
$(".add-row").click(function () {
    let tbl = $(this).data("table");

    let row =
        `<tr>
            <td>
                <select class="form-control form-control-sm">
                    <option value="">-- Select Type --</option>
                </select>
            </td>
            <td><input type="number" class="form-control form-control-sm"></td>
            <td><button type="button" class="btn btn-sm btn-danger remove-row">Remove</button></td>
        </tr>`;

    $("#" + tbl + " tbody").append(row);
});

// Remove Row
$(document).on("click", ".remove-row", function () {
    $(this).closest("tr").remove();
});
</script>

</body>
</html>
