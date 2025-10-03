
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
//  $('#frmsys_permission #btnNew').hide();
  $('#frmsys_permission #btnList').hide();
//  $('#frmsys_permission #btnSave').hide();
  $('#frmsys_permission #btnPrint').hide();
  $('#frmsys_permission #btnDelete').hide();
//  $('#frmsys_permission #btnApprove').hide();
//  $('#frmsys_permission #btnReject').hide();
  $('#frmsys_permission #cboRole').prop('disabled', true);
  $('#frmsys_permission #cboModule').prop('disabled', true);
  
  if(intViewx){ // View Permission
 	$('#frmsys_permission #cboRole').prop('disabled', false);
 	$('#frmsys_permission #cboModule').prop('disabled', false);
  }
//  if(intListx){ // Listing Permission
// 	$('#frmsys_permission #btnList').show();
//  }
//  if(intAddx){ // Insert New Permission
// 	$('#frmsys_permission #btnNew').show();
// 	$('#frmsys_permission #btnSave').show();
//  }
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
  //      Delete Function
  // --------------------------------------------------------
  $("#frmsys_permission #btnDelete").click(function(){  
    var requestType = 'delete';
    var id = '';
    if($('#frmsys_permission #cboRole').val()==''){
      modalMsgBox("Error", "Record is not selected ...");	
      return false;
    }
    else{
      id = $('#frmsys_permission #cboRole').val();
    }
    var url = "rolePermission-db-set.php";
    var obj = $.ajax({
          url:url,
          dataType: "json",
          type:'post', 
          data:'requestType='+requestType+'&role_id='+id,
          async:false,

          success:function(json){
                  if(json.type=='pass'){
                      modalMsgBox("Success", json.msg);
                      $('#frmsys_permission #tBodyPermission .dataRow').each(function(){
                        $(this).remove();
                      });
                      $('#frmsys_permission #cboRole').val('');
                      $('#frmsys_permission #cboModule').val('');
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

  // --------------------------------------------------------
  //      Close Function
  // --------------------------------------------------------
  $("#frmsys_permission #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
  // ===========================================
  // ===============  Load Access Grid =========
  // ===========================================
  $("#frmsys_permission #cboRole").change(function(){  
    loadPermissionGrid();
  });
  $("#frmsys_permission #cboModule").change(function(){  
    loadPermissionGrid();
  });
});// Document Ready End

//==================================================
//      Load Permission Grid
//==================================================
function loadPermissionGrid(){
  $('#frmsys_permission #tBodyPermission .dataRow').each(function(){
    $(this).remove();
  });
  var url = "rolePermission-db-get.php";
  if($('#frmsys_permission #cboRole').val()==''){
      return;	
  }
  if($('#frmsys_permission #cboModule').val()==''){
      return;	
  }
  $roleId = $('#frmsys_permission #cboRole').val();
  $moduleName = $('#frmsys_permission #cboModule').val();
  var httpobj = $.ajax({
      url:url,
      dataType:'json',
      data:'requestType=loadPermissionGrid&roleId='+$roleId+'&module='+$moduleName,
      async:false,
      success:function(json){
        $('#frmsys_permission #tBodyPermission .dataRow').each(function(){
          $(this).remove();
        });
        drawPermissionGrid(json,'');
      }
  });
};
// --------------------------------------------------
//      Draw Permission Grid
// --------------------------------------------------
function drawPermissionGrid($menuList, $space){
  jQuery.each($menuList, function($m, $menu) {
    $newTr = $('#frmsys_permission .cloneRow').eq(0).clone();
    $newTr.css('display','table-row');
    $newTr.removeClass('cloneRow');
    $newTr.addClass('dataRow');
    $('.sym_id',$newTr).val($menu['id']);
    $('label',$newTr).html($menu['label']);
    $('#frmsys_permission #tBodyPermission').append($newTr);
    $('.menu:enabled', $newTr).checkbox();
    // Maintain Tree Spaces
//    for (i = 0; i < $space; i++) { 
      $('.menu', $newTr).closest('td').prepend($space);
//    }
    $('.permission:enabled', $newTr).checkbox();
    // Action Checkbox (display or hide)
    jQuery.each($menu['actions'], function($a, $action) {
      $('.'+$a,$newTr).checkbox();
      if($action=="0"){
        $('.'+$a,$newTr).prop('disabled',true);
      }
      else{
        $('.'+$a,$newTr).prop('disabled',false);
      }
    });
    // Permission Checkbox (Tick Or Untick)
    $atLeastOneChecked = false;
    jQuery.each($menu['permission'], function($p, $permission) {
      if($permission=="0"){
        $('.'+$p,$newTr).prop('checked',false);
      }
      else{
        $atLeastOneChecked = true;
        $('.'+$p,$newTr).prop('checked',true);
      }
    });
    // All Checked Status Check
    $allChecked = true;
    $('.permission:enabled', $newTr).each(function(){
      if(!$(this).is(':checked')){
        $allChecked = false;
      }
    });
    // Menu Label Check Box Status Change
    if($('.permission:enabled', $newTr).length==0){
      $('.menu', $newTr).prop('disabled',true);
    }
    if($allChecked && $('.permission:enabled', $newTr).length>0){
      $('.menu', $newTr).prop('checked',true);
    }
    else if(!$allChecked && $('.permission:enabled:checked', $newTr).length>0){
      $('.menu', $newTr).checkbox().state('indeterminate');
    }
    else{
      $('.menu', $newTr).prop('checked',false);
    }
    // Event handdler
    $('.menu', $newTr).on('change',function(event){
      menuPermission(event);
    });
    $('.permission', $newTr).on('change',function(event){
      actionPermission(event);
    });
    // Get Sub Menus
    if($menu['sub_menu'].length > 0){
      drawPermissionGrid($menu['sub_menu'], '&nbsp;&nbsp;');
    }
  });
}

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
  var url = "rolePermission-db-set.php";
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
  var url = "rolePermission-db-set.php";
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