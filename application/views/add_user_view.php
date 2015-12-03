<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
            <div class="box box-primary" style="height:750px;" >
                <div class="box-header">
                    <h4><i class="fa fa-angle-right"></i> Shto përdorues</h4>
                    <hr>
                </div>
                <div class="box-body">
                    <form action="users_controller" id="users_form" method="post" autocomplete="off" autocomplete="off">
                        <div class="row">
                            <div class="col-md-6">  
                                <!-- FORM VALIDATION  -->
                                <?php if(validation_errors()){?>
                                    <div class="alert alert-danger alert-dismissable col-md-12" >
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="hidden">×</button>        
                                        <?php echo validation_errors(); ?>
                                    </div>
                                <?php }?>
                                <?php if(isset($success_user)){?>
                                    <div class="alert alert-success alert-dismissable col-md-12 success_div">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="hidden">×</button>        
                                        <?php echo $success_user; ?>
                                    </div>
                                <?php }?>
                                <!-- FORM VALIDATION END -->

                                <div class="form-group col-md-12">
                                    <label>Username: <font style="color:red;">*</font></label>
                                    <input type="text" class="form-control" name="name_user" id="name_user" autofocus>
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Password: <font style="color:red;">*</font></label>
                                    <input type="text" class="form-control" name="password" id="password">
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Admin &nbsp;&nbsp;&nbsp; &nbsp;</label>
                                    <input type="checkbox" value="" id="admin" name="admin">
                                </div><!-- /.form group -->
                                <div class="form-group col-md-12">
                                    <button type="submit" class="btn btn-primary btn-lg btn-flat pull-right" value="insert_user" name="insert_user" id="insert_user">Shto</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
