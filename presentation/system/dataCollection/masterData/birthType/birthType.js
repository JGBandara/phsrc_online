
$( document ).ready( function () {

  $('#frmsys_birth_type #btnNew').hide();
  $('#frmsys_birth_type #btnList').hide();
  $('#frmsys_birth_type #btnSave').hide();
  $('#frmsys_birth_type #btnPrint').hide();
  $('#frmsys_birth_type #btnDelete').hide();
  $('#frmsys_birth_type #btnApprove').hide();
  $('#frmsys_birth_type #btnReject').hide();
  $('#frmsys_birth_type #cboSearch').prop('disabled', true);
  
  if(intViewx){ // View Permission
 	$('#frmsys_birth_type #cboSearch').prop('disabled', false);
  }
  if(intListx){ // Listing Permission
 	$('#frmsys_birth_type #btnList').show();
  }
  if(intAddx){ // Insert New Permission
 	$('#frmsys_birth_type #btnNew').show();
 	$('#frmsys_birth_type #btnSave').show();
  }
  if(intEditx){ // Update Permission
 	$('#frmsys_birth_type #btnSave').show();
 	$('#frmsys_birth_type #cboSearch').prop('disabled', false);
  }
  if(intDeletex){ // Delete Permission
 	$('#frmsys_birth_type #btnDelete').show();
 	$('#frmsys_birth_type #cboSearch').prop('disabled', false);
  }
  if(intPrintx){ // Delete Permission
 	$('#frmsys_birth_type #btnPrint').show();
 	$('#frmsys_birth_type #cboSearch').prop('disabled', false);
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
  $( "#frmsys_birth_type" ).validate( {
      rules: {
        txtCode: {
                  required: true,
                  maxlength: 10
                },
        txtName: {
                  required: true,
                  maxlength: 50
                },
        txtDescription: {
                  maxlength: 250
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
  $('#frmsys_birth_type #chkAutoManual').click(function(){
    if($('#frmsys_birth_type #chkAutoManual').eq(0).is(':checked')){
      anStatus = "Auto";
      $('#frmsys_birth_type #dc_code').val('');
      $('#frmsys_birth_type #dc_code').prop("readonly",true);
      $('#frmsys_birth_type #dc_code').rules( "remove" );
    }
    else{
      anStatus = "Manual";
      $('#frmsys_birth_type #dc_code').val('');
      $('#frmsys_birth_type #dc_code').prop("readonly",false);
      $('#frmsys_birth_type #dc_code').rules("add", {
                                                    required: true,
                                                  });
    }
  });
  // --------------------------------------------------------
  //      New Function
  // --------------------------------------------------------
  $("#frmsys_birth_type #btnNew").click(function(){  
    $("#frmsys_birth_type").get(0).reset();
    $("#frmsys_birth_type").validate().resetForm();
  });
  // --------------------------------------------------------
  //      Listing Function
  // --------------------------------------------------------
  $("#frmsys_birth_type #btnList").click(function(){  
    window.location.assign("birth_typeListing.php");
  });
  // --------------------------------------------------------
  //      Print Function
  // --------------------------------------------------------
  $("#frmsys_birth_type #btnPrint").click(function(){  
    if($('#frmsys_birth_type #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmsys_birth_type #cboSearch').val();
      window.location.assign("birth_typePrint.php?id="+id);
    }
  });
  // --------------------------------------------------------
  //      Close Function
  // --------------------------------------------------------
  $("#frmsys_birth_type #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
  // --------------------------------------------------------
  //      Save Function
  // --------------------------------------------------------
  $("#frmsys_birth_type #btnSave").click(function(){  
    var requestType = '';
    var id = '';

   if($("#frmsys_birth_type").valid()){   
  var cboVal = $('#frmsys_birth_type #cboSearch').val();

  if(cboVal == '' || cboVal == null){
    requestType = 'add';	
  } else {
    requestType = 'edit';	
    id = cboVal;
  }
      var url = "birthType-db-set.php";
      var obj = $.ajax({
			url:url,
			dataType: "json",
			type:'post', 
			data:$("#frmsys_birth_type").serialize()+'&requestType='+requestType+'&cboSearch='+id,
			async:false,
			
			success:function(json){
					if(json.type=='pass'){
						$('#frmsys_birth_type').get(0).reset();
                        id = json.id;
						loadSearchCombo(id);
                        $('#frmsys_birth_type #cboSearch').trigger('change');
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
  $("#frmsys_birth_type #btnDelete").click(function(){  
    var requestType = 'delete';
    var id = '';
    if($('#frmsys_birth_type #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
       if (!confirm("Are you sure you want to delete this record?")) {
        return false; // if user clicks NO, stop delete
    }
    else{
      id = $('#frmsys_birth_type #cboSearch').val();

    }
    var url = "birthType-db-set.php";
    var obj = $.ajax({
          url:url,
          dataType: "json",
          type:'post', 
          data:'requestType='+requestType+'&cboSearch='+id,
          async:false,

          success:function(json){
                  if(json.type=='pass'){
                      $('#frmsys_birth_type').get(0).reset();
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
  $("#frmsys_birth_type #cboSearch").focus(function(){  
    loadSearchCombo($(this).val());
  });
  // ========================================
  // ===============  Search Record =========
  // ========================================

  $("#frmsys_birth_type #cboSearch").change(function(){  
    $("#frmsys_birth_type").validate().resetForm();
    id = $('#frmsys_birth_type #cboSearch').val();
    var url = "birthType-db-get.php";
    if($('#frmsys_birth_type #cboSearch').val()==''){
        $('#frmsys_birth_type').get(0).reset();
        return;	
    }
    var httpobj = $.ajax({
        url:url,
        dataType:'json',
        data:'requestType=loadDetails&id='+id,
        async:false,
        success:function(json){
        $('#frmsys_birth_type #txtCode').val(json.bt_code);
        $('#frmsys_birth_type #txtName').val(json.bt_name);
        $('#frmsys_birth_type #txtDescription').val(json.bt_description);
        $('#frmsys_birth_type #cboStatus').val(json.bt_status);

                        }
    });
  });
  
  // =================================
  // Load Search Dropdown content
  // ---------------------------------
  loadSearchCombo(searchId);

});// Document Ready End

function loadSearchCombo($id){
	var url = "birthType-db-get.php?requestType=loadSearchCombo";
	var httpobj = $.ajax({url:url,async:false})
	$('#frmsys_birth_type #cboSearch').html(httpobj.responseText);
	$('#frmsys_birth_type #cboSearch').val($id);
	$('#frmsys_birth_type #cboSearch').trigger('change');
}


