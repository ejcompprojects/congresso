<div class="col-sm-12">
	<p style="font-size:14pt;" class="back-link">Desenvolvido por <a href="http://ejcomp.com.br" target="_blank">EJComp</a></p>

	<p class="back-link">Template by <a href="https://www.medialoot.com">Medialoot</a></p>
</div>
</div><!--/.row-->
</div>	<!--/.main-->


<script src="<?= base_url('/assets/painel/') ?>js/jquery-1.11.1.min.js"></script>
<script src="<?= base_url('/assets/painel/') ?>js/bootstrap.min.js"></script>
<script src="<?= base_url('/assets/painel/') ?>js/chart.min.js"></script>
<script src="<?= base_url('/assets/painel/') ?>js/chart-data.js"></script>
<script src="<?= base_url('/assets/painel/') ?>js/easypiechart.js"></script>
<script src="<?= base_url('/assets/painel/') ?>js/easypiechart-data.js"></script>
<script src="<?= base_url('/assets/painel/') ?>js/bootstrap-datepicker.js"></script>

<script type="text/javascript">


	!function ($) {
		$(document).on("click","ul.nav li.parent > a ", function(){          
			$(this).find('em').toggleClass("fa-minus");      
		}); 
		$(".sidebar span.icon").find('em:first').addClass("fa-plus");
	}

	(window.jQuery);
	$(window).on('resize', function () {
		if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
	})
	$(window).on('resize', function () {
		if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
	})

	$(document).on('click', '.panel-heading span.clickable', function(e){
		var $this = $(this);
		if(!$this.hasClass('panel-collapsed')) {
			$this.parents('.panel').find('.panel-body').slideUp();
			$this.addClass('panel-collapsed');
			$this.find('em').removeClass('fa-toggle-up').addClass('fa-toggle-down');
		} else {
			$this.parents('.panel').find('.panel-body').slideDown();
			$this.removeClass('panel-collapsed');
			$this.find('em').removeClass('fa-toggle-down').addClass('fa-toggle-up');
		}
	})

</script>


</body>
</html>