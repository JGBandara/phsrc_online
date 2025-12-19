<meta charset="UTF-8">
<title>Pagination table with search option</title>
<!--<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'>-->
<link rel="stylesheet" href="../../../css/grid_js/style.css">
<style>
  .avatar1-pic {
    width: 350px;
    height: 20px
  }

  .profilImg {
    width: 250px;
    height: 20px
  }

</style>
<style>
  .modal-dialog {
    width: 95%;
    max-width: 1200px;
    margin: 20px auto;
  }

  .modal-content {
    height: 90vh;
    overflow: hidden; /* prevent the footer from moving */
    display: flex;
    flex-direction: column;
  }

  .modal-body {
    flex: 1 1 auto;
    overflow-y: auto;
    max-height: none; /* remove previous max height */
  }

  .modal-footer {
    flex-shrink: 0;
    height: 60px; /* fixed footer height */
    padding: 10px 15px;
    background: #f9f9f9;
    border-top: 1px solid #ddd;
  }
 @media print {
  body * {
    visibility: hidden;
  }

  .modal-content, .modal-content * {
    visibility: visible;
  }

  .modal-content {
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: auto;
    overflow: visible;
  }

  .modal-footer, .btn, select, textarea {
    display: none !important; /* Hide controls during print */
  }

  .modal-body {
    overflow: visible !important;
    height: auto !important;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
  }

  th, td {
    border: 1px solid #999;
    padding: 6px;
    font-size: 13px;
  }

  h4.modal-title {
    text-align: center;
    font-size: 20px;
    margin-bottom: 20px;
  }

  /* Ensure multi-page printing */
  .form-group, table, .card {
    page-break-inside: avoid;
  }

  .modal-dialog {
    width: 100% !important;
    max-width: none !important;
    margin: 0 !important;
  }
}


</style>
<style>
#printArea {
    font-size: 10px;
    line-height: 1.2;
    font-family: Arial, sans-serif;
}

#printArea table {
    width: 100%;
    border-collapse: collapse;
}

#printArea th, #printArea td {
    border: 1px solid #555;
    padding: 4px;
    text-align: left;
}

#printArea th {
    background:#333;
    color:#fff;
}

h2 {
    font-size: 14px;
}
</style>

</head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>


<script>
  $(document).ready(function () {
    $('#btnPrint').click(function () {
      // Show all hidden sections before printing
      $('#basicInfo, #staffInfo, #instituteInfo, #facilityInfo, #documentList, #paymentInfo, #checkList').show();

      // Print the full modal content
      window.print();
    });
  });
</script>


