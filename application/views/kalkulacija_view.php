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

<div id="printKalkulacija" style="margin-top:20px; display:none;">
    <div class="container">
        <div class="row">
            <div class="col-xs-6">
                <img src="<?php echo base_url();?>common/images/logo.png" alt="Fixkim" width="120px"> 
            </div>
            <div class="col-xs-3 text-right">
                <p></p>
                <p>
                   <small>Дан.бр МК ???</small>
                </p>
                <p>
                   <small>Ж.с-ка 270070348140110</small>
                </p>
                <p>
                   <small>ХАЛКБАНК</small>
                </p>
                <p>
                   <small>ГОСТИВАРСКА</small>
                </p>
                <p>
                   <small>1200 ТЕТОВО</small>
                </p>
            </div>
            <div class="col-xs-3 text-right">
                <p></p>
                <p>
                   <small>Nr.TVSH МК ???</small>
                </p>
                <p>
                   <small>Xh.llog 270070348140110</small>
                </p>
                <p>
                   <small>HALKBANK</small>
                </p>
                <p>
                   <small>GOSTIVARSKA</small>
                </p>
                <p>
                   <small>1200 TETOVË</small>
                </p>
            </div>
        </div>
        <hr width="100%">
        <div class="row">
            <div class="col-xs-5" >
            <p style="font-size: 10px;">
               <b>Фактура бр.  / Faktura nr. &nbsp; </b> <?php echo $broj_faktura;?>
            </p>
            <p style="font-size: 10px;">
            	<b>Датум:  / Data: &nbsp; </b><?php echo $datum;?>
            </p>
            </div>
            <div class="col-xs-6 col-xs-offset-1 " style="font-size: 10px;">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <b> До / Për: &nbsp;&nbsp;</b><?php echo " " . $ime_komintent . "  -  " . $grad_komintent; ?> 
                    </div>
                </div>
            </div>
        </div>
        <hr width="100%" style="margin-top: 0px;">
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
                        <p>Цена без ДДВ</p>
                    </th>
                    <th>
                        <p>ДДВ</p>
                    </th>
                    <th>
                        <p>Основ за ДДВ</p>
                    </th>
                    <th>
                        <p>Цена со ДДВ</p>
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
                    <th>
                        <p>Sasia</p>
                    </th>
                    <th>
                        <p>Rabat</p>
                    </th>
                    <th>
                        <p>Çmimi pa TVSH</p>
                    </th>
                    <th>
                        <p>TVSH</p>
                    </th>
                    <th>
                        <p>Baza e TVSH</p>
                    </th>
                    <th>
                        <p>Çmimi me TVSH</p>
                    </th>
                    <th>
                        <p>Vlera</p>
                    </th>
                </tr>
            </thead>
            <!-- <tbody>
             <?php 
                
                $br = 0;
                $vkupno_bez_ddv = 0;
                $vkupno_ddv = 0;
                $vkupno_za_naplata = 0;
               
             	foreach($faktura as $fakt){
                 	$br++;
                    $naziv_artikal = $fakt->naziv_artikal;
                    $ed_merka = $fakt->ed_merka;
                    $kolicina_pak = $fakt->kolicina_pak;
                    $kolicina = $fakt->kolicina;
                    $rabat = $fakt->popust;
                    $prodazna_cena = $fakt->cena;
                    $ddv = $fakt->ddv;
                    $cena_bez_ddv = $prodazna_cena - ($prodazna_cena * ($ddv / 100));
                    $iznos = $prodazna_cena * $kolicina;
                    $osnov_ddv = $iznos * ($ddv / 100);   // baza e TVSH

                    $vkupno_bez_ddv += $cena_bez_ddv;
                    $vkupno_ddv += $osnov_ddv;
                    $vkupno_za_naplata += $prodazna_cena;

                 	?>
                    <tr>

                        <td>
                            <?php echo $br;?>
                        </td>

                        <td> 
                            <?php echo $naziv_artikal;?> 
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
                            <?php echo $rabat;?>
                        </td>

                        <td style="text-align:right;">
                            <?php echo number_format($cena_bez_ddv,2);?>
                        </td>

                        <td>
                            <?php echo $ddv . "%";?> 
                        </td>

                        <td style="text-align:right;">
                            <?php echo number_format($osnov_ddv,2);?>
                        </td>

                        <td style="text-align:right;">
                            <?php echo $prodazna_cena;?>
                        </td>

                        <td style="text-align:right;">
                            <?php echo number_format($iznos,2);?>
                        </td>

                    </tr>

                    <?php if ($br == count($faktura)){?>
                    	<tr>
                    		<td colspan="10" style="text-align: right;">
                                <b>Износ без ДДВ &nbsp;/ &nbsp;Vlera pa TVSH: &nbsp;</b>
                            </td>
                    		<td style="text-align:right;" >
                                <?php echo number_format($vkupno_bez_ddv,2);?>
                            </td>
                    	</tr>
                    	
                        <tr>
                    		<td colspan="10" style="text-align: right;">
                                <b>ДДВ &nbsp;/ &nbsp;TVSH &nbsp;</b>
                            </td>
                    		<td style="text-align:right;">
                                <?php echo number_format($vkupno_ddv,2);?>
                            </td>
                    	</tr>
                    	
                        <tr>	
                    		<td colspan="10" style="text-align: right;">
                                <b>Вкупно за наплата &nbsp;/ &nbsp;Gjithsejt: &nbsp;</b>
                            </td>
                    		<td style="text-align:right;">
                                <?php echo number_format($vkupno_za_naplata,2);?>
                            </td>
                    	</tr>	
                    <?php }?>
                <?php }?>
            </tbody> -->
        </table>

        <hr width="100%">
        <div class="row">
            <div class="col-xs-6">
         	<p style="font-size: 9px">* &nbsp;Цените се пресметани во денари.</p>
        	<p style="font-size: 9px">* &nbsp;Рок на плаќање: 30 дена од:<?php echo $datum;?></p>
            <p style="font-size: 9px">* &nbsp;За лично превземена стока рекламации не се примат.</p>
            <!-- <p style="font-size: 9px">* &nbsp;За ненавремено платена фактура пресметуваме камата согласно законските прописи.</p> -->
        </div>
        <div class="col-xs-6 ">
      		<p style="font-size: 9px">* &nbsp;Çmimet janë të llogaritura në denarë.</p>
         	<p style="font-size: 9px">* &nbsp;Afati i pagesës: 30 ditë nga: <?php echo $datum;?></p> 
            <p style="font-size: 9px">* &nbsp;Për artikullat e dorëzara personalisht, reklmacione nuk pranohen </p>
            <!-- <p style="font-size: 9px">* &nbsp;Për mospagesen te fatures ne kohë të caktuar , llogarisim kamatën sipas rregullave ligjore</p> -->
        </div>     
    </div>      
</div>
    <br></br>
    <div class="col-xs-6 " style="text-align: center;">
        _____________
        <p>Издал/Dorëzoi</p>
    </div>
    <div class="col-xs-6 " style="text-align: center;">
        _____________
        <p>Примил/Pranoi</p>
    </div>
</div>



