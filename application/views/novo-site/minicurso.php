<?php

require 'importacoes/header.php';
require 'importacoes/menu.php';

?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<div class="row" style="margin-bottom: 0px;">
	<div class="col m12 s12 center animate fadeInLeft">
		<p class="intro brandon_t orn">MINICURSOS</p>
	</div>
</div>

<div class="row animate fadeInLeft">
	<p><small>*Clique na imagem para ampliar. <a class="blue-text" href="<?= base_url('assets/img/foldercompleto.jpg') ?>" target="_blank">CLIQUE AQUI para visualizar na íntegra.</a> </p>
	<div class="col m6 s12 center">
		<img class="folder materialboxed" src="<?= base_url('assets/img/folder1.jpg') ?>">
	</div>
	<div class="col m6 s12 center">
		<img class="folder materialboxed" src="<?= base_url('assets/img/folder2.jpg') ?>">
	</div>
</div>

<div class="row animate fadeInLeft">
	<div class="col m12 s12 center">
			<button class="prog bt_date brandon_t responsive" style="padding: 5px 10px; border-radius: 3px;" onclick="programacao('#terceiro')">13/07</button>	
	</div>
</div>

	<!-- Terceira tabela -->
	<div id="terceiro" class="animate fadeInLeft">
		<div>
			<table class="responsive-table striped tw_cent">
				<tbody>
					<tr class="hide-responsive">
						<th style="width: 20%;" class="align_center">PERÍODO</th>
						<th class="align_center">ATIVIDADE</th>
						<th style="width: 20%;" class="align_center">LOCAL</th>
					</tr>
					<tr>
						<th class="align_center brandon_n">MANHÃ<br> 
						<td>
							<b>CONFIRA OS MINICURSOS NO BANNER<b>
						</td>
						<th class="align_center"><span style="font-size: 10pt;" class="right_offset">CENTRO UNIVERSITÁRIO<br>(TOLEDO PRUDENTE)</span></th>
					</tr>
				</tbody>
			</table>
		</div>
	</div>

	<script type="text/javascript">

		$(".prog").click(function(){
			$(".prog").removeClass("mudacor")
			$(this).addClass("mudacor")
		})


		function programacao(div){
			$('#primeiro').hide();
			$('#segundo').hide();
			$('#terceiro').hide();

			$(div).fadeIn('slow');
		}

		$(document).ready(function(){
			$('.materialboxed').materialbox();
		});
	</script>	

	<?php require 'importacoes/footer.php'; ?>
