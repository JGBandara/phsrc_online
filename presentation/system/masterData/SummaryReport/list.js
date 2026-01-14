// JavaScript Document
$(document).ready(function () {
    $('#staffInfo').hide();
    

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
            var $cat_name = json.cat_name;
            var $year = json.year;
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
                } else if ($approveStatus[i] === "Approved by Manager") {
                    rowColor = "background-color: rgba(0, 102, 204, 1); color: white;";
                    approveText = "Approved by Manager";
                } else if ($approveStatus[i] === "Approved by Secretary") {
                    rowColor = "background-color: rgba(102, 0, 204, 1); color: white;";
                    approveText = "Approved by Secretary";
                } else if ($approveStatus[i] === "Approved by PHSRC Officer") {
                    rowColor = "background-color: rgba(101, 235, 168, 1); color: white;";
                    approveText = "Approved by PHSRC Officer";
                } else if ($approveStatus[i] === "Approved by First Committee Member") {
                    rowColor = "background-color: rgba(120, 180, 124, 1); color: white;";
                    approveText = "Approved by First Committee Member";
                } else if ($approveStatus[i] === "Approved by Second Committee Member") {
                    rowColor = "background-color: rgba(68, 220, 78, 1); color: white;";
                    approveText = "Approved by Second Committee Member";
                } else if ($approveStatus[i] === "Approved by Third Committee Member") {
                    rowColor = "background-color: rgba(6, 72, 29, 1); color: white;";
                    approveText = "Approved by Third Committee Member";
                }
                else {
                    approveText = "Pending";
                }
                $('#table-id tbody').append("<tr style='" + rowColor + "'>" +
                    "<td>" + $name[i] + "</td>" +
                    "<td>" + $regNo[i] + "</td>" +
                    "<td>" + $cat_name[i] + "</td>" +
                    "<td>" + $year[i] + "</td>" +
                    "<td>" + approveText + "</td>" +
                    "<td><center><button type='button' class='btn btn-success btn-md btnView' data-toggle='modal' data-target='#myModal' id='" + $id[i] + "'>View</button></center></td>" +
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
}



    $('#butBasicInfo').click(function () {
        $('#basicInfo').show();
        $('#staffInfo,#instituteInfo,#facilityInfo,#documentList,#paymentInfo,#checkList').hide();
    })
    $('#butStaffInfo').click(function () {
        $('#staffInfo').show();
        $('#basicInfo,#instituteInfo,#facilityInfo,#documentList,#paymentInfo,#checkList').hide();
    })

    $('#butCheckInfo').click(function () {

        var id = $('#txtId').val();
        window.location.href = "../system/approval/checkList/basicInformation/basicInformation.php?id=" + id;
//	$('#checkList').show();
//	$('#basicInfo,#staffInfo,#instituteInfo,#facilityInfo,#documentList,#paymentInfo').hide();	
    })


    $('.btnView').click(function () {

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
                    $('#lblSubDate').text(json.appSubmitDate);
                    $('#lblPayDate').text(json.paymentDate);
                    $('#lblRecDate').text(json.recomendDate);
                    $('#lblForDate').text(json.managerApprovedDate);
                    $('#lblCheDate').text(json.checkedDate);
                    $('#lblSecDate').text(json.secretaryApprovalDate);
                    $('#lblRegNo').text(json.regNo);
                    $('#lblInsName').text(json.insName);

                if (json.detailVal3 != null) {
                        $("#tblsubCommittee").find("tr:gt(0)").remove();
                        for (var j = 0; j <= json.detailVal3.length - 1; j++) {
                            $member = json.detailVal3[j].member;
                            $name = json.detailVal3[j].name ?? '-';
                            $status = json.detailVal3[j].status;
                            $date = json.detailVal3[j].date ?? '-';
                            $('#tblsubCommittee').append("<tbody><tr><td align='center' class='p-1' style='font-weight:bold;color:#0d6efd;font-size:14px;text-align:center;'>" + $member + "</td><td class='p-1' style='font-weight:bold;color:#212529;font-size:15px;'>" + $name + "</td><td class='p-1' style='font-weight:bold;color:#198754;font-size:14px;'>" + $status + "</td><td class='p-1'  style='font-weight:bold;color:#dc3545;font-size:13px;'>" + $date + "</td></tr></tbody>");


                        }

                    }
    }
}
})
    });

    $('#btnClose').click(function () {

        location.reload();

    });
    $('#frmItemCount .btnCancel').click(function () {

        location.reload();

    })
});