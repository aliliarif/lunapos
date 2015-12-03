<!-- MUST BE .PHP FILE - ACTS LIKE JS -->
<!-- // add table rows -->
<script type="text/javascript">

$("#FH_form").on('submit', function(event) {
    var $fakture_nr = $("#fakture_nr").val();
    var $fakture_nga = $("#fakture_nga").val();
    var $fakture_data = $("#fakture_data").val();

    if($fakture_nr == '' || $fakture_nr === undefined){
        alert("Shkruani nr e fakturës hyrëse ! ");
        event.preventDefault();
    }

    if($fakture_nga == '' || $fakture_nga === undefined){
        alert("Shkruani emrin e blerësit ! ");
        event.preventDefault();
    }

    if ($fakture_data == '' || $fakture_data === undefined){
        alert("Shkruani datën ! ");
        event.preventDefault();
    }
});

nr=2;
function addRowFakturyHyrese(){ //FH
    br=nr-1;

    if($('#sasia_FH_'+br).val() == ''){
        alert('Sasia nuk mund te jete zbrazet');
        return false;
    }
    if($('#prod_'+br).val() == ''){
        alert('Produkti nuk mund te jete zbrazet');
        return false;
    }

    $("#faktureHyreseTable > tbody").append(
        '<tr id="'+nr+'">' 
            + '<td>'+ nr +'</td>'
            + '<td>'
                + '<select class="form-control combobox" id="prod_FH_'+nr+'" name="prod_FH_'+nr+'" >'  
                    + '<option value=""></option>' 
                    + '<?php foreach($artikli as $art){ ?>'
                        + '<option  value="<?php echo $art->sifra_artikal;?>"><?php echo $art->naziv_artikal;?></option>'
                    + '<?php }?>'
                + '</select>' 
            + '</td>'
            + '<td><input type="text" class="form-control col-md-12 nabavna_so_ddv decimalOnly" id="nabavna_so_ddv_FH_'+nr+'" name="nabavna_so_ddv_FH_'+nr+'" style="text-align:right; width:100%;"></td>'
            + '<td>'
                + '<select class="form-control nabavna_ddv" name="ddv_FH_'+nr+'" id="ddv_FH_'+nr+'" style="width:80px;">'
                    + '<option value=" "></option>'
                    + '<option value="0">0</option>'
                    + '<option value="5">5%</option>'
                    + '<option value="18">18%</option>'
                + '</select>'
            + '</td>'
            + '<td><input type="text" class="form-control nabavna_bez_DDV decimalOnly" id="nabavna_bez_ddv_FH_'+nr+'" name="nabavna_bez_ddv_FH_'+nr+'" style="text-align:right;" tabindex="-1"></td>'
            + '<td><input type="text" class="form-control nabavna_rabat decimalOnly" id="rabat_FH_'+nr+'" name="rabat_FH_'+nr+'" style="text-align:right; width:100%;"></td>'
            + '<td><input type="text" class="form-control decimalOnly" id="sasia_FH_'+nr+'" name="sasia_FH_'+nr+'" style="text-align:right;"></td>'
            
            + '<td style="width:40px;"><button type="button" class="btn btn-success btn-xs" onClick="addRowFakturyHyrese();" id="shto_row_'+nr+'"><i class="fa fa-check"></i></button></td>'
        + '</tr>'
    );
    // ++ '<td class="danger"><input type="text" class="form-control col-md-12 prodazna_marza decimalOnly" id="marza_FH_'+nr+'" name="sasia_FH_'+nr+'" style="text-align:right; width:100%;"></td>'
    //         + '<td class="danger"><input type="text" class="form-control col-md-12 prodazna_bez_ddv decimalOnly" id="prodazna_bez_ddv_FH_'+nr+'" name="sasia_FH_'+nr+'" style="text-align:right; width:100%;" readonly tabindex="-1"></td>'
    //         + '<td class="danger"><input type="text" class="form-control col-md-12 prodazna_so_ddv decimalOnly" id="prodazna_so_ddv_FH_'+nr+'" name="sasia_FH_'+nr+'" style="text-align:right; width:100%;" tabindex="-1"></td> '

    $("#shto_row_"+br+" i").attr('class','fa fa-times');
    $("#shto_row_"+br).attr('class','btn btn-danger btn-xs');
    $("#shto_row_"+br).attr('onClick','delRow('+br+');');

    $("#maxFaktureHyrse").val(br);
    $("#prod_FH_"+nr).combobox();  
    nr++;
}

