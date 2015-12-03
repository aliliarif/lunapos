<style type="text/css">
p {
    font-size: 10px;
    margin: 0;
    padding: 0;
}
td {
    white-space: nowrap;
    font-size: 10px;
}
</style>

<div id="printIspratnica" style=" margin-top:10px; ">
    <div class="container">
        
        <div class="row">
            <div class="col-xs-3"> 
                <img src="<?php echo base_url();?>common/images/logo.png" alt="Biofix" width="120px">
            </div>
            <div class="col-xs-9 text-left" style="text-align: center; margin-top:15px;">
                <p style="font-size:20px;"><b>PRONTODELIVERY DOOEL</b></p>
                <p style="font-size:17px;"><i>GOSTIVAR</i></p>
            </div>
        </div>

        <hr width="100%" style="border: 1px double #000; margin-bottom: 3px;">
        
        <div class="col-xs-12" style="text-align: center; padding-bottom: 5px; ">
            <p style="font-size: 12px;"><i>Rr."BANJESHNICA 2 NR.73/A",Gostivar &middot; Mob: 078/357-777 &middot; prontodelivery@yahoo.com</i></p>
            <p style="font-size: 12px;"><i>Xhirollogaria 200002946295258 &middot; Deponent: STOPANSKA BANKA</i></p>
        </div>
        
        <div class="col-xs-6 " >
            <p style="font-size: 15px;">
                <i>Ispratnica br. / <i>Fletëdërgesa nr. </i><b><?php echo $broj_ispratnica;?></b>
            </p>
        </div>
    
        <div class="col-xs-6 pull-right" style="text-align: right;"> <!-- style="text-align: center; margin-top: 20px; padding-bottom: 25px; " -->
            <p style="font-size: 15px;">До / Për: <b><?php if(isset($ime_komintent)){ echo $ime_komintent; }else{ echo "-"; } ?></b></p>
        </div>
        
        <div class="col-xs-12 text-right" style="padding-bottom: 15px;">
            <?php $date = date ( 'd.m.Y', time () )?>
            <?php echo $date;?>
        </div>

        <!-- / end client details section -->
        <table class="table-bordered" style="width:100%;" >
            <thead>
                <tr style="background-color: #82CAC8!important; ">
                    <th>
                        <p>Р.бр</p>
                    </th>
                    <th>
                        <p>Назив на артикал</p>
                    </th>
                    <th>
                        <p>Пак.</p>
                    </th>
                    <th>
                        <p>Кол во пак.</p>
                    </th>
                    <th>
                        <p>Количина</p>
                    </th>
                    <th>
                        <p>Рабат</p>
                    </th>
                    <th>
                        <p>Единечна Цена</p>
                    </th>
                    <th>
                        <p>Износ</p>
                    </th>
                </tr>
            </thead>
            <thead>
                <tr style="background-color: #82CAC8!important; " >
                    <th>
                        <p>Nr r.</p>
                    </th>
                    <th>
                        <p>Emri i artikullit</p>
                    </th>
                    <th>
                        <p>Pak.</p>
                    </th>
                    <th>
                        <p>Sasia ne pak.</p>
                    </th>
                    <th>
                        <p>Sasia</p>
                    </th>
                    <th>
                        <p>Rabat</p>
                    </th>
                    <th>
                        <p>Çmimi per njesi</p>
                    </th>
                    <th>
                        <p>Vlera</p>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $br=0; 
                $vkupno_za_naplata = 0;
                foreach($ispratnica as $ispr){
                    $br++;
                    $naziv_artikal = $ispr->naziv_artikal;
                    $ed_merka = $ispr->ed_merka;
                    $kolicina_pak = $ispr->kolicina_pak;
                    $kolicina = $ispr->kolicina;
                    $popust = $ispr->popust;
                    $prodazna_cena = $ispr->cena;
                    $iznos = $prodazna_cena * $kolicina;

                    
                    $vkupno_za_naplata += $prodazna_cena * $kolicina;
                    
                    ?>
                    <tr>
                        <td>
                            <?php echo $br;?>
                        </td>

                        <td> 
                            <?php echo $ispr->naziv_artikal;?> 
                        </td>

                        <?php if($ed_merka == 'liter'){?>
                            <td>lt</td>
                        <?php }else{?>
                            <td><?php echo $ed_merka; ?></td>
                        <?php }?>

                        <td>
                            <?php echo $kolicina_pak;?>
                        </td>

                        <td>
                            <?php echo $kolicina;?> 
                        </td>

                        <td>
                            <?php echo $popust;?> 
                        </td>

                        <td style="text-align:right;">
                            <?php echo $prodazna_cena;?>
                        </td>

                        <td style="text-align:right;">
                            <?php echo number_format($iznos,2);?>
                        </td>
                    </tr>
                    <?php  if ($br == count($ispratnica)){?>
                        <tr>
                            <td colspan="7" style="text-align:right;">
                                <b>Вкупно за наплата &nbsp;/ &nbsp;Gjithsejt: &nbsp;</b>
                            </td>
                            <td style="text-align:right;">
                                <?php echo number_format($vkupno_za_naplata,2);?>
                            </td>
                        </tr>
                    <?php }?>
                <?php }?>
            </tbody>
        </table>
    </div>
    <br></br>
    <!-- <div class="col-xs-6 " style="text-align: center;">
        _____________
        <p>Издал/Dorëzoi</p>
    </div>
    <div class="col-xs-6 " style="text-align: center;">
        _____________
        <p>Примил/Pranoi</p>
    </div> -->
</div>