/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-05-26
 */
/*
 * Message Display Modal
 * $type : Success / Error
 * $message : custom Message
 */
function modalMsgBox($type, $message){
  $('#msgBoxModal #msgBoxModalTitle').html($type);
  $('#msgBoxModal .modal-body').html($message);
  // reset Msg Box
  $('#msgBoxModal .modal-dialog').removeClass('text-success');
//  $('#msgBoxModal .modal-footer button').removeClass('btn-success');
  $('#msgBoxModal .modal-dialog').removeClass('text-danger');
//  $('#msgBoxModal .modal-footer button').removeClass('btn-danger');
  $('#msgBoxModal .modal-dialog').removeClass('text-info');
//  $('#msgBoxModal .modal-footer button').removeClass('btn-info');
  if($type == "Success"){
    $('#msgBoxModal .modal-dialog').addClass('text-success');
//    $('#msgBoxModal .modal-footer button').addClass('btn-success');
  }
  else if ($type == "Error") {
    $('#msgBoxModal .modal-dialog').addClass('text-danger');
//    $('#msgBoxModal .modal-footer button').addClass('btn-danger');
  }
  else if ($type == "Info") {
    $('#msgBoxModal .modal-dialog').addClass('text-info');
//    $('#msgBoxModal .modal-footer button').addClass('btn-info');
  }
  $('#msgBoxModal').modal();
}

$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
