<?php// print_r($info); print_r($success); print_r($danger); exit(); ?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="<?= base_url('Painel') ?>">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Página Inicial</li>
			</ol>
		</div><!--/.row-->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Bem-vindo <?= $_SESSION['usuario']->primeiro_nome ?>!</h1>
	</div>
</div><!--/.row-->
<div class="content">
	<div class="col-lg-12">
		<div class="panel">
		<div class="panel-body">
		<h2>Este é o Painel do Participante</h2>
		<p>escrever sobre que o anexo do trabalho é até o fim do mês de inscrição caso n seja feito a inscrição será cancelada.</p>
		<p>escrever sobre o prazo para o anexo do comprovante de pagamento.</p>
		<p>colocar o valor que o participante deve pagar.</p>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
<?php 
			if($porcentagem == 60 || $porcentagem == 90){
				echo '<div class="panel panel-info ">
			<div class="panel-heading">
				<strong>Sua inscrição está em análise</strong>';
			}
			else if($completo) echo '<div class="panel panel-success "><div class="panel-heading">
				<strong>Sua inscrição está completa!</strong>';
			else{
				echo '<div class="panel panel-danger ">
			<div class="panel-heading">
				<strong>Sua inscrição ainda não está completa!</strong>';
			}
			
?>

		

				<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
				<div class="panel-body">
					<div class="col-md-12 no-padding">
						<div class="row progress-labels">
							<div class="col-sm-6">
								<?php 
									if(count($info) > 0){ 
										// echo '<p>Ainda resta você fazer:</p>';
										echo '<ul>';
										for($i = 0 ; $i < count($info); $i++){
											echo '<li>'.$info[$i].'</li>';
										}
										echo '</ul>';
									}
								?>
								
								
								<!-- <ul>
									<li>Você não anexou a foto de seu comprovante de pagamento ainda!</li>
									<li>Você deve enviar seu artigo até fim do mês!</li>
								</ul> -->
							</div>
							<div class="col-sm-6" style="text-align: right;"><?= $porcentagem ?>%</div>
						</div>
						<div class="progress">
							<div data-percentage="0%" style="width: <?= $porcentagem ?>%;" class="progress-bar progress-bar-blue" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>



<div class="col-md-12">

	<div class="panel panel-default ">
		<div class="panel-heading">
			<strong>Efetue os seguintes passos para se inscrever:</strong>

			<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
			<div class="panel-body timeline-container">
				<ul class="timeline timeline-horizontal">
					<li class="timeline-item">
						<div class="timeline-badge"><i class="glyphicon glyphicon-pushpin"></i></div>
						<div class="timeline-panel">
							<div class="timeline-heading">
								<h4 class="timeline-title <?php if($estagio == 1) echo 'primary' ?>"><strong>1 - Preenchimento dos Dados</strong></h4>
							</div>
							<div class="timeline-body">
								<p>Você já passou por este passo ao preencher os dados no formulário de inscrição.</p>
							</div>
						</div>
					</li>
					<li class="timeline-item">
						<div class="timeline-badge  <?php if($estagio == 2) echo 'primary' ?>"><i class="glyphicon glyphicon-envelope"></i></div>
						<div class="timeline-panel">
							<div class="timeline-heading">
								<h4 class="timeline-title"><strong>2 - Efetue o depósito</strong></h4>
							</div>
							<div class="timeline-body">
								<p>Efetue o depósito do valor da sua inscrição na conta do evento.</p>
							</div>
						</div>
					</li>
					<li>
						<div class="timeline-badge  <?php if($estagio == 3) echo 'primary' ?>"><i class="glyphicon glyphicon-camera"></i></div>
						<div class="timeline-panel">
							<div class="timeline-heading">
								<h4 class="timeline-title"><strong>3 - Tire uma foto do comprovante de depósito</strong></h4>
							</div>
							<div class="timeline-body">
								<p>Tire uma foto do comprovante de depósito e nos envie <a href="<?= base_url('Painel/enviar_arquivos') ?>">clicando aqui!</a></p>
							</div>
						</div>
					</li>
					<?php if($vai_submeter_trabalho){ ?>
					<li>
						<div class="timeline-badge  <?php if($estagio == 4) echo 'primary' ?>"><i class="glyphicon glyphicon-paperclip"></i></div>
						<div class="timeline-panel">
							<div class="timeline-heading">
								<h4 class="timeline-title"><strong>4 - Queremos ver seu trabalho!</strong></h4>
							</div>
							<div class="timeline-body">
								<p>Anexe seu trabalho, com autor e outra versão sem autor e sem informações sobre você.</p>
								<p>Após anexar seu trabalho, ele irá para a análise se você está apto a apresentá-lo no congresso ou não. Caso não esteja, não desanime, pois você ainda poderá participar do Congresso e debater sobre os assuntos!</p><p>Nos envie seu trabalho  <a href="<?= base_url('Painel/enviar_arquivos') ?>">clicando aqui!</a></p>
							</div>
						</div>
					</li>
					<?php } ?>
					<li>
						<div class="timeline-badge  <?php if($estagio == 5) echo 'primary' ?>"><i class="glyphicon glyphicon-ok"></i></div>
						<div class="timeline-panel">
							<div class="timeline-heading">
								<h4 class="timeline-title"><strong>5 - Você está inscrito com sucesso!</strong></h4>
							</div>
							<div class="timeline-body">
								<p>Agora é só vir para o congresso e aproveitar o que temos a oferecer!</p>
								<p><strong>OBS: Em breve abriremos as vagas para os minicursos e oficinas, fique atento pois são vagas limitadas!</strong></p>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</div>



	</div><!--/.col-->

	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading" id="duvida">
				<strong>Entre em contato conosco</strong>


				<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
				<div class="panel-body">
					<?= $mensagens ?>
					<form class="form-horizontal" action="<?= base_url('Painel/send_doubt') ?>" method="post">
						<fieldset>
							<p>Está com alguma dúvida? Escreva para nós!</p>
							<!-- Message body -->
							<div class="form-group">

								<div class="col-md-12">
									<textarea style="resize:none;" required="true" class="form-control" id="message" name="message" placeholder="Escreva sua dúvida aqui..." rows="5"></textarea>
								</div>

							</div>

							<!-- Form actions -->
							<div class="form-group">
								<div class="col-md-12 widget-right">
									<button type="submit" class="btn btn-info btn-md pull-right">Enviar</button>
								</div>
							</div>
						</fieldset>
					</form>
				</div>

			</div>
		</div>
	</div>