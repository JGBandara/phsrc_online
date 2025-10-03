
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-11
 */
var anStatus = "Auto";
$( document ).ready( function () {
  // =================================
  // Access Control
  // ---------------------------------
  // Reset
  $('#frmhrm_designation #btnNew').hide();
  $('#frmhrm_designation #btnList').hide();
  $('#frmhrm_designation #btnSave').hide();
  $('#frmhrm_designation #btnPrint').hide();
  $('#frmhrm_designation #btnDelete').hide();
  $('#frmhrm_designation #btnApprove').hide();
  $('#frmhrm_designation #btnReject').hide();
  $('#frmhrm_designation #cboSearch').prop('disabled', true);
  
  if(intViewx){ // View Permission
 	$('#frmhrm_designation #cboSearch').prop('disabled', false);
  }
  if(intListx){ // Listing Permission
 	$('#frmhrm_designation #btnList').show();
  }
  if(intAddx){ // Insert New Permission
 	$('#frmhrm_designation #btnNew').show();
 	$('#frmhrm_designation #btnSave').show();
  }
  if(intEditx){ // Update Permission
 	$('#frmhrm_designation #btnSave').show();
 	$('#frmhrm_designation #cboSearch').prop('disabled', false);
  }
  if(intDeletex){ // Delete Permission
 	$('#frmhrm_designation #btnDelete').show();
 	$('#frmhrm_designation #cboSearch').prop('disabled', false);
  }
  if(intPrintx){ // Delete Permission
 	$('#frmhrm_designation #btnPrint').show();
 	$('#frmhrm_designation #cboSearch').prop('disabled', false);
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
  $( "#frmhrm_designation" ).validate( {
      rules: {
        txtName: {
                  required: true,
                  maxlength: 128
                },
        txtCode: {
                  required: true,
                  maxlength: 32
                },
        optRank:"required",
        txtSalaryCode: {
                    maxlength: 32
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
  // --------------------------------------------------------
  //      Auto Number / Manual Number
  // --------------------------------------------------------
  $('#frmhrm_designation #chkAutoManual').click(function(){
    if($('#frmhrm_designation #chkAutoManual').eq(0).is(':checked')){
      anStatus = "Auto";
      $('#frmhrm_designation #dsg_name').val('');
      $('#frmhrm_designation #dsg_name').prop("readonly",true);
      $('#frmhrm_designation #dsg_name').rules( "remove" );
    }
    else{
      anStatus = "Manual";
      $('#frmhrm_designation #dsg_name').val('');
      $('#frmhrm_designation #dsg_name').prop("readonly",false);
      $('#frmhrm_designation #dsg_name').rules("add", {
                                                    required: true,
                                                  });
    }
  });
  // --------------------------------------------------------
  //      New Function
  // --------------------------------------------------------
  $("#frmhrm_designation #btnNew").click(function(){  
    $("#frmhrm_designation").get(0).reset();
    $("#frmhrm_designation").validate().resetForm();
  });
  // --------------------------------------------------------
  //      Listing Function
  // --------------------------------------------------------
  $("#frmhrm_designation #btnList").click(function(){  
    window.location.assign("designationListing.php");
  });
  // --------------------------------------------------------
  //      Print Function
  // --------------------------------------------------------
  $("#frmhrm_designation #btnPrint").click(function(){  
    if($('#frmhrm_designation #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmhrm_designation #cboSearch').val();
      window.location.assign("designationPrint.php?id="+id);
    }
  });
  // --------------------------------------------------------
  //      Close Function
  // --------------------------------------------------------
  $("#frmhrm_designation #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
  // --------------------------------------------------------
  //      Save Function
  // --------------------------------------------------------
  $("#frmhrm_designation #btnSave").click(function(){  
    var requestType = '';
    var id = '';
    if($("#frmhrm_designation").valid()){   // test for validity
      if($('#frmhrm_designation #cboSearch').val()==''){
        requestType = 'add';	
      }
      else{
        requestType = 'edit';	
        id = $('#frmhrm_designation #cboSearch').val();
      }
      var url = "designation-db-set.php";
      var obj = $.ajax({
			url:url,
			dataType: "json",
			type:'post', 
			data:$("#frmhrm_designation").serialize()+'&requestType='+requestType+'&cboSearch='+id+'&anStatus='+anStatus,
			async:false,
			
			success:function(json){
					if(json.type=='pass'){
						$('#frmhrm_designation').get(0).reset();
                        id = json.id;
						loadSearchCombo(id);
                        $('#frmhrm_designation #cboSearch').trigger('change');
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
  $("#frmhrm_designation #btnDelete").click(function(){  
    var requestType = 'delete';
    var id = '';
    if($('#frmhrm_designation #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmhrm_designation #cboSearch').val();
    }
    var url = "designation-db-set.php";
    var obj = $.ajax({
          url:url,
          dataType: "json",
          type:'post', 
          data:'requestType='+requestType+'&cboSearch='+id,
          async:false,

          success:function(json){
                  if(json.type=='pass'){
                      $('#frmhrm_designation').get(0).reset();
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
  $("#frmhrm_designation #cboSearch").focus(function(){  
    loadSearchCombo($(this).val());
  });
  // ========================================
  // ===============  Search Record =========
  // ========================================
  $("#frmhrm_designation #cboSearch").change(function(){  
    $("#frmhrm_designation").validate().resetForm();
    var url = "designation-db-get.php";
    if($(this).val()==''){
        $('#frmhrm_designation').get(0).reset();return;	
    }
    $id = $(this).val();
    var httpobj = $.ajax({
        url:url,
        dataType:'json',
        data:'requestType=loadDetails&id='+$id,
        async:false,
        success:function(json){
          $('#frmhrm_designation').get(0).reset();
          $('#frmhrm_designation #cboSearch').val($id);
          if(json){ 
            $('#frmhrm_designation #txtName').val(json[0].dsg_name);
            $('#frmhrm_designation #txtCode').val(json[0].dsg_code);
            $('#frmhrm_designation #txtSalaryCode').val(json[0].dsg_salary_code);
            if(json[0].dsg_ot_allowed=='1')
              $('#frmhrm_designation #optOtAllowed').prop('checked',true);
            else
              $('#frmhrm_designation #optOtAllowed').prop('checked',false); 

            if(json[0].dsg_early_ot_allowed=='1')
              $('#frmhrm_designation #optEarlyOtAllowed').prop('checked',true);
            else
              $('#frmhrm_designation #optEarlyOtAllowed').prop('checked',false); 

            $('#frmhrm_designation #cboCadre').val(json[0].dsg_cadre);
            $('#frmhrm_designation #optRank').val(json[0].dsg_rank);

            $('#frmhrm_designation #txtRemarks').val(json[0].dsg_remarks);
            $('#frmhrm_designation #cboStatus').val(json[0].dsg_status);
                      
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
	var url = "designation-db-get.php?requestType=loadSearchCombo";
	var httpobj = $.ajax({url:url,async:false})
	$('#frmhrm_designation #cboSearch').html(httpobj.responseText);
	$('#frmhrm_designation #cboSearch').val($id);
	$('#frmhrm_designation #cboSearch').trigger('change');
}


