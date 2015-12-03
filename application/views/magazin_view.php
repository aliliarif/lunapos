<div class="content-wrapper">
   <section class="content">
      <div class="row">
         <div class="col-md-12">
            <div class="nav-tabs-custom">
               <ul class="nav nav-tabs" role="tablist">
                  <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Magazin</a></li>
                  <li role="presentation"><a href="#shto" aria-controls="shto" role="tab" data-toggle="tab">Fakture Hyrese</a></li>
               </ul>
               <div class="tab-content">
                  <div role="tabpanel" class="tab-pane active" id="home">
                     <table id="magazinTable" style="font-size: 13px;" class="table table-striped table-hover table-bordered" >
                        <h4><i class="fa fa-angle-right"></i> Magazin</h4>
                        <hr>
                        <thead>
                           <tr class="info">
                              <th>Artikulli</th>
                              <th>Shitje gjith kohës</th>
                              <th>Në magazin</th>
                              <th>Njesia matese</th>
                              <th>%</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php foreach($artikli as $mag){
                              $naziv_artikal = $mag->naziv_artikal;
                              $gjith_kohes = $mag->prodadeni;
                              $ne_magazin = $mag->zaliha;
                              $ed_merka = $mag->ed_merka;
                              $static_zaliha = $mag->static_zaliha;
                              if ($static_zaliha){ // hala ska ne magazin
                                 $percentage = (100*$ne_magazin)/$static_zaliha;
                              }else{
                                 $percentage = 0;
                              }
                              if ($percentage > 0 && $percentage < 30){
                                 $class = "progress-bar-danger";
                              }else if($percentage >= 30 && $percentage < 60){
                                 $class = "progress-bar-warning";
                              }else if($percentage >= 60 && $percentage < 80){
                                 $class = "progress-bar-info";
                              }else{
                                 $class = "progress-bar-success";
                              }
                           ?>
                           <tr>
                              <td>
                                 <?php echo $naziv_artikal; ?>
                              </td>
                              <td>
                                 <?php echo $gjith_kohes; ?>
                              </td>
                              <td>
                                 <?php echo $ne_magazin; ?>
                              </td>
                              <td>
                                 <?php echo $ed_merka; ?>
                              </td>
                              <td>
                                 <div class="progress">
                                    <div class="progress-bar <?php echo $class;?>" role="progressbar" aria-valuenow="<?php echo $percentage;?>"
                                       aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $percentage . "%";?>">
                                       <b style="color:black;"><?php echo number_format($percentage,2) . "%"; ?></b>
                                    </div>
                                 </div>
                              </td>
                           </tr>
                           <?php }?>
                        </tbody>
                     </table>
                  </div>
                  <div role="tabpanel" class="tab-pane" id="shto">
                     <form action="magazin_controller" method="post" id="FH_form">
                        <table  id="faktureHyreseTable" style="font-size: 13px;" class="table table-striped table-hover table-bordered" >
                           </br>

                           <button type="submit" class="btn btn-success pull-right btn-sm" name="shto_FH" id="shto_FH" style="margin-top:25px;"><i class="fa fa-check"></i> Ruaj dhe printo kalkulimin</button>
                           
                           <div class="row">
                              <div class="form-group col-xs-4">
                                 <label for="fakture_nga" >Nga:</label>
                                 <select class="form-control combobox input-sm" id="fakture_nga" name="fakture_nga">
                                    <option value=""></option>
                                    <?php foreach($komintenti as $komi){ ?>
                                       <option value="<?php echo $komi->id_komintent;?>"><?php echo $komi->ime_komintent;?></option>
                                    <?php }?>
                                 </select>
                              </div>
                              <div class="form-group col-xs-2">
                                 <label for="fakture_data" >Data:</label>
                                 <input id="fakture_data" name="fakture_data" class="form-control input-group-lg datepicker input-sm" type="text" />
                              </div>
                              <div class="form-group col-xs-1">
                                 <label for="fakture_nr" >Faktura nr:</label>
                                 <input id="fakture_nr" name="fakture_nr" class="form-control input-group-lg input-sm" type="text" />
                              </div>
                              <div class="form-group col-xs-3" style="margin-top:10px;">
                                 <br>
                                 <label for="status" style="margin-right:10px;">E paguar</label>
                                 <input type="checkbox" id="status" name="status">
                              </div>
                           </div>
        
                           
                           <thead>
                              <tr class="info">
                                 <th> #</th>
                                 <th style="width:30%;"> Artikulli</th>
                                 <th> Çmimi blerës me TVSH</th>
                                 <th> TVSH</th>
                                 <th> Çmimi blerës pa TVSH</th>
                                 <th> Rabat</th>
                                 <th> Sasia</th>
                                 <!-- <th class="danger" > Marzha</th>
                                 <th class="danger" > Çmimi shitës pa TVSH</th>
                                 <th class="danger" > Çmimi shitës me TVSH</th> -->
                                 <th> </th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr id="1">
                                 <td style="width:2%;">1</td>
                                 <td>
                                    <select class="form-control combobox" id="prod_FH_1" name="prod_FH_1">
                                       <option value=""></option>
                                       <?php foreach($artikli as $art){?>
                                       <option value="<?php echo $art->sifra_artikal;?>"><?php echo $art->naziv_artikal;?></option>
                                       <?php }?>
                                    </select>
                                 </td>
                                 
                                 <td>
                                    <input type="text" class="form-control col-md-12 nabavna_so_ddv" id="nabavna_so_ddv_FH_1" name="nabavna_so_ddv_FH_1" style="text-align:right; width:100%;">
                                 </td>
                                 
                                 <td>
                                    <select class="form-control nabavna_ddv" name="ddv_FH_1" id="ddv_FH_1" style="width:80px;">
                                       <option value=" "></option>
                                       <option value="0">0</option>
                                       <option value="5">5%</option>
                                       <option value="18">18%</option>
                                    </select>
                                 </td>

                                 <td>
                                    <input type="text" class="form-control col-md-12 nabavna_bez_DDV decimalOnly" id="nabavna_bez_ddv_FH_1" name="nabavna_bez_ddv_FH_1" style="text-align:right; width:100%;" tabindex="-1">
                                 </td>

                                 <td>
                                    <input type="text" class="form-control col-md-12 nabavna_rabat decimalOnly" id="rabat_FH_1" name="rabat_FH_1" style="text-align:right; width:100%;">
                                 </td>

                                 <td>
                                    <input type="text" class="form-control col-md-12 decimalOnly" id="sasia_FH_1" name="sasia_FH_1" style="text-align:right; width:100%;">
                                 </td>

                                 <!-- PRODAZBA -->
                                 <!-- <td class="danger">
                                    <input type="text" class="form-control col-md-12 prodazna_marza decimalOnly" id="marza_FH_1" name="marza_FH_1" style="text-align:right; width:100%;">
                                 </td>

                                 <td class="danger">
                                    <input type="text" class="form-control col-md-12 prodazna_bez_ddv decimalOnly" id="prodazna_bez_ddv_FH_1" name="prodazna_bez_ddv_FH_1" style="text-align:right; width:100%;" readonly tabindex="-1">
                                 </td>

                                 <td class="danger">
                                    <input type="text" class="form-control col-md-12 prodazna_so_ddv decimalOnly" id="prodazna_so_ddv_FH_1" name="prodazna_so_ddv_FH_1" style="text-align:right; width:100%;" tabindex="-1">
                                 </td>  -->
                                 <!-- PRODAZBA END-->

                                 <td style="width:50px;"><button type="button" class="btn btn-success btn-xs" onClick="addRowFakturyHyrese();" id="shto_row_1" name="shto_row_1"><i class="fa fa-check"></i></button></td>
                              </tr>
                           </tbody>
                           <input type="hidden" name="maxFaktureHyrse" id="maxFaktureHyrse" value=""> 
                        </table>
                     </form>
                  </div>
               </div>
            </div>
         </div>
   </section>
</div>