/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-12
 */
var anStatus = "Auto";
$( document ).ready( function () {
    Dropzone.autoDiscover = false;

  // =================================
  // Access Control
  // ---------------------------------
  // Reset
  $('#frmdms_trn_file #btnNew').hide();
  $('#frmdms_trn_file #btnList').hide();
  $('#frmdms_trn_file #btnSave').hide();
  $('#frmdms_trn_file #btnPrint').hide();
  $('#frmdms_trn_file #btnDelete').hide();
  $('#frmdms_trn_file #btnApprove').hide();
  $('#frmdms_trn_file #btnReject').hide();
  $('#frmdms_trn_file #cboSearch').prop('disabled', true);
  
  if(intViewx){ // View Permission
 	$('#frmdms_trn_file #cboSearch').prop('disabled', false);
  }
  if(intListx){ // Listing Permission
 	$('#frmdms_trn_file #btnList').show();
  }
  if(intAddx){ // Insert New Permission
 	$('#frmdms_trn_file #btnNew').show();
 	$('#frmdms_trn_file #btnSave').show();
  }
  if(intEditx){ // Update Permission
 	$('#frmdms_trn_file #btnSave').show();
 	$('#frmdms_trn_file #cboSearch').prop('disabled', false);
  }
  if(intDeletex){ // Delete Permission
 	$('#frmdms_trn_file #btnDelete').show();
 	$('#frmdms_trn_file #cboSearch').prop('disabled', false);
  }
  if(intPrintx){ // Delete Permission
 	$('#frmdms_trn_file #btnPrint').show();
 	$('#frmdms_trn_file #cboSearch').prop('disabled', false);
  }
  
  // =================================
  // Validation
  // ---------------------------------
  $( "#frmdms_trn_file" ).validate( {
      rules: {
        txtReferenceNo: {
                  required: true,
                  maxlength: 128
                },
        cboFileCategoryId:"required",
        txtMetaData: {
                    required: true,
                    maxlength: 256
                  },
        txtRemarks: {
                    maxlength: 256
                  },
        cboStatus:"required",
//        cboCompanyId:"required",
        
      },
      submitHandler: function () {
          modalMsgBox("Info", "Not Implemented ...");
      }
  } );
  // --------------------------------------------------------
  //      Auto Number / Manual Number
  // --------------------------------------------------------
  $('#frmdms_trn_file #chkAutoManual').click(function(){
    if($('#frmdms_trn_file #chkAutoManual').eq(0).is(':checked')){
      anStatus = "Auto";
      $('#frmdms_trn_file #dfi_file_name').val('');
      $('#frmdms_trn_file #dfi_file_name').prop("readonly",true);
      $('#frmdms_trn_file #dfi_file_name').rules( "remove" );
    }
    else{
      anStatus = "Manual";
      $('#frmdms_trn_file #dfi_file_name').val('');
      $('#frmdms_trn_file #dfi_file_name').prop("readonly",false);
      $('#frmdms_trn_file #dfi_file_name').rules("add", {
                                                    required: true,
                                                  });
    }
  });
  // --------------------------------------------------------
  //      New Function
  // --------------------------------------------------------
  $("#frmdms_trn_file #btnNew").click(function(){  
    $("#frmdms_trn_file").get(0).reset();
    $("#frmdms_trn_file").validate().resetForm();
  });
  // --------------------------------------------------------
  //      Listing Function
  // --------------------------------------------------------
  $("#frmdms_trn_file #btnList").click(function(){  
    window.location.assign("fileListing.php");
  });
  // --------------------------------------------------------
  //      Print Function
  // --------------------------------------------------------
  $("#frmdms_trn_file #btnPrint").click(function(){  
    if($('#frmdms_trn_file #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmdms_trn_file #cboSearch').val();
      window.location.assign("filePrint.php?id="+id);
    }
  });
  // --------------------------------------------------------
  //      Close Function
  // --------------------------------------------------------
  $("#frmdms_trn_file #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
  // --------------------------------------------------------
  //      Save Function
  // --------------------------------------------------------
  $("#frmdms_trn_file #btnSave").click(function(){  
    var requestType = '';
    var id = '';
    if($("#frmdms_trn_file").valid()){   // test for validity
      //------------------------------------------
      // upload files
      //------------------------------------------
      divDropzone.processQueue();
                        
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
              $refNo = $('#txtReferenceNo').val();
              $catId = $('#cboFileCategoryId').val();
              $meta = $('#txtMetaData').val();
              $refId = 0;//$('#cboSearch').val();
              $para = '&ref_no='+$refNo+'&ref_id='+$refId+'&cat_id='+$catId+'&meta='+$meta;
              this.options.url = backwardSeparator+"presentation/dms/file/file-db-set.php?requestType=upload"+$para;
            });
            this.on("error", function(file, errorMessage, xhr) {
              file.status = Dropzone.QUEUED;
            });
            this.on("success", function(file, response) {
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
  // --------------------------------------------------------
  //      Delete Function
  // --------------------------------------------------------
  $("#frmdms_trn_file #btnDelete").click(function(){  
    var requestType = 'delete';
    var id = '';
    if($('#frmdms_trn_file #cboSearch').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmdms_trn_file #cboSearch').val();
    }
    var url = "file-db-set.php";
    var obj = $.ajax({
          url:url,
          dataType: "json",
          type:'post', 
          data:'requestType='+requestType+'&cboSearch='+id,
          async:false,

          success:function(json){
                  if(json.type=='pass'){
                      $('#frmdms_trn_file').get(0).reset();
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
  $("#frmdms_trn_file #cboSearch").focus(function(){  
    loadSearchCombo($(this).val());
  });
  // ========================================
  // ===============  Search Record =========
  // ========================================
  $("#frmdms_trn_file #cboSearch").change(function(){  
    $("#frmdms_trn_file").validate().resetForm();
    var url = "file-db-get.php";
    if($(this).val()==''){
        $('#frmdms_trn_file').get(0).reset();return;	
    }
    $id = $(this).val();
    var httpobj = $.ajax({
        url:url,
        dataType:'json',
        data:'requestType=loadDetails&id='+$id,
        async:false,
        success:function(json){
          $('#frmdms_trn_file').get(0).reset();
          $('#frmdms_trn_file #cboSearch').val($id);
          divDropzone.disable();
          $('.dz-preview').remove();
          divDropzone.enable();
          if(json){ 
            $('#frmdms_trn_file #txtFileName').val(json[0].dfi_file_name);
            $('#frmdms_trn_file #txtFileExtension').val(json[0].dfi_file_extension);
            $('#frmdms_trn_file #txtStoreLocation').val(json[0].dfi_store_location);
            $('#frmdms_trn_file #txtUrl').val(json[0].dfi_url);
            $('#frmdms_trn_file #txtReferenceNo').val(json[0].dfi_reference_no);
            $('#frmdms_trn_file #cboReferenceId').val(json[0].dfi_reference_id);
            $('#frmdms_trn_file #cboFileCategoryId').val(json[0].dfi_file_category_id);
            $('#frmdms_trn_file #txtFileVersion').val(json[0].dfi_file_version);
            $('#frmdms_trn_file #txtMetaData').val(json[0].dfi_meta_data);
            $('#frmdms_trn_file #txtRemarks').val(json[0].dfi_remarks);
            $('#frmdms_trn_file #cboStatus').val(json[0].dfi_status);
            if(json[0].dfi_is_deleted=='1')
              $('#frmdms_trn_file #optIsDeleted').prop('checked',true);
            else
              $('#frmdms_trn_file #optIsDeleted').prop('checked',false); 
            $('#frmdms_trn_file input[name="optIsDeleted"][value="'+json[0].dfi_is_deleted+'"]').prop('checked', true);

            $('#frmdms_trn_file #cboCompanyId').val(json[0].dfi_company_id);
            $('#frmdms_trn_file #cboCreatedBy').val(json[0].dfi_created_by);
            $('#frmdms_trn_file #cboCreatedOn').val(json[0].dfi_created_on);
            $('#frmdms_trn_file #cboLastModifiedBy').val(json[0].dfi_last_modified_by);
            $('#frmdms_trn_file #cboLastModifiedOn').val(json[0].dfi_last_modified_on);
            $('#frmdms_trn_file #cboDeletedBy').val(json[0].dfi_deleted_by);
            $('#frmdms_trn_file #cboDeletedOn').val(json[0].dfi_deleted_on);
                      
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
	var url = "file-db-get.php?requestType=loadSearchCombo";
	var httpobj = $.ajax({url:url,async:false})
	$('#frmdms_trn_file #cboSearch').html(httpobj.responseText);
	$('#frmdms_trn_file #cboSearch').val($id);
	$('#frmdms_trn_file #cboSearch').trigger('change');
}

$(document).ready(function(){
  $('.dropzoneHeader').click(function(){
    $dropTable = $(this).parent();
    $tr = $('tr',$dropTable).eq(1);
    if($tr.css('display')=="none"){
      $tr.css('display','table-row');
    }
    else{
      $tr.css('display','none');
    }
  })
});

