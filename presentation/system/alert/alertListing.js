
/* 
 * Sethsiri IT Soultion
 * Janaka Rajapaksha
 * 2019-06-16
 */
$( document ).ready( function () {
  // =================================
  // Listing Export Buttons
  // ---------------------------------
  $buttons = [{text: 'Show/Hide',
      action: function ( e, dt, node, conf ) {
                    $('#sys_trn_alertToggleModal').modal();
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
    $('#gridsys_trn_alert tfoot th').each( function ($k) {
      if($k>=1){
        var title = $(this).text();
        $(this).html( '<input type="text" class="form-control form-control-sm columnSearch" placeholder="'+title+'" />' );
      }
    } );
  // =================================
  // Create Table
  // ---------------------------------
  var table = $('#gridsys_trn_alert').DataTable({
    processing: true,
    serverSide: true,
    ajax: "./alertListing-db-get.php",
    dom: '<"row pb-1"<"col-sm-12"B>><"row"<"col-sm-6"l><"col-sm-6"f>>tr<"row"<"col-sm-5"i><"col-sm-7"p>>',
    buttons: $buttons,
    deferRender: true,
    scrollY:     300,
    scroller:    false,
    fixedColumns:   true,
    scrollX:        true,
    scrollCollapse: true,
    paging:         true,
    order: [[ 1, "desc" ]],
    fixedColumns:   {
        leftColumns: 1
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
              if(row[1]=="New"){
                action += '<span class="fas fa-check actionView" onclick="clearAlert('+data+')" data-toggle="tooltip" data-placement="top" title="Clear"></span>';
              }
              if(intViewx=='1')
                action += '<span class="fas fa-eye actionView" onclick="viewRecord('+data+','+intMenuId+')" data-toggle="tooltip" data-placement="top" title="View"></span>';
              if(intEditx=='1')
                action += '<span class="fas fa-pencil-alt actionEdit" onclick="editRecord('+data+','+intMenuId+')" data-toggle="tooltip" data-placement="top" title="Edit"></span>';
              if(intDeletex=='1')
                action += '<span class="fas fa-trash-alt actionEdit" onclick="editRecord('+data+','+intMenuId+')" data-toggle="tooltip" data-placement="top" title="Delete"></span>';
              if(intPrintx=='1')
                action += '<span class="fas fa-print actionView" onclick="printRecord('+data+','+intMenuId+')" data-toggle="tooltip" data-placement="top" title="Print"></span>';
            return action;
          }
        },
        {
        "targets": [5,6,7,8,9,10,11,12,13,14,],
          "visible": false
        }
    ]
  });
  $('#gridsys_trn_alert').on('draw.dt', function () {
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
  $("#frmsys_trn_alertListing #btnClose").click(function(){  
    window.location.assign(backwardSeparator+"main.php");
  });
});// Document Ready End

// Load Record in Form View Url Paramete rec_id
function clearAlert($alertId){
  // get page Url
  $pageUrl = "";
  var url = "./alertListing-db-set.php";
  var obj = $.ajax({
    url:url,
    dataType: "json",
    type:'post', 
    data:'requestType=tookAction&alert_id='+$alertId,
    async:false,

    success:function(json){
      if(json.type=='pass'){
          modalMsgBox("Success", json.msg);
      }    
    },
    error:function(xhr,status){
      modalMsgBox("Error", "AJAX error "+xhr.status);
    }		
    });
}
