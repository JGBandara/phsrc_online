<meta charset="UTF-8">
<title>Pagination table with search option</title>
<!--<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'>-->
<link rel="stylesheet" href="../../../../css/grid_js/style.css">
<style>
    .avatar1-pic {
        width: 350px;
        height: 20px
    }
</style>
</head>
<body>
<!-- partial:index.partial.html -->
<div class="container">
    <div class="header_wrap">
        <div class="num_rows">

            <div class="form-group">    <!--		Show Numbers Of Rows 		-->
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


        <thead>
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

</div> <!-- 		End of Container -->


<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title">Institute Details</h4>
                <button type="button" class="close" id="btnClose" data-dismiss="modal">&times;</button>
            </div>
            <div class="btn-group btn-group-justified">
                <a href="#" class="btn " style="background-color:#099;color:#FFF" id='butBasicInfo'>Institute Basic
                    Information</a>
                <a href="#" class="btn " style="background-color:#099;color:#FFF" id='butStaffInfo'>Staff
                    Information</a>
                <a href="#" class="btn " style="background-color:#099;color:#FFF" id='butInstituteInfo'>Institution
                    Information</a>
                <a href="#" class="btn " style="background-color:#099;color:#FFF" id='butFacilityInfo'>Institute
                    Facilities </a>
                <a href="#" class="btn " style="background-color:#099;color:#FFF" id='butDocInfo'>Institute Document
                    Files </a>
                <a href="#" class="btn " style="background-color:#099;color:#FFF" id='butPaymentInfo'>Payments </a>
            </div>
            <div class="modal-body" style="margin-top:20px">
                <div id="basicInfo">
                    <input type="hidden" id="txtId" name="txtId"/>
                    <div class="form-row">
                        <div class="form-group col-md-3 textMainTxtStyle">Name of the person who is operating or
                            maintaining the institution
                        </div>
                        <div class="form-group col-md-9">:&nbsp;<label class="textStyle" id="lblName"></label></div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-3 textMainTxtStyle">Address(Official)</div>
                        <div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="lblRelationship"></label>
                        </div>
                        <div class="form-group col-md-3 textMainTxtStyle">Address(Private)</div>
                        <div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="lblAddress"></label></div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-3 textMainTxtStyle">The relationship with the institution</div>
                        <div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="lblInsRel"></label></div>
                        <div class="form-group col-md-3 textMainTxtStyle">
                            &nbsp;
                        </div>
                        <div class="form-group col-md-3">&nbsp;<label class="textStyle" id=""></label></div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-3 textMainTxtStyle">Name of the institution</div>
                        <div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="lblInsName"></label></div>
                        <div class="form-group col-md-3 textMainTxtStyle">
                            Institute Address
                        </div>
                        <div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="lblInsAddress"></label>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-3 textMainTxtStyle">Telephone</div>
                        <div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="lblTelephone"></label>
                        </div>
                        <div class="form-group col-md-3 textMainTxtStyle">
                            Email
                        </div>
                        <div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="lblMail"></label></div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-3 textMainTxtStyle">Province</div>
                        <div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="lblProvince"></label></div>
                        <div class="form-group col-md-3 textMainTxtStyle">
                            District
                        </div>
                        <div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="lblDistrict"></label></div>
                    </div>
                </div>
                <!-- ------------------------------------------------------------------------------------------------------------------------------------- -->
                <div id="staffInfo">
                    <div class="form-row">
                        <div class="form-group col-md-12 textMainTxtStyle">The details of the medical staff including
                            Doctors, Consultants engaged in the profession under this institution
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover table-bordered small" id="tblEmpExistingDocuments1"
                                   style="overflow:auto">
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
                        <div class="form-group col-md-3 textMainTxtStyle">Government officer or not (If yes name of the
                            institution and the post held by the officer currently)
                        </div>
                        <div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="textIsGovOfficer"></label>
                        </div>
                        <div class="form-group col-md-3 textMainTxtStyle">
                            Government officer or not (If yes name of the institution and the post held by the officer
                            currently)
                        </div>
                        <div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="textIsname"></label></div>
                    </div>


                    <div class="form-row">
                        <div class="form-group col-md-3 textMainTxtStyle">Hours of practice</div>
                        <div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="textPracHoure"></label>
                        </div>
                    </div>

                </div>
                <!-- ------------------------------------------------------------------------------------------------------------------------------------- -->
                <div id="instituteInfo">
                    <div class="form-row">
                        <div class="form-group col-md-3">Method of record keeping</div>
                        <div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="textRecKeep"></label></div>
                        <div class="form-group col-md-3">
                            Availability of visiting specialists
                        </div>
                        <div class="form-group col-md-3">:&nbsp;<label class="textStyle"
                                                                       id="textVisitSpeciality"></label></div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-3">Dental laboratory facilities</div>
                        <div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="textLabFacility"></label>
                        </div>
                        <div class="form-group col-md-3">
                            X-ray facilities(The number of licence issued by the Atomic Energy Authority)
                        </div>
                        <div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="textXrayFacility"></label>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-3">Emergency kit available or not</div>
                        <div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="textEmargancyKit"></label>
                        </div>
                        <div class="form-group col-md-3">
                            Any other facilities (specify):
                        </div>
                        <div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="textOtherFacility"></label>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-3">Ownership:</div>
                        <div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="textOwnership"></label>
                        </div>
                        <div class="form-group col-md-3">
                            &nbsp;
                        </div>
                        <div class="form-group col-md-3">&nbsp;</div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-3">Practicing as a,</div>
                        <div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="textPracticeType"></label>
                        </div>
                        <div class="form-group col-md-3">
                            If so, what is your speciality?
                        </div>
                        <div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="textSpeciality"></label>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-3">Clinical waste disposal method</div>
                        <div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="textOwnership"></label>
                        </div>
                        <div class="form-group col-md-3">
                            Method of sterilization of instruments & dressings
                        </div>
                        <div class="form-group col-md-3">:&nbsp;<label class="textStyle"
                                                                       id="textInstrumantDressing"></label></div>
                    </div>
                </div>
                <!-- ------------------------------------------------------------------------------------------------------------------------------------- -->
                <div id="facilityInfo">
                    <div class="form-row">
                        <div class="form-group col-md-3">Total no: of inpatient beds</div>
                        <div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="txtNoBed"></label></div>
                        <div class="form-group col-md-3">
                            Total No. of rooms
                        </div>
                        <div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="txtNoRoom"></label></div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-3">Total No. of Wards</div>
                        <div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="txtNoWard"></label></div>
                        <div class="form-group col-md-3">
                            &nbsp;
                        </div>
                        <div class="form-group col-md-3">&nbsp;<label class="textStyle" id="cboAtomicEnergy"></label>
                        </div>
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

                    <!--    <div class="form-row"><div class="form-group col-md-3">License obtained from the Atomic Energy Authority for Radiology Service</div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="cboAtomicEnergy"></label></div><div class="form-group col-md-3">
                     The number of such license </div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="txtNoLicense"></label></div></div>

                     <div class="form-row"><div class="form-group col-md-3">Method of clinical waste disposal</div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="txtclinicalDis"></label></div><div class="form-group col-md-3">
                     Method of sterilization of instruments and dressings</div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="txtInsDress"></label></div></div>

                     <div class="form-row"><div class="form-group col-md-3">Emergency kit</div><div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="cboEmgKit"></label></div><div class="form-group col-md-3">
                             &nbsp; </div><div class="form-group col-md-3">&nbsp;<label class="textStyle" id=""></label></div></div>-->

                </div>
                <!-- ------------------------------------------------------------------------------------------------------------------------------------- -->
                <!-- ------------------------------------------------------------------------------------------------------------------------------------- -->
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
                                        <a href="#" class="action" target="_blank"><span
                                                    class="fas fa-download actionView"></span></a>
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
                            Registration Year
                        </div>
                        <div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="txtYear"></label></div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-3">Registration Fee</div>
                        <div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="txtregAmount"></label>
                        </div>
                        <div class="form-group col-md-3">
                            Stamp Fee
                        </div>
                        <div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="txtStampAmount"></label>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-3">Arrears Amount</div>
                        <div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="txtArras"></label></div>
                        <div class="form-group col-md-3">
                            Payment Amount
                        </div>
                        <div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="txtAmount"></label></div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-3">Paying Branch</div>
                        <div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="txtPaymentBranch"></label>
                        </div>
                        <div class="form-group col-md-3">Payment Date
                            &nbsp;
                        </div>
                        <div class="form-group col-md-3">:&nbsp;<label class="textStyle" id="txtPaymentDate"></label>
                        </div>
                    </div>
                    <br>
                    <div class="form-row">
                        <div class="form-group col-md-3">Bank Slip</div>
                        <div class="form-group col-md-3">:&nbsp;<a style="display:contents" target="_blank" id="slip">View</a>
                        </div>
                        <div class="form-group col-md-3">&nbsp;</div>
                        <div class="form-group col-md-3">&nbsp;</div>
                    </div>

                </div>
                <!-- ------------------------------------------------------------------------------------------------------------------------------------- -->


            </div>
            <div>
                <center><textarea style="width:90%" placeholder="Please enter the reason ..." name="txtRemark"
                                  id="txtRemark"></textarea></center>
            </div>
            <div class="modal-footer">
                <div style=""><b><label id="lblAcction" style="font-size:36px;"></label></b></div>
                <div class="col-md-5">&nbsp;</div>
                <center>
                    <button type="button" class="btn btn-success" id="btnApprove">OK</button>&nbsp;<button type="button"
                                                                                                           class="btn btn-danger"
                                                                                                           id="btnReject">
                        BACK
                    </button>&nbsp;<button type="button" class="btn btn-warning" data-dismiss="modal" id="btnClose">
                        Close
                    </button>
                </center>
            </div>
        </div>

    </div>
</div>
<!--  Developed By Yasser Mas -->
<!-- partial -->
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js'></script>
<script src='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'></script>
<script src="../../../../js/grid_js/script.js"></script>
<script src="list.js"></script>

