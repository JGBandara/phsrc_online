
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
  $('#frmhrm_trn_job_status #btnNew').hide();
  $('#frmhrm_trn_job_status #btnList').hide();
  $('#frmhrm_trn_job_status #btnSave').hide();
  $('#frmhrm_trn_job_status #btnPrint').hide();
  $('#frmhrm_trn_job_status #btnDelete').hide();
  $('#frmhrm_trn_job_status #btnApprove').hide();
  $('#frmhrm_trn_job_status #btnReject').hide();
  $('#frmhrm_trn_job_status #cboSearch').prop('disabled', true);
  
  if(intViewx){ // View Permission
 	$('#frmhrm_trn_job_status #cboSearch').prop('disabled', false);
  }
  if(intListx){ // Listing Permission
 	$('#frmhrm_trn_job_status #btnList').show();
  }
  if(intAddx){ // Insert New Permission
 	$('#frmhrm_trn_job_status #btnNew').show();
 	$('#frmhrm_trn_job_status #btnSave').show();
  }
  if(intEditx){ // Update Permission
 	$('#frmhrm_trn_job_status #btnSave').show();
 	$('#frmhrm_trn_job_status #cboSearch').prop('disabled', false);
  }
  if(intDeletex){ // Delete Permission
 	$('#frmhrm_trn_job_status #btnDelete').show();
 	$('#frmhrm_trn_job_status #cboSearch').prop('disabled', false);
  }
  if(intPrintx){ // Delete Permission
 	$('#frmhrm_trn_job_status #btnPrint').show();
 	$('#frmhrm_trn_job_status #cboSearch').prop('disabled', false);
  }

    // =================================
  // Validation
  // ---------------------------------
  $( "#frmhrm_trn_job_status" ).validate( {
      rules: {
        cboEmployeeId:"required",
        cboEmploymentTypeId:"required",
        dtpStartDate: {
                  required: true,
                  dateISO: true,
                },
        cboStatutoryClassificationId:"required",
        cboEmploymentCategoryId:"required",
        txtRemarks: {
                    maxlength: 256
                  },
        cboStatus:"required",
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
  $('#frmhrm_trn_job_status #chkAutoManual').click(function(){
    if($('#frmhrm_trn_job_status #chkAutoManual').eq(0).is(':checked')){
      anStatus = "Auto";
      $('#frmhrm_trn_job_status #ejs_employee_id').val('');
      $('#frmhrm_trn_job_status #ejs_employee_id').prop("readonly",true);
      $('#frmhrm_trn_job_status #ejs_employee_id').rules( "remove" );
    }
    else{
      anStatus = "Manual";
      $('#frmhrm_trn_job_status #ejs_employee_id').val('');
      $('#frmhrm_trn_job_status #ejs_employee_id').prop("readonly",false);
      $('#frmhrm_trn_job_status #ejs_employee_id').rules("add", {
                                                    required: true,
                                                  });
    }
  });
  // --------------------------------------------------------
  //      New Function
  // --------------------------------------------------------
  $("#frmhrm_trn_job_status #btnNew").click(function(){  
    $("#frmhrm_trn_job_status").get(0).reset();
    $("#frmhrm_trn_job_status").validate().resetForm();
    $('#tblEmpJobStatus tbody .dataRow').each(function(){
      $(this).remove();
    });	

  });
  // --------------------------------------------------------
  //      Listing Function
  // --------------------------------------------------------
  $("#frmhrm_trn_job_status #btnList").click(function(){  
    window.location.assign("jobStatusListing.php");
  });
  // --------------------------------------------------------
  //      Print Function
  // --------------------------------------------------------
  $("#frmhrm_trn_job_status #btnPrint").click(function(){  
    if($('#frmhrm_trn_job_status #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmhrm_trn_job_status #cboSearch').val();
      window.location.assign("jobStatusPrint.php?id="+id);
    }
  });
  // --------------------------------------------------------
  //      Close Function
  // --------------------------------------------------------
  $("#frmhrm_trn_job_status #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
  // --------------------------------------------------------
  //      Save Function
  // --------------------------------------------------------
  $("#frmhrm_trn_job_status #btnSave").click(function(){  
    var requestType = '';
    var id = '';
    if($("#frmhrm_trn_job_status").valid()){   // test for validity
      if($('#frmhrm_trn_job_status #cboSearch').val()==''){
        requestType = 'add';	
      }
      else{
        requestType = 'edit';	
        id = $('#frmhrm_trn_job_status #cboSearch').val();
      }
      var url = "jobStatus-db-set.php";
      var obj = $.ajax({
			url:url,
			dataType: "json",
			type:'post', 
			data:$("#frmhrm_trn_job_status").serialize()+'&requestType='+requestType+'&cboSearch='+id+'&anStatus='+anStatus,
			async:false,
			
			success:function(json){
					if(json.type=='pass'){
						$('#frmhrm_trn_job_status').get(0).reset();
                        id = json.id;
						loadSearchCombo(id);
                        $('#frmhrm_trn_job_status #cboSearch').trigger('change');
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
  $("#frmhrm_trn_job_status #btnDelete").click(function(){  
    var requestType = 'delete';
    var id = '';
    if($('#frmhrm_trn_job_status #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmhrm_trn_job_status #cboSearch').val();
    }
    var url = "jobStatus-db-set.php";
    var obj = $.ajax({
          url:url,
          dataType: "json",
          type:'post', 
          data:'requestType='+requestType+'&cboSearch='+id,
          async:false,

          success:function(json){
                  if(json.type=='pass'){
                      $('#frmhrm_trn_job_status').get(0).reset();
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
  $("#frmhrm_trn_job_status #cboSearch").focus(function(){  
    loadSearchCombo($(this).val());
  });
  // ========================================
  // ===============  Search Record =========
  // ========================================
  $("#frmhrm_trn_job_status #cboSearch").change(function(){  
    $("#frmhrm_trn_job_status").validate().resetForm();
    var url = "jobStatus-db-get.php";
    if($(this).val()==''){
        $('#frmhrm_trn_job_status').get(0).reset();return;	
    }
    $id = $(this).val();
    var httpobj = $.ajax({
        url:url,
        dataType:'json',
        data:'requestType=loadDetails&id='+$id,
        async:false,
        success:function(json){
          $('#frmhrm_trn_job_status').get(0).reset();
          $('#frmhrm_trn_job_status #cboSearch').val($id);
          if(json){ 
            $('#frmhrm_trn_job_status #cboEmployeeId').val(json[0].ejs_employee_id);
            $('#frmhrm_trn_job_status #cboEmployeeId').trigger('change');
            $('#frmhrm_trn_job_status #cboEmploymentTypeId').val(json[0].ejs_employment_type_id);
            $('#frmhrm_trn_job_status #dtpStartDate').val(json[0].ejs_start_date);
            $('#frmhrm_trn_job_status #dtpEndDate').val(json[0].ejs_end_date);
            $('#frmhrm_trn_job_status #cboStatutoryClassificationId').val(json[0].ejs_statutory_classification_id);
            $('#frmhrm_trn_job_status #cboEmploymentCategoryId').val(json[0].ejs_employment_category_id);
            $('#frmhrm_trn_job_status #txtRemarks').val(json[0].ejs_remarks);
                      
          }
        }
    });
  });
  // ===============================================
  // ===============  Get Existing Job Status =========
  // ===============================================
  $("#frmhrm_trn_job_status #cboEmployeeId").change(function(){  
    var url = "jobStatus-db-get.php";
    $('#tblEmpJobStatus tbody .dataRow').each(function(){
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
        data:'requestType=loadExistingJobStatus&id='+employeeId,
        async:false,
        success:function(json){
//          $('#frmhrm_trn_job_status').get(0).reset();
//          $("#frmhrm_trn_job_status #cboEmployeeId").val($id);
          if(json){ 
            for (var i=0; i<json.length; i++) {
//              ema_id, sye_name, syf_name, ema_account_no, ema_amount, stat_name
              $newRow = $('#tblEmpJobStatus .cloneRow').eq(0).clone();
              $newRow.removeClass('cloneRow').addClass('dataRow');
              $newRow.css('display','table-row');
              $('.type', $newRow).html(json[i].emt_name);
              $('.start', $newRow).html(json[i].ejs_start_date);
              $('.end', $newRow).html(json[i].ejs_end_date);
              $('.status', $newRow).html(json[i].stat_name);
              // Update Link
              $href = $('.action', $newRow).attr('href');
              $href = $href.split('?id=')[0];
              $href = $href.split('?rec_id=')[0]+'?rec_id='+json[i].ejs_id;
              $('.action', $newRow).attr('href', $href);
              if(json[i].stat_name!=='Active'){
                $('.action', $newRow).hide();
              }
              
              $('#tblEmpJobStatus tbody').append($newRow);
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
    $("#frmhrm_trn_job_status #cboEmployeeId").val(employeeId);
    $("#frmhrm_trn_job_status #cboEmployeeId").trigger('change');
  }

});// Document Ready End

function loadSearchCombo($id){
	var url = "jobStatus-db-get.php?requestType=loadSearchCombo";
	var httpobj = $.ajax({url:url,async:false})
	$('#frmhrm_trn_job_status #cboSearch').html(httpobj.responseText);
	$('#frmhrm_trn_job_status #cboSearch').val($id);
	$('#frmhrm_trn_job_status #cboSearch').trigger('change');
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

