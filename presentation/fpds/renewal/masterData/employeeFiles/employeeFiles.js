

var anStatus = "Auto";
$( document ).ready( function () {
  // =================================
  // Access Control
  // ---------------------------------
  // Reset
  $('#frmhrm_employee_files #btnNew').hide();
  $('#frmhrm_employee_files #btnList').hide();
  $('#frmhrm_employee_files #btnSave').hide();
  $('#frmhrm_employee_files #btnPrint').hide();
  $('#frmhrm_employee_files #btnDelete').hide();
  $('#frmhrm_employee_files #btnApprove').hide();
  $('#frmhrm_employee_files #btnReject').hide();
  $('#frmhrm_employee_files #cboSearch').prop('disabled', true);
  
  if(intViewx){ // View Permission
 	$('#frmhrm_employee_files #cboSearch').prop('disabled', false);
  }
  if(intListx){ // Listing Permission
 	$('#frmhrm_employee_files #btnList').show();
  }
  if(intAddx){ // Insert New Permission
 	$('#frmhrm_employee_files #btnNew').show();
 	$('#frmhrm_employee_files #btnSave').show();
  }
  if(intEditx){ // Update Permission
 	$('#frmhrm_employee_files #btnSave').show();
 	$('#frmhrm_employee_files #cboSearch').prop('disabled', false);
  }
  if(intDeletex){ // Delete Permission
 	$('#frmhrm_employee_files #btnDelete').show();
 	$('#frmhrm_employee_files #cboSearch').prop('disabled', false);
  }
  if(intPrintx){ // Delete Permission
 	$('#frmhrm_employee_files #btnPrint').show();
 	$('#frmhrm_employee_files #cboSearch').prop('disabled', false);
  }

    // =================================
  // Validation
  // ---------------------------------
  $( "#frmhrm_employee_files" ).validate( {
      rules: {
        cboCategoryId:"required",
        cboSearch:"required",
        
      },
      submitHandler: function () {
          modalMsgBox("Info", "Not Implemented ...");
      }
  } );
  // ----------------------------------------------------------
  //        Active Tab
  // ----------------------------------------------------------
  $('.employee-tab a').each(function(){
    $href = $(this).attr('href');
    $url = $href.split('?')[0];
    $tempPath = backwardSeparator + xprojectPath;
    if($url==$tempPath){
      $(this).addClass('active');
    }
    else{
      $(this).removeClass('active');
    }
  });
  // --------------------------------------------------------
  //      New Function
  // --------------------------------------------------------
  $("#frmhrm_employee_files #btnNew").click(function(){  
    $("#frmhrm_employee_files").get(0).reset();
    $("#frmhrm_employee_files").validate().resetForm();
  });
  // --------------------------------------------------------
  //      Listing Function
  // --------------------------------------------------------
  $("#frmhrm_employee_files #btnList").click(function(){  
    window.location.assign("employeeFilesListing.php");
  });
  // --------------------------------------------------------
  //      Print Function
  // --------------------------------------------------------
  $("#frmhrm_employee_files #btnPrint").click(function(){  
    if($('#frmhrm_employee_files #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmhrm_employee_files #cboSearch').val();
      window.location.assign("employeeFilesPrint.php?id="+id);
    }
  });
  // --------------------------------------------------------
  //      Close Function
  // --------------------------------------------------------
  $("#frmhrm_employee_files #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
  // --------------------------------------------------------
  //      Save Function
  // --------------------------------------------------------
  $("#frmhrm_employee_files #btnSave").click(function(){  
    var requestType = '';
    var id = '';
    if($("#frmhrm_employee_files").valid()){   // test for validity
      //------------------------------------------
      // upload files
      //------------------------------------------
      divDropzone.processQueue();
     // $('#frmhrm_employee_files #cboSearch').trigger('change');
     $('#frmhrm_employee_files #cboSearch').change();
                        
    } else {
      modalMsgBox("Error", "Validation Failed ...");
    }
  });
  // --------------------------------------------------------
  //      Upload Files
  // --------------------------------------------------------
  Dropzone.autoDiscover = false;
  var divDropzone = new Dropzone("#abc-efg", {
        paramName: "file",
        maxFilesize: 10,
        acceptedFiles: "application/pdf",
        url: backwardSeparator+'presentation/dms/file/file-db-set.php?requestType=upload',
        previewsContainer: "#dropzone-previews",
        autoProcessQueue: false,
        uploadMultiple: false,
        parallelUploads: 5,
//                  clickable: inputClick[0],
        maxFiles: 20,
        init: function() {
            var cd;
            var index = 0;
            this.on("processing", function(file) {
              $refNo = '';//$('#txtReferenceNo').val();
              $catId = $('#cboCategoryId').val();
              $meta = $('#txtMetaData').val();
              $refId = $('#cboSearch').val();
              $para = '&ref_no='+$refNo+'&ref_id='+$refId+'&cat_id='+$catId+'&meta='+$meta;
              this.options.url = backwardSeparator+"presentation/dms/file/file-db-set.php?requestType=upload"+$para;
            });
            this.on("error", function(file, errorMessage, xhr) {
              file.status = Dropzone.QUEUED;
            });
            this.on("success", function(file, response) {
              location.reload();
                $('.dz-progress').hide();
                $('.dz-size').hide();
                $('.dz-error-mark').hide();
                $('.dz-success-mark').show();
                console.log(response);
                console.log(file);
                cd = JSON.parse(response);

                var idInput = Dropzone.createElement('<input type="hidden" class="doc_id" value="'+cd.id+'"/>');
                var urlInput = Dropzone.createElement('<input type="hidden" class="doc_url" value="'+cd.url+'"/>');
                file.previewElement.append(idInput);
                file.previewElement.append(urlInput);
                location.reload();
            });
            this.on("addedfile", function(file) {
                var removeButton = Dropzone.createElement('<div class="filePreviewDeleteButton"><a href="#"><img src="'+backwardSeparator+'img/core/deletered.png"></img></a></div>');
                var _this = this;
                removeButton.addEventListener("click", function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    _this.removeFile(file);
                    $id = $('.doc_id', $(e.target).closest('div').parent()).val();
                    $url = $('.doc_url', $(e.target).closest('div').parent()).val();
//                        var name = "largeFileName=" + cd.pi.largePicPath + "&smallFileName=" + cd.pi.smallPicPath;
                    var name = "fileName=" + $url +"&id=" + $id;
                    $.ajax({
                        type: 'POST',
                        url: backwardSeparator+'presentation/dms/file/file-db-set.php?requestType=unlink',
                        data: name,
                        dataType: 'json'
                    });
                });
                file.previewElement.append(removeButton);
                var remarksButton = Dropzone.createElement('<div class="filePreviewUpdateButton" id="divPreviewBtn_'+index+'"><a href="#"><img src="'+backwardSeparator+'img/core/edit.png"></img></a></div>');
                var _this = this;
                remarksButton.addEventListener("click", function(e) {
                    $id = $('.doc_id', $(e.target).closest('div').parent()).val();
                    updateRemarks($id);
                });
                file.previewElement.append(remarksButton);
                
                index++; // Increment Image Index
            });
        }
  });
    
  // =====================================================
  // ===============  Search  combo Content Load =========
  // =====================================================
  $("#frmhrm_employee_files #cboSearch").focus(function(){
      const urlParams = new URLSearchParams(window.location.search);
      const id = urlParams.get('id');
      loadSearchCombo(id);
  });
  // ========================================
  // ===============  Search Record =========
  // ========================================
  $("#frmhrm_employee_files #cboSearch").change(function(){  
    $("#frmhrm_employee_files").validate().resetForm();
    var url = "employeeFiles-db-get.php";
    $('#tblEmpExistingDocuments tbody .dataRow').each(function(){
      $(this).remove();
    });	
    if($(this).val()==''){
        return;
    }
    $id = $(this).val();
    var httpobj = $.ajax({
        url:url,
        dataType:'json',
        data:'requestType=loadDetails&id='+$id,
        async:false,
        success:function(json){
          if(json){ 
            for (var i=0; i<json.length; i++) {
//              ema_id, sye_name, syf_name, ema_account_no, ema_amount, stat_name
              $newRow = $('#tblEmpExistingDocuments .cloneRow').eq(0).clone();
              $newRow.removeClass('cloneRow').addClass('dataRow');
              $newRow.css('display','table-row');
              $('.category', $newRow).html(json[i].dfc_name);
              $('.name', $newRow).html(json[i].dfi_file_name);
              $('.reference', $newRow).html(json[i].dfi_reference_no);
              $('.version', $newRow).html(json[i].dfi_file_version);
//              $('.status', $newRow).html(json[i].stat_name);
              // Update Link
              var fileId = json[i].dfi_id;
              $('.action', $newRow).attr('data_file_id',fileId);
              $('.action', $newRow).on('click',function(e){
                e.preventDefault(); 
                var fileId = $(e.target).closest('a').attr('data_file_id');
                fileAccess(fileId);
              });
              $('.action', $newRow).hide();
              /*if(json[i].permission>0){*/
                $('.action', $newRow).show();
            /*  }*/
              
              $('#tblEmpExistingDocuments tbody').append($newRow);
            }
            loadFileList($id);
          }        
        }
    });
  });
  
  // =================================
  // Load Search Dropdown content
  // ---------------------------------
  loadSearchCombo(employeeId);

});// Document Ready End

function loadSearchCombo($id){
	var url = "employeeFiles-db-get.php?requestType=loadSearchCombo&id="+$id;
	var httpobj = $.ajax({url:url,async:false})
	$('#frmhrm_employee_files #cboSearch').html(httpobj.responseText);
	//$('#frmhrm_employee_files #cboSearch').val($id);
	$('#frmhrm_employee_files #cboSearch').trigger('change');
}
function loadFileList($id){
    $("#tblEmpExistingDocuments1").find("tr:gt(0)").remove();
     var url = "employeeFiles-db-get.php";
    var httpobj = $.ajax({
        url:url,
        dataType:'json',
        data:'requestType=loadFileList&id='+$id,
        async:false,
        success:function(json){
          if(json){ 
            for (var i=0; i<json.length; i++) {
                
               $('#tblEmpExistingDocuments1').append('<tr class="cloneRow" style=""><td class="category p-1">'+json[i].dfc_name+'</td><td class="name p-1">'+json[i].dfc_is_mandatory+'</td></tr>');
            }
          }        
        }
    });
    
}

