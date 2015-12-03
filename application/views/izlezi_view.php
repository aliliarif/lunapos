<div class="content-wrapper">
   <section class="content">
      <!-- LATER -->
         <!-- <form method="POST" action="">
            <div class="row">
               <div class="form-group col-xs-3">
                  <label for="fakture_nga" >Nga:</label>
                  <select class="form-control combobox input-sm" id="fakture_nga" name="fakture_nga">
                     <option value=""></option>
                     <?php foreach($komintenti as $komi){ ?>
                           <option value="<?php echo $komi->id_komintent;?>"><?php echo $komi->ime_komintent;?></option>
                     <?php }?>
                  </select>
               </div>
               <div class="form-group col-xs-1">
                  <label for="fakture_data" >Prej:</label>
                  <input id="fakture_data" name="fakture_data" class="form-control input-group-lg datepicker input-sm" type="text" />
               </div>
               <div class="form-group col-xs-1">
                  <label for="fakture_data" >Deri:</label>
                  <input id="fakture_data" name="fakture_data" class="form-control input-group-lg datepicker input-sm" type="text" />
               </div> 
               <div class="col-lg-1" style="margin-top: 24px; ">
                  <button type="submit" name="kontrollo_kontroll_ditor" class="btn btn-success btn-sm" >Kontrollo</button>
               </div>
            </div>
      </form> -->
      <div class="row">
         <div class="col-md-12">
            <div class="box box-primary ">
               <div class="box-body">
                  <!-- Date dd/mm/yyyy -->
                     <table id="izlezi_table" class="table table-striped table-hover table-bordered nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Nr. fakturës</th>
                            <th>Data</th>
                            <th>Per</th>
                            <th>Totali</th>
                            <!-- <th style="width:20px;">E paguar</th> -->
                            <!-- <th style="width:20px;"></th> -->
                        </tr>
                    </thead>
                </table>
               </div>
           </div>
       </div>
   </section>
</div>

<!-- MODAL PAY FAKUTRA -->
<div class="modal" id="pay_fakt_modal" role="dialog" aria-labelledby="gridSystemModalLabel" data-backdrop="static">
   <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#3C8DBC; color:white;">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="gridSystemModalLabel">Konfirmo pagesën</h4>
        </div>
        <form action="vlezovi_controller" method="POST">
            <div class="modal-body">
               <label>Paguaj fakturën?</label>
               <!-- hidden input to save sifra_artikal for update -->
               <input type="hidden" id="vl_fakt_br" name="vl_fakt_br">
               <input type="hidden" id="vl_id_komintent" name="vl_id_komintent">
            </div>
            <div class="modal-footer">
               <button type="submit" id="pay_fakt" name="pay_fakt" value="pay_fakt" class="btn btn-success">Paguaj</button>
         </div>
        </form>
      </div>
   </div>
</div>
<!-- MODAL PAY FAKUTRA END-->