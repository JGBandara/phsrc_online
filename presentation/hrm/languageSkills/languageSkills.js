
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-24
 */
var anStatus = "Auto";
$( document ).ready( function () {
  // =================================
  // Access Control
  // ---------------------------------
  // Reset
  $('#frmhrm_trn_language_skills #btnNew').hide();
  $('#frmhrm_trn_language_skills #btnList').hide();
  $('#frmhrm_trn_language_skills #btnSave').hide();
  $('#frmhrm_trn_language_skills #btnPrint').hide();
  $('#frmhrm_trn_language_skills #btnDelete').hide();
  $('#frmhrm_trn_language_skills #btnApprove').hide();
  $('#frmhrm_trn_language_skills #btnReject').hide();
  $('#frmhrm_trn_language_skills #cboSearch').prop('disabled', true);
  
  if(intViewx){ // View Permission
 	$('#frmhrm_trn_language_skills #cboSearch').prop('disabled', false);
  }
  if(intListx){ // Listing Permission
 	$('#frmhrm_trn_language_skills #btnList').show();
  }
  if(intAddx){ // Insert New Permission
 	$('#frmhrm_trn_language_skills #btnNew').show();
 	$('#frmhrm_trn_language_skills #btnSave').show();
  }
  if(intEditx){ // Update Permission
 	$('#frmhrm_trn_language_skills #btnSave').show();
 	$('#frmhrm_trn_language_skills #cboSearch').prop('disabled', false);
  }
  if(intDeletex){ // Delete Permission
 	$('#frmhrm_trn_language_skills #btnDelete').show();
 	$('#frmhrm_trn_language_skills #cboSearch').prop('disabled', false);
  }
  if(intPrintx){ // Delete Permission
 	$('#frmhrm_trn_language_skills #btnPrint').show();
 	$('#frmhrm_trn_language_skills #cboSearch').prop('disabled', false);
  }

    // =================================
  // Validation
  // ---------------------------------
  $( "#frmhrm_trn_language_skills" ).validate( {
      rules: {
        cboEmployeeId:"required",
        cboLanguageId:"required",
        cboSkillTypeId:"required",
        cboMeritId:"required",
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
  $('#frmhrm_trn_language_skills #chkAutoManual').click(function(){
    if($('#frmhrm_trn_language_skills #chkAutoManual').eq(0).is(':checked')){
      anStatus = "Auto";
      $('#frmhrm_trn_language_skills #lgs_employee_id').val('');
      $('#frmhrm_trn_language_skills #lgs_employee_id').prop("readonly",true);
      $('#frmhrm_trn_language_skills #lgs_employee_id').rules( "remove" );
    }
    else{
      anStatus = "Manual";
      $('#frmhrm_trn_language_skills #lgs_employee_id').val('');
      $('#frmhrm_trn_language_skills #lgs_employee_id').prop("readonly",false);
      $('#frmhrm_trn_language_skills #lgs_employee_id').rules("add", {
                                                    required: true,
                                                  });
    }
  });
  // --------------------------------------------------------
  //      New Function
  // --------------------------------------------------------
  $("#frmhrm_trn_language_skills #btnNew").click(function(){  
    $("#frmhrm_trn_language_skills").get(0).reset();
    $("#frmhrm_trn_language_skills").validate().resetForm();
  });
  // --------------------------------------------------------
  //      Listing Function
  // --------------------------------------------------------
  $("#frmhrm_trn_language_skills #btnList").click(function(){  
    window.location.assign("languageSkillsListing.php");
  });
  // --------------------------------------------------------
  //      Print Function
  // --------------------------------------------------------
  $("#frmhrm_trn_language_skills #btnPrint").click(function(){  
    if($('#frmhrm_trn_language_skills #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmhrm_trn_language_skills #cboSearch').val();
      window.location.assign("languageSkillsPrint.php?id="+id);
    }
  });
  // --------------------------------------------------------
  //      Close Function
  // --------------------------------------------------------
  $("#frmhrm_trn_language_skills #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
  // --------------------------------------------------------
  //      Save Function
  // --------------------------------------------------------
  $("#frmhrm_trn_language_skills #btnSave").click(function(){  
    var requestType = '';
    var id = '';
    if($("#frmhrm_trn_language_skills").valid()){   // test for validity
      if($('#frmhrm_trn_language_skills #cboSearch').val()==''){
        requestType = 'add';	
      }
      else{
        requestType = 'edit';	
        id = $('#frmhrm_trn_language_skills #cboSearch').val();
      }
      var url = "languageSkills-db-set.php";
      var obj = $.ajax({
			url:url,
			dataType: "json",
			type:'post', 
			data:$("#frmhrm_trn_language_skills").serialize()+'&requestType='+requestType+'&cboSearch='+id+'&anStatus='+anStatus,
			async:false,
			
			success:function(json){
					if(json.type=='pass'){
						$('#frmhrm_trn_language_skills').get(0).reset();
                        id = json.id;
						loadSearchCombo(id);
                        $('#frmhrm_trn_language_skills #cboSearch').trigger('change');
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
  $("#frmhrm_trn_language_skills #btnDelete").click(function(){  
    var requestType = 'delete';
    var id = '';
    if($('#frmhrm_trn_language_skills #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmhrm_trn_language_skills #cboSearch').val();
    }
    var url = "languageSkills-db-set.php";
    var obj = $.ajax({
          url:url,
          dataType: "json",
          type:'post', 
          data:$("#frmhrm_trn_language_skills").serialize()+'&requestType='+requestType+'&cboSearch='+id,
          async:false,

          success:function(json){
                  if(json.type=='pass'){
                      $('#frmhrm_trn_language_skills').get(0).reset();
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
  $("#frmhrm_trn_language_skills #cboSearch").focus(function(){  
    loadSearchCombo($(this).val());
  });
  // ========================================
  // ===============  Search Record =========
  // ========================================
  $("#frmhrm_trn_language_skills #cboSearch").change(function(){  
    $("#frmhrm_trn_language_skills").validate().resetForm();
    var url = "languageSkills-db-get.php";
    if($(this).val()==''){
        $('#frmhrm_trn_language_skills').get(0).reset();return;	
    }
    $id = $(this).val();
    var httpobj = $.ajax({
        url:url,
        dataType:'json',
        data:'requestType=loadDetails&id='+$id,
        async:false,
        success:function(json){
          $('#frmhrm_trn_language_skills').get(0).reset();
          $('#frmhrm_trn_language_skills #cboSearch').val($id);
          if(json!=null){
            for(var j=0;j<=json.length-1;j++){
              $('#frmhrm_trn_language_skills #cboEmployeeId').val(json[0].lgs_employee_id);
              $('#frmhrm_trn_language_skills #cboLanguageId').val(json[0].lgs_language_id);
              $('#frmhrm_trn_language_skills .type_'+json[j].lgs_skill_type_id).val(json[j].lgs_merit_id);
//              $('#frmhrm_trn_language_skills #cboMeritId').val(json[0].lgs_merit_id);
              $('#frmhrm_trn_language_skills #txtRemarks').val(json[0].lgs_remarks);
              $('#frmhrm_trn_language_skills #cboStatus').val(json[0].lgs_status);
            }
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
	var url = "languageSkills-db-get.php?requestType=loadSearchCombo";
	var httpobj = $.ajax({url:url,async:false})
	$('#frmhrm_trn_language_skills #cboSearch').html(httpobj.responseText);
	$('#frmhrm_trn_language_skills #cboSearch').val($id);
	$('#frmhrm_trn_language_skills #cboSearch').trigger('change');
}


