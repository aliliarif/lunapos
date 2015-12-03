var ClickedBtnID;
var nr_porosive=0;

$("#add_article_btn").on('click', function(event) {
    var $sifra_artikal = $('#produkti').val();
    var $kolicina = $('#sasija').val();
    var $produkti_pom = $('#produkti option:selected').text();
    var $produkti = $produkti_pom.split("-")[1]; // remove interna_sifra

    if ($sifra_artikal == ''){
        alert("Zgjidhni produktin!");
        return false;
    }else if($kolicina == ''){
        alert("Zgjidhni sasine e produktit!");
        return false;
    }

    // PROVERKA VO ZALIHA
    proveriZaliha($sifra_artikal,$kolicina)
    .done(function(vo_zaliha){
        if(Number($kolicina) > Number(vo_zaliha)){
            // show modal - nedostatok vo zaliha
            $("#span_nedostatok_zaliha").html("Mungesë sasie në magazin për artikullin <b>" + $produkti + "</b> , gjendja momentale: <b>" + vo_zaliha + "</b>");
            $("#modal_nedostatokZaliha").modal('show');
        }else{
            addRow(); 
        }
    });
});

function proveriZaliha(sifra_artikal,kolicina){
    return $.ajax({
        url: 'zaliha_controller/',
        type: 'GET',
        dataType: 'text',
        data: {
            sifra_artikal : sifra_artikal,
            kolicina : kolicina
        },
    })
    .fail(function() {
        alert("Ajax error");
    })
}

$('button[type="submit"]').click(function(e){
    ClickedBtnID = $(this).attr("id");
});

$("#produkti").on('change', function(event) {
    var product_price = $("#produkti option:selected").data("price"); // gets product price from html5 data-
    $("#cmimi_inp").val(product_price);
});

