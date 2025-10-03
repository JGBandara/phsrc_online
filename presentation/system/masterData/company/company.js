
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-07
 */
var anStatus = "Auto";
$( document ).ready( function () {
  // =================================
  // Access Control
  // ---------------------------------
  // Reset
  $('#frmsys_companies #btnNew').hide();
  $('#frmsys_companies #btnList').hide();
  $('#frmsys_companies #btnSave').hide();
  $('#frmsys_companies #btnPrint').hide();
  $('#frmsys_companies #btnDelete').hide();
  $('#frmsys_companies #btnApprove').hide();
  $('#frmsys_companies #btnReject').hide();
  $('#frmsys_companies #cboSearch').prop('disabled', true);
  
  if(intViewx){ // View Permission
 	$('#frmsys_companies #cboSearch').prop('disabled', false);
  }
  if(intListx){ // Listing Permission
 	$('#frmsys_companies #btnList').show();
  }
  if(intAddx){ // Insert New Permission
 	$('#frmsys_companies #btnNew').show();
 	$('#frmsys_companies #btnSave').show();
  }
  if(intEditx){ // Update Permission
 	$('#frmsys_companies #btnSave').show();
 	$('#frmsys_companies #cboSearch').prop('disabled', false);
  }
  if(intDeletex){ // Delete Permission
 	$('#frmsys_companies #btnDelete').show();
 	$('#frmsys_companies #cboSearch').prop('disabled', false);
  }
  if(intPrintx){ // Delete Permission
 	$('#frmsys_companies #btnPrint').show();
 	$('#frmsys_companies #cboSearch').prop('disabled', false);
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
  $( "#frmsys_companies" ).validate( {
      rules: {
        txtCode: {
                  required: true,
                  maxlength: 10
                },
        txtName: {
                  required: true,
                  maxlength: 50
                },
        cboCountryId:"required",
        txtWebSite: {
                  maxlength: 250
                },
        txtRemarks: {
                  maxlength: 250
                },
        txtAccountNo: {
                  maxlength: 100
                },
        txtRegistrationNo: {
                  maxlength: 100
                },
        txtVatNo: {
                  maxlength: 100
                },
        txtSvatNo: {
                  maxlength: 100
                },
        txtWorkingDayType: {
                  maxlength: 32
                },
        txtMenuOrder: {
                  maxlength: 100
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
  $('#frmsys_companies #chkAutoManual').click(function(){
    if($('#frmsys_companies #chkAutoManual').eq(0).is(':checked')){
      anStatus = "Auto";
      $('#frmsys_companies #syc_code').val('');
      $('#frmsys_companies #syc_code').prop("readonly",true);
      $('#frmsys_companies #syc_code').rules( "remove" );
    }
    else{
      anStatus = "Manual";
      $('#frmsys_companies #syc_code').val('');
      $('#frmsys_companies #syc_code').prop("readonly",false);
      $('#frmsys_companies #syc_code').rules("add", {
                                                    required: true,
                                                  });
    }
  });
  // --------------------------------------------------------
  //      New Function
  // --------------------------------------------------------
  $("#frmsys_companies #btnNew").click(function(){  
    $("#frmsys_companies").get(0).reset();
    $("#frmsys_companies").validate().resetForm();
  });
  // --------------------------------------------------------
  //      Listing Function
  // --------------------------------------------------------
  $("#frmsys_companies #btnList").click(function(){  
    window.location.assign("companyListing.php");
  });
  // --------------------------------------------------------
  //      Print Function
  // --------------------------------------------------------
  $("#frmsys_companies #btnPrint").click(function(){  
    if($('#frmsys_companies #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmsys_companies #cboSearch').val();
      window.location.assign("companyPrint.php?id="+id);
    }
  });
  // --------------------------------------------------------
  //      Close Function
  // --------------------------------------------------------
  $("#frmsys_companies #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
  // --------------------------------------------------------
  //      Save Function
  // --------------------------------------------------------
  $("#frmsys_companies #btnSave").click(function(){  
    var requestType = '';
    var id = '';
    if($("#frmsys_companies").valid()){   // test for validity
      if($('#frmsys_companies #cboSearch').val()==''){
        requestType = 'add';	
      }
      else{
        requestType = 'edit';	
        id = $('#frmsys_companies #cboSearch').val();
      }
      var url = "company-db-set.php";
      var obj = $.ajax({
			url:url,
			dataType: "json",
			type:'post', 
			data:$("#frmsys_companies").serialize()+'&requestType='+requestType+'&cboSearch='+id+'&anStatus='+anStatus,
			async:false,
			
			success:function(json){
					if(json.type=='pass'){
						$('#frmsys_companies').get(0).reset();
                        id = json.id;
						loadSearchCombo(id);
                        $('#frmsys_companies #cboSearch').trigger('change');
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
  $("#frmsys_companies #btnDelete").click(function(){  
    var requestType = 'delete';
    var id = '';
    if($('#frmsys_companies #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmsys_companies #cboSearch').val();
    }
    var url = "company-db-set.php";
    var obj = $.ajax({
          url:url,
          dataType: "json",
          type:'post', 
          data:'requestType='+requestType+'&cboSearch='+id,
          async:false,

          success:function(json){
                  if(json.type=='pass'){
                      $('#frmsys_companies').get(0).reset();
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
  $("#frmsys_companies #cboSearch").focus(function(){  
    loadSearchCombo($(this).val());
  });
  // ========================================
  // ===============  Search Record =========
  // ========================================
  $("#frmsys_companies #cboSearch").change(function(){  
    $("#frmsys_companies").validate().resetForm();
    var url = "company-db-get.php";
    if($('#frmsys_companies #cboSearch').val()==''){
        $('#frmsys_companies').get(0).reset();return;	
    }
    var httpobj = $.ajax({
        url:url,
        dataType:'json',
        data:'requestType=loadDetails&id='+$(this).val(),
        async:false,
        success:function(json){
        //jQuery.each($menuList, function($m, $menu) {
        //});
        $('#frmsys_companies #txtCode').val(json[0].syc_code);
                $('#frmsys_companies #txtName').val(json[0].syc_name);
                $('#frmsys_companies #cboCountryId').val(json[0].syc_country_id);
                $('#frmsys_companies #txtWebSite').val(json[0].syc_web_site);
                $('#frmsys_companies #txtRemarks').val(json[0].syc_remarks);
                $('#frmsys_companies #txtAccountNo').val(json[0].syc_account_no);
                $('#frmsys_companies #txtRegistrationNo').val(json[0].syc_registration_no);
                $('#frmsys_companies #txtVatNo').val(json[0].syc_vat_no);
                $('#frmsys_companies #txtSvatNo').val(json[0].syc_svat_no);
                $('#frmsys_companies #txtWorkingDayType').val(json[0].syc_working_day_type);
                $('#frmsys_companies #cboBaseCurrencyId').val(json[0].syc_base_currency_id);
                if(json[0].syc_tax_applicable=='1')
                  $('#frmsys_companies #optTaxApplicable').prop('checked',true);
                else
                  $('#frmsys_companies #optTaxApplicable').prop('checked',false); 
                $('#frmsys_companies input[name="optTaxApplicable"][value="'+json[0].syc_tax_applicable+'"]').prop('checked', true);

                if(json[0].syc_nopay_consider=='1')
                  $('#frmsys_companies #optNopayConsider').prop('checked',true);
                else
                  $('#frmsys_companies #optNopayConsider').prop('checked',false); 
                $('#frmsys_companies input[name="optNopayConsider"][value="'+json[0].syc_nopay_consider+'"]').prop('checked', true);

                $('#frmsys_companies #txtMenuOrder').val(json[0].syc_menu_order);
                $('#frmsys_companies #cboStatus').val(json[0].syc_status);
                if(json[0].syc_is_deleted=='1')
                  $('#frmsys_companies #optIsDeleted').prop('checked',true);
                else
                  $('#frmsys_companies #optIsDeleted').prop('checked',false); 
                $('#frmsys_companies input[name="optIsDeleted"][value="'+json[0].syc_is_deleted+'"]').prop('checked', true);

                $('#frmsys_companies #cboCreatedBy').val(json[0].syc_created_by);
                $('#frmsys_companies #cboCreatedOn').val(json[0].syc_created_on);
                $('#frmsys_companies #cboLastModifiedBy').val(json[0].syc_last_modified_by);
                $('#frmsys_companies #cboLastModifiedOn').val(json[0].syc_last_modified_on);
                $('#frmsys_companies #cboDeletedBy').val(json[0].syc_deleted_by);
                $('#frmsys_companies #cboDeletedOn').val(json[0].syc_deleted_on);
                        }
    });
  });
  
  // =================================
  // Load Search Dropdown content
  // ---------------------------------
  loadSearchCombo(searchId);

});// Document Ready End

function loadSearchCombo($id){
	var url = "company-db-get.php?requestType=loadSearchCombo";
	var httpobj = $.ajax({url:url,async:false})
	$('#frmsys_companies #cboSearch').html(httpobj.responseText);
	$('#frmsys_companies #cboSearch').val($id);
	$('#frmsys_companies #cboSearch').trigger('change');
}


