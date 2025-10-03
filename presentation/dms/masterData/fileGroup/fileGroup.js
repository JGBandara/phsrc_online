
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
  $('#frmdms_file_group #btnNew').hide();
  $('#frmdms_file_group #btnList').hide();
  $('#frmdms_file_group #btnSave').hide();
  $('#frmdms_file_group #btnPrint').hide();
  $('#frmdms_file_group #btnDelete').hide();
  $('#frmdms_file_group #btnApprove').hide();
  $('#frmdms_file_group #btnReject').hide();
  $('#frmdms_file_group #cboSearch').prop('disabled', true);
  
  if(intViewx){ // View Permission
 	$('#frmdms_file_group #cboSearch').prop('disabled', false);
  }
  if(intListx){ // Listing Permission
 	$('#frmdms_file_group #btnList').show();
  }
  if(intAddx){ // Insert New Permission
 	$('#frmdms_file_group #btnNew').show();
 	$('#frmdms_file_group #btnSave').show();
  }
  if(intEditx){ // Update Permission
 	$('#frmdms_file_group #btnSave').show();
 	$('#frmdms_file_group #cboSearch').prop('disabled', false);
  }
  if(intDeletex){ // Delete Permission
 	$('#frmdms_file_group #btnDelete').show();
 	$('#frmdms_file_group #cboSearch').prop('disabled', false);
  }
  if(intPrintx){ // Delete Permission
 	$('#frmdms_file_group #btnPrint').show();
 	$('#frmdms_file_group #cboSearch').prop('disabled', false);
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
  $( "#frmdms_file_group" ).validate( {
      rules: {
        txtName: {
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
  // --------------------------------------------------------
  //      Auto Number / Manual Number
  // --------------------------------------------------------
  $('#frmdms_file_group #chkAutoManual').click(function(){
    if($('#frmdms_file_group #chkAutoManual').eq(0).is(':checked')){
      anStatus = "Auto";
      $('#frmdms_file_group #dfg_name').val('');
      $('#frmdms_file_group #dfg_name').prop("readonly",true);
      $('#frmdms_file_group #dfg_name').rules( "remove" );
    }
    else{
      anStatus = "Manual";
      $('#frmdms_file_group #dfg_name').val('');
      $('#frmdms_file_group #dfg_name').prop("readonly",false);
      $('#frmdms_file_group #dfg_name').rules("add", {
                                                    required: true,
                                                  });
    }
  });
  // --------------------------------------------------------
  //      New Function
  // --------------------------------------------------------
  $("#frmdms_file_group #btnNew").click(function(){  
    $("#frmdms_file_group").get(0).reset();
    $("#frmdms_file_group").validate().resetForm();
  });
  // --------------------------------------------------------
  //      Listing Function
  // --------------------------------------------------------
  $("#frmdms_file_group #btnList").click(function(){  
    window.location.assign("fileGroupListing.php");
  });
  // --------------------------------------------------------
  //      Print Function
  // --------------------------------------------------------
  $("#frmdms_file_group #btnPrint").click(function(){  
    if($('#frmdms_file_group #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmdms_file_group #cboSearch').val();
      window.location.assign("fileGroupPrint.php?id="+id);
    }
  });
  // --------------------------------------------------------
  //      Close Function
  // --------------------------------------------------------
  $("#frmdms_file_group #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
  // --------------------------------------------------------
  //      Save Function
  // --------------------------------------------------------
  $("#frmdms_file_group #btnSave").click(function(){  
    var requestType = '';
    var id = '';
    if($("#frmdms_file_group").valid()){   // test for validity
      if($('#frmdms_file_group #cboSearch').val()==''){
        requestType = 'add';	
      }
      else{
        requestType = 'edit';	
        id = $('#frmdms_file_group #cboSearch').val();
      }
      var url = "fileGroup-db-set.php";
      var obj = $.ajax({
			url:url,
			dataType: "json",
			type:'post', 
			data:$("#frmdms_file_group").serialize()+'&requestType='+requestType+'&cboSearch='+id+'&anStatus='+anStatus,
			async:false,
			
			success:function(json){
					if(json.type=='pass'){
						$('#frmdms_file_group').get(0).reset();
                        id = json.id;
						loadSearchCombo(id);
                        $('#frmdms_file_group #cboSearch').trigger('change');
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
  $("#frmdms_file_group #btnDelete").click(function(){  
    var requestType = 'delete';
    var id = '';
    if($('#frmdms_file_group #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmdms_file_group #cboSearch').val();
    }
    var url = "fileGroup-db-set.php";
    var obj = $.ajax({
          url:url,
          dataType: "json",
          type:'post', 
          data:'requestType='+requestType+'&cboSearch='+id,
          async:false,

          success:function(json){
                  if(json.type=='pass'){
                      $('#frmdms_file_group').get(0).reset();
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
  $("#frmdms_file_group #cboSearch").focus(function(){  
    loadSearchCombo($(this).val());
  });
  // ========================================
  // ===============  Search Record =========
  // ========================================
  $("#frmdms_file_group #cboSearch").change(function(){  
    $("#frmdms_file_group").validate().resetForm();
    var url = "fileGroup-db-get.php";
    if($(this).val()==''){
        $('#frmdms_file_group').get(0).reset();return;	
    }
    $id = $(this).val();
    var httpobj = $.ajax({
        url:url,
        dataType:'json',
        data:'requestType=loadDetails&id='+$id,
        async:false,
        success:function(json){
          $('#frmdms_file_group').get(0).reset();
          $('#frmdms_file_group #cboSearch').val($id);
          if(json){ 
            $('#frmdms_file_group #txtName').val(json[0].dfg_name);
            $('#frmdms_file_group #txtRemarks').val(json[0].dfg_remarks);
            $('#frmdms_file_group #cboStatus').val(json[0].dfg_status);
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
	var url = "fileGroup-db-get.php?requestType=loadSearchCombo";
	var httpobj = $.ajax({url:url,async:false})
	$('#frmdms_file_group #cboSearch').html(httpobj.responseText);
	$('#frmdms_file_group #cboSearch').val($id);
	$('#frmdms_file_group #cboSearch').trigger('change');
}


