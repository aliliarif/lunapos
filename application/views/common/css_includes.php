<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Pronto</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url();?>plugins/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link href="<?php echo base_url();?>plugins/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url();?>dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url();?>dist/css/skins/_all-skins.min.css">
    <!-- BOOTSTRP-COMBOBOX CSS -->
    <link href="<?php echo base_url();?>plugins/bootstrapcombobox/css/bootstrap-combobox.css" rel="stylesheet" />
    <!-- Data tables CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>dist/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>dist/css/responsive.bootstrap.min.CSS">
   
    <!-- <link href="<?php echo base_url();?>dist/css/jquery.dataTables.min.css" rel="stylesheet" /> -->
    <!-- BOOTSTRP DATEPICKER CSS -->
    <link href="<?php echo base_url();?>plugins/datepicker/datepicker3.css" rel="stylesheet" />
    <!-- BOOTSTRP TIMEPICKER CSS -->
    <link href="<?php echo base_url();?>plugins/timepicker/bootstrap-timepicker.css" rel="stylesheet" />

    <style type="text/css">
        /* le gjindet .. */
        .input-xs {
            height: 22px;
            padding: 2px 5px;
            font-size: 12px;
            line-height: 1.5; 
            border-radius: 3px;
        }

        /* CSS FOR EXTEND ROW IN DATATABES == USED IN hyrje_view.php  + and - img */
        td.details-control {
            background: url('<?php echo base_url();?>common/images/details_open.png') 
            no-repeat center center;
            cursor: pointer;
        }
        tr.shown td.details-control {
            background: url('<?php echo base_url();?>common/images/details_close.png') 
            no-repeat center center;
        }

        /* datepicker -- without this datepicker will be behind modal */
        .datepicker {z-index: 1151 !important;}

    </style>
  </head>
   <!-- ADD THE CLASS sidedar-collapse TO HIDE THE SIDEBAR PRIOR TO LOADING THE SITE -->
   