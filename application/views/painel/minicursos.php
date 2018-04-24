<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="<?= base_url('Painel') ?>">
				<em class="fa fa-home"></em>
			</a></li>
			<li class="active">Minicursos</li>
		</ol>
	</div><!--/.row-->

	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Minicursos</h1>
			<?=$mensagens?>
		</div>
	</div><!--/.row-->
	<?php if(count($minicurso) == 0){
		echo '<h2>Será liberado em breve a escolha para os minicursos.</h2>';
	} ?>

	<?php foreach ($minicurso as $minicurso) { ?>
	<div class='content'>
		<div class='col-lg-12'>
			<div class='panel'>
				<div class='panel-body'>
					<h3>Minicurso: "<?=$minicurso->nome?>"</h3>
					<h4><?=date('d/m/Y ', strtotime($minicurso->dia));echo $minicurso->horario_inicio = date('H:i', strtotime($minicurso->horario_inicio));
					echo "-".$minicurso->horario_fim = date('H:i', strtotime($minicurso->horario_fim))?></h4>
					<br><br>
					<div class='col-lg-6'>
						<label>Convidado: <?=$minicurso->convidado?></label>
					</div>
					<div class='col-lg-6'>
						<label for='nome'>Vagas Restantes: <?=$minicurso->vagasRestantes?></label> 
					</div>
					<div class='col-lg-12'><br></div>
					<div class='col-lg-12'>
						<label for='celular'>Descrição: <?=$minicurso->descricao?></label>
					</div>
					<div class='form-group'>

					</div>
					<div class='col-lg-12'><br></div>
					<div class='col-lg-12'>
						<button 
						<?php if(minicursoInArray($meusMinicursos, $minicurso->id)){
							$buttonName = "Inscrito";
							$target = "";
							$disable = "disabled";
						}
						else{
							$buttonName = "Inscrever-se";
							$target = "#modalInscrever";
							$disable = "";
						}
						?>
						data-toggle     ="modal"
						data-id         ="<?=$minicurso->id?>"
						data-dia        ="<?=str_replace('/','-',$minicurso->dia)?>"
						class           ="btn btn-primary <?=$disable?>"
						data-target     = "<?=$target?>"


						<? } ?>
						<?=$buttonName ?>
					</button>
				</div>
			</div>
		</div>

	</div>

	<?php } ?>

	<div class="modal fade in" id="modalInscrever" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="exampleModalLabel">Inscrição no Minicurso</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<p>Tem certeza que deseja se inscrever no minicurso?</p>
					</div>
				</div>
				<div class="modal-footer">
					<a href="" id="linkInscrever" class="btn btn-round btn-theme">Inscrever-se </a>
					<button type="button" class="btn btn-round btn-secundary" data-dismiss="modal"> Fechar </button>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="<?= base_url('assets/js/jquery-3.3.1.js') ?>"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function () {
			function fechaDivMessage(){
				$('#message').fadeOut('slow');
			} 


			$('#modalInscrever').on('show.bs.modal', function (event) {
      			var button  = $(event.relatedTarget) // Button that triggered the modal
      			var id      = button.data('id') 
      			var dia     = button.data('dia')// Extract info from data-* attributes
      			var link    = "<?=base_url('Painel/minicursoInscrever/')?>"+id
      			var modal = $(this)
      			modal.find('#linkInscrever').attr("href", link);
      		})
		/*$('#modalDesinscrever').on('show.bs.modal', function (event) {
      			var button  = $(event.relatedTarget) // Button that triggered the modal
      			var id      = button.data('id') // Extract info from data-* attributes
      			var link    = "<?=base_url('Painel/minicursoDesinscrever/')?>" + id
      			var modal = $(this)
      			modal.find('#linkDesinscrever').attr("href", link);
      		})*/
		});
	</script>