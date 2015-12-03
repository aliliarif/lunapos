
  <body class="hold-transition login-page" >
    <div class="login-box">
    	<?php if( isset($error_login)){?>
            <div class="alert alert-danger alert-dismissable col-md-12" style="">
               <button type="button" class="close" data-dismiss="alert" aria-hidden="hidden">×</button>        
               <?php echo $error_login; ?>
            </div>
            <?php }?>
    	
      <div class="login-logo">

      		
        <a ><b>pronto</b></a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        
        <form action="login_controller" method="post">
          <div class="form-group has-feedback">
            <input type="text" name="user" id="user" class="form-control" placeholder="User">
            <span class="fa fa-user form-control-feedback"></span>

          </div>
          <div class="form-group has-feedback">
            <input type="password" name="password" id="password" class="form-control" placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
                  
                </label>
              </div>
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" name="login_btn" id="login_btn" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div><!-- /.col -->
          </div>
        </form>

       


      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->




  </body>
</html>
