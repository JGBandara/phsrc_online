
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-05-31
 */
var anStatus = "Auto";
$( document ).ready( function () {
  // =================================
  // Access Control
  // ---------------------------------
  // Reset
  $('#frmsys_menus #btnNew').hide();
  $('#frmsys_menus #btnList').hide();
  $('#frmsys_menus #btnSave').hide();
  $('#frmsys_menus #btnPrint').hide();
  $('#frmsys_menus #btnDelete').hide();
  $('#frmsys_menus #btnApprove').hide();
  $('#frmsys_menus #btnReject').hide();
  $('#frmsys_menus #cboSearch').prop('disabled', true);
  
  if(intViewx){ // View Permission
 	$('#frmsys_menus #cboSearch').prop('disabled', false);
  }
  if(intListx){ // Listing Permission
 	$('#frmsys_menus #btnList').show();
  }
  if(intAddx){ // Insert New Permission
 	$('#frmsys_menus #btnNew').show();
 	$('#frmsys_menus #btnSave').show();
  }
  if(intEditx){ // Update Permission
 	$('#frmsys_menus #btnSave').show();
 	$('#frmsys_menus #cboSearch').prop('disabled', false);
  }
  if(intDeletex){ // Delete Permission
 	$('#frmsys_menus #btnDelete').show();
 	$('#frmsys_menus #cboSearch').prop('disabled', false);
  }
  if(intPrintx){ // Delete Permission
 	$('#frmsys_menus #btnPrint').show();
 	$('#frmsys_menus #cboSearch').prop('disabled', false);
  }

  // =================================
  // Color Picker
  // ---------------------------------
  $('#txtCssColor').colorpicker();
  $('#txtCssColor').on('colorpickerChange', function(event) {
    $(this).css('background-color', event.color.toString());
  });
  
  // =================================
  // Load Search Dropdown content
  // ---------------------------------
  loadSearchCombo("");
  // =================================
  // Validation
  // ---------------------------------
  $( "#frmsys_menus" ).validate( {
      rules: {
        txtCode: {
                  maxlength: 10
                },
        cboParentId:"required",
        txtName: {
                  required: true,
                  maxlength: 100
                },
        txtUrl: {
                  maxlength: 255
                },
        cboStatus:"required",
        cboView:"required",
        cboAdd:"required",
        cboEdit:"required",
        cboDelete:"required",
        cboApproval1:"required",
        cboApproval2:"required",
        cboApproval3:"required",
        cboApproval4:"required",
        cboApproval5:"required",
        cboSendToApproval:"required",
        cboPrint:"required",
        cboReject:"required",
        cboRevise:"required",
        cboExportToExcel:"required",
        cboExportToPdf:"required",
        cboWithoutPermission:"required",
        txtBehaviour: {
                  maxlength: 64
                },
        txtAwesomeIcon: {
                  maxlength: 64
                },
        txtModule: {
                  required: true,
                  maxlength: 64
                },
        
      },
      submitHandler: function () {
          modalMsgBox("Info", "Not Implemented ...");
      }
  } );
  // --------------------------------------------------------
  //      Auto Number / Manual Number
  // --------------------------------------------------------
  $('#frmsys_menus #chkAutoManual').click(function(){
    if($('#frmsys_menus #chkAutoManual').eq(0).is(':checked')){
      anStatus = "Auto";
      $('#frmsys_menus #sym_code').val('');
      $('#frmsys_menus #sym_code').prop("readonly",true);
      $('#frmsys_menus #sym_code').rules( "remove" );
    }
    else{
      anStatus = "Manual";
      $('#frmsys_menus #sym_code').val('');
      $('#frmsys_menus #sym_code').prop("readonly",false);
      $('#frmsys_menus #sym_code').rules("add", {
                                                    required: true,
                                                  });
    }
  });
  // --------------------------------------------------------
  //      New Function
  // --------------------------------------------------------
  $("#frmsys_menus #btnNew").click(function(){  
    $("#frmsys_menus").get(0).reset();
  });
  // --------------------------------------------------------
  //      Listing Function
  // --------------------------------------------------------
  $("#frmsys_menus #btnList").click(function(){  
    window.location.assign("menuListing.php");
  });
  // --------------------------------------------------------
  //      Close Function
  // --------------------------------------------------------
  $("#frmsys_menus #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
  // --------------------------------------------------------
  //      Save Function
  // --------------------------------------------------------
  $("#frmsys_menus #btnSave").click(function(){  
    var requestType = '';
    var id = '';
    if($("#frmsys_menus").valid()){   // test for validity
      if($('#frmsys_menus #cboSearch').val()==''){
        requestType = 'add';	
      }
      else{
        requestType = 'edit';	
        id = $('#frmsys_menus #cboSearch').val();
      }
      var url = "menu-db-set.php";
      var obj = $.ajax({
			url:url,
			dataType: "json",
			type:'post', 
			data:$("#frmsys_menus").serialize()+'&requestType='+requestType+'&cboSearch='+id+'&anStatus='+anStatus,
			async:false,
			
			success:function(json){
					if(json.type=='pass'){
						$('#frmsys_menus').get(0).reset();
                        id = json.id;
						loadSearchCombo(id);
                        $('#frmsys_menus #cboSearch').trigger('change');
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
  $("#frmsys_menus #btnDelete").click(function(){  
    var requestType = 'delete';
    var id = '';
    if($('#frmsys_menus #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmsys_menus #cboSearch').val();
    }
    var url = "menu-db-set.php";
    var obj = $.ajax({
          url:url,
          dataType: "json",
          type:'post', 
          data:'requestType='+requestType+'&cboSearch='+id,
          async:false,

          success:function(json){
                  if(json.type=='pass'){
                      $('#frmsys_menus').get(0).reset();
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
  $("#frmsys_menus #cboSearch").focus(function(){  
    loadSearchCombo($(this).val());
  });
  // ========================================
  // ===============  Search Record =========
  // ========================================
  $("#frmsys_menus #cboSearch").change(function(){  
    var url = "menu-db-get.php";
    if($('#frmsys_menus #cboSearch').val()==''){
        $('#frmsys_menus').get(0).reset();return;	
    }
    var httpobj = $.ajax({
        url:url,
        dataType:'json',
        data:'requestType=loadDetails&id='+$(this).val(),
        async:false,
        success:function(json){
        $('#frmsys_menus #txtCode').val(json[0].sym_code);
                $('#frmsys_menus #cboParentId').val(json[0].sym_parent_id);
                $('#frmsys_menus #txtName').val(json[0].sym_name);
                $('#frmsys_menus #txtUrl').val(json[0].sym_url);
                $('#frmsys_menus #cboStatus').val(json[0].sym_status);
                $('#frmsys_menus #cboOrderBy').val(json[0].sym_order_by);
                if(json[0].sym_show_menu=='1')
                  $('#frmsys_menus #optShowMenu').prop('checked',true);
                else
                  $('#frmsys_menus #optShowMenu').prop('checked',false); 
                $('#frmsys_menus input[name="optShowMenu"][value="'+json[0].sym_show_menu+'"]').prop('checked', true);

                $('#frmsys_menus #cboView').val(json[0].sym_view);
                $('#frmsys_menus #cboList').val(json[0].sym_list);
                $('#frmsys_menus #cboAdd').val(json[0].sym_add);
                $('#frmsys_menus #cboEdit').val(json[0].sym_edit);
                $('#frmsys_menus #cboDelete').val(json[0].sym_delete);
                $('#frmsys_menus #cboApproval1').val(json[0].sym_approval_1);
                $('#frmsys_menus #cboApproval2').val(json[0].sym_approval_2);
                $('#frmsys_menus #cboApproval3').val(json[0].sym_approval_3);
                $('#frmsys_menus #cboApproval4').val(json[0].sym_approval_4);
                $('#frmsys_menus #cboApproval5').val(json[0].sym_approval_5);
                $('#frmsys_menus #cboSendToApproval').val(json[0].sym_send_to_approval);
                $('#frmsys_menus #cboPrint').val(json[0].sym_print);
                $('#frmsys_menus #cboReject').val(json[0].sym_reject);
                $('#frmsys_menus #cboRevise').val(json[0].sym_revise);
                $('#frmsys_menus #cboAdminRight').val(json[0].sym_admin_right);
                $('#frmsys_menus #cboCopyToClipboard').val(json[0].sym_copy_to_clipboard);
                $('#frmsys_menus #cboExportToExcel').val(json[0].sym_export_to_excel);
                $('#frmsys_menus #cboExportToPdf').val(json[0].sym_export_to_pdf);
                $('#frmsys_menus #cboWithoutPermission').val(json[0].sym_without_permission);
                $('#frmsys_menus #txtBehaviour').val(json[0].sym_behaviour);
                $('#frmsys_menus #txtAwesomeIcon').val(json[0].sym_awesome_icon);
                $('#frmsys_menus #txtModule').val(json[0].sym_module);
                        }
    });
  });
});// Document Ready End

function loadSearchCombo($id){
	var url = "menu-db-get.php?requestType=loadSearchCombo";
	var httpobj = $.ajax({url:url,async:false})
	$('#frmsys_menus #cboSearch').html(httpobj.responseText);
	$('#frmsys_menus #cboSearch').val($id);
}


