$(document).ready( function(){
    var heightwindow = $(document).height() - 0.22 * $(document).height(); 
    $('.mypanel-height').css('height', heightwindow+'px');

    $('.combobox').combobox();
});

$( window ).resize(function() {
    var heightwindow = $(window).height() - 0.20 * $(document).height(); 
    $('.mypanel-height').css('height', heightwindow+'px');
});

// Datatable
$(document).ready(function() {
    $('#magazinTable').DataTable( {
        "paging":   false,
        "ordering": false,
        "info":     false,
        "oLanguage": {
            "sSearch": "Kerko: "
        }
    } );
} );
// Datatable END

// Datatable Artikujt
$(document).ready(function() {
    $('#artikujtTable').DataTable( {
        "paging":   false,
        "ordering": false,
        "info":     false,
        "oLanguage": {
            "sSearch": "Kerko: "
        }
    } );
} );

// $("#fakture_btn").click(function(event) {
//      $("#printThis").printThis({
//         importCSS: true,
//         importStyle: true
//     });
// });

// $("#ispratnic_btn").on('click', function(event) {
//     //event.preventDefault();
//     $("#printIspratnica").printThis({
//         importCSS: true,
//         importStyle: true
//     });
//      Act on the event 
// });
// // $("#ispratnic_btn").click(function(event) {
// //      $("#printIspratnica").printThis({
// //         importCSS: true,
// //         importStyle: true
// //     });
// // });

// $("#report_ditor_print").click(function(event) {
//     $("#printReportDitor").printThis({
//         importCSS: true,
//         importStyle: true
//     });
// });


// make div dissapear

setTimeout(function() {
    $('.success_div').fadeOut("slow");
}, 5000); 


//pass id_order to modal to delete

$(".del_order").click(function(event) {
    $('#deleteConfirmation').modal('show');
    $("#id_order").val($(this).data('del'));
});



$(function () {
    var now = new Date().getHours() + ":" + new Date().getMinutes(); // gets momental time

    var before_20_minutes_temp = new Date();
    before_20_minutes_temp.setMinutes(before_20_minutes_temp.getMinutes() - 20);


    var before_20_minutes = before_20_minutes_temp.getHours() + ":" + before_20_minutes_temp.getMinutes();


    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
        todayHighlight: true
    }).datepicker("setDate", new Date());;


    $('#timepickerFrom').timepicker({
        defaultTime: before_20_minutes,
        minuteStep: 1,
        disableFocus: true,
        template: 'dropdown',
        showMeridian:false
    });

    $('#timepickerTo').timepicker({
        defaultTime: now,
        minuteStep: 1,
        disableFocus: true,
        template: 'dropdown',
        showMeridian:false
    });
});

// only decimal numbers for input
$(".decimalOnly").keydown(function (event) {
    
    if (event.shiftKey == true) {
        event.preventDefault();
    }
    if ((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105) || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 46 || event.keyCode == 190) {

    }else{
        event.preventDefault();
    }
    if($(this).val().indexOf('.') !== -1 && event.keyCode == 190){
        event.preventDefault();
    }
        

});