<!-- // add table rows end -->

<!-- // del row -->
function delRow(row){
    $('#'+row).remove();
}

// PRESMETKI

$("#faktureHyreseTable").on('input','.nabavna_so_ddv', function(event) {
    var $id_pom = $(this).prop('id'); 
    var $id = getRowNumber($id_pom); // samo br na redot
});

$("#faktureHyreseTable").on('change','.nabavna_ddv', function(event) {
    var $id_pom = $(this).prop('id'); 
    var $id = getRowNumber($id_pom); // samo br na redot
    presmetajNabavnaBezDDV($id);
});

$("#faktureHyreseTable").on('input','.prodazna_marza', function(event) {
    var $id_pom = $(this).prop('id'); 
    var $id = getRowNumber($id_pom); // samo br na redot
    presmetajProdaznaBezDDV($id);
    presmetajProdaznaSoDDV($id);
});  

$("#faktureHyreseTable").on('input','.prodazna_so_ddv', function(event) {
    var $id_pom = $(this).prop('id'); 
    var $id = getRowNumber($id_pom); // samo br na redot
    presmetajMarza($id);
});  



// splits id of changed row and gets ROW NUMBER 
function getRowNumber(id){
    var $count = (id.match(/_/g) || []).length; // mduhet kjo per ti numeruar sa her pojavitet "_" sepse sesht perher nisoj
    var $id = id.split('_')[$count];
    return $id;
}



// $("#nabavna_so_ddv").on('input', function(event) {
//     presmetajBezDDV();
//     presmetajProdaznaCena();
// });


// $("#ddv").on('change', function(event) {
//     presmetajBezDDV();
//     presmetajSoDDV();
// });

// $("#nabavna_bez_ddv").on('input', function(event) {
//     presmetajSoDDV();
//     presmetajProdaznaCena();
// });

// $("#marza").on('input', function(event) {
//     presmetajProdaznaCena();
// });

// $("#prodazna_cena").on('input', function(event) {
//     presmetajMarza();
// });

function presmetajNabavnaBezDDV(id){ 
    // presmetka na cena bez DDV -- so formulata = (maloprodazna / 1.18 ( ili 1.05 za 5% ) [ opcionalno: - maloprodazna  -- ZA VREDNOSTA NA DDV)]) 
    var $ddv = parseFloat($("#ddv_FH_" + id).val());
    var $nabavna_so_ddv = parseFloat($("#nabavna_so_ddv_FH_" + id).val());
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
        $nabavna_bez_ddv = $nabavna_bez_ddv.toFixed(2); 
        $("#nabavna_bez_ddv_FH_" + id).val($nabavna_bez_ddv);
    }
}

function presmetajProdaznaBezDDV(id){
    var $marza = parseFloat($("#marza_FH_" + id).val());
    var $nabavna_bez_ddv = parseFloat($("#nabavna_bez_ddv_FH_" + id).val());

    // if(isNaN($marza)){
    //     $("#prodazna_cena").val('');
    //     return false;
    // }

    if (($marza != '' && $marza !== undefined) && ($nabavna_bez_ddv != '' && $nabavna_bez_ddv !== undefined)){
        var $prodazna_cena_bez_ddv = $nabavna_bez_ddv + ($nabavna_bez_ddv * ($marza / 100));
        $("#prodazna_bez_ddv_FH_" + id).val($prodazna_cena_bez_ddv.toFixed(2));
    }else{
        return false;
    }
}

