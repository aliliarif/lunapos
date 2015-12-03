<div class="content-wrapper">
<section class="content">
   <div class="row">
      <div class="col-md-12">
         <div class="box box-primary ">
            <div class="box-body">
               <a href="komintenti_controller?add_komintent=1" class="btn btn-primary pull-right" ><i class="fa fa-plus"></i></a>
               <h4><i class="fa fa-angle-right"></i> Bleresit</h4>
               <hr>
               <table id="artikujtTable" style="font-size: 13px; " class="table table-striped table-bordered table-hover" >
                  <thead>
                     <tr class="info">
                        <th>#</th>
                        <th>Emri</th>
                        <th>Qyteti</th>
                        <th>Tel.</th>
                        <!-- <th></th> -->
                  </thead>
                  <tbody>
                     <?php $br=0;foreach ($komintenti as $komintenti) { $br++; ?>
                     <tr>
                        <td style="width:20px;">
                           <?php echo $br;?>
                        </td>
                        <td >
                           <font style="display:none;"><?php echo $komintenti->ime_komintent; ?></font>
                           <input type="text" id="<?php echo 'name_'.$komintenti->id_komintent;?>" value='<?php echo $komintenti->ime_komintent; ?>' style="width:100%; border:none; background:none;" readonly>
                        </td>
                        <td style="width:10%;">
                           <font style="display:none;"><?php echo $komintenti->ime_grad; ?></font>
                           <input type="text" id="<?php echo 'city_'.$komintenti->id_komintent;?>" value='<?php echo $komintenti->ime_grad; ?>' style="width:100%; border:none; background:none;" readonly>
                        </td>
                        <td style="width:10%;">
                           <font style="display:none;"><?php echo $komintenti->telefon; ?></font>
                           <input type="text" id="<?php echo 'tel_'.$komintenti->id_komintent;?>" value='<?php echo $komintenti->telefon; ?>' style="width:100%; border:none; background:none;" readonly>
                        </td>
                        <!-- <td style="text-align:right; width:60px;">
                           <button  id="<?php echo $komintenti->id_komintent;?>" class="btn btn-primary btn-xs" onClick="customersAction(this.id);"><i   class="fa fa-pencil" ></i></button>
                           <button id="<?php echo "cancel_".$komintenti->id_komintent;?>" class="btn btn-danger btn-xs"><i id="test" class="fa fa-trash-o "></i></button>
                        </td> -->
                     </tr>
                     <?php } ?>
                  </tbody>
                  <input type="hidden" id="max_customers" name="max_customers" value="<?php echo $br;?>">
               </table>
            </div>
         </div>
      </div>
</section>
</div>