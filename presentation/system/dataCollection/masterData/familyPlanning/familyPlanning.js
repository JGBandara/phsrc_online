
$( document ).ready( function () {

  $('#frmsys_plannning_method #btnNew').hide();
  $('#frmsys_plannning_method #btnList').hide();
  $('#frmsys_plannning_method #btnSave').hide();
  $('#frmsys_plannning_method #btnPrint').hide();
  $('#frmsys_plannning_method #btnDelete').hide();
  $('#frmsys_plannning_method #btnApprove').hide();
  $('#frmsys_plannning_method #btnReject').hide();
  $('#frmsys_plannning_method #cboSearch').prop('disabled', true);
  
  if(intViewx){ // View Permission
 	$('#frmsys_plannning_method #cboSearch').prop('disabled', false);
  }
  if(intListx){ // Listing Permission
 	$('#frmsys_plannning_method #btnList').show();
  }
  if(intAddx){ // Insert New Permission
 	$('#frmsys_plannning_method #btnNew').show();
 	$('#frmsys_plannning_method #btnSave').show();
  }
  if(intEditx){ // Update Permission
 	$('#frmsys_plannning_method #btnSave').show();
 	$('#frmsys_plannning_method #cboSearch').prop('disabled', false);
  }
  if(intDeletex){ // Delete Permission
 	$('#frmsys_plannning_method #btnDelete').show();
 	$('#frmsys_plannning_method #cboSearch').prop('disabled', false);
  }
  if(intPrintx){ // Delete Permission
 	$('#frmsys_plannning_method #btnPrint').show();
 	$('#frmsys_plannning_method #cboSearch').prop('disabled', false);
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
  $( "#frmsys_plannning_method" ).validate( {
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
  $('#frmsys_plannning_method #chkAutoManual').click(function(){
    if($('#frmsys_plannning_method #chkAutoManual').eq(0).is(':checked')){
      anStatus = "Auto";
      $('#frmsys_plannning_method #dc_code').val('');
      $('#frmsys_plannning_method #dc_code').prop("readonly",true);
      $('#frmsys_plannning_method #dc_code').rules( "remove" );
    }
    else{
      anStatus = "Manual";
      $('#frmsys_plannning_method #dc_code').val('');
      $('#frmsys_plannning_method #dc_code').prop("readonly",false);
      $('#frmsys_plannning_method #dc_code').rules("add", {
                                                    required: true,
                                                  });
    }
  });
  // --------------------------------------------------------
  //      New Function
  // --------------------------------------------------------
  $("#frmsys_plannning_method #btnNew").click(function(){  
    $("#frmsys_plannning_method").get(0).reset();
    $("#frmsys_plannning_method").validate().resetForm();
  });
  // --------------------------------------------------------
  //      Listing Function
  // --------------------------------------------------------
  $("#frmsys_plannning_method #btnList").click(function(){  
    window.location.assign("familyPlanningListing.php");
  });
  // --------------------------------------------------------
  //      Print Function
  // --------------------------------------------------------
  $("#frmsys_plannning_method #btnPrint").click(function(){  
    if($('#frmsys_plannning_method #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmsys_plannning_method #cboSearch').val();
      window.location.assign("familyPlanningPrint.php?id="+id);
    }
  });
  // --------------------------------------------------------
  //      Close Function
  // --------------------------------------------------------
  $("#frmsys_plannning_method #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
  // --------------------------------------------------------
  //      Save Function
  // --------------------------------------------------------
  $("#frmsys_plannning_method #btnSave").click(function(){  
    var requestType = '';
    var id = '';

   if($("#frmsys_plannning_method").valid()){   
  var cboVal = $('#frmsys_plannning_method #cboSearch').val();

  if(cboVal == '' || cboVal == null){
    requestType = 'add';	
  } else {
    requestType = 'edit';	
    id = cboVal;
  }
      var url = "familyPlanning-db-set.php";
      var obj = $.ajax({
			url:url,
			dataType: "json",
			type:'post', 
			data:$("#frmsys_plannning_method").serialize()+'&requestType='+requestType+'&cboSearch='+id,
			async:false,
			
			success:function(json){
					if(json.type=='pass'){
						$('#frmsys_plannning_method').get(0).reset();
                        id = json.id;
						loadSearchCombo(id);
                        $('#frmsys_plannning_method #cboSearch').trigger('change');
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
  $("#frmsys_plannning_method #btnDelete").click(function(){  
    var requestType = 'delete';
    var id = '';
    if($('#frmsys_plannning_method #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
       if (!confirm("Are you sure you want to delete this record?")) {
        return false; // if user clicks NO, stop delete
    }
    else{
      id = $('#frmsys_plannning_method #cboSearch').val();

    }
    var url = "familyPlanning-db-set.php";
    var obj = $.ajax({
          url:url,
          dataType: "json",
          type:'post', 
          data:'requestType='+requestType+'&cboSearch='+id,
          async:false,

          success:function(json){
                  if(json.type=='pass'){
                      $('#frmsys_plannning_method').get(0).reset();
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
  $("#frmsys_plannning_method #cboSearch").focus(function(){  
    loadSearchCombo($(this).val());
  });
  // ========================================
  // ===============  Search Record =========
  // ========================================

  $("#frmsys_plannning_method #cboSearch").change(function(){  
    $("#frmsys_plannning_method").validate().resetForm();
    id = $('#frmsys_plannning_method #cboSearch').val();
    var url = "familyPlanning-db-get.php";
    if($('#frmsys_plannning_method #cboSearch').val()==''){
        $('#frmsys_plannning_method').get(0).reset();
        return;	
    }
    var httpobj = $.ajax({
        url:url,
        dataType:'json',
        data:'requestType=loadDetails&id='+id,
        async:false,
        success:function(json){
               $('#frmsys_plannning_method #txtCode').val(json.dc_code);
        $('#frmsys_plannning_method #txtName').val(json.dc_name);
        $('#frmsys_plannning_method #txtDescription').val(json.dc_description);
        $('#frmsys_plannning_method #cboStatus').val(json.dc_status);

                        }
    });
  });
  
  // =================================
  // Load Search Dropdown content
  // ---------------------------------
  loadSearchCombo(searchId);

});// Document Ready End

function loadSearchCombo($id){
	var url = "familyPlanning-db-get.php?requestType=loadSearchCombo";
	var httpobj = $.ajax({url:url,async:false})
	$('#frmsys_plannning_method #cboSearch').html(httpobj.responseText);
	$('#frmsys_plannning_method #cboSearch').val($id);
	$('#frmsys_plannning_method #cboSearch').trigger('change');
}


