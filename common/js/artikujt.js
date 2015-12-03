// edit artikli modal JS

$(".editArtikal").on('click', function(event) {
    var $id = $(this).prop('id'); // id from clicked button to edit ARTIKAL
    
    fillArticleModal($id);    
});

// se popolnuva modalot so podatocite od redot sto e klinkat - podatocite se zemat od tabelata sto vise e prikazena
function fillArticleModal(id){
    // get values from table
    var $naziv_artikal = $("#naziv_artikal_"+id).val();
    var $interna_sifra = $("#interna_sifra_"+id).val();
    var $kolicina_pak = $("#kolicina_pak_"+id).val();
    var $ed_merka = $("#ed_merka_"+id).val();
    var $nabavna_cena_so_ddv = $("#nabavna_so_ddv_"+id).val();
    var $ddv = $("#ddv_"+id).val();
    var $marza = $("#marza_"+id).val();
    var $prodazna_cena = $("#prodazna_cena_"+id).val();

    // debug
    //console.log(" naziv: " + $naziv_artikal + " \n interna_sifra: " + $interna_sifra + " \n kolicina_pak: " + $kolicina_pak + " \n ed_merka: " + $ed_merka + " \n nabavna_so_ddv: " + $nabavna_cena_so_ddv + " \n ddv " + $ddv + " \n marza " + $marza + " \n prodazna_cena " + $prodazna_cena );
    
    // set values to modal
    $("#naziv_artikal").val($naziv_artikal);
    $("#interna_sifra").val($interna_sifra);
    $("#kolicina_pak").val($kolicina_pak);
    $("#ed_merka").val($ed_merka);
    $("#nabavna_so_ddv").val($nabavna_cena_so_ddv);
    $("#ddv").val($ddv);
    $("#marza").val($marza);
    $("#prodazna_cena").val($prodazna_cena);

    //put sifra_artikal into hidden input
    $("#hid_sifra_artikal").val(id);

    $("#ddv").change(); // trigger change
    $("#marza").change();

    // show modal
    $("#editArtikal_modal").modal('show');
}

// PRESMETKA NA PRODAZNA CENA

$("#nabavna_so_ddv").on('input', function(event) {
    presmetajBezDDV();
    presmetajProdaznaCena();
});


$("#ddv").on('change', function(event) {
    presmetajBezDDV();
    presmetajSoDDV();
});

$("#nabavna_bez_ddv").on('input', function(event) {
    presmetajSoDDV();
    presmetajProdaznaCena();
});

$("#marza").on('input', function(event) {
    presmetajProdaznaCena();
});

$("#prodazna_cena").on('input', function(event) {
    presmetajMarza();
});

function presmetajBezDDV(){
    // presmetka na cena bez DDV -- so formulata = (maloprodazna / 1.18 ( ili 1.05 za 5% ) [ opcionalno: - maloprodazna  -- ZA VREDNOSTA NA DDV)]) 
    var $ddv = parseFloat($("#ddv").val());
    var $nabavna_so_ddv = parseFloat($("#nabavna_so_ddv").val());
    var $nabavna_bez_ddv = 0;
    if(($ddv != ' ' && $ddv !== undefined) && ($nabavna_so_ddv != '' && $nabavna_so_ddv !== undefined)){
        if($ddv == '5'){
            $ddv_pom = 1.05; //mduhet per formulen
        }else if($ddv == '18'){
            $ddv_pom = 1.18; //mduhet per formulen
        }else{
            return false;
        }
        $nabavna_bez_ddv = $nabavna_so_ddv / $ddv_pom;
        $nabavna_bez_ddv = $nabavna_bez_ddv.toFixed(2); // abolutna vrednost so 2 decimalni vrednosti
        $("#nabavna_bez_ddv").val($nabavna_bez_ddv);
    }
}

function presmetajSoDDV(){ 
    // presmetka na cena so DDV -- so formulata = cena * 1.18 ( ili 1.05 za 5% )
    var $ddv = parseFloat($("#ddv").val());
    var $nabavna_bez_ddv = parseFloat($("#nabavna_bez_ddv").val());
    var $nabavna_so_ddv = 0;
    if(($ddv != ' ' && $ddv !== undefined) && ($nabavna_bez_ddv != '' && $nabavna_bez_ddv !== undefined)){
        if($ddv == '5'){
            var $ddv_pom = 1.05; //mduhet per formulen
        }else if($ddv == '18'){
            var $ddv_pom = 1.18; //mduhet per formulen
        }else{
            return false;
        }
        $nabavna_so_ddv = $nabavna_bez_ddv * $ddv_pom;
        $nabavna_so_ddv = $nabavna_so_ddv.toFixed(2);
        $("#nabavna_so_ddv").val($nabavna_so_ddv);
    }
}

