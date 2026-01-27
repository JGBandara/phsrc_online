$(document).ready(function () {

  $('#frmsys_data_collection #btnNew').hide();
  $('#frmsys_data_collection #btnList').hide();
  $('#frmsys_data_collection #btnSave').hide();
  $('#frmsys_data_collection #btnPrint').hide();
  $('#frmsys_data_collection #btnDelete').hide();
  $('#frmsys_data_collection #btnApprove').hide();
  $('#frmsys_data_collection #btnReject').hide();
  $('#frmsys_data_collection #cboSearch').prop('disabled', true);

  // =================================
  // Permission Handling
  // ---------------------------------
  if (intViewx) {
    $('#frmsys_data_collection #cboSearch').prop('disabled', false);
  }
  if (intListx) {
    $('#frmsys_data_collection #btnList').show();
  }
  if (intAddx) {
    $('#frmsys_data_collection #btnNew').show();
    $('#frmsys_data_collection #btnSave').show();
  }
  if (intEditx) {
    $('#frmsys_data_collection #btnSave').show();
    $('#frmsys_data_collection #cboSearch').prop('disabled', false);
  }
  if (intDeletex) {
    $('#frmsys_data_collection #btnDelete').show();
    $('#frmsys_data_collection #cboSearch').prop('disabled', false);
  }
  if (intPrintx) {
    $('#frmsys_data_collection #btnPrint').show();
    $('#frmsys_data_collection #cboSearch').prop('disabled', false);
  }

  // =================================
  // New Button
  // ---------------------------------

  $("#frmsys_data_collection #btnNew").click(function () {
    $("#frmsys_data_collection").get(0).reset();
    $("#frmsys_data_collection").validate().resetForm();
    
  });

// $(".add-row").click(function () {
//     let tbl = $(this).data("table");

//     let row =
//         `<tr>
//             <td>
//                 <select class="form-control form-control-sm" >
//                     <option value="">-- Select Type --</option>
//                 </select>
//             </td>
//             <td><input type="number" class="form-control form-control-sm"></td>
//             <td><button type="button" class="btn btn-sm btn-danger remove-row">Remove</button></td>
//         </tr>`;

//     $("#" + tbl + " tbody").append(row);
// });

// $(document).on("click", ".remove-row", function () {
//     $(this).closest("tr").remove();
// });


// ===============================
// GENERIC ADD ROW HANDLER
// ===============================
$(document).on('click', '.add-row', function () {

    let tableId = $(this).data('table');

    if (tableId === 'tblChanel') {
        addChanelRow(tableId);
    }
    else if (tableId === 'tblNotifiable') {
        addDiseaseRow(tableId);
    }
    else if (tableId === 'tblVaccines') {
        addVaccinesRow(tableId);
    }
    else if (tableId === 'tblDeliveries') {
        addDeliveriesRow(tableId);
    }
    else if (tableId === 'tblLiveBirths') {
        addLiveBirthsRow(tableId);
    }
    else if (tableId === 'tblFamilyPlanning') {
        addFamilyPlanningRow(tableId);
    }
    else if (tableId === 'tblLaboratoryTests') {
        addLaboratoryTestsRow(tableId);
    }
    else if (tableId === 'tblRadiologyTests') {
      addRadiologyTestsRow(tableId);
    }
    // else if (tableId === 'tblAdverseEvents') {
    //   addAdverseEventsRow(tableId);
    // } 
});



// ===============================
// ADD CHANNELED ROW
// ===============================
function addChanelRow(tableId) {

    $.ajax({
        url: 'dataCollect-db-get.php', // <-- your PHP get file
        type: 'GET',
        data: {
            requestType: 'loadChanneledType'
        },
        success: function (optionHtml) {

            let row = `
                <tr>
                    <td>
                        <select class="form-control form-control-sm chn-type">
                            ${optionHtml}
                        </select>
                    </td>
                    <td>
                        <input type="number"
                               class="form-control form-control-sm chn-count"
                               value="0"
                               min="0">
                    </td>
                    <td class="text-center">
                        <button type="button"
                                class="btn btn-sm btn-danger remove-row">
                           Delete
                        </button>
                    </td>
                </tr>
            `;

            $('#' + tableId + ' tbody').append(row);
        }
    });
}

function addDiseaseRow(tableId) {

    $.ajax({
        url: 'dataCollect-db-get.php', // <-- your PHP get file
        type: 'GET',
        data: {
            requestType: 'loadDiseasesType'
        },
        success: function (optionHtml) {

            let row = `
                <tr>
                    <td>
                        <select class="form-control form-control-sm disease-type">
                            ${optionHtml}
                        </select>
                    </td>
                    <td>
                        <input type="number"
                               class="form-control form-control-sm disease-count"
                               value="0"
                               min="0">
                    </td>
                    <td class="text-center">
                        <button type="button"
                                class="btn btn-sm btn-danger remove-row">
                           Delete
                        </button>
                    </td>
                </tr>
            `;

            $('#' + tableId + ' tbody').append(row);
        }
    });
}

function addVaccinesRow(tableId) {

    $.ajax({
        url: 'dataCollect-db-get.php', // <-- your PHP get file
        type: 'GET',
        data: {
            requestType: 'loadVaccinesType'
        },
        success: function (optionHtml) {

            let row = `
                <tr>
                    <td>
                        <select class="form-control form-control-sm vaccines-type">
                            ${optionHtml}
                        </select>
                    </td>
                    <td>
                        <input type="number"
                               class="form-control form-control-sm vaccines-count"
                               value="0"
                               min="0">
                    </td>
                    <td class="text-center">
                        <button type="button"
                                class="btn btn-sm btn-danger remove-row">
                           Delete
                        </button>
                    </td>
                </tr>
            `;

            $('#' + tableId + ' tbody').append(row);
        }
    });
}
function addDeliveriesRow(tableId) {

    $.ajax({
        url: 'dataCollect-db-get.php', // <-- your PHP get file
        type: 'GET',
        data: {
            requestType: 'loadDeliveryType'
        },
        success: function (optionHtml) {

            let row = `
                <tr>
                    <td>
                        <select class="form-control form-control-sm delivery-type">
                            ${optionHtml}
                        </select>
                    </td>
                    <td>
                        <input type="number"
                               class="form-control form-control-sm delivery-count"
                               value="0"
                               min="0">
                    </td>
                    <td class="text-center">
                        <button type="button"
                                class="btn btn-sm btn-danger remove-row">
                           Delete
                        </button>
                    </td>
                </tr>
            `;

            $('#' + tableId + ' tbody').append(row);
        }
    });
} 

function addLiveBirthsRow(tableId) {

    $.ajax({
        url: 'dataCollect-db-get.php', // <-- your PHP get file
        type: 'GET',
        data: {
            requestType: 'loadLiveBirthsType'
        },
        success: function (optionHtml) {

            let row = `
                <tr>
                    <td>
                        <select class="form-control form-control-sm live-births-type">
                            ${optionHtml}
                        </select>
                    </td>
                    <td>
                        <input type="number"
                               class="form-control form-control-sm live-births-count"
                               value="0"
                               min="0">
                    </td>
                    <td class="text-center">
                        <button type="button"
                                class="btn btn-sm btn-danger remove-row">
                           Delete
                        </button>
                    </td>
                </tr>
            `;

            $('#' + tableId + ' tbody').append(row);
        }
    });
}

function addFamilyPlanningRow(tableId) {

    $.ajax({
        url: 'dataCollect-db-get.php', // <-- your PHP get file
        type: 'GET',
        data: {
            requestType: 'loadFamilyPlanningType'
        },
        success: function (optionHtml) {

            let row = `
                <tr>
                    <td>
                        <select class="form-control form-control-sm family-type">
                            ${optionHtml}
                        </select>
                    </td>
                    <td>
                        <input type="number"
                               class="form-control form-control-sm family-count"
                               value="0"
                               min="0">
                    </td>
                    <td class="text-center">
                        <button type="button"
                                class="btn btn-sm btn-danger remove-row">
                           Delete
                        </button>
                    </td>
                </tr>
            `;

            $('#' + tableId + ' tbody').append(row);
        }
    });
}
function addLaboratoryTestsRow(tableId) {
   $.ajax({
        url: 'dataCollect-db-get.php', // <-- your PHP get file
        type: 'GET',
        data: {
            requestType: 'loadLaboratoryType'
        },
        success: function (optionHtml) {

            let row = `
                <tr>
                    <td>
                        <select class="form-control form-control-sm laboratory-type">
                            ${optionHtml}
                        </select>
                    </td>
                    <td>
                        <input type="number"
                               class="form-control form-control-sm laboratory-count"
                               value="0"
                               min="0">
                    </td>
                    <td class="text-center">
                        <button type="button"
                                class="btn btn-sm btn-danger remove-row">
                           Delete
                        </button>
                    </td>
                </tr>
            `;

            $('#' + tableId + ' tbody').append(row);
        }
    });
}

function addRadiologyTestsRow(tableId) {
   $.ajax({
        url: 'dataCollect-db-get.php', // <-- your PHP get file
        type: 'GET',
        data: {
            requestType: 'loadRadiologyType'
        },
        success: function (optionHtml) {

            let row = `
                <tr>
                    <td>
                        <select class="form-control form-control-sm radiology-type">
                            ${optionHtml}
                        </select>
                    </td>
                    <td>
                        <input type="number"
                               class="form-control form-control-sm radiology-count"
                               value="0"
                               min="0">
                    </td>
                    <td class="text-center">
                        <button type="button"
                                class="btn btn-sm btn-danger remove-row">
                           Delete
                        </button>
                    </td>
                </tr>
            `;

            $('#' + tableId + ' tbody').append(row);
        }
    });
}

// function addAdverseEventsRow(tableId) {
//    $.ajax({
//         url: 'dataCollect-db-get.php', // <-- your PHP get file
//         type: 'GET',
//         data: {
//             requestType: 'loadEventType'
//         },
//         success: function (optionHtml) {

//             let row = `
//                 <tr>
//                     <td>
//                         <select class="form-control form-control-sm chn-type">
//                             ${optionHtml}
//                         </select>
//                     </td>
//                     <td>
//                         <input type="number"
//                                class="form-control form-control-sm chn-count"
//                                value="0"
//                                min="0">
//                     </td>
//                     <td class="text-center">
//                         <button type="button"
//                                 class="btn btn-sm btn-danger remove-row">
//                            Delete
//                         </button>
//                     </td>
//                 </tr>
//             `;

//             $('#' + tableId + ' tbody').append(row);
//         }
//     });
// }

$(document).on('click', '.remove-row', function () {
    $(this).closest('tr').remove();
});


    $("#frmsys_data_collection #btnSaveChanel").click(function () {

    var requestType = 'saveChanel'; // section-wise save
    var id = $('#frmsys_data_collection #cboSearch').val(); // optional: if you have a header id

 // ===============================
    // REQUIRED FIELD VALIDATION
    // ===============================
    var year      = $('#txtYear').val().trim();
    var month     = $('#txtMonth').val().trim();
    var institute = $('#txtInstitute').val().trim();
    var regNo     = $('#txtRegNo').val().trim();

    if (year === '') {
        alert("Year is required");
        $('#txtYear').focus();
        return false;
    }

    if (month === '') {
        alert("Month is required");
        $('#txtMonth').focus();
        return false;
    }

    if (institute === '') {
        alert("Institute is required");
        $('#txtInstitute').focus();
        return false;
    }

    if (regNo === '') {
        alert("PHSRC Reg No is required");
        $('#txtRegNo').focus();
        return false;
    }
    const tableId  = $(this).data('table');
    const mainType = $(this).data('type'); 
    let rows = [];

    $('#' + tableId + ' tbody tr').each(function () {

        const subType = $(this).find('.chn-type').val();
        const count   = $(this).find('.chn-count').val();

        if (subType && count !== '') {
            rows.push({
                sub_type: subType,
                count: count
            });
        }
    });

    if (rows.length === 0) {
        alert('No data to save');
        return;
    }

    $.ajax({
        url: 'dataCollect-db-set.php',
        type: 'POST',
        data: {
            requestType: 'saveStatistics',
            main_type: mainType,
            header_id: regNo, // year/month/reg header
            rows: JSON.stringify(rows)
        },
        success: function () {
            alert(mainType + ' saved successfully');
        }
    });
});
//     $("#frmsys_data_collection #btnSaveSurgery").click(function () {

//     var requestType = 'saveStatistics'; // section-wise save
//     var id = $('#frmsys_data_collection #cboSearch').val(); // optional: if you have a header id

//  // ===============================
//     // REQUIRED FIELD VALIDATION
//     // ===============================
//     var year      = $('#txtYear').val().trim();
//     var month     = $('#txtMonth').val().trim();
//     var institute = $('#txtInstitute').val().trim();
//     var regNo     = $('#txtRegNo').val().trim();

//     if (year === '') {
//         alert("Year is required");
//         $('#txtYear').focus();
//         return false;
//     }

//     if (month === '') {
//         alert("Month is required");
//         $('#txtMonth').focus();
//         return false;
//     }

//     if (institute === '') {
//         alert("Institute is required");
//         $('#txtInstitute').focus();
//         return false;
//     }

//     if (regNo === '') {
//         alert("PHSRC Reg No is required");
//         $('#txtRegNo').focus();
//         return false;
//     }
//     const tableId  = $(this).data('table');
//     const mainType = $(this).data('type'); 
//     let rows = [];

//     $('#' + tableId + ' tbody tr').each(function () {

//         const subType = $(this).find('.surgery-type').val();
//         const count   = $(this).find('.surgery-count').val();

//         if (subType && count !== '') {
//             rows.push({
//                 sub_type: subType,
//                 count: count
//             });
//         }
//     });

//     if (rows.length === 0) {
//         alert('No data to save');
//         return;
//     }

//     $.ajax({
//         url: 'dataCollect-db-set.php',
//         type: 'POST',
//         data: {
//             requestType: 'saveStatistics',
//             main_type: mainType,
//             header_id: regNo, // year/month/reg header
//             rows: JSON.stringify(rows)
//         },
//         success: function () {
//             alert(mainType + ' saved successfully');
//         }
//     });
// });

    $("#frmsys_data_collection #btnSaveDiseases").click(function () {

    var requestType = 'saveStatistics'; // section-wise save
    var id = $('#frmsys_data_collection #cboSearch').val(); // optional: if you have a header id

 // ===============================
    // REQUIRED FIELD VALIDATION
    // ===============================
    var year      = $('#txtYear').val().trim();
    var month     = $('#txtMonth').val().trim();
    var institute = $('#txtInstitute').val().trim();
    var regNo     = $('#txtRegNo').val().trim();

    if (year === '') {
        alert("Year is required");
        $('#txtYear').focus();
        return false;
    }

    if (month === '') {
        alert("Month is required");
        $('#txtMonth').focus();
        return false;
    }

    if (institute === '') {
        alert("Institute is required");
        $('#txtInstitute').focus();
        return false;
    }

    if (regNo === '') {
        alert("PHSRC Reg No is required");
        $('#txtRegNo').focus();
        return false;
    }
    const tableId  = $(this).data('table');
    const mainType = $(this).data('type'); 
    let rows = [];

    $('#' + tableId + ' tbody tr').each(function () {

        const subType = $(this).find('.disease-type').val();
        const count   = $(this).find('.disease-count').val();

        if (subType && count !== '') {
            rows.push({
                sub_type: subType,
                count: count
            });
        }
    });

    if (rows.length === 0) {
        alert('No data to save');
        return;
    }

    $.ajax({
        url: 'dataCollect-db-set.php',
        type: 'POST',
        data: {
            requestType: 'saveStatistics',
            main_type: mainType,
            header_id: regNo, // year/month/reg header
            rows: JSON.stringify(rows)
        },
        success: function () {
            alert(mainType + ' saved successfully');
        }
    });
});

    $("#frmsys_data_collection #btnSaveVaccines").click(function () {

    var requestType = 'saveStatistics'; // section-wise save
    var id = $('#frmsys_data_collection #cboSearch').val(); // optional: if you have a header id

 // ===============================
    // REQUIRED FIELD VALIDATION
    // ===============================
    var year      = $('#txtYear').val().trim();
    var month     = $('#txtMonth').val().trim();
    var institute = $('#txtInstitute').val().trim();
    var regNo     = $('#txtRegNo').val().trim();

    if (year === '') {
        alert("Year is required");
        $('#txtYear').focus();
        return false;
    }

    if (month === '') {
        alert("Month is required");
        $('#txtMonth').focus();
        return false;
    }

    if (institute === '') {
        alert("Institute is required");
        $('#txtInstitute').focus();
        return false;
    }

    if (regNo === '') {
        alert("PHSRC Reg No is required");
        $('#txtRegNo').focus();
        return false;
    }
    const tableId  = $(this).data('table');
    const mainType = $(this).data('type'); 
    let rows = [];

    $('#' + tableId + ' tbody tr').each(function () {

        const subType = $(this).find('.vaccines-type').val();
        const count   = $(this).find('.vaccines-count').val();

        if (subType && count !== '') {
            rows.push({
                sub_type: subType,
                count: count
            });
        }
    });

    if (rows.length === 0) {
        alert('No data to save');
        return;
    }

    $.ajax({
        url: 'dataCollect-db-set.php',
        type: 'POST',
        data: {
            requestType: 'saveStatistics',
            main_type: mainType,
            header_id: regNo, // year/month/reg header
            rows: JSON.stringify(rows)
        },
        success: function () {
            alert(mainType + ' saved successfully');
        }
    });
});

    $("#frmsys_data_collection #btnSaveDeliveries").click(function () {

    var requestType = 'saveStatistics'; // section-wise save
    var id = $('#frmsys_data_collection #cboSearch').val(); // optional: if you have a header id

 // ===============================
    // REQUIRED FIELD VALIDATION
    // ===============================
    var year      = $('#txtYear').val().trim();
    var month     = $('#txtMonth').val().trim();
    var institute = $('#txtInstitute').val().trim();
    var regNo     = $('#txtRegNo').val().trim();

    if (year === '') {
        alert("Year is required");
        $('#txtYear').focus();
        return false;
    }

    if (month === '') {
        alert("Month is required");
        $('#txtMonth').focus();
        return false;
    }

    if (institute === '') {
        alert("Institute is required");
        $('#txtInstitute').focus();
        return false;
    }

    if (regNo === '') {
        alert("PHSRC Reg No is required");
        $('#txtRegNo').focus();
        return false;
    }
    const tableId  = $(this).data('table');
    const mainType = $(this).data('type'); 
    let rows = [];

    $('#' + tableId + ' tbody tr').each(function () {

        const subType = $(this).find('.delivery-type').val();
        const count   = $(this).find('.delivery-count').val();

        if (subType && count !== '') {
            rows.push({
                sub_type: subType,
                count: count
            });
        }
    });

    if (rows.length === 0) {
        alert('No data to save');
        return;
    }

    $.ajax({
        url: 'dataCollect-db-set.php',
        type: 'POST',
        data: {
            requestType: 'saveStatistics',
            main_type: mainType,
            header_id: regNo, // year/month/reg header
            rows: JSON.stringify(rows)
        },
        success: function () {
            alert(mainType + ' saved successfully');
        }
    });
});

    $("#frmsys_data_collection #btnSaveLiveBirths").click(function () {

    var requestType = 'saveStatistics'; // section-wise save
    var id = $('#frmsys_data_collection #cboSearch').val(); // optional: if you have a header id

 // ===============================
    // REQUIRED FIELD VALIDATION
    // ===============================
    var year      = $('#txtYear').val().trim();
    var month     = $('#txtMonth').val().trim();
    var institute = $('#txtInstitute').val().trim();
    var regNo     = $('#txtRegNo').val().trim();

    if (year === '') {
        alert("Year is required");
        $('#txtYear').focus();
        return false;
    }

    if (month === '') {
        alert("Month is required");
        $('#txtMonth').focus();
        return false;
    }

    if (institute === '') {
        alert("Institute is required");
        $('#txtInstitute').focus();
        return false;
    }

    if (regNo === '') {
        alert("PHSRC Reg No is required");
        $('#txtRegNo').focus();
        return false;
    }
    const tableId  = $(this).data('table');
    const mainType = $(this).data('type'); 
    let rows = [];

    $('#' + tableId + ' tbody tr').each(function () {

        const subType = $(this).find('.live-births-type-type').val();
        const count   = $(this).find('.live-births-type-count').val();

        if (subType && count !== '') {
            rows.push({
                sub_type: subType,
                count: count
            });
        }
    });

    if (rows.length === 0) {
        alert('No data to save');
        return;
    }

    $.ajax({
        url: 'dataCollect-db-set.php',
        type: 'POST',
        data: {
            requestType: 'saveStatistics',
            main_type: mainType,
            header_id: regNo, // year/month/reg header
            rows: JSON.stringify(rows)
        },
        success: function () {
            alert(mainType + ' saved successfully');
        }
    });
});
  // =================================
  // Print Button
  // ---------------------------------
  $("#frmsys_data_collection #btnPrint").click(function () {
    let id = $('#cboSearch').val();
    if (id === '') {
      alert("Error", "Record is not selected ...");
      return false;
    }
  });

  
  $("#frmsys_data_collection #btnClose").click(function () {
    window.location.assign(backwardSeparator + "main.php");
  });
  
$("#frmsys_data_collection #btnNew").click(function(){  
    $("#frmsys_data_collection").get(0).reset();
    $("#frmsys_data_collection").validate().resetForm();
  });

  // =================================
  // Save Facility Types Button
  // ---------------------------------
  $("#frmsys_data_collection #btnSaveFacility").click(function () {

    var requestType = 'saveFacility'; // section-wise save
    var id = $('#frmsys_data_collection #cboSearch').val(); // optional: if you have a header id

 // ===============================
    // REQUIRED FIELD VALIDATION
    // ===============================
    var year      = $('#txtYear').val().trim();
    var month     = $('#txtMonth').val().trim();
    var institute = $('#txtInstitute').val().trim();
    var regNo     = $('#txtRegNo').val().trim();

    if (year === '') {
        alert("Year is required");
        $('#txtYear').focus();
        return false;
    }

    if (month === '') {
        alert("Month is required");
        $('#txtMonth').focus();
        return false;
    }

    if (institute === '') {
        alert("Institute is required");
        $('#txtInstitute').focus();
        return false;
    }

    if (regNo === '') {
        alert("PHSRC Reg No is required");
        $('#txtRegNo').focus();
        return false;
    }
    var url = "dataCollect-db-set.php";

    var obj = $.ajax({
        url: url,
        dataType: "json",
        type: 'post',
        async: false,
        data:
            'requestType=' + requestType +
            '&reg_no=' + regNo +
            '&id=' + id +
            '&year=' + year +
            '&month=' + month +
            '&institute=' + institute +
            '&pv=' + ($('#txtPv').is(':checked') ? 1 : 0) +
            '&ms=' + ($('#txtMs').is(':checked') ? 1 : 0) +
            '&pg=' + ($('#txtPg').is(':checked') ? 1 : 0) +
            '&mc=' + ($('#txtMc').is(':checked') ? 1 : 0) +
            '&pd=' + ($('#txtPd').is(':checked') ? 1 : 0) +
            '&pa=' + ($('#txtPa').is(':checked') ? 1 : 0) +
            '&pl=' + ($('#txtPl').is(':checked') ? 1 : 0) +
            '&oi=' + ($('#txtOi').is(':checked') ? 1 : 0),

        success: function (json) {
            if (json.type == 'pass') {
                alert(json.msg); // or use modalMsgBox if defined
                return;
            } else if (json.type == 'fail') {
                alert(json.msg);
                return;
            }
        },

        error: function (xhr, status) {
            alert("AJAX error " + xhr.status);
        }
    });

});




$("#frmsys_data_collection #btnSave").click(function(){  
    var requestType = '';
    var id = '';

    if($("#frmsys_data_collection").valid()){

        var cboVal = $('#frmsys_data_collection #cboSearch').val();

        if(cboVal == '' || cboVal == null){
            requestType = 'add';
        } else {
            requestType = 'edit';
            id = cboVal;
        }

      var url = "dataCollect-db-set.php";
      var obj = $.ajax({
			url:url,
			dataType: "json",
			type:'post', 
			data:'requestType='+requestType+'&cboSearch='+id,
			async:false,
			
			success:function(json){
					if(json.type=='pass'){
						$('#frmsys_data_collection').get(0).reset();
                        id = json.id;
						loadSearchCombo(id);
                        $('#frmsys_data_collection #cboSearch').trigger('change');
                        alert("Success", json.msg);
						return;
					}
                    else if(json.type=='fail'){
                        alert("Error", json.msg);
						return;
                    }
				},
			error:function(xhr,status){
                    alert("Error", "AJAX error "+xhr.status);
				}		
			});
    } else {
      alert("Error", "Validation Failed ...");
    }
  });
  
  // =================================
  // Delete Button
  // ---------------------------------
  $("#frmsys_data_collection #btnDelete").click(function () {

    let id = $('#cboSearch').val();
    if (id === '') {
      alert("Error", "Record is not selected ...");
      return false;
    }

    if (!confirm("Are you sure you want to delete this record?")) {
      return false;
    }

   var url = "dataCollect-db-set.php";
   var obj = $.ajax({
      url: url,
      dataType: "json",
      data: "requestType=delete&cboSearch=" + id,
      success: function (json) {
        if (json.type === 'pass') {
          $('#frmsys_data_collection').get(0).reset();
          loadSearchCombo('');
          alert("Success", json.msg);
        } else {
          alert("Error", json.msg);
        }
      },
      error: function (xhr) {
        alert("Error", "AJAX Error : " + xhr.status);
      }
    });

  });
 $("#frmsys_data_collection #txtMonth").change(function(){ 
    $month = $('#frmsys_data_collection #txtMonth').val();
    $year = $('#frmsys_data_collection #txtYear').val();
    var url = "dataCollect-db-get.php?requestType=loadInstituteRegNo&month="+$month+"&year="+$year;
     var httpobj = $.ajax({url:url,async:false})
          $('#frmsys_data_collection #txtRegNo').html(httpobj.responseText);
    
    });

  $("#frmsys_data_collection #txtRegNo").change(function(){ 
    id = $('#frmsys_data_collection #txtRegNo').val();
    var url = "dataCollect-db-get.php";
    if($('#frmsys_data_collection #txtRegNo').val()==''){
        $('#frmsys_data_collection').get(0).reset();
        return;	
    }
    var httpobj = $.ajax({
        url:url,
        dataType:'json',
        data:'requestType=loadInstiituteName&id='+id,
        async:false,
        success:function(json){
        $('#frmsys_data_collection #txtInstitute').val(json.institute_name);

         }
    });
  });
  // =================================
  // Search Combo Events
  // ---------------------------------
  $("#cboSearch").focus(function () {
    loadSearchCombo($(this).val());
  });

  $("#cboSearch").change(function () {

    let id = $(this).val();
    // $("#frmsys_data_collection").validate().resetForm();

    if (id === '') {
      $('#frmsys_data_collection').get(0).reset();
      return;
    }

    $.ajax({
      url: "dataCollect-db-get.php",
      dataType: "json",
      data: "requestType=loadDetails&id=" + id,
      success: function (json) {

        $('#txtYear').val(json.year);

        $('#txtMonth').val(json.month);
        $('#txtInstitute').val(json.name);
        $('#frmsys_data_collection #txtRegNo').html(httpobj.responseText);
        $('#txtRegNo').val(json.reg_no);

        // You can continue mapping fields here
      }
    });

  });

  // =================================
  // Initial Load
  // ---------------------------------
  loadSearchCombo(searchId);

});

// =================================
// Load Search Combo
// ---------------------------------
function loadSearchCombo($id){
	var url = "dataCollect-db-get.php?requestType=loadSearchCombo";
	var httpobj = $.ajax({url:url,async:false})
	$('#frmsys_data_collection #cboSearch').html(httpobj.responseText);
	$('#frmsys_data_collection #cboSearch').val($id);
	$('#frmsys_data_collection #cboSearch').trigger('change');
}
