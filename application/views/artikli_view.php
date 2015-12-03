<div class="content-wrapper">
   <section class="content">
      <div class="row">
         <div class="col-md-12">
            <div class="box box-primary ">
               <div class="box-body">
                  <a href="artikli_controller?add_artikal=1" class="btn btn-primary pull-right" ><i class="fa fa-plus "></i></a>
                  <h4><i class="fa fa-angle-right"></i> Çmimorja</h4>
                  <hr>
                  <table id="artikujtTable" style="font-size: 13px;" class="table table-striped table-hover table-bordered nowrap" >
                     <thead>
                        <tr class="info">
                           <th>#</th>
                           <th>Artikulli</th>
                           <th>Shifra</th>
                           <th>Sasia ne paketim</th>
                           <th>Njesia matese</th>
                           <th>Cmimi blerës pa TVSH</th>
                           <th>TVSH</th>
                           <th>Cmimi blerës me TVSH</th>
                           <th>Marzha</th>
                           <th>Cmimi shitës</th>
                           <th></th>
                        </tr>
                     </thead>
                     <tbody>
                        <form >
                           <?php $br=0;foreach ($artikli as $artikli) { $br++; ?>
                           <tr>
                              <td style="width:15px;">
                                 <?php echo $br;?>
                              </td>
                              <td class="col-md-4">
                                 <font style="display:none;"><?php echo $artikli->naziv_artikal; ?></font>
                                 <input type="text" id="<?php echo 'naziv_artikal_'.$artikli->sifra_artikal;?>" value='<?php echo $artikli->naziv_artikal; ?>' style="width:100%; border:none; background:none;" readonly>
                              </td>
                              <td class="col-md-1">
                                 <font style="display:none;"><?php echo $artikli->interna_sifra; ?></font>
                                 <input type="text" id="<?php echo 'interna_sifra_'.$artikli->sifra_artikal;?>" value='<?php echo $artikli->interna_sifra; ?>' style="width:100%; border:none; background:none;" readonly>
                              </td>
                              <td style="text-align:right;" class="col-md-1">
                                 <font style="display:none;"><?php echo $artikli->kolicina_pak; ?></font>
                                 <input type="text" id="<?php echo 'kolicina_pak_'.$artikli->sifra_artikal;?>" value='<?php echo $artikli->kolicina_pak; ?>' style="width:100%; text-align:right; border:none; background:none;" readonly>
                              </td>

                              <td style="text-align:right;" class="col-md-1">
                                 <?php if($artikli->ed_merka == 'kg'){?>
                                   <font style="display:none;">kg</font>
                                   <input type="text" id="<?php echo 'ed_merka_'.$artikli->sifra_artikal;?>" value='kg' style="width:100%; text-align:right; border:none; background:none;" readonly>
                                 <?php }else{?>
                                   <font style="display:none;"><?php echo $artikli->ed_merka;?></font>
                                   <input type="text" id="<?php echo 'ed_merka_'.$artikli->sifra_artikal;?>" value='<?php echo $artikli->ed_merka;?>' style="width:100%; text-align:right; border:none; background:none;" readonly>
                                 <?php }?>
                              </td>

                              <td style="text-align:right; " class="col-md-1">
                                 <font style="display:none;"><?php echo $artikli->nabavna_cena_bez_ddv; ?></font>
                                 <input type="text" id="<?php echo 'nabavna_bez_ddv_'.$artikli->sifra_artikal;?>" value='<?php echo $artikli->nabavna_cena_bez_ddv; ?>' style="width:100%; text-align:right; border:none; background:none;" readonly>
                              </td>

                              <td style="text-align:right; " class="col-md-1">
                                 <font style="display:none;"><?php echo $artikli->ddv; ?></font>
                                 <input type="text" id="<?php echo 'ddv_'.$artikli->sifra_artikal;?>" value='<?php echo $artikli->ddv; ?>' style="width:100%; text-align:right; border:none; background:none;" readonly>
                              </td>

                              <td style="text-align:right; " class="col-md-1">
                                 <font style="display:none;"><?php echo $artikli->nabavna_cena_so_ddv; ?></font>
                                 <input type="text" id="<?php echo 'nabavna_so_ddv_'.$artikli->sifra_artikal;?>" value='<?php echo $artikli->nabavna_cena_so_ddv; ?>' style="width:100%; text-align:right; border:none; background:none;" readonly>
                              </td>

                              <td style="text-align:right; " class="col-md-1">
                                 <font style="display:none;"><?php echo $artikli->marza; ?></font>
                                 <input type="text" id="<?php echo 'marza_'.$artikli->sifra_artikal;?>" value='<?php echo $artikli->marza; ?>' style="width:100%; text-align:right; border:none; background:none;" readonly>
                              </td>

                              <td style="text-align:right; " class="col-md-1">
                                 <font style="display:none;"><?php echo $artikli->prodazna_cena; ?></font>
                                 <input type="text" id="<?php echo 'prodazna_cena_'.$artikli->sifra_artikal;?>" value='<?php echo $artikli->prodazna_cena; ?>' style="width:100%; text-align:right; border:none; background:none;" readonly>
                              </td>

                              <td style="text-align:right; width:20px;" class="col-md-1">
                                 <!--<button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>-->
                                 <button type="button" id="<?php echo $artikli->sifra_artikal;?>" class="btn btn-primary btn-xs editArtikal"><i class="fa fa-pencil"></i></button>
                              </td>
                           </tr>
                           <?php } ?>
                        </form>
                     </tbody>
                     <input type="hidden" id="max_artikuj" name="max_artikuj" value="<?php echo $br;?>">
                  </table>
               </div>
            </div>
         </div>
   </section>