<body>
  <!-- partial:index.partial.html -->
  <div class="container">
    <div class="header_wrap">
      <div class="num_rows">

        <div class="form-group"> <!--		Show Numbers Of Rows 		-->
          <select class="form-control" name="state" id="maxRows">


            <option value="10">10</option>
            <option value="15">15</option>
            <option value="20">20</option>
            <option value="50">50</option>
            <option value="70">70</option>
            <option value="100">100</option>
            <option value="5000">Show ALL Rows</option>
          </select>

        </div>
      </div>
      <div class="tb_search">
        <input type="text" id="search_input_all" onKeyUp="FilterkeyWord_all_table()" placeholder="Search.."
          class="form-control">
      </div>
    </div>
    <table class="table table-striped table-class" id="table-id">


      <thead class="bg-gradient-dark">
        <tr>
          <th>Institute Reg No</th>
          <th>Institute Name</th>
          <th>Category</th>
          <th>Date</th>
          <th>Action</th>
        </tr>
      </thead>


    </table>
    <!--		Start Pagination -->
    <div class='pagination-container'>
      <nav>
        <ul class="pagination">
          <!--	Here the JS Function Will Add the Rows -->
        </ul>
      </nav>
    </div>
    <div class="rows_count">Showing 11 to 20 of 91 entries</div>
  </div> 
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">

          <h4 class="modal-title">Institute Details</h4>
          <button type="button" class="close" id="btnClose" data-dismiss="modal">&times;</button>
        </div>
        <div class="btn-group btn-group-justified">
          <a href="#" class="btn " style="background-color:#099;color:#FFF" id='butBasicInfo'>Basic Information</a>
          <a href="#" class="btn " style="background-color:#099;color:#FFF" id='butStaffInfo'>Staff Information</a>
          <a href="#" class="btn " style="background-color:#099;color:#FFF" id='butInstituteInfo'>Institution Information</a>
          <a href="#" class="btn " style="background-color:#099;color:#FFF" id='butFacilityInfo'>Facilities </a>
          <a href="#" class="btn " style="background-color:#099;color:#FFF" id='butDocInfo'>Documents </a>
          <a href="#" class="btn " style="background-color:#099;color:#FFF" id='butPaymentInfo'>Payments </a>
          <!-- <a href="#" class="btn " style="background-color:#099;color:#FFF" id='butCheckInfo'>Check List</a> -->
        </div>
        <div class="modal-body" style="margin-top:20px">
          <div id="basicInfo">
            <input type="hidden" id="txtId" name="txtId" />
            <div class="form-row">
              <div class="form-group col-md-3 textMainTxtStyle"><i class="fa fa-user-circle" aria-hidden="true" style="color:#F00"></i>
                &nbsp;Name of the person who is operating or maintaining the institution</div>
              <div class="form-group col-md-9">:&nbsp;<label class="textStyle" id="lblName"></label></div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-3 textMainTxtStyle"><i class="fa fa-window-minimize" aria-hidden="true" style="color:#6C6"></i>
                &nbsp;The relationship with the institution </div>
              <div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="lblRelationship"></label></div>
              <div class="form-group col-md-3 textMainTxtStyle"><i class="fa fa-address-book" aria-hidden="true" style="color:#090"></i>

                &nbsp;Address</div>
              <div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="lblAddress"></label></div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-3 textMainTxtStyle"><i class="fa fa-address-card" aria-hidden="true" style="color:#FC0"></i>&nbsp;
                Name of the institution</div>
              <div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="lblInsName"></label></div>
              <div class="form-group col-md-3 textMainTxtStyle">
                <i class="fa fa-telegram" aria-hidden="true" style="color:#F63"></i>
                &nbsp;Institute Address
              </div>
              <div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="lblInsAddress"></label></div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-3 textMainTxtStyle">Telephone</div>
              <div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="lblTelephone"></label></div>
              <div class="form-group col-md-3 textMainTxtStyle">
                Mobile Number </div>
              <div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="lblMobile"></label></div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-3 textMainTxtStyle">Web site</div>
              <div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="lblWeb"></label></div>
              <div class="form-group col-md-3 textMainTxtStyle">
                Province </div>
              <div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="lblProvince"></label></div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-3 textMainTxtStyle">E-mail</div>
              <div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="lblMail"></label></div>
              <div class="form-group col-md-3 textMainTxtStyle">
                District </div>
              <div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="lblDistrict"></label></div>
            </div>
          </div>
          <!-- ------------------------------------------------------------------------------------------------------------------------------------- -->
          <div id="staffInfo">
            <div class="form-row">
              <div class="form-group col-md-12 textMainTxtStyle">The details of the medical staff including Doctors, Consultants engaged in the profession under this institution</div>
            </div>

            <div class="card">
              <div class="card-body">
                <table class="table table-hover table-bordered small" id="tblEmpExistingDocuments1" style="overflow:auto">
                  <thead class="">
                    <tr>
                      <th style="width: 20%;">Name</th>
                      <th style="width: 20%;">Qualifications</th>
                      <th style="width: 12%;">Institute</th>
                      <th style="width: 12%;">Country</th>
                      <th style="width: 12%;">PostGraduate</th>
                      <th style="width: 12%;">Speciality</th>
                      <th style="width: 12%;">SLMC No</th>
                    </tr>
                  </thead>

                </table>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-12 textMainTxtStyle">Managment Information</div>
            </div>

            <div class="card">
              <div class="card-body">
                <table class="table table-hover table-bordered small" id="tblstaffManagemnt">
                  <thead class="">
                    <tr>
                      <th style="width: 20%;">Position</th>
                      <th style="width: 25%;">Name</th>
                      <th style="width: 25%;">Contact detail</th>
                      <th style="width: 20%;">Other Information</th>
                    </tr>
                  </thead>

                </table>
              </div>
            </div>


            <div class="form-row">
              <div class="form-group col-md-3 textMainTxtStyle">Government officer or not (If yes name of the institution and the post held by the officer currently)</div>
              <div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="textIsGovOfficer"></label></div>
              <div class="form-group col-md-3 textMainTxtStyle">
                Government officer or not (If yes name of the institution and the post held by the officer currently)</div>
              <div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="textIsname"></label></div>
            </div>


            <div class="form-row">
              <div class="form-group col-md-3 textMainTxtStyle">Hours of practice</div>
              <div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="textPracHoure"></label></div>
            </div>

          </div>
          <!-- ------------------------------------------------------------------------------------------------------------------------------------- -->
          <div id="instituteInfo">
            <div class="form-row">
              <div class="form-group col-md-3">Date of Establishment</div>
              <div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="txtEstDate"></label></div>
              <div class="form-group col-md-3">
                Company/ Business registration no </div>
              <div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="txtBR"></label></div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-3">BOI registration</div>
              <div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="txtBOI"></label></div>
              <div class="form-group col-md-3">
                &nbsp; </div>
              <div class="form-group col-md-3">&nbsp;</div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-3">Type of the institution</div>
              <div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="txtInsType"></label></div>
              <div class="form-group col-md-3">
                Ownership status </div>
              <div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="txtOwnerShip"></label></div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-3">Institute/Owner Profile</div>
              <div class="form-group col-md-3">:&nbsp;<div class="profilDiv"></div>
              </div>
              <div class="form-group col-md-3">
                &nbsp; </div>
              <div class="form-group col-md-3" style="display:none" id="regNo">&nbsp;</div>
            </div>
          </div>
           <div id="facilityInfo">
            <div class="form-row">
              <!-- <div class="form-group col-md-3">Total no: of inpatient beds</div>
              <div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="txtNoBed"></label></div> -->
              <div class="form-group col-md-3">
                Total No. of rooms </div>
              <div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="txtNoRoom"></label></div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-3">Total No. of Wards</div>
              <div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="txtNoWard"></label></div>
              <div class="form-group col-md-3">
                &nbsp; </div>
              <div class="form-group col-md-3">&nbsp;<label class="textStyle" id="cboAtomicEnergy"></label></div>
            </div>



            <div class="form-row">
              <div class="form-group col-md-12">
                <div class="card">
                  <div class="card-body">
                    <table class="table table-hover table-bordered small" id="tblinsFacility">
                      <thead class="">
                        <tr>
                          <th style="width: 30%;">Facility</th>
                          <th style="width: 30%;">Value</th>
                          <th style="width: 40%;">Description</th>

                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>
              </div>
            </div>
        </div>
          <div id="documentList">
            <div class="card">
              <div class="card-body">
                <table class="table table-hover table-bordered small" id="tblEmpExistingDocuments">
                  <thead class="">
                    <tr>
                      <th>Action</th>
                      <th style="width: 20%;">Category</th>
                      <th style="width: 25%;">Name</th>
                      <th style="width: 25%;">Reference No</th>
                      <th style="width: 20%;">version</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="cloneRow" style="display: none;">
                      <td align='center' class="p-1">
                        <a href="#" class="action" target="_blank"><span class="fas fa-download actionView"></span></a>
                      </td>
                      <td class="category p-1"></td>
                      <td class="name p-1"></td>
                      <td class="reference p-1"></td>
                      <td class="version p-1"></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- ------------------------------------------------------------------------------------------------------------------------------------- -->
          <!-- ------------------------------------------------------------------------------------------------------------------------------------- -->
          <div id="paymentInfo">
            <div class="form-row">
              <div class="form-group col-md-3">Payment Type</div>
              <div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="cboPayType"></label></div>
              <div class="form-group col-md-3">
                Registration Year </div>
              <div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="txtYear"></label></div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-3">Registration Fee</div>
              <div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="txtregAmount"></label></div>
              <div class="form-group col-md-3">
                Stamp Fee</div>
              <div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="txtStampAmount"></label></div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-3">Board Payment</div>
              <div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="txtArras"></label></div>
              <div class="form-group col-md-3">
                Payment Amount</div>
              <div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="txtAmount"></label></div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-3">Paying Branch</div>
              <div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="txtPaymentBranch"></label></div>
              <div class="form-group col-md-3">Payment Date
                &nbsp;</div>
              <div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="txtPaymentDate"></label></div>
            </div>
            <br>

            <div class="form-row">
              <div class="form-group col-md-3">Bank Slip</div>
              <div class="form-group col-md-3">:&nbsp;<a style="display:contents" target="_blank" id="slip">View</a></div>
              <div class="form-group col-md-3">&nbsp;</div>
              <div class="form-group col-md-3">&nbsp;</div>
            </div>

          </div>
          <div id="checkList">
         
          </div>
