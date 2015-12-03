<div class="content-wrapper">
   <section class="content">
      <div class="row">
         <div class="col-md-12">
            <div class="box box-primary" style="height:750px;" >
               <div class="box-header">
                  <h4><i class="fa fa-angle-right"></i> Shto blerës</h4>
                  <hr>
               </div>
               <div class="box-body">
                  <form action="komintenti_controller" id="komintenti_form" method="post"  id="productForm" autocomplete="off">
                    <div class="row">
                        <div class="col-md-6">  
                           <!-- FORM VALIDATION  -->
                           <?php if(validation_errors()){?>
                              <div class="alert alert-danger alert-dismissable col-md-12" >
                                 <button type="button" class="close" data-dismiss="alert" aria-hidden="hidden">×</button>        
                                 <?php echo validation_errors(); ?>
                              </div>
                           <?php }?>
                           <?php if(isset($success_komintent)){?>
                              <div class="alert alert-success alert-dismissable col-md-12 success_div">
                                 <button type="button" class="close" data-dismiss="alert" aria-hidden="hidden">×</button>        
                                 <?php echo $success_komintent; ?>
                              </div>
                           <?php }?>
                           <!-- FORM VALIDATION END -->

                           <div class="form-group col-md-12">
                              <label>Emri: <font style="color:red;">*</font></label>
                              <input type="text" class="form-control" name="ime_komintent" id="ime_komintent" autofocus>
                           </div>
                           <div class="form-group col-md-12">
                              <label>Qyteti: <font style="color:red;">*</font></label>
                              <select type="text" class="form-control" name="grad_komintent" id="grad_komintent">
                                 <?php foreach($gradovi as $grad){?>
                                 <option value="<?php echo $grad->id_grad;?>"><?php echo $grad->ime_grad;?></option>
                                 <?php }?>
                              </select>
                           </div>
                           <div class="form-group col-md-12">
                              <label>Tel: </label>
                              <div class="input-group">   
                                 <input type="text" class="form-control decimalOnly" name="tel_komintent" id="tel_komintent" value="<?php if(validation_errors()){echo set_value('tel_komintent');} ?>">
                                 <div class="input-group-addon">
                                    <i class="fa fa-phone"></i>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group col-md-12">
                              <button type="submit" class="btn btn-primary btn-lg btn-flat pull-right"  value="insert_komintent" name="insert_komintent" id="insert_komintent">Shto</button>
                           </div>
                        </div>
                     </div>
                  </form>   
               </div>
            </div>
         </div>
   </section>
</div>
