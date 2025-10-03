
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-05-31
 */
$( document ).ready( function () {
  // =================================
  // Listing Export Buttons
  // ---------------------------------
  $buttons = [];
  if(intCopyx){
    $buttons.push("copy");
  }
  if(intExcelx){
    $buttons.push({
            extend: 'excel',
            className : 'btn-danger',
//            exportOptions: {
//                modifier: {
//                    page: 'current'
//                }
//            }
        });
  }
  if(intPdfx){
    $buttons.push("pdf");
  }
  // =================================
  // Create Table
  // ---------------------------------
  $('#gridsys_menus').DataTable({
    processing: true,
    serverSide: true,
    ajax: "./menuListing-db-get.php",
    dom: '<"row pb-1"<"col-sm-12"B>><"row"<"col-sm-6"l><"col-sm-6"f>>tr<"row"<"col-sm-5"i><"col-sm-7"p>>',
    buttons: $buttons,
    deferRender: true,
    scrollY:     300,
    scroller:    false,
    fixedColumns:   true,
    scrollX:        true,
    scrollCollapse: true,
    paging:         true,
    fixedColumns:   {
        leftColumns: 1
    }
  });
  // =================================
  //      Close Function
  // ---------------------------------
  $("#frmsys_menusListing #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
});// Document Ready End


