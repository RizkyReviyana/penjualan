<footer>
    <center>&copy; Copy right <?php echo date('Y'); ?></center>
</footer>

<!-- jQuery -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.11.2.min.js"></script>

<!-- Materialize JS -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/materialize.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/materialize.min.js"></script>

<!-- DataTables JS -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/data-tables/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/data-tables/data-tables-script.js"></script>

<!-- Plugins JS - Specific JS codes for Plugin Settings -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins.js"></script>

<script>
    // Initialize side navigation
    $(".button-collapse").sideNav();
    
    // Close alert box on click
    $('#alert_close').click(function() {
        $("#alert_box").fadeOut("slow", function() {});
    });
</script>

</body>
</html>
