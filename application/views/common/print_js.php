<!-- THIS SUCKS,
    MUST BE LIKE THIS
    this will be like JS file
    onClick on ispratnica/fakture button wont work becouse of submit
    parametrat miren prej action_controller.php dhe report_ditor_controller.php
 -->

<?php if(isset($tip_plakanje) && $tip_plakanje == 'ruaj'){?>
    <script>
        $(document).ready(function(){
        alert("Porosia u ruajt");
        });
    </script>
<?php
$insert_successful = 'no';
}elseif(isset($tip_plakanje) && $tip_plakanje == 'fakture') {
?>
    <script>
        $("#printThis").printThis({
            importCSS: true,
            importStyle: true
        });
    </script>
<?php
}elseif(isset($tip_plakanje) && $tip_plakanje == 'ispratnic') {
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

<!--  print report ditor 
<?php if(isset($print_kalkulacija) && $print_kalkulacija == 'faktura'){?>
    <script>
        $("#printKalkulacija").printThis({
            importCSS: true,
            importStyle: true
        });
    </script>
<?php } ?>-->