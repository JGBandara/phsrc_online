
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-10
 */
var anStatus = "Auto";
$( document ).ready( function () {
  // =================================
  // Access Control
  // ---------------------------------
  // Reset
  $('#frmhrm_employee_dependence #btnNew').hide();
  $('#frmhrm_employee_dependence #btnList').hide();
  $('#frmhrm_employee_dependence #btnSave').hide();
  $('#frmhrm_employee_dependence #btnPrint').hide();
  $('#frmhrm_employee_dependence #btnDelete').hide();
  $('#frmhrm_employee_dependence #btnApprove').hide();
  $('#frmhrm_employee_dependence #btnReject').hide();
  $('#frmhrm_employee_dependence #cboSearch').prop('disabled', true);
  
  if(intViewx){ // View Permission
 	$('#frmhrm_employee_dependence #cboSearch').prop('disabled', false);
  }
  if(intListx){ // Listing Permission
 	$('#frmhrm_employee_dependence #btnList').show();
  }
  if(intAddx){ // Insert New Permission
 	$('#frmhrm_employee_dependence #btnNew').show();
 	$('#frmhrm_employee_dependence #btnSave').show();
  }
  if(intEditx){ // Update Permission
 	$('#frmhrm_employee_dependence #btnSave').show();
 	$('#frmhrm_employee_dependence #cboSearch').prop('disabled', false);
  }
  if(intDeletex){ // Delete Permission
 	$('#frmhrm_employee_dependence #btnDelete').show();
 	$('#frmhrm_employee_dependence #cboSearch').prop('disabled', false);
  }
  if(intPrintx){ // Delete Permission
 	$('#frmhrm_employee_dependence #btnPrint').show();
 	$('#frmhrm_employee_dependence #cboSearch').prop('disabled', false);
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
  $( "#frmhrm_employee_dependence" ).validate( {
      rules: {
        cboEmployeeId:"required",
        txtFullName: {
                  required: true,
                  maxlength: 128
                },
        txtNicNo: {
                  maxlength: 32
                },
        txtTelephone: {
                  maxlength: 32,
                  tel: true,
                },
        txtWorkingAddress: {
                  maxlength: 256
                },
        txtWorkingTelephone: {
                  maxlength: 32,
                  tel: true,
                },
        txtPermanentAddress: {
                  maxlength: 256
                },
        txtMobile: {
                  maxlength: 32,
                  tel: true,
                },
        txtRemarks: {
                    maxlength: 256
                  },
        cboStatus:"required",
        
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
  $('#frmhrm_employee_dependence #chkAutoManual').click(function(){
    if($('#frmhrm_employee_dependence #chkAutoManual').eq(0).is(':checked')){
      anStatus = "Auto";
      $('#frmhrm_employee_dependence #emd_employee_id').val('');
      $('#frmhrm_employee_dependence #emd_employee_id').prop("readonly",true);
      $('#frmhrm_employee_dependence #emd_employee_id').rules( "remove" );
    }
    else{
      anStatus = "Manual";
      $('#frmhrm_employee_dependence #emd_employee_id').val('');
      $('#frmhrm_employee_dependence #emd_employee_id').prop("readonly",false);
      $('#frmhrm_employee_dependence #emd_employee_id').rules("add", {
                                                    required: true,
                                                  });
    }
  });
  // --------------------------------------------------------
  //      New Function
  // --------------------------------------------------------
  $("#frmhrm_employee_dependence #btnNew").click(function(){  
    $("#frmhrm_employee_dependence").get(0).reset();
    $("#frmhrm_employee_dependence").validate().resetForm();
  });
  // --------------------------------------------------------
  //      Listing Function
  // --------------------------------------------------------
  $("#frmhrm_employee_dependence #btnList").click(function(){  
    window.location.assign("employeeDependenceListing.php");
  });
  // --------------------------------------------------------
  //      Print Function
  // --------------------------------------------------------
  $("#frmhrm_employee_dependence #btnPrint").click(function(){  
    if($('#frmhrm_employee_dependence #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmhrm_employee_dependence #cboSearch').val();
      window.location.assign("employeeDependencePrint.php?id="+id);
    }
  });
  // --------------------------------------------------------
  //      Close Function
  // --------------------------------------------------------
  $("#frmhrm_employee_dependence #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
  // --------------------------------------------------------
  //      Save Function
  // --------------------------------------------------------
  $("#frmhrm_employee_dependence #btnSave").click(function(){  
    var requestType = '';
    var id = '';
    if($("#frmhrm_employee_dependence").valid()){   // test for validity
      if($('#frmhrm_employee_dependence #cboSearch').val()==''){
        requestType = 'add';	
      }
      else{
        requestType = 'edit';	
        id = $('#frmhrm_employee_dependence #cboSearch').val();
      }
      var url = "employeeDependence-db-set.php";
      var obj = $.ajax({
			url:url,
			dataType: "json",
			type:'post', 
			data:$("#frmhrm_employee_dependence").serialize()+'&requestType='+requestType+'&cboSearch='+id+'&anStatus='+anStatus,
			async:false,
			
			success:function(json){
					if(json.type=='pass'){
						$('#frmhrm_employee_dependence').get(0).reset();
                        id = json.id;
						loadSearchCombo(id);
                        $('#frmhrm_employee_dependence #cboSearch').trigger('change');
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
  $("#frmhrm_employee_dependence #btnDelete").click(function(){  
    var requestType = 'delete';
    var id = '';
    if($('#frmhrm_employee_dependence #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmhrm_employee_dependence #cboSearch').val();
    }
    var url = "employeeDependence-db-set.php";
    var obj = $.ajax({
          url:url,
          dataType: "json",
          type:'post', 
          data:'requestType='+requestType+'&cboSearch='+id,
          async:false,

          success:function(json){
                  if(json.type=='pass'){
                      $('#frmhrm_employee_dependence').get(0).reset();
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
  $("#frmhrm_employee_dependence #cboSearch").focus(function(){  
    loadSearchCombo($(this).val());
  });
  // ========================================
  // ===============  Search Record =========
  // ========================================
  $("#frmhrm_employee_dependence #cboSearch").change(function(){  
    $("#frmhrm_employee_dependence").validate().resetForm();
    $('#tblEmpExistingDependence tbody .dataRow').each(function(){
      $(this).remove();
    });	
    if($(this).val()==''){
        $('#frmhrm_employee_dependence').get(0).reset();return;	
    }
    var url = "employeeDependence-db-get.php";
    $id = $(this).val();
    var httpobj = $.ajax({
        url:url,
        dataType:'json',
        data:'requestType=loadDetails&id='+$id,
        async:false,
        success:function(json){
          $('#frmhrm_employee_dependence').get(0).reset();
          $('#frmhrm_employee_dependence #cboSearch').val($id);
          if(json){ 
            $('#frmhrm_employee_dependence #cboEmployeeId').val(json[0].emd_employee_id);
            $("#frmhrm_employee_dependence #cboEmployeeId").trigger('change');
            $('#frmhrm_employee_dependence #txtFullName').val(json[0].emd_full_name);
            $('#frmhrm_employee_dependence #dtpDateOfBirth').val(json[0].emd_date_of_birth);
            $('#frmhrm_employee_dependence #txtNicNo').val(json[0].emd_nic_no);
            $('#frmhrm_employee_dependence #txtTelephone').val(json[0].emd_telephone);
            if(json[0].emd_entitled_death_donation=='1')
              $('#frmhrm_employee_dependence #optEntitledDeathDonation').prop('checked',true);
            else
              $('#frmhrm_employee_dependence #optEntitledDeathDonation').prop('checked',false); 

            if(json[0].emd_entitled_medical_benifits=='1')
              $('#frmhrm_employee_dependence #optEntitledMedicalBenifits').prop('checked',true);
            else
              $('#frmhrm_employee_dependence #optEntitledMedicalBenifits').prop('checked',false); 

            if(json[0].emd_provident_fund_nominee=='1')
              $('#frmhrm_employee_dependence #optProvidentFundNominee').prop('checked',true);
            else
              $('#frmhrm_employee_dependence #optProvidentFundNominee').prop('checked',false); 

            if(json[0].emd_living=='1')
              $('#frmhrm_employee_dependence #optLiving').prop('checked',true);
            else
              $('#frmhrm_employee_dependence #optLiving').prop('checked',false); 

            $('#frmhrm_employee_dependence #optWorkType').val(json[0].emd_work_type);
            $('#frmhrm_employee_dependence #txtWorkingAddress').val(json[0].emd_working_address);
            $('#frmhrm_employee_dependence #txtWorkingTelephone').val(json[0].emd_working_telephone);
            $('#frmhrm_employee_dependence #txtPermanentAddress').val(json[0].emd_permanent_address);
            $('#frmhrm_employee_dependence #txtMobile').val(json[0].emd_mobile);
            if(json[0].emd_same_office=='1')
              $('#frmhrm_employee_dependence #optSameOffice').prop('checked',true);
            else
              $('#frmhrm_employee_dependence #optSameOffice').prop('checked',false); 

            $('#frmhrm_employee_dependence #cboMaritalStatusId').val(json[0].emd_marital_status_id);
            $('#frmhrm_employee_dependence #txtRemarks').val(json[0].emd_remarks);
            $('#frmhrm_employee_dependence #cboStatus').val(json[0].emd_status);
                      
          }
        }
    });
  });
  // ===============================================
  // ===============  Get Existing Account =========
  // ===============================================
  $("#frmhrm_employee_dependence #cboEmployeeId").change(function(){  
    var url = "employeeDependence-db-get.php";
    $('#tblEmpExistingDependence tbody .dataRow').each(function(){
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
        data:'requestType=loadExistingDependence&id='+employeeId,
        async:false,
        success:function(json){
          if(json){ 
            for (var i=0; i<json.length; i++) {
//              emd_id, emd_full_name, emd_date_of_birth, emd_telephone, stat_name
              $newRow = $('#tblEmpExistingDependence .cloneRow').eq(0).clone();
              $newRow.removeClass('cloneRow').addClass('dataRow');
              $newRow.css('display','table-row');
              $('.name', $newRow).html(json[i].emd_full_name);
              $('.dob', $newRow).html(json[i].emd_date_of_birth);
              $('.telephone', $newRow).html(json[i].emd_telephone);
              $('.status', $newRow).html(json[i].stat_name);
              // Update Link
              $href = $('.action', $newRow).attr('href');
              $href = $href.split('?id=')[0];
              $href = $href.split('?rec_id=')[0]+'?rec_id='+json[i].emd_id;
              $('.action', $newRow).attr('href', $href);
              
              $('#tblEmpExistingDependence tbody').append($newRow);
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
    $("#frmhrm_employee_dependence #cboEmployeeId").val(employeeId);
    $("#frmhrm_employee_dependence #cboEmployeeId").trigger('change');
  }

});// Document Ready End

function loadSearchCombo($id){
	var url = "employeeDependence-db-get.php?requestType=loadSearchCombo";
	var httpobj = $.ajax({url:url,async:false})
	$('#frmhrm_employee_dependence #cboSearch').html(httpobj.responseText);
	$('#frmhrm_employee_dependence #cboSearch').val($id);
	$('#frmhrm_employee_dependence #cboSearch').trigger('change');
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


