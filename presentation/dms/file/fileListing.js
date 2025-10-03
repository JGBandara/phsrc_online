
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-12
 */
$( document ).ready( function () {
  // =================================
  // Listing Export Buttons
  // ---------------------------------
  $buttons = [{text: 'Show/Hide',
      action: function ( e, dt, node, conf ) {
                    $('#dms_trn_fileToggleModal').modal();
                },
      className: 'btn btn-warning'
    }];
  if(intCopyx){
    $buttons.push("copy");
  }
  if(intExcelx){
    $buttons.push({
            extend: 'excel',
            className : 'btn-warning',
            exportOptions: {
//                modifier: {
//                    page: 'current'
//                },    
                columns: ':visible',
            }
        });
  }
  if(intPdfx){
    $buttons.push({
            extend: 'pdf',
            exportOptions: {
                columns: ':visible',
            }
        });
  }
  // =================================
  // Column Wise Search
  // ---------------------------------
  // Setup - add a text input to each footer cell
    $('#griddms_trn_file tfoot th').each( function ($k) {
      if($k>=2){
        var title = $(this).text();
        $(this).html( '<input type="text" class="form-control form-control-sm columnSearch" placeholder="'+title+'" />' );
      }
    } );
  // =================================
  // Create Table
  // ---------------------------------
  var table = $('#griddms_trn_file').DataTable({
    processing: true,
    serverSide: true,
    ajax: "./fileListing-db-get.php",
    dom: '<"row pb-1"<"col-sm-12"B>><"row"<"col-sm-6"l><"col-sm-6"f>>tr<"row"<"col-sm-5"i><"col-sm-7"p>>',
    buttons: $buttons,
    deferRender: true,
    scrollY:     300,
    scroller:    false,
    fixedColumns:   true,
    scrollX:        true,
    scrollCollapse: true,
    paging:         true,
    order: [[ 1, "asc" ]],
    fixedColumns:   {
        leftColumns: 2
    },
    columnDefs: [
        {
          "targets": [ 0 ],
          "width": "50px",
          "visible": true,
          "searchable": false,
          "className": "actionColumn",
          "orderable": false,
          "render": function ( data, type, row, meta ) {
              var action = '';
              if(row[21]>0){
                action += '<span class="fas fa-download actionView" onclick="fileAccess('+data+')" data-toggle="tooltip" data-placement="top" title="Download"></span>';
              }
            return action;
          }
        },
        {
        "targets": [2,3,4,6,9,10,12,13,14,15,16,17,18,19,20],
          "visible": false
        }
    ]
  });
  $('#griddms_trn_file').on('draw.dt', function () {
    var info = $(this).DataTable().page.info();
    if(info.recordsDisplay>2){
      $('[data-toggle="tooltip"]').tooltip();
    }
  });
  // =================================
  // Apply the search
  // ---------------------------------
  table.columns().every( function () {
      var that = this;
       $( 'input', this.footer() ).on( 'keyup change', function () {
          if ( that.search() !== this.value ) {
              that
                  .search( this.value )
                  .draw();
          }
      });
  });
  // =================================
  // On Load search
  // ---------------------------------
  table.columns(5).search(filter_ref_no).draw(); //Reference No
  $('.columnSearch').eq(0).val(filter_ref_no);
  table.columns(6).search(filter_ref_id).draw(); //Reference ID
  table.columns(8).search(filter_cat_name).draw(); //File Category
  $('.columnSearch').eq(2).val(filter_cat_name);
  // =================================
  // Toggle Table Column Show/Hide
  // ---------------------------------
  $('a.toggle-vis').on( 'click', function (e) {
    e.preventDefault();
    // Get the column API object
    var column = table.column( $(this).attr('data-column') );
    // Toggle the visibility
    column.visible( ! column.visible() );
  });
  // =================================
  //      Close Function
  // ---------------------------------
  $("#frmdms_trn_fileListing #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
});// Document Ready End


