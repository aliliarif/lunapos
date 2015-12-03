<div class="content-wrapper">
<section class="content">
   <form method="POST" action="">
      <div class="row">
         <div class="col-lg-2 col-sm-2">
            <div class="input-group">
               <input type="text" class="form-control datepicker" id="datepicker" name="datepicker"  <?php if (isset($date)) { ?> value="<?php echo $date;?>" <?php } ?>> 
               <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>
         </div>
         <div class="col-lg-2 col-sm-2">
            <div class="input-group bootstrap-timepicker timepicker">
               <span class="input-group-addon">Prej:</span>
               <input type="text" class="form-control " id="timepickerFrom" name="timepickerFrom" <?php if (isset($time_from)) { ?> value="<?php echo $time_from;?>" <?php } ?> >
               <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
            </div>
         </div>
         
         <div class="col-lg-2 col-sm-2">
            <div class="input-group bootstrap-timepicker timepicker">
               <span class="input-group-addon">Deri:</span>
               <input type="text" class="form-control " id="timepickerTo" name="timepickerTo" <?php if (isset($time_to)) { ?> value="<?php echo $time_to;?>" <?php } ?> >
               <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
            </div>
         </div>
         <div class="col-lg-1" style="padding-bottom: 20px; ">
            <button type="submit" name="kontrollo_kontroll_ditor" class="btn btn-success" >Kontrollo</button>
         </div>
         <div class="col-lg-5" style="padding-bottom: 20px;">
            <button type="submit" class="btn btn-info pull-right" name="report_ditor_print" id="report_ditor_print"><i class="fa fa-print"></i> &nbsp;&nbsp;Print</button>
         </div>
      </div>
   </form>
   <div class="row">
      <div class="col-md-12">
         <div class="box box-primary mypanel-height">
            <div class="box-body">
               <!-- Date dd/mm/yyyy -->
               <table style="font-size: 13px;" class="table table-striped table-hover table-bordered" id="header-fixed">
                  <thead>
                     <tr class="info">
                        <th style="width:30px;">#</th>
                        <th>Produkti</th>
                        <th style="width:30px;">Sasia</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php if(isset($report_ditor)){?>
                        <?php $br=0; foreach($report_ditor as $rep_ditor){ $br++; ?>
                           <tr>
                              <td><?php echo $br; ?></td>
                              <td><?php echo $rep_ditor->name_product; ?></td>
                              <td style="text-align:center;"><?php echo $rep_ditor->orders_total; ?></td>
                           </tr>
                     <?php 
                        }
                     } 
                     ?>
                  </tbody>
               </table>
               <!-- /.form group -->
            </div>
            <!-- /.box-body -->
         </div>
         <!-- /.box -->
      </div>
      <!-- /.col (left) -->
      <!-- /.row -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper