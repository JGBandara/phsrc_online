/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//function fileDownload($id){
//  // get Ajax Url
//  $ajaxUrl = "";
//  var url = backwardSeparator+"dataAccess/common-db-get.php";
//  var obj = $.ajax({
//    url:url,
//    dataType: "json",
//    type:'post', 
//    data:'requestType=getDownloadUrl&file_id='+$id,
//    async:false,
//
//    success:function(json){
//      $ajaxUrl = backwardSeparator + json.url;
//      // download
//      window.open($ajaxUrl);
//    },
//    error:function(xhr,status){
//      modalMsgBox("Error", xhr.responseText);
//    }		
//  });
//}
function viewRecord($id, $menuId){
  // get Ajax Url
  $ajaxUrl = "";
  var url = backwardSeparator+"dataAccess/common-db-get.php";
  var obj = $.ajax({
    url:url,
    dataType: "json",
    type:'post', 
    data:'requestType=getAjaxGetUrl&menu_id='+$menuId,
    async:false,

    success:function(json){
      $ajaxUrl = json.url;
      // Get View Content
      getPartialViewContent($ajaxUrl, $id);
    },
    error:function(xhr,status){
      modalMsgBox("Error", "AJAX error "+xhr.status);
    }		
    });
  $('#partialViewModal').modal();
}
// Load View Content
function getPartialViewContent($ajaxUrl, $id){
  var url = backwardSeparator+$ajaxUrl;
  var obj = $.ajax({
    url:url,
    dataType: "json",
    type:'post', 
    data:'requestType=loadPartial&record_id='+$id,
    async:false,
    success:function(json){
        if(json.type=='pass'){
            $('#partialViewModal .modal-dialog').html(json.content);
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
// Load Record in Form View
function editRecord($id, $menuId){
  // get page Url
  $pageUrl = "";
  var url = backwardSeparator+"dataAccess/common-db-get.php";
  var obj = $.ajax({
    url:url,
    dataType: "json",
    type:'post', 
    data:'requestType=getPageUrl&menu_id='+$menuId,
    async:false,

    success:function(json){
      $pageUrl = json.url;
      // Load Page
      window.location.assign(backwardSeparator+$pageUrl+"?id="+$id);
    },
    error:function(xhr,status){
      modalMsgBox("Error", "AJAX error "+xhr.status);
    }		
    });
  $('#partialViewModal').modal();
}
// Load Record in Form View Url Paramete rec_id
function editRecord2($id, $menuId){
  // get page Url
  $pageUrl = "";
  var url = backwardSeparator+"dataAccess/common-db-get.php";
  var obj = $.ajax({
    url:url,
    dataType: "json",
    type:'post', 
    data:'requestType=getPageUrl&menu_id='+$menuId,
    async:false,

    success:function(json){
      $pageUrl = json.url;
      // Load Page
      window.location.assign(backwardSeparator+$pageUrl+"?rec_id="+$id);
    },
    error:function(xhr,status){
      modalMsgBox("Error", "AJAX error "+xhr.status);
    }		
    });
  $('#partialViewModal').modal();
}
// Load Print View
function printRecord($id, $menuId){
  // get page Url
  $pageUrl = "";
  var url = backwardSeparator+"dataAccess/common-db-get.php";
  var obj = $.ajax({
    url:url,
    dataType: "json",
    type:'post', 
    data:'requestType=getPrintUrl&menu_id='+$menuId,
    async:false,

    success:function(json){
      $pageUrl = json.url;
      // Load Page
      window.location.assign(backwardSeparator+$pageUrl+"?id="+$id);
    },
    error:function(xhr,status){
      modalMsgBox("Error", "AJAX error "+xhr.status);
    }		
    });
  $('#partialViewModal').modal();
}

