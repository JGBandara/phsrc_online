
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-09
 */
var anStatus = "Auto";
$( document ).ready( function () {
  // =================================
  // Access Control
  // ---------------------------------
  // Reset
  $('#frmhrm_employee_bank_account #btnNew').hide();
  $('#frmhrm_employee_bank_account #btnList').hide();
  $('#frmhrm_employee_bank_account #btnSave').hide();
  $('#frmhrm_employee_bank_account #btnPrint').hide();
  $('#frmhrm_employee_bank_account #btnDelete').hide();
  $('#frmhrm_employee_bank_account #btnApprove').hide();
  $('#frmhrm_employee_bank_account #btnReject').hide();
  $('#frmhrm_employee_bank_account #cboSearch').prop('disabled', true);
  
  if(intViewx){ // View Permission
 	$('#frmhrm_employee_bank_account #cboSearch').prop('disabled', false);
  }
  if(intListx){ // Listing Permission
 	$('#frmhrm_employee_bank_account #btnList').show();
  }
  if(intAddx){ // Insert New Permission
 	$('#frmhrm_employee_bank_account #btnNew').show();
 	$('#frmhrm_employee_bank_account #btnSave').show();
  }
  if(intEditx){ // Update Permission
 	$('#frmhrm_employee_bank_account #btnSave').show();
 	$('#frmhrm_employee_bank_account #cboSearch').prop('disabled', false);
  }
  if(intDeletex){ // Delete Permission
 	$('#frmhrm_employee_bank_account #btnDelete').show();
 	$('#frmhrm_employee_bank_account #cboSearch').prop('disabled', false);
  }
  if(intPrintx){ // Delete Permission
 	$('#frmhrm_employee_bank_account #btnPrint').show();
 	$('#frmhrm_employee_bank_account #cboSearch').prop('disabled', false);
  }

  // =================================
  // Color Picker
  // ---------------------------------
  $('#txtCssColor').colorpicker();
  $('#txtCssColor').on('colorpickerChange', function(event) {
    $(this).css('background-color', event.color.toString());
  });
  
  // =================================
  // Validation
  // ---------------------------------
  $( "#frmhrm_employee_bank_account" ).validate( {
      rules: {
        cboEmployeeId:"required",
        cboBankId:"required",
        cboBranchId:"required",
        txtAccountNo: {
                  required: true,
                  maxlength: 32
                },
        txtAccountHolder: {
                  required: true,
                  maxlength: 128
                },
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
  $('#frmhrm_employee_bank_account #chkAutoManual').click(function(){
    if($('#frmhrm_employee_bank_account #chkAutoManual').eq(0).is(':checked')){
      anStatus = "Auto";
      $('#frmhrm_employee_bank_account #ema_employee_id').val('');
      $('#frmhrm_employee_bank_account #ema_employee_id').prop("readonly",true);
      $('#frmhrm_employee_bank_account #ema_employee_id').rules( "remove" );
    }
    else{
      anStatus = "Manual";
      $('#frmhrm_employee_bank_account #ema_employee_id').val('');
      $('#frmhrm_employee_bank_account #ema_employee_id').prop("readonly",false);
      $('#frmhrm_employee_bank_account #ema_employee_id').rules("add", {
                                                    required: true,
                                                  });
    }
  });
  // --------------------------------------------------------
  //      New Function
  // --------------------------------------------------------
  $("#frmhrm_employee_bank_account #btnNew").click(function(){  
    $("#frmhrm_employee_bank_account").get(0).reset();
    $("#frmhrm_employee_bank_account").validate().resetForm();
  });
  // --------------------------------------------------------
  //      Listing Function
  // --------------------------------------------------------
  $("#frmhrm_employee_bank_account #btnList").click(function(){  
    window.location.assign("employeeBankAccountListing.php");
  });
  // --------------------------------------------------------
  //      Print Function
  // --------------------------------------------------------
  $("#frmhrm_employee_bank_account #btnPrint").click(function(){  
    if($('#frmhrm_employee_bank_account #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmhrm_employee_bank_account #cboSearch').val();
      window.location.assign("employeeBankAccountPrint.php?id="+id);
    }
  });
  // --------------------------------------------------------
  //      Close Function
  // --------------------------------------------------------
  $("#frmhrm_employee_bank_account #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
  // --------------------------------------------------------
  //      Get Branch List
  // --------------------------------------------------------
  $("#frmhrm_employee_bank_account #cboBankId").change(function(){  
	var url = "employeeBankAccount-db-get.php?requestType=loadBranchCombo&id="+$(this).val();
	var httpobj = $.ajax({url:url,async:false})
	$('#frmhrm_employee_bank_account #cboBranchId').html(httpobj.responseText);
  });
  // --------------------------------------------------------
  //      Save Function
  // --------------------------------------------------------
  $("#frmhrm_employee_bank_account #btnSave").click(function(){  
    var requestType = '';
    var id = '';
    if($("#frmhrm_employee_bank_account").valid()){   // test for validity
      if($('#frmhrm_employee_bank_account #cboSearch').val()==''){
        requestType = 'add';	
      }
      else{
        requestType = 'edit';	
        id = $('#frmhrm_employee_bank_account #cboSearch').val();
      }
      var url = "employeeBankAccount-db-set.php";
      var obj = $.ajax({
			url:url,
			dataType: "json",
			type:'post', 
			data:$("#frmhrm_employee_bank_account").serialize()+'&requestType='+requestType+'&cboSearch='+id+'&anStatus='+anStatus,
			async:false,
			
			success:function(json){
					if(json.type=='pass'){
						$('#frmhrm_employee_bank_account').get(0).reset();
                        id = json.id;
						loadSearchCombo(id);
                        $('#frmhrm_employee_bank_account #cboSearch').trigger('change');
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
  $("#frmhrm_employee_bank_account #btnDelete").click(function(){  
    var requestType = 'delete';
    var id = '';
    if($('#frmhrm_employee_bank_account #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmhrm_employee_bank_account #cboSearch').val();
    }
    var url = "employeeBankAccount-db-set.php";
    var obj = $.ajax({
          url:url,
          dataType: "json",
          type:'post', 
          data:'requestType='+requestType+'&cboSearch='+id,
          async:false,

          success:function(json){
                  if(json.type=='pass'){
                      $('#frmhrm_employee_bank_account').get(0).reset();
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
  $("#frmhrm_employee_bank_account #cboSearch").focus(function(){  
    loadSearchCombo($(this).val());
  });
  // ========================================
  // ===============  Search Record =========
  // ========================================
  $("#frmhrm_employee_bank_account #cboSearch").change(function(){  
    $("#frmhrm_employee_bank_account").validate().resetForm();
    $('#tblEmpExistingBankAcc tbody .dataRow').each(function(){
      $(this).remove();
    });	
    var url = "employeeBankAccount-db-get.php";
    if($(this).val()==''){
        $('#frmhrm_employee_bank_account').get(0).reset();return;	
    }
    $id = $(this).val();
    var httpobj = $.ajax({
        url:url,
        dataType:'json',
        data:'requestType=loadDetails&id='+$id,
        async:false,
        success:function(json){
          $('#frmhrm_employee_bank_account').get(0).reset();
          $("#frmhrm_employee_bank_account #cboSearch").val($id);
          if(json){ 
            $('#frmhrm_employee_bank_account #cboEmployeeId').val(json[0].ema_employee_id);
            $('#frmhrm_employee_bank_account #cboEmployeeId').trigger('change');
            $('#frmhrm_employee_bank_account #cboBankId').val(json[0].ema_bank_id);
            $('#frmhrm_employee_bank_account #cboBankId').trigger('change');
            $('#frmhrm_employee_bank_account #cboBranchId').val(json[0].ema_branch_id);
            if(json[0].ema_account_type=='1')
              $('#frmhrm_employee_bank_account #optAccountType').prop('checked',true);
            else
              $('#frmhrm_employee_bank_account #optAccountType').prop('checked',false); 
            $('#frmhrm_employee_bank_account input[name="optAccountType"][value="'+json[0].ema_account_type+'"]').prop('checked', true);

            $('#frmhrm_employee_bank_account #txtAccountNo').val(json[0].ema_account_no);
            $('#frmhrm_employee_bank_account #txtAccountHolder').val(json[0].ema_account_holder);
            $('#frmhrm_employee_bank_account #txtAmount').val(json[0].ema_amount);
            $('#frmhrm_employee_bank_account #txtRemarks').val(json[0].ema_remarks);
            $('#frmhrm_employee_bank_account #cboStatus').val(json[0].ema_status);
                      
          }
        }
    });
  });
  // ===============================================
  // ===============  Get Existing Account =========
  // ===============================================
  $("#frmhrm_employee_bank_account #cboEmployeeId").change(function(){  
    var url = "employeeBankAccount-db-get.php";
    $('#tblEmpExistingBankAcc tbody .dataRow').each(function(){
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
        data:'requestType=loadExistingBankAccounts&id='+employeeId,
        async:false,
        success:function(json){
//          $('#frmhrm_employee_bank_account').get(0).reset();
//          $("#frmhrm_employee_bank_account #cboEmployeeId").val($id);
          if(json){ 
            for (var i=0; i<json.length; i++) {
//              ema_id, sye_name, syf_name, ema_account_no, ema_amount, stat_name
              $newRow = $('#tblEmpExistingBankAcc .cloneRow').eq(0).clone();
              $newRow.removeClass('cloneRow').addClass('dataRow');
              $newRow.css('display','table-row');
              $('.bank', $newRow).html(json[i].sye_name);
              $('.branch', $newRow).html(json[i].syf_name);
              $('.account', $newRow).html(json[i].ema_account_no);
              $('.amount', $newRow).html(json[i].ema_amount);
              $('.status', $newRow).html(json[i].stat_name);
              // Update Link
              $href = $('.action', $newRow).attr('href');
              $href = $href.split('?id=')[0];
              $href = $href.split('?rec_id=')[0]+'?rec_id='+json[i].ema_id;
              $('.action', $newRow).attr('href', $href);
              
              $('#tblEmpExistingBankAcc tbody').append($newRow);
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
    $("#frmhrm_employee_bank_account #cboEmployeeId").val(employeeId);
    $("#frmhrm_employee_bank_account #cboEmployeeId").trigger('change');
  }

});// Document Ready End

function loadSearchCombo($id){
	var url = "employeeBankAccount-db-get.php?requestType=loadSearchCombo";
	var httpobj = $.ajax({url:url,async:false})
	$('#frmhrm_employee_bank_account #cboSearch').html(httpobj.responseText);
	$('#frmhrm_employee_bank_account #cboSearch').val($id);
	$('#frmhrm_employee_bank_account #cboSearch').trigger('change');
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


