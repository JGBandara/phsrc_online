
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-05
 */
var anStatus = "Auto";
$( document ).ready( function () {
  // =================================
  // Access Control
  // ---------------------------------
  // Reset
  $('#frmsys_status #btnNew').hide();
  $('#frmsys_status #btnList').hide();
  $('#frmsys_status #btnSave').hide();
  $('#frmsys_status #btnPrint').hide();
  $('#frmsys_status #btnDelete').hide();
  $('#frmsys_status #btnApprove').hide();
  $('#frmsys_status #btnReject').hide();
  $('#frmsys_status #cboSearch').prop('disabled', true);
  
  if(intViewx){ // View Permission
 	$('#frmsys_status #cboSearch').prop('disabled', false);
  }
  if(intListx){ // Listing Permission
 	$('#frmsys_status #btnList').show();
  }
  if(intAddx){ // Insert New Permission
 	$('#frmsys_status #btnNew').show();
 	$('#frmsys_status #btnSave').show();
  }
  if(intEditx){ // Update Permission
 	$('#frmsys_status #btnSave').show();
 	$('#frmsys_status #cboSearch').prop('disabled', false);
  }
  if(intDeletex){ // Delete Permission
 	$('#frmsys_status #btnDelete').show();
 	$('#frmsys_status #cboSearch').prop('disabled', false);
  }
  if(intPrintx){ // Delete Permission
 	$('#frmsys_status #btnPrint').show();
 	$('#frmsys_status #cboSearch').prop('disabled', false);
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
  $( "#frmsys_status" ).validate( {
      rules: {
        txtName: {
                  required: true,
                  maxlength: 20
                },
        txtCssClass: {
                  maxlength: 64
                },
        txtCssColor: {
                  maxlength: 32
                },
        
      },
      submitHandler: function () {
          modalMsgBox("Info", "Not Implemented ...");
      }
  } );
  // --------------------------------------------------------
  //      Auto Number / Manual Number
  // --------------------------------------------------------
  $('#frmsys_status #chkAutoManual').click(function(){
    if($('#frmsys_status #chkAutoManual').eq(0).is(':checked')){
      anStatus = "Auto";
      $('#frmsys_status #stat_name').val('');
      $('#frmsys_status #stat_name').prop("readonly",true);
      $('#frmsys_status #stat_name').rules( "remove" );
    }
    else{
      anStatus = "Manual";
      $('#frmsys_status #stat_name').val('');
      $('#frmsys_status #stat_name').prop("readonly",false);
      $('#frmsys_status #stat_name').rules("add", {
                                                    required: true,
                                                  });
    }
  });
  // --------------------------------------------------------
  //      New Function
  // --------------------------------------------------------
  $("#frmsys_status #btnNew").click(function(){  
    $("#frmsys_status").get(0).reset();
    $('#frmsys_status #txtCssColor').css('background-color', '#fff');
  });
  // --------------------------------------------------------
  //      Listing Function
  // --------------------------------------------------------
  $("#frmsys_status #btnList").click(function(){  
    window.location.assign("statusListing.php");
  });
  // --------------------------------------------------------
  //      Print Function
  // --------------------------------------------------------
  $("#frmsys_status #btnPrint").click(function(){  
    if($('#frmsys_status #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmsys_status #cboSearch').val();
      window.location.assign("statusPrint.php?id="+id);
    }
  });
  // --------------------------------------------------------
  //      Close Function
  // --------------------------------------------------------
  $("#frmsys_status #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
  // --------------------------------------------------------
  //      Save Function
  // --------------------------------------------------------
  $("#frmsys_status #btnSave").click(function(){  
    var requestType = '';
    var id = '';
    if($("#frmsys_status").valid()){   // test for validity
      if($('#frmsys_status #cboSearch').val()==''){
        requestType = 'add';	
      }
      else{
        requestType = 'edit';	
        id = $('#frmsys_status #cboSearch').val();
      }
      var url = "status-db-set.php";
      var obj = $.ajax({
			url:url,
			dataType: "json",
			type:'post', 
			data:$("#frmsys_status").serialize()+'&requestType='+requestType+'&cboSearch='+id+'&anStatus='+anStatus,
			async:false,
			
			success:function(json){
					if(json.type=='pass'){
						$('#frmsys_status').get(0).reset();
                        id = json.id;
						loadSearchCombo(id);
                        $('#frmsys_status #cboSearch').trigger('change');
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
  $("#frmsys_status #btnDelete").click(function(){  
    var requestType = 'delete';
    var id = '';
    if($('#frmsys_status #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmsys_status #cboSearch').val();
    }
    var url = "status-db-set.php";
    var obj = $.ajax({
          url:url,
          dataType: "json",
          type:'post', 
          data:'requestType='+requestType+'&cboSearch='+id,
          async:false,

          success:function(json){
                  if(json.type=='pass'){
                      $('#frmsys_status').get(0).reset();
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
  $("#frmsys_status #cboSearch").focus(function(){  
    loadSearchCombo($(this).val());
  });
  // ========================================
  // ===============  Search Record =========
  // ========================================
  $("#frmsys_status #cboSearch").change(function(){  
    var url = "status-db-get.php";
    if($('#frmsys_status #cboSearch').val()==''){
        $('#frmsys_status').get(0).reset();return;	
    }
    var httpobj = $.ajax({
        url:url,
        dataType:'json',
        data:'requestType=loadDetails&id='+$(this).val(),
        async:false,
        success:function(json){
        //jQuery.each($menuList, function($m, $menu) {
        //});
            $('#frmsys_status #txtCssColor').css('background-color', '#fff');
            $('#frmsys_status #txtName').val(json[0].stat_name);
            $('#frmsys_status #txtCssClass').val(json[0].stat_css_class);
            $('#frmsys_status #txtCssColor').val(json[0].stat_css_color);
            $('#frmsys_status #txtCssColor').css('background-color', json[0].stat_css_color);
            if(json[0].stat_status=='1')
              $('#frmsys_status #optStatus').prop('checked',true);
            else
              $('#frmsys_status #optStatus').prop('checked',false); 

        }
    });
  });
  // =================================
  // Load Search Dropdown content
  // ---------------------------------
  loadSearchCombo(searchId);
});// Document Ready End

function loadSearchCombo($id){
	var url = "status-db-get.php?requestType=loadSearchCombo";
	var httpobj = $.ajax({url:url,async:false})
	$('#frmsys_status #cboSearch').html(httpobj.responseText);
	$('#frmsys_status #cboSearch').val($id);
    $('#frmsys_status #cboSearch').trigger('change');
}


