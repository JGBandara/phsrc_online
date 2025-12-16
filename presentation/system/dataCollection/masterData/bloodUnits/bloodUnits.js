
$( document ).ready( function () {

  $('#frmsys_blood_units #btnNew').hide();
  $('#frmsys_blood_units #btnList').hide();
  $('#frmsys_blood_units #btnSave').hide();
  $('#frmsys_blood_units #btnPrint').hide();
  $('#frmsys_blood_units #btnDelete').hide();
  $('#frmsys_blood_units #btnApprove').hide();
  $('#frmsys_blood_units #btnReject').hide();
  $('#frmsys_blood_units #cboSearch').prop('disabled', true);
  
  if(intViewx){ // View Permission
 	$('#frmsys_blood_units #cboSearch').prop('disabled', false);
  }
  if(intListx){ // Listing Permission
 	$('#frmsys_blood_units #btnList').show();
  }
  if(intAddx){ // Insert New Permission
 	$('#frmsys_blood_units #btnNew').show();
 	$('#frmsys_blood_units #btnSave').show();
  }
  if(intEditx){ // Update Permission
 	$('#frmsys_blood_units #btnSave').show();
 	$('#frmsys_blood_units #cboSearch').prop('disabled', false);
  }
  if(intDeletex){ // Delete Permission
 	$('#frmsys_blood_units #btnDelete').show();
 	$('#frmsys_blood_units #cboSearch').prop('disabled', false);
  }
  if(intPrintx){ // Delete Permission
 	$('#frmsys_blood_units #btnPrint').show();
 	$('#frmsys_blood_units #cboSearch').prop('disabled', false);
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
  $( "#frmsys_blood_units" ).validate( {
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
  $('#frmsys_blood_units #chkAutoManual').click(function(){
    if($('#frmsys_blood_units #chkAutoManual').eq(0).is(':checked')){
      anStatus = "Auto";
      $('#frmsys_blood_units #dc_code').val('');
      $('#frmsys_blood_units #dc_code').prop("readonly",true);
      $('#frmsys_blood_units #dc_code').rules( "remove" );
    }
    else{
      anStatus = "Manual";
      $('#frmsys_blood_units #dc_code').val('');
      $('#frmsys_blood_units #dc_code').prop("readonly",false);
      $('#frmsys_blood_units #dc_code').rules("add", {
                                                    required: true,
                                                  });
    }
  });
  // --------------------------------------------------------
  //      New Function
  // --------------------------------------------------------
  $("#frmsys_blood_units #btnNew").click(function(){  
    $("#frmsys_blood_units").get(0).reset();
    $("#frmsys_blood_units").validate().resetForm();
  });
  // --------------------------------------------------------
  //      Listing Function
  // --------------------------------------------------------
  $("#frmsys_blood_units #btnList").click(function(){  
    window.location.assign("blood_unitsListing.php");
  });
  // --------------------------------------------------------
  //      Print Function
  // --------------------------------------------------------
  $("#frmsys_blood_units #btnPrint").click(function(){  
    if($('#frmsys_blood_units #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmsys_blood_units #cboSearch').val();
      window.location.assign("blood_unitsPrint.php?id="+id);
    }
  });
  // --------------------------------------------------------
  //      Close Function
  // --------------------------------------------------------
  $("#frmsys_blood_units #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
  // --------------------------------------------------------
  //      Save Function
  // --------------------------------------------------------
  $("#frmsys_blood_units #btnSave").click(function(){  
    var requestType = '';
    var id = '';

   if($("#frmsys_blood_units").valid()){   
  var cboVal = $('#frmsys_blood_units #cboSearch').val();

  if(cboVal == '' || cboVal == null){
    requestType = 'add';	
  } else {
    requestType = 'edit';	
    id = cboVal;
  }
      var url = "bloodUnits-db-set.php";
      var obj = $.ajax({
			url:url,
			dataType: "json",
			type:'post', 
			data:$("#frmsys_blood_units").serialize()+'&requestType='+requestType+'&cboSearch='+id,
			async:false,
			
			success:function(json){
					if(json.type=='pass'){
						$('#frmsys_blood_units').get(0).reset();
                        id = json.id;
						loadSearchCombo(id);
                        $('#frmsys_blood_units #cboSearch').trigger('change');
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
  $("#frmsys_blood_units #btnDelete").click(function(){  
    var requestType = 'delete';
    var id = '';
    if($('#frmsys_blood_units #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
       if (!confirm("Are you sure you want to delete this record?")) {
        return false; // if user clicks NO, stop delete
    }
    else{
      id = $('#frmsys_blood_units #cboSearch').val();

    }
    var url = "blood_units-db-set.php";
    var obj = $.ajax({
          url:url,
          dataType: "json",
          type:'post', 
          data:'requestType='+requestType+'&cboSearch='+id,
          async:false,

          success:function(json){
                  if(json.type=='pass'){
                      $('#frmsys_blood_units').get(0).reset();
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
  $("#frmsys_blood_units #cboSearch").focus(function(){  
    loadSearchCombo($(this).val());
  });
  // ========================================
  // ===============  Search Record =========
  // ========================================

  $("#frmsys_blood_units #cboSearch").change(function(){  
    $("#frmsys_blood_units").validate().resetForm();
    id = $('#frmsys_blood_units #cboSearch').val();
    var url = "bloodUnits-db-get.php";
    if($('#frmsys_blood_units #cboSearch').val()==''){
        $('#frmsys_blood_units').get(0).reset();
        return;	
    }
    var httpobj = $.ajax({
        url:url,
        dataType:'json',
        data:'requestType=loadDetails&id='+id,
        async:false,
        success:function(json){
        $('#frmsys_blood_units #txtCode').val(json.bu_code);
        $('#frmsys_blood_units #txtName').val(json.bu_name);
        $('#frmsys_blood_units #txtDescription').val(json.bu_description);
        $('#frmsys_blood_units #cboStatus').val(json.bu_status);

                        }
    });
  });
  
  // =================================
  // Load Search Dropdown content
  // ---------------------------------
  loadSearchCombo(searchId);

});// Document Ready End

function loadSearchCombo($id){
	var url = "bloodUnits-db-get.php?requestType=loadSearchCombo";
	var httpobj = $.ajax({url:url,async:false})
	$('#frmsys_blood_units #cboSearch').html(httpobj.responseText);
	$('#frmsys_blood_units #cboSearch').val($id);
	$('#frmsys_blood_units #cboSearch').trigger('change');
}


