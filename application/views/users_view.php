<div class="content-wrapper">
<section class="content">
   <div class="row">
      <div class="col-md-12">
         <div class="box box-primary">
            <div class="box-body">
               <a href="users_controller?add_user=1" class="btn btn-primary pull-right" ><i class="fa fa-plus "></i></a>
               <h4><i class="fa fa-angle-right"></i> Users</h4>
               <hr>
               <table id="artikujtTable" style="font-size: 13px;" class="table table-striped table-hover table-bordered" id="header-fixed">
                  <thead>
                     <tr class="info">
                        <th>#</th>
                        <th>Emri</th>
                        <th>Password</th>
                        <th>Admin</th>
                        <!-- <th></th> -->
                  </thead>
                  <tbody>
                     <form action="kotekot" method="post">
                        <?php $br=0;foreach ($users as $user) { $br++; ?>
                        <tr>
                           <td style="width:20px;">
                              <?php echo $br;?>
                           </td>
                           <td>
                              <font style="display:none;"><?php echo $user->name_user; ?></font>
                              <input type="text" id="<?php echo 'user_'.$user->id_user;?>" value='<?php echo $user->name_user; ?>' style="width:100%; border:none; background:none;" readonly>
                           </td>
                           <td style="text-align:right; width:120px;">
                              <font style="display:none;"><?php echo $user->password; ?></font>
                              <input type="text" id="<?php echo 'password_'.$user->id_user;?>" value='<?php echo $user->password; ?>' style="width:100%; text-align:right; border:none; background:none;" readonly>
                           </td>
                            <td style="text-align:right; width:120px;">
                              <font style="display:none;"><?php echo $user->admin; ?></font>
                              <input type="text" id="<?php echo 'admin_'.$user->id_user;?>" value='<?php echo $user->admin; ?>' style="width:100%; text-align:right; border:none; background:none;" readonly>
                           </td>
                           <!-- <td style="text-align:right; width:30px;">
                              <button  id="<?php echo $user->id_user;?>" class="btn btn-primary btn-xs" onClick="usersAction(this.id);"><i   class="fa fa-pencil" ></i></button>
                           </td> -->
                        </tr>
                        <?php } ?>
                     </form>
                  </tbody>
                  <input type="hidden" id="max_user" name="max_user" value="<?php echo $br;?>">
               </table>
            </div>
         </div>
      </div>
   </section>
</div>
