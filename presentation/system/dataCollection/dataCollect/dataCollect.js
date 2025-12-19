$(document).ready(function () {

  // =================================
  // Button Visibility (Initial)
  // ---------------------------------
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
  // Form Validation
  // ---------------------------------
  $("#frmsys_data_collection").validate({
    rules: {
      txtYear: { required: true },
      txtMonth: { required: true },
      txtInstitute: { required: true },
      txtRegNo: { required: true }
    },
    submitHandler: function () {
      return false;
    }
  });

  // =================================
  // New Button
  // ---------------------------------
  $("#frmsys_data_collection #btnNew").click(function () {
    $("#frmsys_data_collection").get(0).reset();
    $("#frmsys_data_collection").validate().resetForm();
    $('#cboSearch').val('');
  });

  // =================================
  // Listing Button
  // ---------------------------------
  $("#frmsys_data_collection #btnList").click(function () {
    window.location.assign("dataCollectListing.php");
  });

  // =================================
  // Print Button
  // ---------------------------------
  $("#frmsys_data_collection #btnPrint").click(function () {
    let id = $('#cboSearch').val();
    if (id === '') {
      modalMsgBox("Error", "Record is not selected ...");
      return false;
    }
    window.location.assign("dataCollectPrint.php?id=" + id);
  });

  // =================================
  // Close Button
  // ---------------------------------
  $("#frmsys_data_collection #btnClose").click(function () {
    window.location.assign(backwardSeparator + "main.php");
  });

  // =================================
  // Save Button (Add / Edit)
  // ---------------------------------
  $("#frmsys_data_collection #btnSave").click(function () {

    if (!$("#frmsys_data_collection").valid()) {
      modalMsgBox("Error", "Validation Failed ...");
      return false;
    }

    let requestType = 'add';
    let id = $('#cboSearch').val();

    if (id !== '') {
      requestType = 'edit';
    }

    $.ajax({
      url: "dataCollect-db-set.php",
      type: "post",
      dataType: "json",
      data: $("#frmsys_data_collection").serialize()
            + "&requestType=" + requestType
            + "&cboSearch=" + id,
      success: function (json) {
        if (json.type === 'pass') {
          $('#frmsys_data_collection').get(0).reset();
          loadSearchCombo(json.id);
          modalMsgBox("Success", json.msg);
        } else {
          modalMsgBox("Error", json.msg);
        }
      },
      error: function (xhr) {
        modalMsgBox("Error", "AJAX Error : " + xhr.status);
      }
    });

  });

  // =================================
  // Delete Button
  // ---------------------------------
  $("#frmsys_data_collection #btnDelete").click(function () {

    let id = $('#cboSearch').val();
    if (id === '') {
      modalMsgBox("Error", "Record is not selected ...");
      return false;
    }

    if (!confirm("Are you sure you want to delete this record?")) {
      return false;
    }

    $.ajax({
      url: "dataCollect-db-set.php",
      type: "post",
      dataType: "json",
      data: "requestType=delete&cboSearch=" + id,
      success: function (json) {
        if (json.type === 'pass') {
          $('#frmsys_data_collection').get(0).reset();
          loadSearchCombo('');
          modalMsgBox("Success", json.msg);
        } else {
          modalMsgBox("Error", json.msg);
        }
      },
      error: function (xhr) {
        modalMsgBox("Error", "AJAX Error : " + xhr.status);
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
    $("#frmsys_data_collection").validate().resetForm();

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
        $('#txtInstitute').val(json.institute);
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
function loadSearchCombo(id) {
  $.ajax({
    url: "dataCollect-db-get.php?requestType=loadSearchCombo",
    async: false,
    success: function (html) {
      $('#cboSearch').html(html);
      $('#cboSearch').val(id).trigger('change');
    }
  });
}