<!--          

        </div>
        <div class="form-row">
          <div class="form-group col-md-3">&nbsp;Inspection Officer
          </div>
          <div class="form-group col-md-3">
            <center><select class="form-control form-control-sm" id="cboInspection" name="cboInspection">
                <?php

                $sql = "SELECT syu_id,syu_full_name FROM sys_users s JOIN sys_user_location l ON s.syu_id=l.syo_user_id WHERE syu_designation_id=6 AND l.syo_location_id=$userLocationId";

                $result = $db->singleQuery($sql);
                while ($row = mysqli_fetch_array($result)) {

                  echo "<option value=\"" . $row['syu_id'] . "\">" . $row['syu_full_name'] . "</option>";
                }
                ?>
              </select></center>
          </div>
        </div>
        <div><center><textarea style="width:90%" placeholder="Please enter the reason for the rejection.." name="txtRemark" id="txtRemark" readonly></textarea></center></div>
        <div class="modal-footer">

          <div style=""><b><label id="lblAcction" style="font-size:36px;"></label></b></div>
          <div class="col-md-5">&nbsp;</div>
          <center><button type="button" class="btn btn-success btnApprove" id="btnApprove">Approve</button>&nbsp;<button type="button" class="btn btn-danger" id="btnReject">Reject</button>&nbsp;<button type="button" class="btn btn-warning" data-dismiss="modal" id="btnClose">Close</button></center>
        </div>
      </div>

    </div>
  </div> -->
  <!-- Existing footer area -->
