<div class="content-wrapper">
   <section class="content">
      <div class="row">
         <div class="col-md-6">
            <div class="box box-primary mypanel-height">
               <div class="box-body">
                  <div class="form-group ">
                     <label>Blerësi:</label>
                     <div class="col-xs-12 input-group" >
                        <select class="form-control combobox" name="bleresi" id="bleresi">
                           <option value=""></option>
                           <?php foreach($komintenti as $komintenti){ ?>
                              <option value="<?php echo $komintenti->id_komintent;?>"><?php echo $komintenti->ime_komintent;?></option>
                           <?php }?>
                        </select>
                     </div>
                  </div>
                  <div class="form-group"  id="prodDiv">
                     <label>Produkti:</label>
                     <div class="col-xs-12 input-group ">
                        <select class="form-control combobox " name="produkti" id="produkti">
                           <option value=""></option>
                           <?php foreach($artikli as $artikli){ ?>
                              <option value="<?php echo $artikli->sifra_artikal;?>" data-price="<?php echo $artikli->prodazna_cena; ?>"><?php echo $artikli->interna_sifra . " - " . $artikli->naziv_artikal;?></option>
                           <?php }?>
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <label>Sasia:</label>
                     <div class="input-group">
                        <input type="number" min="1" class="form-control" name="sasija" id="sasija" />
                        <span class="input-group-addon">njësi</span>
                     </div>
                  </div>
                  <div class="form-group">
                     <label>Çmimi për njësi:</label>
                     <div class="input-group">
                        <input type="number" min="1" class="form-control" name="cmimi_inp" id="cmimi_inp" />
                        <span class="input-group-addon">den</span>
                     </div>
                  </div>
                  <div class="form-group">
                     <label>Zbritje:</label>
                     <div class="input-group">
                        <div class="input-group-addon">
                           <input type="checkbox" name="checkbox_zbritje" id="checkbox_zbritje" value="value" onChange="document.getElementById('zbritje').disabled = !this.checked;">
                        </div>
                        <input type="number" min="1" class="form-control" name="zbritje" id="zbritje" disabled/>
                        <span class="input-group-addon">%</span>
                     </div>
                  </div>
                  <div class="form-group">
                     <button type="button" id="add_article_btn" name="add_article_btn" class="btn btn-primary btn-lg btn-flat  pull-right" ><i class="fa fa-arrow-right"></i></button>
                  </div>
               </div>
            </div>
         </div>
         <form id="action_form" method="post" action="action_controller">
            <div class="col-md-6">
               <div class="box box-primary mypanel-height">
                  <div class="box-body">
                     <table class="table" id="llogaria_table">
                        <thead>
                           <tr>
                              <th style="width:1%;">#</th>
                              <th style="width:80%;">Produkti</th>
                              <th style="width:9%;">Sasia</th>
                              <th style="width:5%;">Cmimi</th>
                              <th style="width:5%; text-align:right;"><a href="http://localhost:81/pronto/index_controller">X</a></th>
                           </tr>
                        </thead>
                        <tbody>
                        </tbody>
                     </table>
                     <div class="box box-success col-lg-6" style="-webkit-box-shadow: 0 0px 0px rgba(0, 0, 0, 0); bottom: 0; width:97%; height:30px; position: absolute;">
                        <b style="font-size: 25px; ">Totali:</b>
                        <input  type="text" value="0" id="totali" name="totali" style="float:right; padding-right:35px; clear:both; text-align:right; font-size: 25px; border:none; background:none" readonly>   
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-12">
               <div class="box box-widget">
                  <div class="box-body">
                     <div class="col-xs-3">
                        <button type="submit" class="btn bg-olive btn-flat margin btn-lg btn-block" name="fiskale_btn" id="fiskale_btn" form="action_form" >
                        <i class="glyphicon glyphicon-print"></i> &nbsp;&nbsp;Fiskale </button>
                     </div>
                     <div class="col-xs-1">
                        <button type="button" id="fiskalni_izvestai_btn" name="fiskalni_izvestai_btn" class="btn bg-olive btn-flat margin btn-lg btn-block"  data-toggle="modal" data-target="#fiskalni_izvestai">
                        <i class="glyphicon glyphicon-th-list"></i>  </button>
                     </div>
                     <div class="col-xs-4">
                        <button type="submit" class="btn bg-olive btn-flat margin btn-lg btn-block" name="ispratnic_btn" id="ispratnic_btn" form="action_form">
                        <i class="fa fa-file-text-o"></i> </span> &nbsp;&nbsp;Fletedergese </button>                                
                     </div>
                     <div class="col-xs-4">
                        <button type=submit class="btn bg-olive btn-flat margin btn-lg btn-block" name="fakture_btn" id="fakture_btn"  form="action_form">
                        <i class="fa fa-file-text-o"></i> &nbsp;&nbsp;Fakture </button>
                     </div>
                     <!-- <div class="col-xs-3">
                        <button type="submit" class="btn bg-olive btn-flat margin btn-lg btn-block" name="ruaj_btn" id="ruaj_btn" form="action_form" disabled>
                        <i class="glyphicon glyphicon-ok"></i> &nbsp;&nbsp;Ruaj </button>
                     </div> -->
                  </div>
               </div>
            </div>
            <input type="hidden" id="nr_porosive" name="nr_porosive" value="">
         </form>
      </div>
   </section>
</div>

<!-- MODAL NEDOSTATOK ZALIHA -->

<div id="modal_nedostatokZaliha" class="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="color:white; background-color:#DD4B39;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Mungesë në magazin!</h4>
      </div>
      <div class="modal-body">
        <span id="span_nedostatok_zaliha" style="font-size:16px;"></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn bg-olive btn-flat" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>