function addRow(){
    var i=0;
    var bleresi = $('#bleresi').val();
    var produkti_pom = $('#produkti option:selected').text();
    var produkti = produkti_pom.split("-")[1]; // remove interna_sifra
    var produkti_id = $('#produkti').val();
    var sasija = $('#sasija').val();
    var zbritje = $('#zbritje').val();
    var checkbox_zbritje = $('#checkbox_zbritje').is(":checked")
    var product_price = $("#cmimi_inp").val();

    
    if(produkti == ''){
        alert("Zgjidhni produktin!");
        return false;
    }else if(sasija == ''){
        alert("Zgjidhni sasine e produktit!");
        return false;
    }else if(sasija == 0){
        alert("Sasia nuk mund te jete me vlere 0!");
        return false;
    }else if(checkbox_zbritje == true && zbritje == ''){
        alert("Zgjidhni zbritjen!");
        return false;
    }else{
        nr_porosive++;

        $('#bleresi').val('');
        $('#produkti').val('');
        $('#prodDiv .glyphicon.glyphicon-remove').click(); // click X to reset produkti combobox
        $('#sasija').val('');
        $('#zbritje').val('');
    }

    //per bleresin END
    $("#nr_porosive").val(nr_porosive);
    var temp = product_price;
    // if there is discount change product price
    if(checkbox_zbritje == true){
        product_price =  parseFloat(product_price) - parseFloat(product_price) * parseFloat(zbritje)/100;
    }
    // if there is discount change product price end

    $('#llogaria_table').append(
        '<tr id=row_' + nr_porosive +'>' +
        '<td>' + "<input type='text' value='"+nr_porosive+"' style='background:none;border:none; width:7px; font-size:12px;' readonly>" + '</td>' +
        '<td>' + "<input type='text' id='product_name_table_"+nr_porosive+"' name='product_name_table_"+nr_porosive+"' value='"+produkti+"' style=' font-size:12px; width:100%; height:100%; background:none; border:none;' readonly></input>" + 
        "<input type='hidden' value='"+produkti_id+"' id='sifra_artikal_table_"+nr_porosive+"' name='sifra_artikal_table_"+nr_porosive+"'>" +
        "<input type='hidden' value='"+bleresi+"' id='bleresi_table_"+nr_porosive+"' name='bleresi_table_"+nr_porosive+"'>" +
        "<input type='hidden' value='"+zbritje+"' id='discount_table_"+nr_porosive+"' name='discount_table_"+nr_porosive+"'>" + '</td>' +
        '<td style="text-align:center;">' + "<input type='text' name='quantity_table_"+nr_porosive+"' id='quantity_table_"+nr_porosive+"' value="+sasija+" style='width:50px;font-size:12px;  text-align:center; background:none; border:none; padding-right:5px;' readonly>" + '</td>' +
        '<td style="text-align:center;">' + "<input type='text' name='product_price_table_"+nr_porosive+"' id='product_price_table_"+nr_porosive+"' value="+product_price+" style='width:50px; font-size:12px; text-align:center; background:none; border:none;' readonly>" + '</td>' +
        '<td  style="color: red;  ">' + "<input type='button'  name=del_" + nr_porosive + "  id=del_" + nr_porosive +" value='   X' style='background:none!important; font-size:12px; border:none; text-align:right; padding-right:0;' onClick='deleteRow(this.id); readonly' />" + '</td>' +
        '</tr>'
        );

    $('#totali').val((parseFloat($('#totali').val()) + parseFloat(product_price) * parseFloat(sasija)).toFixed(2));

    // if there is discount add css and attr
    if(checkbox_zbritje == true){
        $("#product_price_table_"+nr_porosive).css("background-color", "yellow");
        $("#product_price_table_"+nr_porosive).attr('data-toggle', 'tooltip');
        $("#product_price_table_"+nr_porosive).attr('data-placement', 'top');
        $("#product_price_table_"+nr_porosive).attr('data-container', 'body');
        $("#product_price_table_"+nr_porosive).attr('title', "Cmimi origjinal: " + temp + " den ,Zbritje: "+zbritje + "%");
        $('[data-toggle="tooltip"]').tooltip()
    }
    // if there is discount add css and attr END
}
function deleteRow(row_id){

    var prod_price = 0;
    var prod_quantity = 0;
    var id_del = row_id.split("_")[1];
    $('#row_'+id_del ).remove();

    // get price and quantity of all products that are in the table so the total will change.
    $('#totali').val(0);
    
    for(i=1; i<=nr_porosive+1; i++){
        prod_price = $('#product_price_table_'+i).val();
        prod_quantity = $('#quantity_table_'+i).val();
        if(prod_price != undefined && prod_quantity != undefined && prod_price != 0 && prod_quantity != 0 && prod_price != '' && prod_quantity != ''){
            $('#totali').val(parseFloat($('#totali').val()) + parseFloat(prod_price)  * parseFloat(prod_quantity));
        }
    }    
    nr_porosive--;  
}

// called from ruaj button, to check if there is data to post --- prevent to insert blank things in db
$('#action_form').submit(function() {
    var bleresi = $('#bleresi').val();

    if((ClickedBtnID == "fakture_btn" || ClickedBtnID == "ispratnic_btn") && (($("#bleresi_table_1").val() == '' || $("#bleresi_table_1").val() == undefined ))){
        alert("Per te gjeneruar Fakture/Fletedergese duhet te zgjidhni bleresin!");
        return false;
    }
    if (nr_porosive === 0) {
        alert('Zgjidhni me se paku nje artikull!');
        return false;
    }
});

// presmetka na popust
$("#cmimi_inp").on('blur', function(event) {
    var $nova_cena = $("#cmimi_inp").val();
    var $originalna_cena = $("#produkti option:selected").data("price");
    //var $test = ((($originalna_cena - $nova_cena) / $nova_cena) * 100) / 2;
    var $test = ($originalna_cena - $nova_cena) / $nova_cena;
    $("#zbritje").val($test.toFixed(2));
    //console.log(Math.abs($test));
});