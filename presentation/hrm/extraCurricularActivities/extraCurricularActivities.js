
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-23
 */
var anStatus = "Auto";
$( document ).ready( function () {
  // =================================
  // Access Control
  // ---------------------------------
  // Reset
  $('#frmhrm_trn_extra_curricular_activities #btnNew').hide();
  $('#frmhrm_trn_extra_curricular_activities #btnList').hide();
  $('#frmhrm_trn_extra_curricular_activities #btnSave').hide();
  $('#frmhrm_trn_extra_curricular_activities #btnPrint').hide();
  $('#frmhrm_trn_extra_curricular_activities #btnDelete').hide();
  $('#frmhrm_trn_extra_curricular_activities #btnApprove').hide();
  $('#frmhrm_trn_extra_curricular_activities #btnReject').hide();
  $('#frmhrm_trn_extra_curricular_activities #cboSearch').prop('disabled', true);
  
  if(intViewx){ // View Permission
 	$('#frmhrm_trn_extra_curricular_activities #cboSearch').prop('disabled', false);
  }
  if(intListx){ // Listing Permission
 	$('#frmhrm_trn_extra_curricular_activities #btnList').show();
  }
  if(intAddx){ // Insert New Permission
 	$('#frmhrm_trn_extra_curricular_activities #btnNew').show();
 	$('#frmhrm_trn_extra_curricular_activities #btnSave').show();
  }
  if(intEditx){ // Update Permission
 	$('#frmhrm_trn_extra_curricular_activities #btnSave').show();
 	$('#frmhrm_trn_extra_curricular_activities #cboSearch').prop('disabled', false);
  }
  if(intDeletex){ // Delete Permission
 	$('#frmhrm_trn_extra_curricular_activities #btnDelete').show();
 	$('#frmhrm_trn_extra_curricular_activities #cboSearch').prop('disabled', false);
  }
  if(intPrintx){ // Delete Permission
 	$('#frmhrm_trn_extra_curricular_activities #btnPrint').show();
 	$('#frmhrm_trn_extra_curricular_activities #cboSearch').prop('disabled', false);
  }

    // =================================
  // Validation
  // ---------------------------------
  $( "#frmhrm_trn_extra_curricular_activities" ).validate( {
      rules: {
        cboEmployeeId:"required",
        txtCategory: {
                    maxlength: 128
                  },
        txtType: {
                  required: true,
                  maxlength: 128
                },
        txtAchievement: {
                    maxlength: 128
                  },
        txtDate: {
                    maxlength: 16
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
  // --------------------------------------------------------
  //      Auto Number / Manual Number
  // --------------------------------------------------------
  $('#frmhrm_trn_extra_curricular_activities #chkAutoManual').click(function(){
    if($('#frmhrm_trn_extra_curricular_activities #chkAutoManual').eq(0).is(':checked')){
      anStatus = "Auto";
      $('#frmhrm_trn_extra_curricular_activities #eca_employee_id').val('');
      $('#frmhrm_trn_extra_curricular_activities #eca_employee_id').prop("readonly",true);
      $('#frmhrm_trn_extra_curricular_activities #eca_employee_id').rules( "remove" );
    }
    else{
      anStatus = "Manual";
      $('#frmhrm_trn_extra_curricular_activities #eca_employee_id').val('');
      $('#frmhrm_trn_extra_curricular_activities #eca_employee_id').prop("readonly",false);
      $('#frmhrm_trn_extra_curricular_activities #eca_employee_id').rules("add", {
                                                    required: true,
                                                  });
    }
  });
  // --------------------------------------------------------
  //      New Function
  // --------------------------------------------------------
  $("#frmhrm_trn_extra_curricular_activities #btnNew").click(function(){  
    $("#frmhrm_trn_extra_curricular_activities").get(0).reset();
    $("#frmhrm_trn_extra_curricular_activities").validate().resetForm();
  });
  // --------------------------------------------------------
  //      Listing Function
  // --------------------------------------------------------
  $("#frmhrm_trn_extra_curricular_activities #btnList").click(function(){  
    window.location.assign("extraCurricularActivitiesListing.php");
  });
  // --------------------------------------------------------
  //      Print Function
  // --------------------------------------------------------
  $("#frmhrm_trn_extra_curricular_activities #btnPrint").click(function(){  
    if($('#frmhrm_trn_extra_curricular_activities #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmhrm_trn_extra_curricular_activities #cboSearch').val();
      window.location.assign("extraCurricularActivitiesPrint.php?id="+id);
    }
  });
  // --------------------------------------------------------
  //      Close Function
  // --------------------------------------------------------
  $("#frmhrm_trn_extra_curricular_activities #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
  // --------------------------------------------------------
  //      Save Function
  // --------------------------------------------------------
  $("#frmhrm_trn_extra_curricular_activities #btnSave").click(function(){  
    var requestType = '';
    var id = '';
    if($("#frmhrm_trn_extra_curricular_activities").valid()){   // test for validity
      if($('#frmhrm_trn_extra_curricular_activities #cboSearch').val()==''){
        requestType = 'add';	
      }
      else{
        requestType = 'edit';	
        id = $('#frmhrm_trn_extra_curricular_activities #cboSearch').val();
      }
      var url = "extraCurricularActivities-db-set.php";
      var obj = $.ajax({
			url:url,
			dataType: "json",
			type:'post', 
			data:$("#frmhrm_trn_extra_curricular_activities").serialize()+'&requestType='+requestType+'&cboSearch='+id+'&anStatus='+anStatus,
			async:false,
			
			success:function(json){
					if(json.type=='pass'){
						$('#frmhrm_trn_extra_curricular_activities').get(0).reset();
                        id = json.id;
						loadSearchCombo(id);
                        $('#frmhrm_trn_extra_curricular_activities #cboSearch').trigger('change');
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
  $("#frmhrm_trn_extra_curricular_activities #btnDelete").click(function(){  
    var requestType = 'delete';
    var id = '';
    if($('#frmhrm_trn_extra_curricular_activities #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmhrm_trn_extra_curricular_activities #cboSearch').val();
    }
    var url = "extraCurricularActivities-db-set.php";
    var obj = $.ajax({
          url:url,
          dataType: "json",
          type:'post', 
          data:'requestType='+requestType+'&cboSearch='+id,
          async:false,

          success:function(json){
                  if(json.type=='pass'){
                      $('#frmhrm_trn_extra_curricular_activities').get(0).reset();
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
  $("#frmhrm_trn_extra_curricular_activities #cboSearch").focus(function(){  
    loadSearchCombo($(this).val());
  });
  // ========================================
  // ===============  Search Record =========
  // ========================================
  $("#frmhrm_trn_extra_curricular_activities #cboSearch").change(function(){  
    $("#frmhrm_trn_extra_curricular_activities").validate().resetForm();
    var url = "extraCurricularActivities-db-get.php";
    if($(this).val()==''){
        $('#frmhrm_trn_extra_curricular_activities').get(0).reset();return;	
    }
    $id = $(this).val();
    var httpobj = $.ajax({
        url:url,
        dataType:'json',
        data:'requestType=loadDetails&id='+$id,
        async:false,
        success:function(json){
          $('#frmhrm_trn_extra_curricular_activities').get(0).reset();
          $('#frmhrm_trn_extra_curricular_activities #cboSearch').val($id);
          if(json){ 
            $('#frmhrm_trn_extra_curricular_activities #cboEmployeeId').val(json[0].eca_employee_id);
            $('#frmhrm_trn_extra_curricular_activities #txtCategory').val(json[0].eca_category);
            $('#frmhrm_trn_extra_curricular_activities #txtType').val(json[0].eca_type);
            $('#frmhrm_trn_extra_curricular_activities #txtAchievement').val(json[0].eca_achievement);
            $('#frmhrm_trn_extra_curricular_activities #txtDate').val(json[0].eca_date);
            $('#frmhrm_trn_extra_curricular_activities #txtRemarks').val(json[0].eca_remarks);
            $('#frmhrm_trn_extra_curricular_activities #cboStatus').val(json[0].eca_status);
            if(json[0].eca_is_deleted=='1')
              $('#frmhrm_trn_extra_curricular_activities #optIsDeleted').prop('checked',true);
            else
              $('#frmhrm_trn_extra_curricular_activities #optIsDeleted').prop('checked',false); 
            $('#frmhrm_trn_extra_curricular_activities input[name="optIsDeleted"][value="'+json[0].eca_is_deleted+'"]').prop('checked', true);

            $('#frmhrm_trn_extra_curricular_activities #cboCompanyId').val(json[0].eca_company_id);
            $('#frmhrm_trn_extra_curricular_activities #cboCreatedBy').val(json[0].eca_created_by);
            $('#frmhrm_trn_extra_curricular_activities #cboCreatedOn').val(json[0].eca_created_on);
            $('#frmhrm_trn_extra_curricular_activities #cboLastModifiedBy').val(json[0].eca_last_modified_by);
            $('#frmhrm_trn_extra_curricular_activities #cboLastModifiedOn').val(json[0].eca_last_modified_on);
            $('#frmhrm_trn_extra_curricular_activities #cboDeletedBy').val(json[0].eca_deleted_by);
            $('#frmhrm_trn_extra_curricular_activities #cboDeletedOn').val(json[0].eca_deleted_on);
                      
          }
        }
    });
  });
  
  // =================================
  // Load Search Dropdown content
  // ---------------------------------
  loadSearchCombo(searchId);

});// Document Ready End

function loadSearchCombo($id){
	var url = "extraCurricularActivities-db-get.php?requestType=loadSearchCombo";
	var httpobj = $.ajax({url:url,async:false})
	$('#frmhrm_trn_extra_curricular_activities #cboSearch').html(httpobj.responseText);
	$('#frmhrm_trn_extra_curricular_activities #cboSearch').val($id);
	$('#frmhrm_trn_extra_curricular_activities #cboSearch').trigger('change');
}