function presmetajProdaznaCena(){
    var $marza = parseFloat($("#marza").val());
    var $nabavna_so_ddv = parseFloat($("#nabavna_so_ddv").val());

    if(isNaN($marza)){
        $("#prodazna_cena").val('');
        return false;
    }

    if (($marza != '' && $marza !== undefined) && ($nabavna_so_ddv != '' && $nabavna_so_ddv !== undefined)){
        var $prodazna_cena = $nabavna_so_ddv + ($nabavna_so_ddv * ($marza / 100));
        $("#prodazna_cena").val($prodazna_cena.toFixed(2));
    }else{
        return false;
    }
}

function presmetajMarza(){
    var $prodazna_cena = parseFloat($("#prodazna_cena").val()).toFixed(2); 
    var $nabavna_so_ddv = parseFloat($("#nabavna_so_ddv").val()).toFixed(2); // samo za kontrola
    
    if(isNaN($prodazna_cena)){
        $("#marza").val('');
        return false;
    }

    if(($prodazna_cena != ' ' && $prodazna_cena !== undefined) && ($nabavna_so_ddv != ' ' && $nabavna_so_ddv !== undefined && !isNaN($nabavna_so_ddv))){
        var $nabavna_so_ddv = parseFloat($("#nabavna_so_ddv").val());
        var $marza_changed =  ((($prodazna_cena - $nabavna_so_ddv) / $nabavna_so_ddv) * 100) // change marza
        $("#marza").val($marza_changed.toFixed(2))
    }else{
        $("#prodazna_cena").val('');
    }
}

// $("#ddv").on('change',  function(event) {
//     var $marza = $("#marza").val();
//     presmetajCenaSoDDV();
//     if ($marza != '' && $marza !== undefined){
//         presmetajProdaznaCena();
//     }
// });

// $(document).on('blur', '#marza', function(event) {
//     presmetajProdaznaCena();
// });

// $("#prodazna_cena").on('blur', function(event) {
//     presmetajMarza();
// });

// $("#nabavna_cena").on('blur', function(event) {
//     var $marza = $("#marza").val();
//     presmetajCenaSoDDV();
//     if ($marza != '' && $marza !== undefined){
//         presmetajProdaznaCena();
//     }
    
// });

// function presmetajCenaSoDDV(){
//     var $ddv = $("#ddv").val();
//     var $nabavna_cena = parseFloat($("#nabavna_cena").val());

//     if (($nabavna_cena != '' && $nabavna_cena !== undefined) && $ddv != '-1'){
//         var $cena_so_ddv = $nabavna_cena + ($nabavna_cena * ($ddv / 100));
//         $("#cena").val($cena_so_ddv.toFixed(2));
//     }
// }

// function presmetajProdaznaCena(){
//     var $marza = parseFloat($("#marza").val());
//     var $cena_so_ddv = parseFloat($("#cena").val());
//     if (($marza != '' && $marza !== undefined) && ($cena_so_ddv != '' && $cena_so_ddv !== undefined)){
//         var $prodazna_cena = $cena_so_ddv + ($cena_so_ddv * ($marza / 100));
//         $("#prodazna_cena").val($prodazna_cena.toFixed(2));
//     }
// }

// function presmetajMarza(){
//     var $prodazna_cena = parseFloat($("#prodazna_cena").val()).toFixed(2); 
//     var $nabavna_cena = parseFloat($("#nabavna_cena").val()).toFixed(2); // samo za kontrola
//     if(($prodazna_cena != '' && $prodazna_cena !== undefined) && ($nabavna_cena != '' && $nabavna_cena !== undefined)){
//          var $cena_so_ddv = parseFloat($("#cena").val());
//          var $marza_changed =  ((($prodazna_cena - $cena_so_ddv) / $cena_so_ddv) * 100)// change marza
//          $("#marza").val($marza_changed.toFixed(2))

//     }else{
//         $("#prodazna_cena").val('');
//     }
// }
