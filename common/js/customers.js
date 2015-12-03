// action customers
function customersAction(id){
    $("#name_"+id).attr("readonly", false); 
    $("#city_"+id).attr("readonly", false); 
    $("#tel_"+id).attr("readonly", false); 
    $("#name_"+id).css('background','yellow');
    $("#city_"+id).css('background','yellow');
    $("#tel_"+id).css('background','yellow');

    $("#name_"+id).focus();
    var max = $("#max_customers").val();
    for(var i=1; i<=1000; i++){
        if(i!=id){
            $("#"+i).hide();
            $("#cancel_"+i).hide();
        }else{
            // submit button 
            $("#"+i).attr('class','btn btn-success btn-xs');
            $("#"+i).attr("onClick","updCustomer("+id+")"); 
            $("#"+i+" i").attr('class','fa fa-check');
            // cancel button
            $("#cancel_"+i+" i").attr('class','fa fa-times');
            $("#cancel_"+i).attr('onClick','location.reload()');
        }
    }
}

function updCustomer(id){
    name_customer = $("#name_"+id).val();
    city_customer = $("#city_"+id).val();
    tel_customer = $("#tel_"+id).val();
    window.location = 'settings_controller?upd_customer='+id+'&name_customer='+name_customer+'&city_customer='+city_customer+'&tel_customer='+tel_customer
}

// action customers end