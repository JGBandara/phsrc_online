// JavaScript Document
$(document).ready(function () {

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
            // if (end > totalRows) end = totalRows;

            $('.rows_count').text("Showing " + start + " to " + end + " of " + totalRows + " entries");
        }
    });
}


   
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

            //alert();

            $id = a;
            $sheetName = $('#frmItemCount #sheetName' + a).val();
            $sheetSize = $('#frmItemCount #sheetSize' + a).val();
            $paperSize = $('#frmItemCount #paperSize' + a).val();
            $singleSide = $('#frmItemCount #singleSide' + a).val();
            $doubleSide = $('#frmItemCount #doubleSide' + a).val();

            //if(updated==1){
            //var requestType="edit";

            //}else{

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
            //alert(id);


        })


    }


});