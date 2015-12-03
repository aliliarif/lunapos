<div class="content-wrapper">
   <section class="content">
      <div class="row">
         <div class="col-md-12">
            <div class="box box-primary" style="height:750px;" >
               <div class="box-header">
                  <h4><i class="fa fa-angle-right"></i> Shto artikull</h4>
                  <hr>
               </div>
               <div class="box-body">
                  <form id="settings_controller" method="post" action="artikli_controller"  autocomplete="off">
                     <div class="row">
                        <div class="col-md-6">     
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
                                 <option value="liter" <?php if (set_value('ed_merka')=='liter' && validation_errors()) echo "selected"; ?>>Liter</option>
                                 <option value="cope" <?php if (set_value('ed_merka')=='cope' && validation_errors()) echo "selected"; ?>>Cope</option>
                              </select>
                           </div>
                           <div class="form-group col-md-4">
                              <label>Çmimi blerës me TVSH: <font style="color:red;">*</font></label>
                              <div class="input-group"> <!-- was nabavna cena -->
                                 <input type="text" class="form-control decimalOnly" name="nabavna_so_ddv" id="nabavna_so_ddv" style="text-align:right;" value="<?php if(validation_errors()){echo set_value('nabavna_so_ddv');} ?>">
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
                              <label>Cmimi blerës pa TVSH: <font style="color:red;">*</font></label>
                              <div class="input-group"> <!-- was cena -->
                                 <input type="text" class="form-control" name="nabavna_bez_ddv" id="nabavna_bez_ddv" style="text-align:right;" value="<?php if(validation_errors()){echo set_value('nabavna_bez_ddv');} ?>" >
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
                           <div class="form-group col-md-12">
                              <button type="submit" class="btn btn-primary btn-lg btn-flat pull-right" value="insert_artikal" id="insert_artikal" name="insert_artikal">Shto</button>
                           </div>
                        </div>
                     </div>
                  </form>
               </div> <!-- box body -->
            </div> <!-- box box-primary -->
         </div> <!-- col-md-12 -->
      </div> <!-- row -->
   </section> <!-- content -->
</div> <!-- content-wrapper -->

