<!-- THIS SUCKS,
    MUST BE LIKE THIS !!!
    this will be called after form submit. 
    onClick on ispratnica/fakture button wont work becouse of submit
    parametrat miren prej action_controller.php dhe report_ditor_controller.php
 -->


<?php if(isset($insert_successful) && $insert_successful == 'yes'){?>
    <script>
        $(document).ready(function(){
        alert("Porosia u ruajt");
        });
    </script>
<?php
$insert_successful = 'no';
}elseif(isset($insert_successful) && $insert_successful == 'fakture') {
?>
    <script>
        $("#printThis").printThis({
        importCSS: true,
        importStyle: true
        });
    </script>
<?php
}elseif(isset($insert_successful) && $insert_successful == 'ispratnic') {
?>
    <script>
        $("#printIspratnica").printThis({
        importCSS: true,
        importStyle: true
        });
    </script>
<?php
}
?>

<!--  print report ditor -->
<?php if(isset($print_report_ditor) && $print_report_ditor == 'print'){?>
    <script>
        $("#printReportDitor").printThis({
        importCSS: true,
        importStyle: true
        });
    </script>
<?php } ?>