<div class="modal-footer-container">
  <div class="footer-inputs">
    <div class="form-row">
      <div class="form-group col-md-3">&nbsp;Inspection Officer</div>
      <div class="form-group col-md-3">
        <center>
          <select class="form-control form-control-sm" id="cboInspection" name="cboInspection">
            <?php
            $sql = "SELECT syu_id, syu_full_name FROM sys_users s 
                    JOIN sys_user_location l ON s.syu_id=l.syo_user_id 
                    WHERE syu_designation_id=6 AND l.syo_location_id=$userLocationId";
            $result = $db->singleQuery($sql);
            while ($row = mysqli_fetch_array($result)) {
              echo "<option value=\"" . $row['syu_id'] . "\">" . $row['syu_full_name'] . "</option>";
            }
            ?>
          </select>
        </center>
      </div>
    </div>
    <div>
      <center>
        <textarea style="width:90%" placeholder="Please enter the reason for the rejection.." name="txtRemark" id="txtRemark" ></textarea>
      </center>
    </div>
  </div>

  <div class="modal-footer">
    <div><b><label id="lblAcction" style="font-size:36px;"></label></b></div>
    <div class="col-md-5">&nbsp;</div>
    <center>
      <button type="button" class="btn btn-success btnApprove" id="btnApprove">Approve</button>
      &nbsp;
      <button type="button" class="btn btn-danger" id="btnReject">Reject</button>
      &nbsp;
      <button type="button" class="btn btn-primary" id="btnPrint">Print</button>
      &nbsp;
      <button type="button" class="btn btn-warning" data-dismiss="modal" id="btnClose">Close</button>
      &nbsp;&nbsp;
      <button id="btnDownloadPDF" class="btn btn-primary"> <i class="fa fa-file-pdf"></i> Download PDF
</button>
    </center>
  </div>
</div>
<script>
$("#btnDownloadPDF").click(function () {
    var sections = [
        { id: "basicInfo", title: "Basic Information" },
        { id: "staffInfo", title: "Staff Information" },
        { id: "instituteInfo", title: "Institute Information" },
        { id: "facilityInfo", title: "Facilities Information" },
        { id: "paymentInfo", title: "Payment Information" },
        { id: "documentList", title: "Documents" }
    ];

    var pdfContent = $("<div></div>");

    pdfContent.append("<style>" +
        "body { font-family: Arial, sans-serif; font-size: 10px; line-height:1.2; }" +
        "h1 { font-size: 14px; margin-bottom: 5px; text-align:center; }" +
        "h2 { color: #0d6efd; font-size: 12px; margin-top: 15px; margin-bottom:5px; }" +
        "table { width: 100%; border-collapse: collapse; margin-bottom: 10px; }" +
        "th, td { border: 1px solid #555; padding: 4px; text-align: left; font-size:10px; }" +
        "th { background-color: #343a40; color: #fff; }" +
        "</style>");

    var regNo = $("#regNo").text() || "-";
    var instituteName = $("#lblInsName").text() || "-";
    pdfContent.append("<h1>Registration No: " + regNo + " | Institute Name: " + instituteName + "</h1>");

    sections.forEach(function(section) {
        var sec = $("#" + section.id);
        var wasHidden = sec.css("display") === "none";
        if (wasHidden) sec.show();

        var clonedSec = sec.clone();

        if (section.id === "paymentInfo") {
            clonedSec.find("table tr").each(function() {
                $(this).find("th:last-child, td:last-child").remove();
            });
        }

        pdfContent.append("<h2>" + section.title + "</h2>");
        pdfContent.append(clonedSec);

        if (wasHidden) sec.hide();
    });

    var opt = {
        margin:       10,
        filename:     'Institute_Details.pdf',
        image:        { type: 'jpeg', quality: 0.98 },
        html2canvas:  { scale: 2, useCORS: true },
        jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
    };

    html2pdf().set(opt).from(pdfContent[0]).save();
});

</script>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script>
<script src='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'></script>
 <script src="<?php echo $backwardSeparator;?>js/dms.js"></script>
<script  src="../../../../js/grid_js/script.js"></script>
<script  src="list.js"></script>