</div>


<!-- MODAL EDIT ARTIKAL -->
<div class="modal" id="editArtikal_modal" role="dialog" aria-labelledby="gridSystemModalLabel" data-backdrop="static">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header" style="background-color:#3C8DBC; color:white;">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="gridSystemModalLabel">Modifiko arikullin</h4>
         </div>
         <div class="modal-body">
            <form action="artikli_controller" method="POST">
               <div class="row">
                  <div class="col-md-12">     
                     <!-- FORM VALIDATION -->
                     <?php if(validation_errors()){?>
                        <div class="alert alert-danger alert-dismissable col-md-12" >
                           <button type="button" class="close" data-dismiss="alert" aria-hidden="hidden">×</button>        
                           <?php echo validation_errors(); ?>
                        </div>
                     <?php }?>
                     <?php if(isset($success_article)){?>
                        <div class="alert alert-success alert-dismissable col-md-12 success_div">
                           <button type="button" class="close" data-dismiss="alert" aria-hidden="hidden">×</button>        
                           <?php echo $success_article; ?>
                        </div>
                     <?php }?>
                     <!-- FORM VALIDATION END -->
                     <div class="form-group col-md-12">
                        <label>Emri artikullit: <font style="color:red;">*</font></label>
                        <input type="text" class="form-control" name="naziv_artikal" id="naziv_artikal" value="<?php if(validation_errors()){echo set_value('naziv_artikal');} ?>" autofocus>
                     </div>
                     <div class="form-group col-md-4">
                        <label>Shifra e artikullit: </label>
                        <input type="text" class="form-control decimalOnly" name="interna_sifra" id="interna_sifra" value="<?php if(validation_errors()){echo set_value('interna_sifra');} ?>">
                     </div>
                     <div class="form-group col-md-4">
                        <label>Sasia në paketim: </label>
                        <input type="text" class="form-control decimalOnly" name="kolicina_pak" id="kolicina_pak" value="<?php if(validation_errors()){echo set_value('kolicina_pak');} ?>">
                     </div>
                     <div class="form-group col-md-4">
                        <label>Njësia matëse: <font style="color:red;">*</font></label>
                        <select class="form-control" name="ed_merka" id="ed_merka">
                           <option value=""></option>
                           <option value="kg" <?php if (set_value('ed_merka')=='kg' && validation_errors()) echo "selected"; ?>>Kilogram</option>
                           <option value="litër" <?php if (set_value('ed_merka')=='liter' && validation_errors()) echo "selected"; ?>>Liter</option>
                           <option value="cope" <?php if (set_value('cope')=='liter' && validation_errors()) echo "selected"; ?>>cope</option>
                        </select>
                     </div>
                     <div class="form-group col-md-4">
                        <label>Çmimi blerës me TVSH: <font style="color:red;">*</font></label>
                        <div class="input-group">
                           <input type="text" class="form-control decimalOnly" name="nabavna_so_ddv" id="nabavna_so_ddv" style="text-align:right;" value="<?php if(validation_errors()){echo set_value('nabavna_cena_bez_ddv');} ?>">
                           <div class="input-group-addon">
                              den
                           </div>
                        </div>
                     </div>
                     <div class="form-group col-md-4">
                        <label>TVSH: <font style="color:red;">*</font></label>
                        <select class="form-control" name="ddv" id="ddv">
                           <option value=" " <?php if (set_value('ddv')==-1 && validation_errors()) echo "selected";?>></option>
                           <option value="0" <?php if (set_value('ddv')==0 && validation_errors()) echo "selected"; ?>>0</option>
                           <option value="5" <?php if (set_value('ddv')==5 && validation_errors()) echo "selected"; ?>>5%</option>
                           <option value="18" <?php if (set_value('ddv')==18 && validation_errors()) echo "selected"; ?>>18%</option>
                        </select>
                     </div>
                     <div class="form-group col-md-4">
                        <label>Çmimi blerës pa TVSH: <font style="color:red;">*</font></label>
                        <div class="input-group">
                           <input type="text" class="form-control" name="nabavna_bez_ddv" id="nabavna_bez_ddv" style="text-align:right;" value="<?php if(validation_errors()){echo set_value('nabavna_cena_bez_ddv');} ?>">
                           <div class="input-group-addon">
                              den
                           </div>
                        </div>
                     </div>
                     <div class="form-group col-md-6">
                        <label>Marzha: <font style="color:red;">*</font></label>
                        <div class="input-group">
                           <input type="text" class="form-control decimalOnly" name="marza" id="marza" style="text-align:right;" value="<?php if(validation_errors()){echo set_value('marza');} ?>">
                           <div class="input-group-addon">
                              &nbsp;&nbsp;%&nbsp;&nbsp;
                           </div>
                        </div>
                     </div>
                     <div class="form-group col-md-6">
                        <label>Cmimi shites: <font style="color:red;">*</font></label>
                        <div class="input-group">
                           <input type="text" class="form-control decimalOnly" name="prodazna_cena" id="prodazna_cena" style="text-align:right; border-color:green;" value="<?php if(validation_errors()){echo set_value('prodazna_cena');} ?>" tabindex="-1">
                           <div class="input-group-addon" style="border-color:green;">
                              den
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- hidden input to save sifra_artikal for update -->
            <input type="hidden" id="hid_sifra_artikal" name="hid_sifra_artikal">
            <div class="modal-footer">
              <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
              <button type="submit" id="upd_artikal" name="upd_artikal" value="upd_artikal" class="btn btn-primary">Ruaj</button>
            </div>
         </form>
      </div>
   </div>
</div>
<!-- MODAL EDIT END -->