function presmetajProdaznaSoDDV(id){
    var $marza = parseFloat($("#marza_FH_" + id).val());
    var $nabavna_so_ddv = parseFloat($("#nabavna_so_ddv_FH_" + id).val());

    // if(isNaN($marza)){
    //     $("#prodazna_cena").val('');
    //     return false;
    // }

    if (($marza != '' && $marza !== undefined) && ($nabavna_so_ddv != '' && $nabavna_so_ddv !== undefined)){
        var $prodazna_cena = $nabavna_so_ddv + ($nabavna_so_ddv * ($marza / 100));
        $("#prodazna_so_ddv_FH_" + id).val($prodazna_cena.toFixed(2));
    }else{
        return false;
    }
}

function presmetajMarza(id){
    var $prodazna_cena = parseFloat($("#prodazna_so_ddv_FH_" + id).val()).toFixed(2); 
    var $nabavna_so_ddv = parseFloat($("#nabavna_so_ddv_FH_" + id).val());
    
    // if(isNaN($prodazna_cena)){
    //     $("#marza").val('');
    //     return false;
    // }

    if(($prodazna_cena != ' ' && $prodazna_cena !== undefined) && ($nabavna_so_ddv != ' ' && $nabavna_so_ddv !== undefined && !isNaN($nabavna_so_ddv))){
        //var $nabavna_so_ddv = parseFloat($("#nabavna_so_ddv").val());
        var $marza_changed =  ((($prodazna_cena - $nabavna_so_ddv) / $nabavna_so_ddv) * 100) // change marza
        
        $("#marza_FH_" + id).val($marza_changed.toFixed(2))
    }
    // else{
    //     $("#prodazna_cena").val('');
    // }
}

// function presmetajSoDDV(){ 
//     // presmetka na cena so DDV -- so formulata = cena * 1.18 ( ili 1.05 za 5% )
//     var $ddv = parseFloat($("#ddv").val());
//     var $nabavna_bez_ddv = parseFloat($("#nabavna_bez_ddv").val());
//     var $nabavna_so_ddv = 0;
//     if(($ddv != ' ' && $ddv !== undefined) && ($nabavna_bez_ddv != '' && $nabavna_bez_ddv !== undefined)){
//         if($ddv == '5'){
//             var $ddv_pom = 1.05; //mduhet per formulen
//         }else if($ddv == '18'){
//             var $ddv_pom = 1.18; //mduhet per formulen
//         }else{
//             return false;
//         }
//         $nabavna_so_ddv = $nabavna_bez_ddv * $ddv_pom;
//         $nabavna_so_ddv = $nabavna_so_ddv.toFixed(2);
//         $("#nabavna_so_ddv").val($nabavna_so_ddv);
//     }
// }

// function presmetajProdaznaCena(){
//     var $marza = parseFloat($("#marza").val());
//     var $nabavna_so_ddv = parseFloat($("#nabavna_so_ddv").val());

//     if(isNaN($marza)){
//         $("#prodazna_cena").val('');
//         return false;
//     }

//     if (($marza != '' && $marza !== undefined) && ($nabavna_so_ddv != '' && $nabavna_so_ddv !== undefined)){
//         var $prodazna_cena = $nabavna_so_ddv + ($nabavna_so_ddv * ($marza / 100));
//         $("#prodazna_cena").val($prodazna_cena.toFixed(2));
//     }else{
//         return false;
//     }
// }

// function presmetajMarza(){
//     var $prodazna_cena = parseFloat($("#prodazna_cena").val()).toFixed(2); 
//     var $nabavna_so_ddv = parseFloat($("#nabavna_so_ddv").val()).toFixed(2); // samo za kontrola
    
//     if(isNaN($prodazna_cena)){
//         $("#marza").val('');
//         return false;
//     }

//     if(($prodazna_cena != ' ' && $prodazna_cena !== undefined) && ($nabavna_so_ddv != ' ' && $nabavna_so_ddv !== undefined && !isNaN($nabavna_so_ddv))){
//         var $nabavna_so_ddv = parseFloat($("#nabavna_so_ddv").val());
//         var $marza_changed =  ((($prodazna_cena - $nabavna_so_ddv) / $nabavna_so_ddv) * 100) // change marza
//         $("#marza").val($marza_changed.toFixed(2))
//     }else{
//         $("#prodazna_cena").val('');
//     }
// }


</script>