<!-- MODAL NEDOSTATOK ZALIHA END-->

<!-- GLAVEN modal izvestai fiskalna -->

<div id="fiskalni_izvestai" class="modal" tabindex="-1"  role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#3C8DBC; color:white;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Raporte fiskale</h4>
      </div>
      <div class="modal-body">
         <div class="row">
            <form action="raport_fiskal_controller" method="POST">
               <div class="col-md-12">
                  <button type="submit" id="raport_pa" name="raport_pa" value="raport_pa" class="btn bg-olive btn-block">Raport pa mbyllje ditore</button>
               </div>

               <div class="col-md-6" style="margin-top:10px; margin-bottom:10px;">
                  <button type="button" id="hyrje_zyrtare_btn" name="hyrje_zyrtare_btn" class="btn btn-default btn-block" data-toggle="modal" data-target="#hyrje_zyrtare_modal">Hyrje Zyrtare</button>
               </div>
               <div class="col-md-6" style="margin-top:10px; margin-bottom:10px;">
                  <button type="button" id="dalje_zyrtare_btn" name="dalje_zyrtare_btn" class="btn btn-default btn-block" data-toggle="modal" data-target="#dalje_zyrtare_modal">Dalje Zyrtare</button>
               </div>

               <div class="col-md-6">
                  <button type="button" id="raport_shkurt_btn" name="raport_shkurt_btn" class="btn btn-default btn-block" data-toggle="modal" data-target="#raport_shkurte_modal">Raport i shkurtë</button>
               </div>
               <div class="col-md-6">
                  <button type="button" id="raport_detal_btn" name="raport_detal_btn" class="btn btn-default btn-block" data-toggle="modal" data-target="#raport_detal_modal">Raport Detal</button>
               </div>

               <div class="col-md-12" style="margin-top:10px; margin-bottom:10px;">
                  <button type="submit" id="mbyllje_me" name="mbyllje_me" value="mbyllje_me" class="btn btn-danger btn-block" >Raport me mbyllje ditore</button>
               </div>
            </form>
         </div>
      </div>
    </div>
  </div>
</div>

<!-- GLAVEN modal fiskalni izvestai end -->

<!-- Hyrje zyrtare MODAL -->

<div class="modal" id="hyrje_zyrtare_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#3C8DBC; color:white;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Hyrje zyrtare</h4>
      </div>
      <form action="raport_fiskal_controller" method="post" class="form-inline" role="form">
         <div class="modal-body">
            <div class="form-group">
               <label for="suma_hyrje">Suma:</label>
               <input type="text" id="suma_hyrje" name="suma_hyrje" class="form-control" style="text-align:right; margin-left:65px;" autofocus>
            </div>
         </div>
         <div class="modal-footer">
            <button type="submit" id="hyrje_zyrtare" name="hyrje_zyrtare" value="hyrje_zyrtare" class="btn btn-success btn-flat ">Ok</button>
         </div>
      </form>
    </div>
  </div>
</div>

<!-- Hyrje zyrtare MODAL END -->

<!-- Dalje zyrtare MODAL -->

<div class="modal" id="dalje_zyrtare_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#3C8DBC; color:white;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Dalje zyrtare</h4>
      </div> 
         <form action="raport_fiskal_controller" method="post" class="form-inline" role="form">
            <div class="modal-body">  
               <div class="form-group">
                  <label for="suma_dalje">Suma:</label>
                  <input type="text" id="suma_dalje" name="suma_dalje" class="form-control" style="text-align:right; margin-left:65px;" autofocus>
               </div>
            </div>
            <div class="modal-footer">
               <button type="submit" id="dalje_zyrtare" name="dalje_zyrtare" value="dalje_zyrtare" class="btn btn-success btn-flat ">Ok</button>
            </div>
         </form>
      </div>
   </div>
</div>

<!-- Dalje zyrtare MODAL END -->

<!-- Raport i shkurte MODAL -->

<div class="modal" id="raport_shkurte_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
         <div class="modal-header" style="background-color:#3C8DBC; color:white;">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Raport i shkurtë</h4>
         </div>
         <form action="raport_fiskal_controller" method="post" role="form">
            <div class="modal-body">
               <div class="form-group">
                  <label for="email">Prej:</label>
                  <input type="text" id="date_start_shkurt" name="date_start_shkurt" class="datepicker form-control" >
               </div>
               <div class="form-group">
                  <label for="pwd">Deri:</label>
                  <input type="text" id="date_end_shkurt" name="date_end_shkurt" class="datepicker form-control">
               </div>
               <div class="modal-footer">
                  <button type="submit" id="raport_shkurt" name="raport_shkurt" value="raport_shkurt" class="btn btn-success btn-flat ">Ok</button>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>

<!-- Raport i shkurte MODAL END -->

<!-- Raport detal MODAL -->

<div class="modal" id="raport_detal_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#3C8DBC; color:white;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Raport i detal</h4>
      </div>
      <form action="raport_fiskal_controller" method="post" role="form">
         <div class="modal-body">
            <div class="form-group">
               <label for="email">Prej:</label>
               <input type="text" id="date_start_detal" name="date_start_detal" class="datepicker form-control" >
            </div>
             <div class="form-group">
               <label for="pwd">Deri:</label>
               <input type="text" id="date_end_detal" name="date_end_detal" class="datepicker form-control">
            </div>
            <div class="modal-footer">
               <button type="submit" id="raport_detal" name="raport_detal" value="raport_detal" class="btn btn-success btn-flat ">Ok</button>
            </div>
         </div>
      </form>
   </div>
</div>


<!-- Raport detal MODAL END -->