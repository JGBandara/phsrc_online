
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
  $('#frmhrm_division #btnNew').hide();
  $('#frmhrm_division #btnList').hide();
  $('#frmhrm_division #btnSave').hide();
  $('#frmhrm_division #btnPrint').hide();
  $('#frmhrm_division #btnDelete').hide();
  $('#frmhrm_division #btnApprove').hide();
  $('#frmhrm_division #btnReject').hide();
  $('#frmhrm_division #cboSearch').prop('disabled', true);
  
  if(intViewx){ // View Permission
 	$('#frmhrm_division #cboSearch').prop('disabled', false);
  }
  if(intListx){ // Listing Permission
 	$('#frmhrm_division #btnList').show();
  }
  if(intAddx){ // Insert New Permission
 	$('#frmhrm_division #btnNew').show();
 	$('#frmhrm_division #btnSave').show();
  }
  if(intEditx){ // Update Permission
 	$('#frmhrm_division #btnSave').show();
 	$('#frmhrm_division #cboSearch').prop('disabled', false);
  }
  if(intDeletex){ // Delete Permission
 	$('#frmhrm_division #btnDelete').show();
 	$('#frmhrm_division #cboSearch').prop('disabled', false);
  }
  if(intPrintx){ // Delete Permission
 	$('#frmhrm_division #btnPrint').show();
 	$('#frmhrm_division #cboSearch').prop('disabled', false);
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
  $( "#frmhrm_division" ).validate( {
      rules: {
        txtName: {
                  required: true,
                  maxlength: 128
                },
        txtCode: {
                  required: true,
                  maxlength: 8
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
  $('#frmhrm_division #chkAutoManual').click(function(){
    if($('#frmhrm_division #chkAutoManual').eq(0).is(':checked')){
      anStatus = "Auto";
      $('#frmhrm_division #div_name').val('');
      $('#frmhrm_division #div_name').prop("readonly",true);
      $('#frmhrm_division #div_name').rules( "remove" );
    }
    else{
      anStatus = "Manual";
      $('#frmhrm_division #div_name').val('');
      $('#frmhrm_division #div_name').prop("readonly",false);
      $('#frmhrm_division #div_name').rules("add", {
                                                    required: true,
                                                  });
    }
  });
  // --------------------------------------------------------
  //      New Function
  // --------------------------------------------------------
  $("#frmhrm_division #btnNew").click(function(){  
    $("#frmhrm_division").get(0).reset();
    $("#frmhrm_division").validate().resetForm();
  });
  // --------------------------------------------------------
  //      Listing Function
  // --------------------------------------------------------
  $("#frmhrm_division #btnList").click(function(){  
    window.location.assign("divisionListing.php");
  });
  // --------------------------------------------------------
  //      Print Function
  // --------------------------------------------------------
  $("#frmhrm_division #btnPrint").click(function(){  
    if($('#frmhrm_division #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmhrm_division #cboSearch').val();
      window.location.assign("divisionPrint.php?id="+id);
    }
  });
  // --------------------------------------------------------
  //      Close Function
  // --------------------------------------------------------
  $("#frmhrm_division #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
  // --------------------------------------------------------
  //      Save Function
  // --------------------------------------------------------
  $("#frmhrm_division #btnSave").click(function(){  
    var requestType = '';
    var id = '';
    if($("#frmhrm_division").valid()){   // test for validity
      if($('#frmhrm_division #cboSearch').val()==''){
        requestType = 'add';	
      }
      else{
        requestType = 'edit';	
        id = $('#frmhrm_division #cboSearch').val();
      }
      var url = "division-db-set.php";
      var obj = $.ajax({
			url:url,
			dataType: "json",
			type:'post', 
			data:$("#frmhrm_division").serialize()+'&requestType='+requestType+'&cboSearch='+id+'&anStatus='+anStatus,
			async:false,
			
			success:function(json){
					if(json.type=='pass'){
						$('#frmhrm_division').get(0).reset();
                        id = json.id;
						loadSearchCombo(id);
                        $('#frmhrm_division #cboSearch').trigger('change');
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
  $("#frmhrm_division #btnDelete").click(function(){  
    var requestType = 'delete';
    var id = '';
    if($('#frmhrm_division #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmhrm_division #cboSearch').val();
    }
    var url = "division-db-set.php";
    var obj = $.ajax({
          url:url,
          dataType: "json",
          type:'post', 
          data:'requestType='+requestType+'&cboSearch='+id,
          async:false,

          success:function(json){
                  if(json.type=='pass'){
                      $('#frmhrm_division').get(0).reset();
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
  $("#frmhrm_division #cboSearch").focus(function(){  
    loadSearchCombo($(this).val());
  });
  // ========================================
  // ===============  Search Record =========
  // ========================================
  $("#frmhrm_division #cboSearch").change(function(){  
    $("#frmhrm_division").validate().resetForm();
    var url = "division-db-get.php";
    if($(this).val()==''){
        $('#frmhrm_division').get(0).reset();return;	
    }
    $id = $(this).val();
    var httpobj = $.ajax({
        url:url,
        dataType:'json',
        data:'requestType=loadDetails&id='+$id,
        async:false,
        success:function(json){
          $('#frmhrm_division').get(0).reset();
          $('#frmhrm_division #cboSearch').val($id);
          if(json){ 
            $('#frmhrm_division #txtName').val(json[0].div_name);
            $('#frmhrm_division #txtCode').val(json[0].div_code);
            $('#frmhrm_division #txtRemarks').val(json[0].div_remarks);
            $('#frmhrm_division #cboStatus').val(json[0].div_status);
                      
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
	var url = "division-db-get.php?requestType=loadSearchCombo";
	var httpobj = $.ajax({url:url,async:false})
	$('#frmhrm_division #cboSearch').html(httpobj.responseText);
	$('#frmhrm_division #cboSearch').val($id);
	$('#frmhrm_division #cboSearch').trigger('change');
}


