
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
  $('#frmhrm_trn_job_duties #btnNew').hide();
  $('#frmhrm_trn_job_duties #btnList').hide();
  $('#frmhrm_trn_job_duties #btnSave').hide();
  $('#frmhrm_trn_job_duties #btnPrint').hide();
  $('#frmhrm_trn_job_duties #btnDelete').hide();
  $('#frmhrm_trn_job_duties #btnApprove').hide();
  $('#frmhrm_trn_job_duties #btnReject').hide();
  $('#frmhrm_trn_job_duties #cboSearch').prop('disabled', true);
  
  if(intViewx){ // View Permission
 	$('#frmhrm_trn_job_duties #cboSearch').prop('disabled', false);
  }
  if(intListx){ // Listing Permission
 	$('#frmhrm_trn_job_duties #btnList').show();
  }
  if(intAddx){ // Insert New Permission
 	$('#frmhrm_trn_job_duties #btnNew').show();
 	$('#frmhrm_trn_job_duties #btnSave').show();
  }
  if(intEditx){ // Update Permission
 	$('#frmhrm_trn_job_duties #btnSave').show();
 	$('#frmhrm_trn_job_duties #cboSearch').prop('disabled', false);
  }
  if(intDeletex){ // Delete Permission
 	$('#frmhrm_trn_job_duties #btnDelete').show();
 	$('#frmhrm_trn_job_duties #cboSearch').prop('disabled', false);
  }
  if(intPrintx){ // Delete Permission
 	$('#frmhrm_trn_job_duties #btnPrint').show();
 	$('#frmhrm_trn_job_duties #cboSearch').prop('disabled', false);
  }

    // =================================
  // Validation
  // ---------------------------------
  $( "#frmhrm_trn_job_duties" ).validate( {
      rules: {
        cboEmployeeId:"required",
        cboDutyId:"required",
        dtpAssignDate: {
                  required: true,
                  dateISO: true,
                },
        cboDutyTypeId:"required",
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
  $('#frmhrm_trn_job_duties #chkAutoManual').click(function(){
    if($('#frmhrm_trn_job_duties #chkAutoManual').eq(0).is(':checked')){
      anStatus = "Auto";
      $('#frmhrm_trn_job_duties #ejt_employee_id').val('');
      $('#frmhrm_trn_job_duties #ejt_employee_id').prop("readonly",true);
      $('#frmhrm_trn_job_duties #ejt_employee_id').rules( "remove" );
    }
    else{
      anStatus = "Manual";
      $('#frmhrm_trn_job_duties #ejt_employee_id').val('');
      $('#frmhrm_trn_job_duties #ejt_employee_id').prop("readonly",false);
      $('#frmhrm_trn_job_duties #ejt_employee_id').rules("add", {
                                                    required: true,
                                                  });
    }
  });
  // --------------------------------------------------------
  //      New Function
  // --------------------------------------------------------
  $("#frmhrm_trn_job_duties #btnNew").click(function(){  
    $("#frmhrm_trn_job_duties").get(0).reset();
    $("#frmhrm_trn_job_duties").validate().resetForm();
    $('#tblEmpJobDuties tbody .dataRow').each(function(){
      $(this).remove();
    });	
  });
  // --------------------------------------------------------
  //      Listing Function
  // --------------------------------------------------------
  $("#frmhrm_trn_job_duties #btnList").click(function(){  
    window.location.assign("assignJobDutiesListing.php");
  });
  // --------------------------------------------------------
  //      Print Function
  // --------------------------------------------------------
  $("#frmhrm_trn_job_duties #btnPrint").click(function(){  
    if($('#frmhrm_trn_job_duties #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmhrm_trn_job_duties #cboSearch').val();
      window.location.assign("assignJobDutiesPrint.php?id="+id);
    }
  });
  // --------------------------------------------------------
  //      Close Function
  // --------------------------------------------------------
  $("#frmhrm_trn_job_duties #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
  // --------------------------------------------------------
  //      Save Function
  // --------------------------------------------------------
  $("#frmhrm_trn_job_duties #btnSave").click(function(){  
    var requestType = '';
    var id = '';
    if($("#frmhrm_trn_job_duties").valid()){   // test for validity
      if($('#frmhrm_trn_job_duties #cboSearch').val()==''){
        requestType = 'add';	
      }
      else{
        requestType = 'edit';	
        id = $('#frmhrm_trn_job_duties #cboSearch').val();
      }
      var url = "assignJobDuties-db-set.php";
      var obj = $.ajax({
			url:url,
			dataType: "json",
			type:'post', 
			data:$("#frmhrm_trn_job_duties").serialize()+'&requestType='+requestType+'&cboSearch='+id+'&anStatus='+anStatus,
			async:false,
			
			success:function(json){
					if(json.type=='pass'){
						$('#frmhrm_trn_job_duties').get(0).reset();
                        id = json.id;
						loadSearchCombo(id);
                        $('#frmhrm_trn_job_duties #cboSearch').trigger('change');
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
  $("#frmhrm_trn_job_duties #btnDelete").click(function(){  
    var requestType = 'delete';
    var id = '';
    if($('#frmhrm_trn_job_duties #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmhrm_trn_job_duties #cboSearch').val();
    }
    var url = "assignJobDuties-db-set.php";
    var obj = $.ajax({
          url:url,
          dataType: "json",
          type:'post', 
          data:'requestType='+requestType+'&cboSearch='+id,
          async:false,

          success:function(json){
                  if(json.type=='pass'){
                      $('#frmhrm_trn_job_duties').get(0).reset();
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
  $("#frmhrm_trn_job_duties #cboSearch").focus(function(){  
    loadSearchCombo($(this).val());
  });
  // ========================================
  // ===============  Search Record =========
  // ========================================
  $("#frmhrm_trn_job_duties #cboSearch").change(function(){  
    $("#frmhrm_trn_job_duties").validate().resetForm();
    var url = "assignJobDuties-db-get.php";
    if($(this).val()==''){
        $('#frmhrm_trn_job_duties').get(0).reset();return;	
    }
    $id = $(this).val();
    var httpobj = $.ajax({
        url:url,
        dataType:'json',
        data:'requestType=loadDetails&id='+$id,
        async:false,
        success:function(json){
          $('#frmhrm_trn_job_duties').get(0).reset();
          $('#frmhrm_trn_job_duties #cboSearch').val($id);
          if(json){ 
            $('#frmhrm_trn_job_duties #cboEmployeeId').val(json[0].ejt_employee_id);
            $('#frmhrm_trn_job_duties #cboEmployeeId').trigger('change');
            $('#frmhrm_trn_job_duties #cboDutyId').val(json[0].ejt_duty_id);
            $('#frmhrm_trn_job_duties #dtpAssignDate').val(json[0].ejt_assign_date);
            $('#frmhrm_trn_job_duties #dtpReleaseDate').val(json[0].ejt_release_date);
            $('#frmhrm_trn_job_duties #cboDutyTypeId').val(json[0].ejt_duty_type_id);
            $('#frmhrm_trn_job_duties #txtRemarks').val(json[0].ejt_remarks);
            $('#frmhrm_trn_job_duties #cboStatus').val(json[0].ejt_status);
                      
          }
        }
    });
  });
  // ===============================================
  // ===============  Get Existing Job Details =========
  // ===============================================
  $("#frmhrm_trn_job_duties #cboEmployeeId").change(function(){  
    var url = "assignJobDuties-db-get.php";
    $('#tblEmpJobDuties tbody .dataRow').each(function(){
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
        data:'requestType=loadExistingJobDuties&id='+employeeId,
        async:false,
        success:function(json){
//          $('#frmhrm_trn_job_duties').get(0).reset();
//          $("#frmhrm_trn_job_duties #cboEmployeeId").val($id);
          if(json){ 
            for (var i=0; i<json.length; i++) {
//              ema_id, sye_name, syf_name, ema_account_no, ema_amount, stat_name
              $newRow = $('#tblEmpJobDuties .cloneRow').eq(0).clone();
              $newRow.removeClass('cloneRow').addClass('dataRow');
              $newRow.css('display','table-row');
              $('.duty', $newRow).html(json[i].dty_name);
              $('.assign', $newRow).html(json[i].ejt_assign_date);
              $('.release', $newRow).html(json[i].ejt_release_date);
              $('.type', $newRow).html(json[i].dtt_name);
              $('.status', $newRow).html(json[i].stat_name);
              // Update Link
              $href = $('.action', $newRow).attr('href');
              $href = $href.split('?id=')[0];
              $href = $href.split('?rec_id=')[0]+'?rec_id='+json[i].ejt_id;
              $('.action', $newRow).attr('href', $href);
//              if(json[i].stat_name!=='Completed'){
//                $('.action', $newRow).hide();
//              }
              
              $('#tblEmpJobDuties tbody').append($newRow);
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
    $("#frmhrm_trn_job_duties #cboEmployeeId").val(employeeId);
    $("#frmhrm_trn_job_duties #cboEmployeeId").trigger('change');
  }

});// Document Ready End

function loadSearchCombo($id){
	var url = "assignJobDuties-db-get.php?requestType=loadSearchCombo";
	var httpobj = $.ajax({url:url,async:false})
	$('#frmhrm_trn_job_duties #cboSearch').html(httpobj.responseText);
	$('#frmhrm_trn_job_duties #cboSearch').val($id);
	$('#frmhrm_trn_job_duties #cboSearch').trigger('change');
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

