

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
<div id="printReportDitor" style=" margin-top:10px; display:none;">
   <div class="container">
      <div class="col-xs-12" style="text-align:center; margin-bottom:15px;">
         <p style="font-size: 17px;"><b>Report Ditor</b></p>
      </div>
      <?php 
         date_default_timezone_set('Europe/Skopje');
         $date = date ( 'd/m/Y H:i', time () );
         ?>
      <div class="col-xs-12" >
         <p style="font-size: 12px;"><b>Printoi:</b> <?php echo $this->session->userdata("user"); ?></p>
         <p style="font-size: 12px;"><b>Porositë për datë:</b> <?php echo date("d/m/Y",strtotime($date));?></p>
         <p style="font-size: 12px;"><b>Ora:</b> <?php echo " <i> prej </i>" . "<b>" . $time_from . "</b>" . " <i>deri</i> " . "<b>" .  $time_to . "</b>" ; ?></p>
      </div>
      <br>
      <div class="col-xs-12" style="text-align: center; margin-top: 10px; padding-bottom: 10px; ">
      </div>
      <!-- / end client details section -->
      <table class="table-bordered" style="width:100%;" >
         <thead>
            <tr style="background-color: #82CAC8!important; " >
               <th style="width:20px;">
                  <p>#</p>
               </th>
               <th>
                  <p>Produkti</p>
               </th>
               <th style="width:30px;">
                  <p>Sasia</p>
               </th>
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
   </div>
</div>
