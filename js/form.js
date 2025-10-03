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

$(document).ready(function(){
    $('.datepicker_past').each(function(){
      $(this).datepicker({ 
        uiLibrary: 'bootstrap4',
        size: 'small',
        iconsLibrary: 'fontawesome',
        format: 'yyyy-mm-dd',
//        disableDates: ['2019-05-31'],
//        disableDaysOfWeek: [0, 6],
        header: true,
        footer: false, 
        modal: false,
        maxDate: new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate()),
        showRightIcon: true,
        showOtherMonths: false,
        weekStartDay: 1,
        keyboardNavigation: true,
//        select: function (e, type) {
//          $eleId = $(e.target).attr('id');
//          $parentForm = $(e.target).closest('form');
//          var validator = $parentForm.validate();
//          validator.element('#'+$eleId);
//          alert($eleId);
////             alert('Select from type of "' + $(e.target).val() + '" is fired');
//         }
      });
    });
    $('.datepicker_future').each(function(){
      $(this).datepicker({ 
        uiLibrary: 'bootstrap4',
        size: 'small',
        iconsLibrary: 'fontawesome',
        format: 'yyyy-mm-dd',
        disableDates: ['2019-05-31'],
        disableDaysOfWeek: [0, 6],
        header: true,
        footer: false, 
        modal: false,
        minDate: new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate()),
        showRightIcon: true,
        showOtherMonths: false,
        weekStartDay: 1,
        keyboardNavigation: true,
      });
    });
//    $('.datepicker').each(function(){
//      $(this).datepicker({ 
//        uiLibrary: 'bootstrap4',
//        size: 'small',
//        iconsLibrary: 'fontawesome',
//        format: 'yyyy-mm-dd',
////        disableDates: ['2019-05-31'],
//        disableDaysOfWeek: [0, 6],
//        header: true,
//        footer: false, 
//        modal: false,
//        maxDate: new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate()),
//        minDate: new Date(new Date().getFullYear()-1, new Date().getMonth(), new Date().getDate()),
//        showRightIcon: true,
//        showOtherMonths: false,
//        weekStartDay: 1,
//        keyboardNavigation: true,
//      });
//    });
    $('.timepicker').each(function(){
      $(this).timepicker({ 
        uiLibrary: 'bootstrap4',
        size: 'small',
        iconsLibrary: 'fontawesome',
        format: 'HH:MM:',
        header: true,
        footer: true, 
        modal: false,
        showRightIcon: true,
      });
    });
    $('.datetimepicker').each(function(){
      $(this).datetimepicker({ 
        datepicker: { 
          uiLibrary: 'bootstrap4',
          size: 'small',
          iconsLibrary: 'fontawesome',
          format: 'yyyy-mm-dd',
          disableDates: ['2019-05-31'],
          disableDaysOfWeek: [0, 6],
          header: false,
          footer: false, 
          modal: false,
          maxDate: new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate()),
          minDate: new Date(new Date().getFullYear()-1, new Date().getMonth(), new Date().getDate()),
          showRightIcon: true,
          showOtherMonths: false,
          weekStartDay: 1
        },
        uiLibrary: 'bootstrap4',
        size: 'small',
        format: 'yyyy-mm-dd HH:MM',
        footer: true,
      });
    });
});
