/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-10
 */
$( document ).ready( function () {
  // =================================
  // Listing Export Buttons
  // ---------------------------------
  $buttons = [{text: 'Show/Hide',
      action: function ( e, dt, node, conf ) {
                    $('#hrm_employee_dependenceToggleModal').modal();
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
    $('#gridhrm_employee_dependence tfoot th').each( function ($k) {
      if($k>=2){
        var title = $(this).text();
        $(this).html( '<input type="text" class="form-control form-control-sm columnSearch" placeholder="'+title+'" />' );
      }
    } );
  // =================================
  // Create Table
  // ---------------------------------
  if(navigator.userAgent.indexOf('Firefox')>-1){
    $fixedColumns = 0;
  }
  else{
    $fixedColumns = 2;
  }
  // =================================
  // Create Table
  // ---------------------------------
  var table = $('#gridhrm_employee_dependence').DataTable({
    processing: true,
    serverSide: true,
    ajax: "./employeeDependenceListing-db-get.php",
    dom: '<"row pb-1"<"col-sm-12"B>><"row"<"col-sm-6"l><"col-sm-6"f>>tr<"row"<"col-sm-5"i><"col-sm-7"p>>',
    buttons: $buttons,
    deferRender: true,
    scrollY:     300,
    scroller:    false,
    scrollX:        true,
    scrollCollapse: true,
    paging:         true,
    order: [[ 1, "asc" ]],
    fixedColumns:   {
        leftColumns: $fixedColumns
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
              if(intViewx=='1')
                action += '<span class="fas fa-eye actionView" onclick="viewRecord('+data+','+intMenuId+')"></span>';
              if(intEditx=='1')
                action += '<span class="fas fa-pencil-alt actionEdit" onclick="editRecord2('+data+','+intMenuId+')"></span>';
              if(intDeletex=='1')
                action += '<span class="fas fa-trash-alt actionEdit" onclick="editRecord2('+data+','+intMenuId+')"></span>';
              if(intPrintx=='1')
                action += '<span class="fas fa-print actionView" onclick="printRecord('+data+','+intMenuId+')"></span>';
            return action;
          }
        },
        {
        "targets": [6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27],
          "visible": false
        }
    ]
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
  $("#frmhrm_employee_dependenceListing #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
});// Document Ready End


