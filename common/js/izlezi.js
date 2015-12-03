

/* Formatting function for row details - modify as you need */
function format(d) { 
    // `d` is the original data object for the row.
    var vl_fakt_clenovi = '';
    var $vlezovi_clenovi_json = get_iz_fakturi_clenovi(d.broj_faktura);
    obj = JSON.parse($vlezovi_clenovi_json);
    
   
    vl_fakt_clenovi = '<table class="table table-striped table-hover table-bordered" cellspacing="0" width="100%">';
    vl_fakt_clenovi += '<thead>';
    vl_fakt_clenovi += '<tr class="info">';
    vl_fakt_clenovi += '<th>Emri i artikullit</th>';
    vl_fakt_clenovi += '<th>Cmimi</th>';
    vl_fakt_clenovi += '<th>Sasia</th>';
    vl_fakt_clenovi += '<th>Suma</th>';
    vl_fakt_clenovi += '</tr>';
    vl_fakt_clenovi += '</thead>';
    vl_fakt_clenovi += '<tbody>';
    for (var i = 0; i < obj.length; i++) {
        vl_fakt_clenovi += '<tr>';
            vl_fakt_clenovi += '<td>' + obj[i].naziv_artikal + '</td>'; 
            vl_fakt_clenovi += '<td>' + obj[i].cena + '</td>'; 
            vl_fakt_clenovi += '<td>' + obj[i].kolicina + '</td>'; 
            vl_fakt_clenovi += '<td>' + obj[i].kolicina * obj[i].cena + '</td>'; 
        vl_fakt_clenovi += '</tr>';
    };
    vl_fakt_clenovi += '</tbody>';
    vl_fakt_clenovi += '</table>';
    
    //console.log(vl_fakt_clenovi);
    return vl_fakt_clenovi;
}
// mora tjet ASYNC se nuk e mer vl_fakt_clenovi............ BAD MSOJU SI TA BOJSH ME CALLBACK
function get_iz_fakturi_clenovi(broj_faktura){
    var jqXHR = $.ajax({
        url: 'izlezi_controller/get_iz_fakturi_clenovi',
        type: 'GET',
        dataType: 'json',
        data: {
            broj_faktura : broj_faktura
        },
        async: false
    })
    return jqXHR.responseText;
}
$(document).ready(function() {
    var table = $('#izlezi_table').DataTable( {
        "ajax": "izlezi_controller/get_iz_fakturi_hd", 
        "columns": [
            {
                "className":      'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": ''
            },
            { "data": "broj_faktura" },
            { "data": "datum" },
            { "data": "ime_komintent" },
            { "data": "iznos" },
            
        ],
        "paging":   false,
        "ordering": false,
        "info":     false,
        "oLanguage": {
            "sSearch": "Kerko: "
        }
    } );
     
    // Add event listener for opening and closing details
    $('#izlezi_table tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
        
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    } );
} );

