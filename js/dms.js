/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-12
 */

// =================================
//  DMS JS Common Functions
// ---------------------------------
function updateRemarks($id){
  $('#fileRemarksBoxModal').modal();
  $('#fileRemarksBoxModal .save').on("click", function(e){
    e.preventDefault();
    $remarks = $('#fileRemarksBoxModal #txtRemarks').val();
    $('#fileRemarksBoxModal .errorMsg div').html('');
    $('#fileRemarksBoxModal .errorMsg').css('display','none');
    
    var url = backwardSeparator+"presentation/dms/file/file-db-set.php";
    var obj = $.ajax({
          url:url,
          dataType: "json",
          type:'post', 
          data:'requestType=updateRemarks'+'&id='+$id+'&remarks='+$remarks,
          async:false,			
          success:function(json){
              if(json.type=='pass'){
                  $('#fileRemarksBoxModal #txtRemarks').val('');
                  $('#fileRemarksBoxModal').modal('toggle');
              }
              else if(json.type=='fail'){
                  $('#fileRemarksBoxModal .errorMsg div').html(json.msg);
                  $('#fileRemarksBoxModal .errorMsg').css('display','block');
              }
            },
          error:function(xhr,status){
                $('#fileRemarksBoxModal .errorMsg div').html(xhr.responseText);
                $('#fileRemarksBoxModal .errorMsg').css('display','block');
            }		
          });
      $('#fileRemarksBoxModal .save').off("click");
    });
  return;
}

function fileAccess($id){
  if($id!=""){
    var url = backwardSeparator+"presentation/dms/file/file-db-set.php";
    var obj = $.ajax({
          url:url,
          dataType: "json",
          type:'post', 
          data:'requestType=accessLog'+'&id='+$id,
          async:false,			
          success:function(json){
                if(json.type=='pass'){
                  window.open(backwardSeparator + json.url);
                  return ;
                }
          },
          error:function(xhr,status){
            modalMsgBox("Error", xhr.responseText);
            return false;
          }		
    });
  }
}


