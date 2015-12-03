<body class="hold-transition skin-blue sidebar-collapse sidebar-mini">
   <!-- Site wrapper -->
   <div class="wrapper">
   <header class="main-header">
      <!-- Logo -->
      <a href="/pronto" class="logo">
         <!-- mini logo for sidebar mini 50x50 pixels -->
         <span class="logo-mini"><font style="font-size:15px;">pro</font><font style="font-size:15px;">nto</font></span>
         <!-- logo for regular state and mobile devices -->
         <span class="logo-lg">pronto</span>
      </a>
      <nav class="navbar navbar-static-top" role="navigation">
         <a href="login" class="sidebar-toggle" data-toggle="offcanvas" role="button">
         <span class="sr-only">Toggle navigation</span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         </a>
         <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
               <!-- User Account: style can be found in dropdown.less -->
               <li class="dropdown user user-menu">
                  <a  class="dropdown-toggle" data-toggle="dropdown">
                  <span class="hidden-xs"><?php echo $this->session->userdata("username"); ?></span>
                  </a>
               </li>
               <li>
                  <a href="login_controller?logout=1" ><i class="fa fa-power-off"></i></a>
               </li>
            </ul>
         </div>
      </nav>
   </header>
   <aside class="main-sidebar">
      <section class="sidebar">
         <ul class="sidebar-menu">
            <li <?php if(strpos(current_url(), "index_controller") || strpos(current_url(), "login_controller") || strpos(current_url(), "action_controller")){ ?> class="active" <?php } ?> >
               <a href="index_controller">
               <i class="fa fa-shopping-cart"></i>
               <span>Porosia</span>
               </a>
            </li>
            <?php if($this->session->userdata("admin") == 1){?>
            <!-- <li <?php if(strpos(current_url(), "historia_controller")){ ?> class="active" <?php } ?> >
               <a href="historia_controller?historia=1">
               <i class="fa fa-table"></i></i> <span>Historia</span>
               </a>
            </li> -->
            <li <?php if(strpos(current_url(), "izlezi")){ ?> class="active" <?php } ?> >
               <a href="izlezi_controller">
               <i class="glyphicon glyphicon-log-out"></i></i> <span>Dalje</span>
               </a>
            </li>
            <li <?php if(strpos(current_url(), "vlezovi")){ ?> class="active" <?php } ?> >
               <a href="vlezovi_controller">
               <i class="glyphicon glyphicon-log-in"></i></i> <span>Hyrje</span>
               </a>
            </li>
            <li <?php if(strpos(current_url(), "magazin_controller")){ ?> class="active" <?php } ?> >
               <a href="magazin_controller">
               <i class="fa fa-codepen"></i></i> <span>Magazin</span>
               </a>
            </li>
            <!-- <li <?php if(strpos(current_url(), "report_ditor_controller")){ ?> class="active" <?php } ?> >
               <a href="report_ditor_controller">
               <i class="fa fa-file-text-o"></i></i> <span>Raport Ditor</span>
               </a>
            </li> -->
            <li <?php if(strpos(current_url(), "artikli_controller") || strpos(current_url(), "komintenti_controller") || strpos(current_url(), "users_controller") ){ ?> class="treeview active" <?php }else{ ?> class="treeview" <?php } ?> > 
               <a href="#">
               <i class="fa fa-cogs"></i></i> <span>Settings</span>
               <i class="fa fa-angle-left pull-right"></i>
               </a>
               <ul class="treeview-menu">
                  <li><a href="artikli_controller">Artikujt</a></li>
                  <li><a href="komintenti_controller">Blerësit</a></li>
                  <li><a href="users_controller">Users</a></li>
               </ul>
            </li>
            <?php }?>
         </ul>
      </section>
   </aside>