	<!-- begin scroll to top btn -->
	<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
	<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->

	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="<?php echo base_url('assets/'); ?>plugins/webshim-1.16.0/polyfiller.js"></script>
	<script src="<?php echo base_url('assets/'); ?>plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script src="<?php echo base_url('assets/'); ?>plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="<?php echo base_url('assets/'); ?>plugins/jquery-cookie/jquery.cookie.js"></script>
	<script src="<?php echo base_url('assets/'); ?>js/dashboard-v2.min.js"></script>
	<script src="<?php echo base_url('assets/'); ?>js/apps.min.js"></script>
	<script src="<?php echo base_url('assets/'); ?>plugins/select2/dist/js/select2.min.js"></script>
	<script src="<?php echo base_url('assets/'); ?>plugins/jstree/dist/jstree.min.js"></script>
	<script src="<?php echo base_url('assets/'); ?>plugins/parsley/js/parsley.js"></script>
	<script src="<?php echo base_url('assets/'); ?>plugins/bootstrap-wizard/js/bwizard.js"></script>
	<script src="<?php echo base_url('assets/'); ?>js/form-wizards-validation.demo.min.js"></script>
	<script src="<?php echo base_url('assets/'); ?>plugins/bootstrap-select/bootstrap-select.min.js"></script>
	<script src="<?php echo base_url('assets/'); ?>plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
	<script src="<?php echo base_url('assets/'); ?>plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.js"></script>
	<script src="<?php echo base_url('assets/'); ?>plugins/jquery-tag-it/js/tag-it.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	<script type="text/javascript">
		$('.select2').select2();
	</script>
	<script>
		$(document).ready(function() {
			App.init();
			DashboardV2.init();
			FormWizardValidation.init();
		});
		$("#jquery-tagIt-primary").val()
	</script>
	<script>
		(function(i, s, o, g, r, a, m) {
			i['GoogleAnalyticsObject'] = r;
			i[r] = i[r] || function() {
				(i[r].q = i[r].q || []).push(arguments)
			}, i[r].l = 1 * new Date();
			a = s.createElement(o),
				m = s.getElementsByTagName(o)[0];
			a.async = 1;
			a.src = g;
			m.parentNode.insertBefore(a, m)
		})(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

		ga('create', 'UA-53034621-1', 'auto');
		ga('send', 'pageview');
	</script>
	<script>
		function onlyNumberKey(evt) {
			var theUjian = evt || window.event;

			// Handle paste
			if (theUjian.type === 'paste') {
				key = event.clipboardData.getData('text/plain');
			} else {
				// Handle key press
				var key = theUjian.keyCode || theUjian.which;
				key = String.fromCharCode(key);
			}
			var regex = /[0-9]|\./;
			if (!regex.test(key)) {
				theUjian.returnValue = false;
				if (theUjian.preventDefault) theUjian.preventDefault();
			}
		}
	</script>
	<script type="text/javascript">
		webshims.setOptions('forms-ext', {
			replaceUI: {
				'number': 'auto'
			},
			widgets: {
				startView: 2,
				openOnMouseFocus: true,
				stepfactor: 1
			}
		});
		webshim.polyfill("forms forms-ext");
	</script>
	</body>

	</html>