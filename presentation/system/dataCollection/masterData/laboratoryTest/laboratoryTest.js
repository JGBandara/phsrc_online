
$( document ).ready( function () {

  $('#frmsys_laboratory_test #btnNew').hide();
  $('#frmsys_laboratory_test #btnList').hide();
  $('#frmsys_laboratory_test #btnSave').hide();
  $('#frmsys_laboratory_test #btnPrint').hide();
  $('#frmsys_laboratory_test #btnDelete').hide();
  $('#frmsys_laboratory_test #btnApprove').hide();
  $('#frmsys_laboratory_test #btnReject').hide();
  $('#frmsys_laboratory_test #cboSearch').prop('disabled', true);
  
  if(intViewx){ // View Permission
 	$('#frmsys_laboratory_test #cboSearch').prop('disabled', false);
  }
  if(intListx){ // Listing Permission
 	$('#frmsys_laboratory_test #btnList').show();
  }
  if(intAddx){ // Insert New Permission
 	$('#frmsys_laboratory_test #btnNew').show();
 	$('#frmsys_laboratory_test #btnSave').show();
  }
  if(intEditx){ // Update Permission
 	$('#frmsys_laboratory_test #btnSave').show();
 	$('#frmsys_laboratory_test #cboSearch').prop('disabled', false);
  }
  if(intDeletex){ // Delete Permission
 	$('#frmsys_laboratory_test #btnDelete').show();
 	$('#frmsys_laboratory_test #cboSearch').prop('disabled', false);
  }
  if(intPrintx){ // Delete Permission
 	$('#frmsys_laboratory_test #btnPrint').show();
 	$('#frmsys_laboratory_test #cboSearch').prop('disabled', false);
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
  $( "#frmsys_laboratory_test" ).validate( {
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
  $('#frmsys_laboratory_test #chkAutoManual').click(function(){
    if($('#frmsys_laboratory_test #chkAutoManual').eq(0).is(':checked')){
      anStatus = "Auto";
      $('#frmsys_laboratory_test #dc_code').val('');
      $('#frmsys_laboratory_test #dc_code').prop("readonly",true);
      $('#frmsys_laboratory_test #dc_code').rules( "remove" );
    }
    else{
      anStatus = "Manual";
      $('#frmsys_laboratory_test #dc_code').val('');
      $('#frmsys_laboratory_test #dc_code').prop("readonly",false);
      $('#frmsys_laboratory_test #dc_code').rules("add", {
                                                    required: true,
                                                  });
    }
  });
  // --------------------------------------------------------
  //      New Function
  // --------------------------------------------------------
  $("#frmsys_laboratory_test #btnNew").click(function(){  
    $("#frmsys_laboratory_test").get(0).reset();
    $("#frmsys_laboratory_test").validate().resetForm();
  });
  // --------------------------------------------------------
  //      Listing Function
  // --------------------------------------------------------
  $("#frmsys_laboratory_test #btnList").click(function(){  
    window.location.assign("laboratoryTestListing.php");
  });
  // --------------------------------------------------------
  //      Print Function
  // --------------------------------------------------------
  $("#frmsys_laboratory_test #btnPrint").click(function(){  
    if($('#frmsys_laboratory_test #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmsys_laboratory_test #cboSearch').val();
      window.location.assign("laboratoryTestPrint.php?id="+id);
    }
  });
  // --------------------------------------------------------
  //      Close Function
  // --------------------------------------------------------
  $("#frmsys_laboratory_test #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
  // --------------------------------------------------------
  //      Save Function
  // --------------------------------------------------------
  $("#frmsys_laboratory_test #btnSave").click(function(){  
    var requestType = '';
    var id = '';

   if($("#frmsys_laboratory_test").valid()){   
  var cboVal = $('#frmsys_laboratory_test #cboSearch').val();

  if(cboVal == '' || cboVal == null){
    requestType = 'add';	
  } else {
    requestType = 'edit';	
    id = cboVal;
  }
      var url = "laboratoryTest-db-set.php";
      var obj = $.ajax({
			url:url,
			dataType: "json",
			type:'post', 
			data:$("#frmsys_laboratory_test").serialize()+'&requestType='+requestType+'&cboSearch='+id,
			async:false,
			
			success:function(json){
					if(json.type=='pass'){
						$('#frmsys_laboratory_test').get(0).reset();
                        id = json.id;
						loadSearchCombo(id);
                        $('#frmsys_laboratory_test #cboSearch').trigger('change');
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
  $("#frmsys_laboratory_test #btnDelete").click(function(){  
    var requestType = 'delete';
    var id = '';
    if($('#frmsys_laboratory_test #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
       if (!confirm("Are you sure you want to delete this record?")) {
        return false; // if user clicks NO, stop delete
    }
    else{
      id = $('#frmsys_laboratory_test #cboSearch').val();

    }
    var url = "laboratoryTest-db-set.php";
    var obj = $.ajax({
          url:url,
          dataType: "json",
          type:'post', 
          data:'requestType='+requestType+'&cboSearch='+id,
          async:false,

          success:function(json){
                  if(json.type=='pass'){
                      $('#frmsys_laboratory_test').get(0).reset();
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
  $("#frmsys_laboratory_test #cboSearch").focus(function(){  
    loadSearchCombo($(this).val());
  });
  // ========================================
  // ===============  Search Record =========
  // ========================================

  $("#frmsys_laboratory_test #cboSearch").change(function(){  
    $("#frmsys_laboratory_test").validate().resetForm();
    id = $('#frmsys_laboratory_test #cboSearch').val();
    var url = "laboratoryTest-db-get.php";
    if($('#frmsys_laboratory_test #cboSearch').val()==''){
        $('#frmsys_laboratory_test').get(0).reset();
        return;	
    }
    var httpobj = $.ajax({
        url:url,
        dataType:'json',
        data:'requestType=loadDetails&id='+id,
        async:false,
        success:function(json){
               $('#frmsys_laboratory_test #txtCode').val(json.dc_code);
        $('#frmsys_laboratory_test #txtName').val(json.dc_name);
        $('#frmsys_laboratory_test #txtDescription').val(json.dc_description);
        $('#frmsys_laboratory_test #cboStatus').val(json.dc_status);

                        }
    });
  });
  
  // =================================
  // Load Search Dropdown content
  // ---------------------------------
  loadSearchCombo(searchId);

});// Document Ready End

function loadSearchCombo($id){
	var url = "laboratoryTest-db-get.php?requestType=loadSearchCombo";
	var httpobj = $.ajax({url:url,async:false})
	$('#frmsys_laboratory_test #cboSearch').html(httpobj.responseText);
	$('#frmsys_laboratory_test #cboSearch').val($id);
	$('#frmsys_laboratory_test #cboSearch').trigger('change');
}


