
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-23
 */
var anStatus = "Auto";
$( document ).ready( function () {
  // =================================
  // Access Control
  // ---------------------------------
  // Reset
  $('#frmhrm_trn_academic_qualification #btnNew').hide();
  $('#frmhrm_trn_academic_qualification #btnList').hide();
  $('#frmhrm_trn_academic_qualification #btnSave').hide();
  $('#frmhrm_trn_academic_qualification #btnPrint').hide();
  $('#frmhrm_trn_academic_qualification #btnDelete').hide();
  $('#frmhrm_trn_academic_qualification #btnApprove').hide();
  $('#frmhrm_trn_academic_qualification #btnReject').hide();
  $('#frmhrm_trn_academic_qualification #cboSearch').prop('disabled', true);
  
  if(intViewx){ // View Permission
 	$('#frmhrm_trn_academic_qualification #cboSearch').prop('disabled', false);
  }
  if(intListx){ // Listing Permission
 	$('#frmhrm_trn_academic_qualification #btnList').show();
  }
  if(intAddx){ // Insert New Permission
 	$('#frmhrm_trn_academic_qualification #btnNew').show();
 	$('#frmhrm_trn_academic_qualification #btnSave').show();
  }
  if(intEditx){ // Update Permission
 	$('#frmhrm_trn_academic_qualification #btnSave').show();
 	$('#frmhrm_trn_academic_qualification #cboSearch').prop('disabled', false);
  }
  if(intDeletex){ // Delete Permission
 	$('#frmhrm_trn_academic_qualification #btnDelete').show();
 	$('#frmhrm_trn_academic_qualification #cboSearch').prop('disabled', false);
  }
  if(intPrintx){ // Delete Permission
 	$('#frmhrm_trn_academic_qualification #btnPrint').show();
 	$('#frmhrm_trn_academic_qualification #cboSearch').prop('disabled', false);
  }

    // =================================
  // Validation
  // ---------------------------------
  $( "#frmhrm_trn_academic_qualification" ).validate( {
      rules: {
        cboEmployeeId:"required",
        cboTypeId:"required",
        cboStreamId:"required",
        txtInstitute: {
                  required: true,
                  maxlength: 256
                },
        txtYear: {
                  required: true,
                  maxlength: 4
                },
        txtIndexNo: {
                    maxlength: 32
                  },
        txtRemarks: {
                    maxlength: 256
                  },
        cboStatus:"required",
        cboCompanyId:"required",
        // TODO: validate year
        
      },
      submitHandler: function () {
          modalMsgBox("Info", "Not Implemented ...");
      }
  } );
  // --------------------------------------------------------
  //      Auto Number / Manual Number
  // --------------------------------------------------------
  $('#frmhrm_trn_academic_qualification #chkAutoManual').click(function(){
    if($('#frmhrm_trn_academic_qualification #chkAutoManual').eq(0).is(':checked')){
      anStatus = "Auto";
      $('#frmhrm_trn_academic_qualification #eaq_employee_id').val('');
      $('#frmhrm_trn_academic_qualification #eaq_employee_id').prop("readonly",true);
      $('#frmhrm_trn_academic_qualification #eaq_employee_id').rules( "remove" );
    }
    else{
      anStatus = "Manual";
      $('#frmhrm_trn_academic_qualification #eaq_employee_id').val('');
      $('#frmhrm_trn_academic_qualification #eaq_employee_id').prop("readonly",false);
      $('#frmhrm_trn_academic_qualification #eaq_employee_id').rules("add", {
                                                    required: true,
                                                  });
    }
  });
  // --------------------------------------------------------
  //      New Function
  // --------------------------------------------------------
  $("#frmhrm_trn_academic_qualification #btnNew").click(function(){  
    $("#frmhrm_trn_academic_qualification").get(0).reset();
    $("#frmhrm_trn_academic_qualification").validate().resetForm();
    $("#tblhrm_trn_academic_qualification_details .dataRow").each(function(){
      $(this).remove();
    });
    $("#tblhrm_trn_academic_qualification_details .deletedRow").each(function(){
      $(this).remove();
    });
        $('#tblhrm_trn_academic_qualification tbody .dataRow').each(function(){
      $(this).remove();
    });	
      });
  // --------------------------------------------------------
  //      Listing Function
  // --------------------------------------------------------
  $("#frmhrm_trn_academic_qualification #btnList").click(function(){  
    window.location.assign("academicQualificationListing.php");
  });
  // --------------------------------------------------------
  //      Print Function
  // --------------------------------------------------------
  $("#frmhrm_trn_academic_qualification #btnPrint").click(function(){  
    if($('#frmhrm_trn_academic_qualification #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmhrm_trn_academic_qualification #cboSearch').val();
      window.location.assign("academicQualificationPrint.php?id="+id);
    }
  });
  // --------------------------------------------------------
  //      Close Function
  // --------------------------------------------------------
  $("#frmhrm_trn_academic_qualification #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
  // --------------------------------------------------------
  //      Save Function
  // --------------------------------------------------------
  $("#frmhrm_trn_academic_qualification #btnSave").click(function(){  
    var requestType = '';
    var id = '';
    if($("#frmhrm_trn_academic_qualification").valid()){   // test for validity
      if($('#frmhrm_trn_academic_qualification #cboSearch').val()==''){
        requestType = 'add';	
      }
      else{
        requestType = 'edit';	
        id = $('#frmhrm_trn_academic_qualification #cboSearch').val();
      }
      var url = "academicQualification-db-set.php";
      var obj = $.ajax({
			url:url,
			dataType: "json",
			type:'post', 
			data:'requestType='+requestType+'&cboSearch='+id+'&anStatus='+anStatus+getParameters(),
			async:false,
			
			success:function(json){
					if(json.type=='pass'){
						$('#frmhrm_trn_academic_qualification').get(0).reset();
                        id = json.id;
						loadSearchCombo(id);
                        $('#frmhrm_trn_academic_qualification #cboSearch').trigger('change');
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
  $("#frmhrm_trn_academic_qualification #btnDelete").click(function(){  
    var requestType = 'delete';
    var id = '';
    if($('#frmhrm_trn_academic_qualification #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmhrm_trn_academic_qualification #cboSearch').val();
    }
    var url = "academicQualification-db-set.php";
    var obj = $.ajax({
          url:url,
          dataType: "json",
          type:'post', 
          data:'requestType='+requestType+'&cboSearch='+id,
          async:false,

          success:function(json){
                  if(json.type=='pass'){
                      $('#frmhrm_trn_academic_qualification').get(0).reset();
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
  $("#frmhrm_trn_academic_qualification #cboSearch").focus(function(){  
    loadSearchCombo($(this).val());
  });
  // ========================================
  // ===============  Search Record =========
  // ========================================
  $("#frmhrm_trn_academic_qualification #cboSearch").change(function(){  
    $("#frmhrm_trn_academic_qualification").validate().resetForm();
    var url = "academicQualification-db-get.php";
    if($(this).val()==''){
        $('#frmhrm_trn_academic_qualification').get(0).reset();return;	
        $("#tblhrm_trn_academic_qualification_details .dataRow").each(function(){
          $(this).remove();
        });
        $("#tblhrm_trn_academic_qualification_details .deletedRow").each(function(){
          $(this).remove();
        });
    }
    $id = $(this).val();
    var httpobj = $.ajax({
        url:url,
        dataType:'json',
        data:'requestType=loadDetails&id='+$id,
        async:false,
        success:function(json){
          $('#frmhrm_trn_academic_qualification').get(0).reset();
          $("#tblhrm_trn_academic_qualification_details .dataRow").each(function(){
            $(this).remove();
          });
          $("#tblhrm_trn_academic_qualification_details .deletedRow").each(function(){
            $(this).remove();
          });
          $('#frmhrm_trn_academic_qualification #cboSearch').val($id);
          if(json){ 
            $('#frmhrm_trn_academic_qualification #cboEmployeeId').val(json.header[0].eaq_employee_id);
            $("#frmhrm_trn_academic_qualification #cboEmployeeId").trigger('change');
            $('#frmhrm_trn_academic_qualification #cboTypeId').val(json.header[0].eaq_type_id);
            $("#frmhrm_trn_academic_qualification #cboTypeId").trigger('change');
            $('#frmhrm_trn_academic_qualification #cboStreamId').val(json.header[0].eaq_stream_id);
            $('#frmhrm_trn_academic_qualification #txtInstitute').val(json.header[0].eaq_institute);
            $('#frmhrm_trn_academic_qualification #txtYear').val(json.header[0].eaq_year);
            $('#frmhrm_trn_academic_qualification #txtIndexNo').val(json.header[0].eaq_index_no);
            $('#frmhrm_trn_academic_qualification #txtRemarks').val(json.header[0].eaq_remarks);
            $('#frmhrm_trn_academic_qualification #cboStatus').val(json.header[0].eaq_status);

            // Details
            if(json.details!=null){
              for(var j=0;j<=json.details.length-1;j++){
                $trCount = $('#tblhrm_trn_academic_qualification_details tbody tr').length;
                $newRow = $("#tblhrm_trn_academic_qualification_details .cloneRow").clone();
                $(".detId", $newRow).attr("id","cboDetId_"+$trCount);
                $(".detId", $newRow).attr("name","cboDetId_"+$trCount);
                $(".detId", $newRow).val(json.details[j].eaqd_id);
                $(".detSubjectId", $newRow).attr("id","cboDetSubjectId_"+$trCount);
                $(".detSubjectId", $newRow).attr("name","cboDetSubjectId_"+$trCount);
                $(".detSubjectId", $newRow).val(json.details[j].eaqd_subject_id);
                $(".detGrade", $newRow).attr("id","txtDetGrade_"+$trCount);
                $(".detGrade", $newRow).attr("name","txtDetGrade_"+$trCount);
                $(".detGrade", $newRow).val(json.details[j].eaqd_grade);
                $(".detRemarks", $newRow).attr("id","txtDetRemarks_"+$trCount);
                $(".detRemarks", $newRow).attr("name","txtDetRemarks_"+$trCount);
                $(".detRemarks", $newRow).val(json.details[j].eaqd_remarks);
                
                $newRow.removeClass('cloneRow');
                $newRow.addClass('dataRow');

                $('.deleteDataRow', $newRow).on('click',function(e){deleteDataRow(e);});
                $('#tblhrm_trn_academic_qualification_details tbody').append($newRow);
              }
            }
          } // Json exist end if
        }
    });
  });
    // ===============================================
  // ===============  Get Existing academicQualification =========
  // ===============================================
  $("#frmhrm_trn_academic_qualification #cboEmployeeId").change(function(){  
    var url = "academicQualification-db-get.php";
    $('#tblacademicQualification tbody .dataRow').each(function(){
      $(this).remove();
    });	
    if($(this).val()==''){
      return;
    }
    employeeId = $(this).val();
    var httpobj = $.ajax({
        url:url,
        dataType:'json',
        data:'requestType=loadExistingAcademicQualification&id='+employeeId,
        async:false,
        success:function(json){
//          $('#frmhrm_trn_academic_qualification').get(0).reset();
//          $("#frmhrm_trn_academic_qualification #cboEmployeeId").val($id);
          if(json){ 
            for (var i=0; i<json.length; i++) {
              $newRow = $('#tblacademicQualification .cloneRow').eq(0).clone();
              $newRow.removeClass('cloneRow').addClass('dataRow');
              $newRow.css('display','table-row');
                
              $('.eaq_id', $newRow).html(json[i].eaq_id);
              $('.eaq_employee_id', $newRow).html(json[i].eaq_employee_id);
              $('.eaq_type_id', $newRow).html(json[i].aqt_name);
              $('.eaq_stream_id', $newRow).html(json[i].aqs_name);
              $('.eaq_institute', $newRow).html(json[i].eaq_institute);
              $('.eaq_year', $newRow).html(json[i].eaq_year);
              $('.eaq_index_no', $newRow).html(json[i].eaq_index_no);
              $('.eaq_remarks', $newRow).html(json[i].eaq_remarks);
              $('.status', $newRow).html(json[i].stat_name);
                            // Update Link
              $href = $('.action', $newRow).attr('href');
              $href = $href.split('?id=')[0];
              $href = $href.split('?rec_id=')[0]+'?rec_id='+json[i].eaq_id;
              $('.action', $newRow).attr('href', $href);
//              if(json[i].stat_name!=='Completed'){
//                $('.action', $newRow).hide();
//              }
              
              $('#tblacademicQualification tbody').append($newRow);
            }
          }
        }
    });
  });
  // =================================
  // Load Subject
  // ---------------------------------
  $('#cboTypeId').on('change', function(){
    $typeId = $(this).val();
    if($typeId == ''){
      $('.detSubjectId').each(function(){$(this).html("");});
      return;
    }
 	var url = "academicQualification-db-get.php?requestType=loadSubjectCombo&type_id="+$typeId;
	var httpobj = $.ajax({url:url,async:false})
    $optionLisr = httpobj.responseText;
    $('.detSubjectId').each(function(){$(this).html($optionLisr);});   
  });
  // =================================
  // Select Employee
  // ---------------------------------
  if(employeeId!==""){
    $("#frmhrm_trn_academic_qualification #cboEmployeeId").val(employeeId);
    $("#frmhrm_trn_academic_qualification #cboEmployeeId").trigger('change');
  }
    // =================================
  // Load Search Dropdown content
  // ---------------------------------
  loadSearchCombo(searchId);
  
  // =================================
  // Details Validation
  // ---------------------------------
    $.validator.addClassRules("detSubjectId", {
      required:true,  
    });
    $.validator.addClassRules("detGrade", {
      required:true,  
      maxlength: 16
    });
    $.validator.addClassRules("detRemarks", {
      maxlength: 256
    });
    $.validator.addClassRules("detStatus", {
      required:true,  
    });
    $.validator.addClassRules("detCompanyId", {
      required:true,  
    });
      

});// Document Ready End

function loadSearchCombo($id){
	var url = "academicQualification-db-get.php?requestType=loadSearchCombo";
	var httpobj = $.ajax({url:url,async:false})
	$('#frmhrm_trn_academic_qualification #cboSearch').html(httpobj.responseText);
	$('#frmhrm_trn_academic_qualification #cboSearch').val($id);
	$('#frmhrm_trn_academic_qualification #cboSearch').trigger('change');
}

function getParameters(){
  var param = "";
      
  param += "&cboEmployeeId="+$("#cboEmployeeId").val();       
  param += "&cboTypeId="+$("#cboTypeId").val();       
  param += "&cboStreamId="+$("#cboStreamId").val();       
  param += "&txtInstitute="+$("#txtInstitute").val();       
  param += "&txtYear="+$("#txtYear").val();       
  param += "&txtIndexNo="+$("#txtIndexNo").val();       
  param += "&txtRemarks="+$("#txtRemarks").val();       
  param += "&cboStatus="+$("#cboStatus").val(); 
  // --------------------------------------------------------------------
  // ----------------     Detail Parameters    --------------------------
  // --------------------------------------------------------------------

  var newData = "[ ";
  $("#tblhrm_trn_academic_qualification_details .dataRow").each(function(){
    newData += '{ ' ;
      
    newData += '"detId":"'+$(".detId",$(this)).val()+'",';      
    newData += '"detSubjectId":"'+$(".detSubjectId",$(this)).val()+'",';      
    newData += '"detGrade":"'+$(".detGrade",$(this)).val()+'",';      
    newData += '"detRemarks":"'+$(".detRemarks",$(this)).val()+'",';
    newData = newData.substr(0,newData.length-1);
    newData += ' },' ;
  });
  newData = newData.substr(0,newData.length-1);
  newData += " ]";
  

  // ======================    Deleted Items  ==========================
  var deletedData = "[ ";
  $("#tblhrm_trn_academic_qualification_details .deletedRow").each(function(){
   
    if($(".detId",$(this)).val()!=""){
      deletedData += '"'+$(".detId",$(this)).val()+'",';
    }
  });
  deletedData = deletedData.substr(0,deletedData.length-1);
  deletedData += " ]";
  
  return param+'&newData='+newData+'&deletedData='+deletedData;
}
// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// =========================================================================
// ===============  Details Section ========================================
// =========================================================================
$( document ).ready( function () {
  $('.newDataRow').each(function(){
    $(this).on('click',function(e){addNewDataRow(e);});
  });
});
function addNewDataRow(e){
  $table = $(e.target).closest('table');
  $newRow = $('.cloneRow', $table).eq(0).clone();
  $trCount = $('tbody tr', $table).length;
  
  $(".detId", $newRow).attr("id","cboDetId_"+$trCount);
  $(".detId", $newRow).attr("name","cboDetId_"+$trCount);
  $(".detSubjectId", $newRow).attr("id","cboDetSubjectId_"+$trCount);
  $(".detSubjectId", $newRow).attr("name","cboDetSubjectId_"+$trCount);
  $(".detGrade", $newRow).attr("id","txtDetGrade_"+$trCount);
  $(".detGrade", $newRow).attr("name","txtDetGrade_"+$trCount);
  $(".detRemarks", $newRow).attr("id","txtDetRemarks_"+$trCount);
  $(".detRemarks", $newRow).attr("name","txtDetRemarks_"+$trCount);
    
  $newRow.removeClass('cloneRow');
  $newRow.addClass('dataRow');
    
  $('.deleteDataRow', $newRow).on('click',function(e){deleteDataRow(e);});
  $('tbody', $table).append($newRow);
}

function deleteDataRow(e){
  $tr = $(e.target).closest('tr');
  $tr.removeClass('dataRow');
  $tr.addClass('deletedRow');
}
