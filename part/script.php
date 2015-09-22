<script src="<?php echo vendor ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js" type="text/javascript"></script> -->
<script type="text/javascript">
    // $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="<?php echo vendor ?>bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script> -->
<script src="<?php echo vendor ?>plugins/morris/morris.min.js" type="text/javascript"></script>
<script src="<?php echo vendor ?>plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
<script src="<?php echo vendor ?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
<script src="<?php echo vendor ?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
<script src="<?php echo vendor ?>plugins/knob/jquery.knob.js" type="text/javascript"></script>
<script src="<?php echo vendor ?>dist/js/moment.js" type="text/javascript"></script>
<script src="<?php echo vendor ?>plugins/datetimepicker/bootstrap.datetimepicker.min.js" type="text/javascript"></script>
<script src="<?php echo vendor ?>plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="<?php echo vendor ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
<script src="<?php echo vendor ?>plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo vendor ?>plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
<script src="<?php echo vendor ?>dist/js/app.min.js" type="text/javascript"></script>
<script src="<?php echo vendor ?>dist/js/demo.js" type="text/javascript"></script>
<?php  
	if (!empty($js)) {
		echo $js;
	}
?>