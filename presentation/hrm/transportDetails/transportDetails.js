
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-22
 */
var anStatus = "Auto";
$( document ).ready( function () {
  // =================================
  // Access Control
  // ---------------------------------
  // Reset
  $('#frmhrm_trn_transport_details #btnNew').hide();
  $('#frmhrm_trn_transport_details #btnList').hide();
  $('#frmhrm_trn_transport_details #btnSave').hide();
  $('#frmhrm_trn_transport_details #btnPrint').hide();
  $('#frmhrm_trn_transport_details #btnDelete').hide();
  $('#frmhrm_trn_transport_details #btnApprove').hide();
  $('#frmhrm_trn_transport_details #btnReject').hide();
  $('#frmhrm_trn_transport_details #cboSearch').prop('disabled', true);
  
  if(intViewx){ // View Permission
 	$('#frmhrm_trn_transport_details #cboSearch').prop('disabled', false);
  }
  if(intListx){ // Listing Permission
 	$('#frmhrm_trn_transport_details #btnList').show();
  }
  if(intAddx){ // Insert New Permission
 	$('#frmhrm_trn_transport_details #btnNew').show();
 	$('#frmhrm_trn_transport_details #btnSave').show();
  }
  if(intEditx){ // Update Permission
 	$('#frmhrm_trn_transport_details #btnSave').show();
 	$('#frmhrm_trn_transport_details #cboSearch').prop('disabled', false);
  }
  if(intDeletex){ // Delete Permission
 	$('#frmhrm_trn_transport_details #btnDelete').show();
 	$('#frmhrm_trn_transport_details #cboSearch').prop('disabled', false);
  }
  if(intPrintx){ // Delete Permission
 	$('#frmhrm_trn_transport_details #btnPrint').show();
 	$('#frmhrm_trn_transport_details #cboSearch').prop('disabled', false);
  }

    // =================================
  // Validation
  // ---------------------------------
  $( "#frmhrm_trn_transport_details" ).validate( {
      rules: {
        cboEmployeeId:"required",
        cboTransportModeId:"required",
        cboTransportVehicleTypeId:"required",
        txtRoute: {
                    maxlength: 256
                  },
        txtTravellingTime: {
                    maxlength: 5
                  },
        txtDistance: {
                    maxlength: 16
                  },
        cboDwellingModeId:"required",
        txtDuration: {
                    maxlength: 16
                  },
        txtRemarks: {
                    maxlength: 256
                  },
        cboStatus:"required",
        cboLocationId:"required",
        cboCompanyId:"required",
        
      },
      submitHandler: function () {
          modalMsgBox("Info", "Not Implemented ...");
      }
  } );
  // ----------------------------------------------------------
  //        Active Tab
  // ----------------------------------------------------------
  $('.employee-tab a').each(function(){
    $href = $(this).attr('href');
    $url = $href.split('?')[0];
    $tempPath = backwardSeparator + xprojectPath;
    if($url==$tempPath){
      $(this).addClass('active');
    }
    else{
      $(this).removeClass('active');
    }
  });
  // --------------------------------------------------------
  //      Auto Number / Manual Number
  // --------------------------------------------------------
  $('#frmhrm_trn_transport_details #chkAutoManual').click(function(){
    if($('#frmhrm_trn_transport_details #chkAutoManual').eq(0).is(':checked')){
      anStatus = "Auto";
      $('#frmhrm_trn_transport_details #etd_employee_id').val('');
      $('#frmhrm_trn_transport_details #etd_employee_id').prop("readonly",true);
      $('#frmhrm_trn_transport_details #etd_employee_id').rules( "remove" );
    }
    else{
      anStatus = "Manual";
      $('#frmhrm_trn_transport_details #etd_employee_id').val('');
      $('#frmhrm_trn_transport_details #etd_employee_id').prop("readonly",false);
      $('#frmhrm_trn_transport_details #etd_employee_id').rules("add", {
                                                    required: true,
                                                  });
    }
  });
  // --------------------------------------------------------
  //      New Function
  // --------------------------------------------------------
  $("#frmhrm_trn_transport_details #btnNew").click(function(){  
    $("#frmhrm_trn_transport_details").get(0).reset();
    $("#frmhrm_trn_transport_details").validate().resetForm();
    $('#tblEmpTransportDetails tbody .dataRow').each(function(){
      $(this).remove();
    });	
  });
  // --------------------------------------------------------
  //      Listing Function
  // --------------------------------------------------------
  $("#frmhrm_trn_transport_details #btnList").click(function(){  
    window.location.assign("transportDetailsListing.php");
  });
  // --------------------------------------------------------
  //      Print Function
  // --------------------------------------------------------
  $("#frmhrm_trn_transport_details #btnPrint").click(function(){  
    if($('#frmhrm_trn_transport_details #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmhrm_trn_transport_details #cboSearch').val();
      window.location.assign("transportDetailsPrint.php?id="+id);
    }
  });
  // --------------------------------------------------------
  //      Close Function
  // --------------------------------------------------------
  $("#frmhrm_trn_transport_details #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
  // --------------------------------------------------------
  //      Save Function
  // --------------------------------------------------------
  $("#frmhrm_trn_transport_details #btnSave").click(function(){  
    var requestType = '';
    var id = '';
    if($("#frmhrm_trn_transport_details").valid()){   // test for validity
      if($('#frmhrm_trn_transport_details #cboSearch').val()==''){
        requestType = 'add';	
      }
      else{
        requestType = 'edit';	
        id = $('#frmhrm_trn_transport_details #cboSearch').val();
      }
      var url = "transportDetails-db-set.php";
      var obj = $.ajax({
			url:url,
			dataType: "json",
			type:'post', 
			data:$("#frmhrm_trn_transport_details").serialize()+'&requestType='+requestType+'&cboSearch='+id+'&anStatus='+anStatus,
			async:false,
			
			success:function(json){
					if(json.type=='pass'){
						$('#frmhrm_trn_transport_details').get(0).reset();
                        id = json.id;
						loadSearchCombo(id);
                        $('#frmhrm_trn_transport_details #cboSearch').trigger('change');
                        modalMsgBox("Success", json.msg);
						return;
					}
                    else if(json.type=='fail'){
                        modalMsgBox("Error", json.msg);
						return;
                    }
                    
				},
			error:function(xhr,status){
                    modalMsgBox("Error", "AJAX error "+xhr.status);
				}		
			});
    } else {
      modalMsgBox("Error", "Validation Failed ...");
    }
  });
  
  // --------------------------------------------------------
  //      Delete Function
  // --------------------------------------------------------
  $("#frmhrm_trn_transport_details #btnDelete").click(function(){  
    var requestType = 'delete';
    var id = '';
    if($('#frmhrm_trn_transport_details #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmhrm_trn_transport_details #cboSearch').val();
    }
    var url = "transportDetails-db-set.php";
    var obj = $.ajax({
          url:url,
          dataType: "json",
          type:'post', 
          data:'requestType='+requestType+'&cboSearch='+id,
          async:false,

          success:function(json){
                  if(json.type=='pass'){
                      $('#frmhrm_trn_transport_details').get(0).reset();
                      modalMsgBox("Success", json.msg);
                      return;
                  }
                  else if(json.type=='fail'){
                      modalMsgBox("Error", json.msg);
                      return;
                  }
              },
          error:function(xhr,status){
              modalMsgBox("Error", "AJAX error "+xhr.status);
              }		
          });
  });
  
  // =====================================================
  // ===============  Search  combo Content Load =========
  // =====================================================
  $("#frmhrm_trn_transport_details #cboSearch").focus(function(){  
    loadSearchCombo($(this).val());
  });
  // ========================================
  // ===============  Search Record =========
  // ========================================
  $("#frmhrm_trn_transport_details #cboSearch").change(function(){  
    $("#frmhrm_trn_transport_details").validate().resetForm();
    var url = "transportDetails-db-get.php";
    if($(this).val()==''){
        $('#frmhrm_trn_transport_details').get(0).reset();return;	
    }
    $id = $(this).val();
    var httpobj = $.ajax({
        url:url,
        dataType:'json',
        data:'requestType=loadDetails&id='+$id,
        async:false,
        success:function(json){
          $('#frmhrm_trn_transport_details').get(0).reset();
          $('#frmhrm_trn_transport_details #cboSearch').val($id);
          if(json){ 
            $('#frmhrm_trn_transport_details #cboEmployeeId').val(json[0].etd_employee_id);
            $('#frmhrm_trn_transport_details #cboEmployeeId').trigger('change');
            $('#frmhrm_trn_transport_details #cboTransportModeId').val(json[0].etd_transport_mode_id);
            $('#frmhrm_trn_transport_details #cboTransportVehicleTypeId').val(json[0].etd_transport_vehicle_type_id);
            $('#frmhrm_trn_transport_details #txtRoute').val(json[0].etd_route);
            $('#frmhrm_trn_transport_details #txtTravellingTime').val(json[0].etd_travelling_time);
            $('#frmhrm_trn_transport_details #txtDistance').val(json[0].etd_distance);
            $('#frmhrm_trn_transport_details #cboDwellingModeId').val(json[0].etd_dwelling_mode_id);
            $('#frmhrm_trn_transport_details #txtDuration').val(json[0].etd_duration);
            $('#frmhrm_trn_transport_details #txtRemarks').val(json[0].etd_remarks);
            $('#frmhrm_trn_transport_details #cboStatus').val(json[0].etd_status);
                      
          }
        }
    });
  });
  
  // ===============================================
  // ===============  Get Existing Job Details =========
  // ===============================================
  $("#frmhrm_trn_transport_details #cboEmployeeId").change(function(){  
    var url = "transportDetails-db-get.php";
    $('#tblEmpTransportDetails tbody .dataRow').each(function(){
      $(this).remove();
    });	
    if($(this).val()==''){
      return;
    }
    employeeId = $(this).val();
    updateTabLink(employeeId)
    var httpobj = $.ajax({
        url:url,
        dataType:'json',
        data:'requestType=loadExistingTransportDetails&id='+employeeId,
        async:false,
        success:function(json){
//          $('#frmhrm_trn_transport_details').get(0).reset();
//          $("#frmhrm_trn_transport_details #cboEmployeeId").val($id);
          if(json){ 
            for (var i=0; i<json.length; i++) {
//              ema_id, sye_name, syf_name, ema_account_no, ema_amount, stat_name
              $newRow = $('#tblEmpTransportDetails .cloneRow').eq(0).clone();
              $newRow.removeClass('cloneRow').addClass('dataRow');
              $newRow.css('display','table-row');
              $('.mode', $newRow).html(json[i].tmd_name);
              $('.dwelling', $newRow).html(json[i].dwm_name);
              $('.time', $newRow).html(json[i].etd_travelling_time);
              $('.distance', $newRow).html(json[i].etd_distance);
              $('.duration', $newRow).html(json[i].etd_duration);
              $('.status', $newRow).html(json[i].stat_name);
              // Update Link
              $href = $('.action', $newRow).attr('href');
              $href = $href.split('?id=')[0];
              $href = $href.split('?rec_id=')[0]+'?rec_id='+json[i].etd_id;
              $('.action', $newRow).attr('href', $href);
//              if(json[i].stat_name!=='Completed'){
//                $('.action', $newRow).hide();
//              }
              
              $('#tblEmpTransportDetails tbody').append($newRow);
            }
          }
        }
    });
  });
    
  // =================================
  // Load Search Dropdown content
  // ---------------------------------
  loadSearchCombo(searchId);
  // =================================
  // Select Employee
  // ---------------------------------
  if(employeeId!==""){
    $("#frmhrm_trn_transport_details #cboEmployeeId").val(employeeId);
    $("#frmhrm_trn_transport_details #cboEmployeeId").trigger('change');
  }

});// Document Ready End

function loadSearchCombo($id){
	var url = "transportDetails-db-get.php?requestType=loadSearchCombo";
	var httpobj = $.ajax({url:url,async:false})
	$('#frmhrm_trn_transport_details #cboSearch').html(httpobj.responseText);
	$('#frmhrm_trn_transport_details #cboSearch').val($id);
	$('#frmhrm_trn_transport_details #cboSearch').trigger('change');
}

// Update id value in Tab URL 
function updateTabLink($id){
  $('.employee-tab li a').each(function(){
    $href = $(this).attr('href');
    $href = $href.split('?rec_id=')[0];
    $href = $href.split('?id=')[0]+'?id='+$id;
    $(this).attr('href', $href);
  });
}

