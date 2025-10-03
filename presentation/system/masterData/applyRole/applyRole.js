
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-05-31
 */
$( document ).ready( function () {
  // =================================
  // Access Control
  // ---------------------------------
  // Reset
  $('#frmsys_permission #btnNew').hide();
  $('#frmsys_permission #btnList').hide();
  $('#frmsys_permission #btnSave').hide();
  $('#frmsys_permission #btnPrint').hide();
  $('#frmsys_permission #btnDelete').hide();
  $('#frmsys_permission #btnApprove').hide();
  $('#frmsys_permission #btnReject').hide();
  $('#frmsys_permission #cboRole').prop('disabled', true);
  $('#frmsys_permission #cboModule').prop('disabled', true);
  
  if(intViewx){ // View Permission
 	$('#frmsys_permission #cboRole').prop('disabled', false);
 	$('#frmsys_permission #cboModule').prop('disabled', false);
  }
//  if(intListx){ // Listing Permission
// 	$('#frmsys_permission #btnList').show();
//  }
  if(intAddx){ // Insert New Permission
 	$('#frmsys_permission #btnNew').show();
 	$('#frmsys_permission #btnSave').show();
  }
  if(intEditx){ // Update Permission
 	$('#frmsys_permission #btnSave').show();
 	$('#frmsys_permission #cboRole').prop('disabled', false);
 	$('#frmsys_permission #cboModule').prop('disabled', false);
  }
  if(intDeletex){ // Delete Permission
 	$('#frmsys_permission #btnDelete').show();
 	$('#frmsys_permission #cboSearch').prop('disabled', false);
  }
  if(intPrintx){ // Delete Permission
 	$('#frmsys_permission #btnPrint').show();
 	$('#frmsys_permission #cboSearch').prop('disabled', false);
  }
  // --------------------------------------------------------
  //      New Function
  // --------------------------------------------------------
  $("#frmsys_permission #btnNew").click(function(){  
    $("#frmsys_permission").get(0).reset();
    $('#frmsys_permission #divRoleDescription').html('');
  });

  // --------------------------------------------------------
  //      Close Function
  // --------------------------------------------------------
  $("#frmsys_permission #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
  // ===========================================
  // ===============  Load Role Description =========
  // ===========================================
  $("#frmsys_permission #cboRole").change(function(){  
    $('#frmsys_permission #divRoleDescription').html('');
    var url = "applyRole-db-get.php";
    if($('#frmsys_permission #cboRole').val()==''){
        return;	
    }
    $roleId = $('#frmsys_permission #cboRole').val();
    var httpobj = $.ajax({
        url:url,
        dataType:'json',
        data:'requestType=loadRoleDetails&roleId='+$roleId,
        async:false,
        success:function(json){
          $('#frmsys_permission #divRoleDescription').html(json.details);
        }
    });
  });
  // ===========================================
  // ===============  Apply Role =========
  // ===========================================
  $("#frmsys_permission #btnSave").click(function(){  
    var url = "applyRole-db-set.php";
    if($('#frmsys_permission #cboRole').val()==''){
        return;	
    }
    if($('#frmsys_permission #cboUser').val()==''){
        return;	
    }
    $roleId = $('#frmsys_permission #cboRole').val();
    $userId = $('#frmsys_permission #cboUser').val();
    var httpobj = $.ajax({
        url:url,
        dataType:'json',
        data:'requestType=applyRole&role_id='+$roleId+'&grant_user_id='+$userId,
        async:false,
        success:function(json){
                  if(json.type=='pass'){
                      $('#frmsys_permission').get(0).reset();
                      $('#frmsys_permission #divRoleDescription').html('');
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
});// Document Ready End

// --------------------------------------------------------
//      Save Function - Whole Actions related to menu
// --------------------------------------------------------
function menuPermission(event){
  $parentTr = $(event.target).closest('tr');
  $menuId = $('.sym_id', $parentTr).val();
  if($('#frmsys_permission #cboRole').val()==''){
    return;
  }
  if($('.menu', $parentTr).checkbox().state()=='indeterminate'){
    return;
  }
  $roleId = $('#frmsys_permission #cboRole').val();
  if($('.menu', $parentTr).is(':checked')){
    $status = "1";
  }
  else{
    $status = "0";
  }
  // Get Enable Fields;
  $para = "";
  $('.permission:enabled', $parentTr).each(function(){
    $para+= "&fields[]="+$(this).attr('field_name');
  });
  var requestType = "menuPermission";
  var url = "applyRole-db-set.php";
  var obj = $.ajax({
        url:url,
        dataType: "json",
        type:'post', 
        data:'requestType='+requestType+'&role_id='+$roleId+'&menu_id='+$menuId+'&status='+$status+$para,
        async:false,

        success:function(json){
                if(json.type=='pass'){
                  if($status=="1"){
                    $('.permission:enabled', $parentTr).prop("checked",true);
                  }
                  else{
                    $('.permission:enabled', $parentTr).prop("checked",false);
                  }
//                    modalMsgBox("Success", json.msg);
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
}
// --------------------------------------------------------
//      Save Function - Action wise
// --------------------------------------------------------
function actionPermission(event){
  $target = $(event.target);
  $parentTr = $(event.target).closest('tr');
  $menuId = $('.sym_id', $parentTr).val();
  if($('#frmsys_permission #cboRole').val()==''){
      return;	
  }
  $roleId = $('#frmsys_permission #cboRole').val();
  if($(event.target).is(':checked')){
    $status = "1";
  }
  else{
    $status = "0";
  }
  // Get Enable Fields;
  $para = "";
  $para+= "&fields[]="+$(event.target).attr('field_name');
  var requestType = "menuPermission";
  var url = "applyRole-db-set.php";
  var obj = $.ajax({
        url:url,
        dataType: "json",
        type:'post', 
        data:'requestType='+requestType+'&role_id='+$roleId+'&menu_id='+$menuId+'&status='+$status+$para,
        async:false,

        success:function(json){
                if(json.type=='pass'){
                  $allChecked = true;
                  $('.permission:enabled', $parentTr).each(function(){
//                    alert($(this).is(':checked'));
                    if(!$(this).is(':checked')){
                      $allChecked = false;
                    }
                  });
//                  alert($allChecked);
                  if($allChecked){
                    $('.menu', $parentTr).prop("checked",true);
                    $('.menu', $parentTr).checkbox().state('checked');
                  }
                  else if(!$allChecked && $('.permission:enabled:checked', $parentTr).length>0){
                    $('.menu', $parentTr).checkbox().state('indeterminate');
                  }
                  else{
                    $('.menu', $parentTr).prop("checked",false);
                    $('.menu', $parentTr).checkbox().state('unchecked');
                  }
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

}