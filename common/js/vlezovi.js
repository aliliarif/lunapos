$("#example").on('click','.payFaktura', function(event) {
    var $id_komintent = $(this).data('id_komintent');
    var $vl_fakt_br = $(this).data('broj_vl_faktura');
    $("#vl_fakt_br").val($vl_fakt_br);
    $("#vl_id_komintent").val($id_komintent);
    $("#pay_fakt_modal").modal('show');
});

/* Formatting function for row details - modify as you need */
function format_vlezovi(d) { 
    // `d` is the original data object for the row.
    var vl_fakt_clenovi = '';
    var $vlezovi_clenovi_json = get_vl_fakturi_clenovi(d.id_vl_fakt);
    obj = JSON.parse($vlezovi_clenovi_json);
    //console.log(obj);
   
    vl_fakt_clenovi = '<table class="table table-striped table-hover table-bordered" cellspacing="0" width="100%">';
    vl_fakt_clenovi += '<thead>';
    vl_fakt_clenovi += '<tr class="info">';
    vl_fakt_clenovi += '<th>Emri i artikullit</th>';
    vl_fakt_clenovi += '<th>Cmimi</th>';
    vl_fakt_clenovi += '<th>TVSH</th>';
    vl_fakt_clenovi += '<th>Rabat</th>';
    vl_fakt_clenovi += '<th>Sasia</th>';
    vl_fakt_clenovi += '<th>Suma</th>';
    vl_fakt_clenovi += '</tr>';
    vl_fakt_clenovi += '</thead>';
    vl_fakt_clenovi += '<tbody>';
    for (var i = 0; i < obj.length; i++) {
        var $popust = obj[i].popust;
        if ($popust == '' || $popust == null){
            $popust = 0;
        }
        vl_fakt_clenovi += '<tr>';
            vl_fakt_clenovi += '<td>' + obj[i].naziv_artikal + '</td>'; 
            vl_fakt_clenovi += '<td>' + obj[i].cena_so_ddv + '</td>'; 
            vl_fakt_clenovi += '<td>' + obj[i].ddv + '</td>'; 
            vl_fakt_clenovi += '<td>' + $popust + '%</td>'; 
            vl_fakt_clenovi += '<td>' + obj[i].kolicina + '</td>'; 
            vl_fakt_clenovi += '<td>' + obj[i].kolicina * obj[i].cena_so_ddv + '</td>'; 
        vl_fakt_clenovi += '</tr>';
    };
    vl_fakt_clenovi += '</tbody>';
    vl_fakt_clenovi += '</table>';
    
    //console.log(vl_fakt_clenovi);
    return vl_fakt_clenovi;
}
// mora tjet ASYNC se nuk e mer vl_fakt_clenovi............ BAD MSOJU SI TA BOJSH ME CALLBACK
function get_vl_fakturi_clenovi(id_vl_fakt){
    var jqXHR = $.ajax({
        url: 'vlezovi_controller/get_vl_fakturi_clenovi',
        type: 'GET',
        dataType: 'json',
        data: {
            id_vl_fakt : id_vl_fakt
        },
        async: false
    })
    return jqXHR.responseText;
}
$(document).ready(function() {
    var table = $('#example').DataTable( {
        "ajax": "vlezovi_controller/get_vl_fakturi_hd", 
        "columns": [
            {
                "className":      'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": ''
            },
            { "data": "broj_vl_faktura" },
            { "data": "datum" },
            { "data": "ime_komintent" },
            { "data": "iznos" },
            {
                "render": function ( data, type, full, meta ) {
                    if(full.status == 1){ // e paguar
                        return '<span class="label label-success label-mini">Po</span>'
                    }else{ // pa paguar
                        var buttonID = "delete_";
                        return '<span data-broj_vl_faktura="'+full.broj_vl_faktura+'" data-id_komintent="'+full.id_komintent+'" data-ime_komintent="'+full.ime_komintent+'" class="label label-danger label-mini payFaktura" style="cursor:pointer;">Jo &nbsp;<i class="fa fa-pencil"></i></span>'
                    }
                    // var buttonID = "delete_";
                    // return '<a id='+buttonID+' class="btn btn-danger deleteBtn" role="button">'+full.status+'</a>';
                }
            },
            
        ],
        "paging":   false,
        "ordering": false,
        "info":     false,
        "oLanguage": {
            "sSearch": "Kerko: "
        }
    });
     
    // Add event listener for opening and closing details
    $('#example tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
        
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }else {
            // Open this row
            row.child(format_vlezovi(row.data())).show();
            tr.addClass('shown');
        }
    });
});

