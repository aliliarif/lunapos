// action users

function usersAction(id){
    $("#user_"+id).attr("readonly", false); 
    $("#password_"+id).attr("readonly", false); 
    $("#admin_"+id).attr("readonly", false); 

    $("#user_"+id).css('background','yellow');
    $("#password_"+id).css('background','yellow');
    $("#admin_"+id).css('background','yellow');
    $("#user_"+id).focus();

    for(var i=1; i<=100; i++){
        if(i!=id){
            $("#"+i).hide();
            $("#cancel_"+i).hide();
        }else{
            // submit button 
            $("#"+i).attr('class','btn btn-success btn-xs');
            $("#"+i).attr("onClick","updUser("+id+")"); 
            $("#"+i+" i").attr('class','fa fa-check');
            // cancel button
            $("#cancel_"+i+" i").attr('class','fa fa-times');
            $("#cancel_"+i).attr('onClick','location.reload()');
        }
    }
}

function updUser(id){
    name_user = $("#user_"+id).val();
    password_user = $("#password_"+id).val();
    admin = $("#admin_"+id).val();
    window.location = 'settings_controller?upd_user='+id+'&name_user='+name_user+'&password_user='+password_user+'&admin='+admin
}
// action users end