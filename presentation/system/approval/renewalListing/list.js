// JavaScript Document
$(document).ready(function () {
    $('#staffInfo,#instituteInfo,#facilityInfo,#documentList,#paymentInfo,#checkList').hide();

    load_detail();
function load_detail() {
    $("#table-id tbody").remove(); // remove old rows
    $.ajax({
        url: "list-db-get.php",
        dataType: 'json',
        data: 'requestType=loadDetails',
        async: false,
        success: function(json) {
            var $id = json.id;
            var $regNo = json.regNo;
            var $name = json.ownerName;
            var $payType = json.paymentType;
            var $cat_name = json.cat_name;
            var $regAmount = json.regAmount;
            var $date = json.crDate;
            var $approveStatus = json.approveStatus;

            $('#table-id').append("<tbody></tbody>");

            for (var i = 0; i < $id.length; i++) {
                var rowColor = "";
                var approveText = "";

                if ($approveStatus[i] === "Approved") {
                    rowColor = "background-color: rgba(33, 99, 47, 1); color: white;";
                    approveText = "Recommended By The PDHS";
                } else if ($approveStatus[i] === "Rejected") {
                    rowColor = "background-color: rgba(173, 10, 26, 1); color: white;";
                    approveText = "Rejected";
                } else if ($approveStatus[i] === "Checked") {
                    rowColor = "background-color: rgba(216, 166, 15, 1); color: black;";
                    approveText = "Officer Checked";
                } else if ($approveStatus[i] === "Recommended") {
                    rowColor = "background-color: rgba(33, 137, 153, 1); color: white;";
                    approveText = "Inspection Officer Checked";
                } else {
                    approveText = "Pending";
                }

                $('#table-id tbody').append("<tr style='" + rowColor + "'>" +
                    "<td>" + $name[i] + "</td>" +
                    "<td>" + $regNo[i] + "</td>" +
                    "<td>" + $payType[i] + "</td>" +
                    "<td>" + $cat_name[i] + "</td>" +
                    "<td>" + $regAmount[i] + "</td>" +
                    "<td>" + $date[i] + "</td>" +
                    "<td>" + approveText + "</td>" +
                    "<td><center><button type='button' class='btn btn-success btn-md' data-toggle='modal' data-target='#myModal' id='" + $id[i] + "'>View</button></center></td>" +
                    "</tr>");
            }

            var totalRows = $id.length;
            var rowsPerPage = 10; 
            var currentPage = 1; 
            var start = (currentPage - 1) * rowsPerPage + 1;
            var end = currentPage * rowsPerPage;

            $('.rows_count').text("Showing " + start + " to " + end + " of " + totalRows + " entries");
        }
    });
}23



    $('#butBasicInfo').click(function () {
        $('#basicInfo').show();
        $('#staffInfo,#instituteInfo,#facilityInfo,#documentList,#paymentInfo,#checkList').hide();
    })
    $('#butStaffInfo').click(function () {
        $('#staffInfo').show();
        $('#basicInfo,#instituteInfo,#facilityInfo,#documentList,#paymentInfo,#checkList').hide();
    })
    $('#butInstituteInfo').click(function () {
        $('#instituteInfo').show();
        $('#basicInfo,#staffInfo,#facilityInfo,#documentList,#paymentInfo,#checkList').hide();
    })
    $('#butFacilityInfo').click(function () {
        $('#facilityInfo').show();
        $('#basicInfo,#staffInfo,#instituteInfo,#documentList,#paymentInfo,#checkList').hide();
    })
    $('#butDocInfo').click(function () {
        $('#documentList').show();
        $('#basicInfo,#staffInfo,#instituteInfo,#facilityInfo,#paymentInfo,#checkList').hide();
    })
    $('#butPaymentInfo').click(function () {

        $('#paymentInfo').show();
        $('#basicInfo,#staffInfo,#instituteInfo,#facilityInfo,#documentList,#checkList').hide();
    });

    $('#butCheckInfo').click(function () {

        var id = $('#txtId').val();
        window.location.href = "../system/approval/checkList/basicInformation/basicInformation.php?id=" + id;
//	$('#checkList').show();
//	$('#basicInfo,#staffInfo,#instituteInfo,#facilityInfo,#documentList,#paymentInfo').hide();	
    })


    $('.btn').click(function () {

        var id = this.id;


        var url = "list-db-get.php";
        var httpobj = $.ajax({
            url: url,
            dataType: 'json',
            data: 'requestType=loadInstituteDetail&id=' + id,
            async: false,
            success: function (json) {

                if (json) {

                    $('#txtId').val(json.aId);
                    $('#lblName').text(json.ownerName);
                    $('#lblRelationship').text(json.relationsip);
                    $('#lblAddress').text(json.owAddress);
                    $('#lblInsName').text(json.insName);
                    $('#lblInsAddress').text(json.insAddress);
                    $('#lblTelephone').text(json.ins_telephone);
                    $('#lblMobile').text(json.ins_mobile);
                    $('#lblWeb').text(json.ins_website);
                    $('#lblMail').text(json.ins_email);
                    $('#lblProvince').text(json.province);
                    $('#lblDistrict').text(json.district);

                    //-----------------------------------------------------------------------
                    //$('#textSLMC').text('2000');
                    $('#textIsGovOfficer').text(json.st_info_is_gov_officer);
                    $('#textIsname').text(json.st_info_gov_ins_name);
                    $('#textPracHoure').text(json.st_info_hours_of_practice);
                    //-----------------------------------------------------------------------
                    $('#txtEstDate').text(json.stDate);
                    $('#txtBR').text(json.brNo);
                    $('#textBoi').text(json.boiReg);
                    $('#txtInsType').text(json.ins_type);
                    $('#txtOwnerShip').text(json.ownership);
                    $('#regNo').text(json.reg_no);
                    //-------------------------------------------------------------------------
                    $('#textRecKeep').text('Manual');
                    $('#textVisitSpeciality').text('Yes');
                    $('#textLabFacility').text('Yes');
                    $('#textXrayFacility').text(json.x_ray_facility);
                    $('#textEmargancyKit').text(json.em_kit_availability);
                    $('#textOtherFacility').text(json.other_facility);
                    $('#textOwnership').text(json.ownership);
                    $('#textPracticeType').text(json.prac_type);
                    $('#textSpeciality').text(json.speciality_info);
                    $('#textOwnership').text(json.disposal_method);
                    $('#textInstrumantDressing').text(json.instrument_dressings);
                    //-----------------------------------------------------------------------
                    $('#textAmount').text(json.payAmont);
                    $('#textPayDate').text(json.payDate);
                    $('#textBranch').text(json.payBranch);
                    $('#textPayType').text(json.payType);
                    var imageName = json.payImageName;

                    $('.avatar1-pic').attr('href', '../../../img/BankSlip/' + imageName);


                    //-----------------------------------------------------------------------
                    //----------------------------- Staff Information -----------------------
                    if (json.detailVal1 != null) {
                        $("#tblEmpExistingDocuments1").find("tr:gt(0)").remove();
                        for (var j = 0; j <= json.detailVal1.length - 1; j++) {
                            $Name = json.detailVal1[j].Name;
                            $Qulification = json.detailVal1[j].Qulification;
                            $institute = json.detailVal1[j].institute;
                            $country = json.detailVal1[j].country;
                            $post_gradu = json.detailVal1[j].post_gradu;
                            $speciality = json.detailVal1[j].speciality;
                            $Register_id = json.detailVal1[j].Register_id;

                            $('#tblEmpExistingDocuments1').append("<tbody><tr><td align='center' class='p-1'>" + $Name + "</td><td class='p-1'>" + $Qulification + "</td><td class='p-1'>" + $institute + "</td><td class='p-1'>" + $country + "</td><td class='p-1'>" + $post_gradu + "</td><td class='p-1'>" + $speciality + "</td><td class='p-1'>" + $Register_id + "</td></tr></tbody>");


                        }
                    } else {
                        $("#tblEmpExistingDocuments1").find("tr:gt(0)").remove();
                    }
                    //----------------------- Staff Management ------------------------------
                    if (json.detailVal1 != null) {
                        $("#tblstaffManagemnt").find("tr:gt(0)").remove();
                        for (var j = 0; j <= json.detailVal2.length - 1; j++) {
                            $position = json.detailVal2[j].position;
                            $name = json.detailVal2[j].name;
                            $contact = json.detailVal2[j].contact;
                            $info = json.detailVal2[j].info;

                            $('#tblstaffManagemnt').append("<tbody><tr><td align='center' class='p-1'>" + $position + "</td><td class='p-1'>" + $name + "</td><td class='p-1'>" + $contact + "</td><td class='p-1'>" + $info + "</td></tr></tbody>");


                        }
                    } else {
                        $("#tblstaffManagemnt").find("tr:gt(0)").remove();
                    }
                    //-------------------------------Institute information--------------------

                    var insProf = json.ins_profile;
                    //$('#insProf').attr('href','../../../drive/insProfile/'+insProf);
                    if (insProf == "" || insProf == null) {
                        $('.profilDiv').html('<p>No Profile Picture</p>');
                    } else {
                        $('.profilDiv').html('<img class="profilImg" src="../../../drive/insProfile/' + insProf + '"/>');
                    }


                    $('#txtEstDate').text(json.stDate);
                    $('#txtBR').text(json.brNo);
                    $('#txtBOI').text(json.boiReg);
                    if (json.is_pvt_hospital == 1)
                        $('#checkPvtHs').prop('checked', true);
                    else
                        $('#checkPvtHs').removeAttr('checked');

                    if (json.is_nursing_home == 1)
                        $('#checkNursingHome').prop('checked', true);
                    else
                        $('#checkNursingHome').removeAttr('checked');

                    if (json.is_mat_home == 1)
                        $('#checkMatHome').prop('checked', true);
                    else
                        $('#checkMatHome').removeAttr('checked');

                    $('#txtInsOther').val(json.other);

                    if (json.is_pub_company == 1)
                        $('#checkPubCompany').prop('checked', true);
                    else
                        $('#checkPubCompany').removeAttr('checked');


                    if (json.is_pvt_company == 1)
                        $('#checkPvtCompany').prop('checked', true);
                    else
                        $('#checkPvtCompany').removeAttr('checked');

                    if (json.is_pro_pvt_company == 1)
                        $('#checkProHospital').prop('checked', true);
                    else
                        $('#checkProHospital').removeAttr('checked');

                    if (json.is_co_hospital == 1)
                        $('#checkCoHospital').prop('checked', true);
                    else
                        $('#checkCoHospital').removeAttr('checked');

                    if (json.is_std_hospital == 1)
                        $('#checkEsHospital').prop('checked', true);
                    else
                        $('#checkEsHospital').removeAttr('checked');

                    $('#txtOwnOther').val(json.own_other);

                    //-----------------------------Institute facility-----------------------

                    $('#txtNoBed').text(json.noBed);
                    $('#txtNoRoom').text(json.noRoom);
                    $('#txtNoWard').text(json.noWard);

                    $('#cboAtomicEnergy').text(json.radioSer);
                    $('#txtNoLicense').text(json.noLicense);
                    $('#txtclinicalDis').text(json.disposal);
                    $('#txtInsDress').text(json.instDress);
                    $('#cboEmgKit').text(json.emgKit);

                    //-------------------------------facility detail----------------------------
                    if (json.detailVal3 != null) {
                        $("#tblinsFacility").find("tr:gt(0)").remove();
                        for (var j = 0; j <= json.detailVal3.length - 1; j++) {
                            $facility = json.detailVal3[j].facility;
                            $value = json.detailVal3[j].value;
                            $description = json.detailVal3[j].description;

                            $('#tblinsFacility').append("<tbody><tr><td align='center' class='p-1'>" + $facility + "</td><td class='p-1'>" + $value + "</td><td class='p-1'>" + $description + "</td></tr></tbody>");


                        }

                    }


                    //------------------------------------------payment -------------------------------------------

                    $('#txtYear').text(json.regYear);
                    $('#txtAmount').text(json.payAmount);
                    $('#txtPaymentDate').text(json.paymentDate);
                    $('#txtPaymentBranch').text(json.paymentBranch);
                    $('#cboPayType').text(json.paymentType);
                    $('#txtregAmount').text(json.payment_reg_fee);
                    $('#txtStampAmount').text(json.payment_stamp_fee);
                    $('#txtArras').text(json.payment_arrears);
                    $('#txtRemark').text(json.reject_remark);


                    $imageName = json.payImageName;

                    $('#txthidImg').val($imageName);
                    // alert($src);
                    //$('#slip').attr("src", $src);
                    if (json.paymentType === 'Card Payment') {
                        $('#slip').attr('href', backwardSeparator + json.receipt_path);
                    } else {
                        $('#slip').attr('href', backwardSeparator + 'img/BankSlip/' + $imageName);
                    }


                    if (json.approval == '1') {
                        $('#lblAcction').text('Approved!')
                        $("#lblAcction").css("color", "#060");
                        $('#btnReject,#btnApprove').hide();

                    } else if (json.approval == '2' || json.approval == '9' || json.approval == '12') {
                        $('#lblAcction').text('Rejected!')
                        $("#lblAcction").css("color", "#C00");
                        $('#btnReject,#btnApprove').hide();
                    } else if (json.approval == '10') {
                        $('#lblAcction').text('Checked!')
                        $("#lblAcction").css("color", "#060");
                        $('#btnReject,#btnApprove').hide();
                    } else if (json.approval == '11') {
                        $('#lblAcction').text('Recommended!')
                        $("#lblAcction").css("color", "#060");
                        $('#btnReject,#btnApprove').hide();
                    } else {

                        $('#lblAcction').text('');
                        $('#btnReject,#btnApprove').hide();

                    }

                }
            }
        });

    });


    $('.btn').click(function () {

        var id = this.id;


        var url = "list-db-get.php";
        var httpobj = $.ajax({
            url: url,
            dataType: 'json',
            data: 'requestType=loadDocDetails&id=' + id,
            async: false,
            success: function (json) {

                if (json) {

                    for (var i = 0; i < json.length; i++) {
//              ema_id, sye_name, syf_name, ema_account_no, ema_amount, stat_name
                        $newRow = $('#tblEmpExistingDocuments .cloneRow').eq(0).clone();
                        $newRow.removeClass('cloneRow').addClass('dataRow');
                        $newRow.css('display', 'table-row');
                        $('.category', $newRow).html(json[i].dfc_name);
                        $('.name', $newRow).html(json[i].dfi_file_name);
                        $('.reference', $newRow).html(json[i].dfi_reference_no);
                        $('.version', $newRow).html(json[i].dfi_file_version);
//              $('.status', $newRow).html(json[i].stat_name);
                        // Update Link
                        var fileId = json[i].dfi_id;
                        $('.action', $newRow).attr('data_file_id', fileId);
                        $('.action', $newRow).on('click', function (e) {
                            e.preventDefault();
                            var fileId = $(e.target).closest('a').attr('data_file_id');
                            fileAccess(fileId);
                        });
                        $('.action', $newRow).hide();
                        if (json[i].dfi_id > 0) {
                            $('.action', $newRow).show();
                        }

                        $('#tblEmpExistingDocuments tbody').append($newRow);
                    }

                }
            }
        });
    });






    $('#btnClose').click(function () {

        location.reload();

    });

   

    $('#frmItemCount .btnSave').click(function () {

        location.reload();

    })

    $('#frmItemCount .btnCancel').click(function () {

        location.reload();

    })


    $('#frmItemCount #addSave').click(function () {


        var requestType = "add";
        //	}
        var url = "itemCount-db-set.php";
        var obj = $.ajax({
            url: url,
            dataType: "json",
            data: $("#frmItemCount").serialize() + "&requestType=" + requestType,
            async: false,

            succuss: function (json) {


            }


        });

        location.reload();

    })

    function save(a) {

        $('#frmItemCount #btnSave' + a).click(function () {

            $id = a;
            $sheetName = $('#frmItemCount #sheetName' + a).val();
            $sheetSize = $('#frmItemCount #sheetSize' + a).val();
            $paperSize = $('#frmItemCount #paperSize' + a).val();
            $singleSide = $('#frmItemCount #singleSide' + a).val();
            $doubleSide = $('#frmItemCount #doubleSide' + a).val();

            var requestType = "edit";
            //	}
            var url = "itemCount-db-set.php";
            var obj = $.ajax({
                url: url,
                dataType: "json",
                data: "&requestType=" + requestType + "&sheetSize=" + $sheetSize + "&paperSize=" + $paperSize + "&singleSide=" + $singleSide + "&doubleSide=" + $doubleSide + "&id=" + $id + '&sheetName=' + $sheetName,
                async: false,

                succuss: function (json) {


                }


            });


        })


    }


});