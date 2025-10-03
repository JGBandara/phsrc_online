/* 
 * Developed By : Janaka Rajapaksha
 * Developed On : 
 * Project      : 
 */
$(document).ready(function(){
    $('body').append('<div id="divToolTip" class="tooltip"></div>');
    $('.rptTblBody td').mouseover(function(e){
        $index = $(this).index();
        $tr = $(this).closest('tr');
        $name = $('td', $tr).eq(0).html();
        $headerText = $('.rptTblHeader').children().eq($index).html();
        $position = $(this).position();
        $headerText = $name + " : " + $headerText;
        $('#divToolTip').html($headerText);
        $('#divToolTip').css('display','block');
        $('#divToolTip').css('top',$position.top-10);
        $('#divToolTip').css('left',$position.left);
    });
});

function printDoc(id){
  $originalContent = $('body', $(document)).html();
  $printContent = $('#'+id).parent().html();
  $('body', $(document)).html($printContent);
  window.print();
  $('body', $(document)).html($originalContent);
}
window.onafterprint = function(){
  alert('Print Success !');
   window.location.reload(true);
}

