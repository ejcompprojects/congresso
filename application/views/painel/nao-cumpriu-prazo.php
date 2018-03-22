<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
	swal({
		title: "Você perdeu o PRAZO para envio do Trabalho!",
		icon: "error",
		text: "Mesmo que você tenha efetuado o pagamento e tenha sido aprovado, você deveria ter enviado o artigo até o fim do mês em que fez o cadastro.\n\n Agora suas opções são:\n\n " +
		"1 - Entre em contato com a organização e explique sua situação.\n\n" +
		"2 - Efetue novamente o pagamento da inscrição referente ao mês atual no valor de R$ <?= $valor ?>,00.\n\n" +
		"3 - Altere sua inscrição para SEM SUBMISSÃO DE TRABALHO clicando sobre o botão abaixo.", 
		button: "Entendi",
	});
</script>


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
	<div class="row">
		<div class="col-md-12">

			<div class="panel panel-danger">
				<div class="panel-heading">
					<strong>Você perdeu o prazo para submissão do trabalho!</strong>



					<?php $porcentagem = 40; ?>

					<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
					<div class="panel-body">
						<div class="col-md-12 no-padding">
							<div class="row progress-labels">

								<div class="pull-right" style="margin-right:10px;"><?= $porcentagem ?>%</div>
							</div>
							<div class="progress">
								<div data-percentage="0%" style="width: <?= $porcentagem ?>%;" class="progress-bar progress-bar-blue" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>
					</div>
				</div>

				<div class="content">
					<div class="col-lg-12">
						<div class="panel">
							<div class="panel-body">
								<h2><strong>O QUE VOCÊ PODE FAZER AGORA:</strong></h2>
								<ol style="font-size:12pt;">
									<li><a href="#duvida">Entre em contato com a organização e explique sua situação.</a></li><br>
									<li><a href="<?= base_url('Painel/enviar_arquivos') ?>">Efetue novamente o pagamento da inscrição referente ao mês atual no valor de R$ <?= $valor ?>,00.</a></li><br>
									<li>Altere sua inscrição para "SEM SUBMISSÃO DE TRABALHO" clicando sobre o botão abaixo. Assim, você poderá participar do evento sem enviar seu trabalho, apenas participando das palestras e minicursos.</li><br>

								</ol>
								<div class="col-md-12">
									<form method="POST">
										<button type="submit" class="btn btn-danger" id="alterar" formaction="<?= base_url('Painel/alterar_para_sem_submissao_de_trabalho') ?>">ALTERAR PARA SEM SUBMISSÃO DE TRABALHO</button>
									</form>
								</div>

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
										<p>Efetue o <strong>depósito</strong> de <strong>R$ <?= $valor ?>,00</strong> na conta do evento:</p>
										<p><strong>Banco:</strong> Caixa Econômica</p>
										<p><strong>Agência:</strong> 4232</p>
										<p><strong>Operação:</strong> 013 (poupança)</p>
										<p><strong>Conta:</strong> 000.000.009.059-4. </p>
										<p><strong>Nome:</strong> Milene Egea Semensato</p>
									</div>
								</div>
							</li>
							<li>
								<div class="timeline-badge  <?php if($estagio == 3) echo 'primary' ?>"><i class="glyphicon glyphicon-camera"></i></div>
								<div class="timeline-panel">
									<div class="timeline-heading">
										<h4 class="timeline-title"><strong>3 - Envie-nos o comprovante de depósito</strong></h4>
									</div>
									<div class="timeline-body">
										<p>Tire uma foto ou scaneie o comprovante de depósito e nos envie <a href="<?= base_url('Painel/enviar_arquivos') ?>">clicando aqui!</a></p>
									</div>
								</div>
							</li>
							<?php if($vai_submeter_trabalho){ ?>
							<li>
								<div class="timeline-badge  <?php if($estagio == 4) echo 'primary' ?>"><i class="glyphicon glyphicon-paperclip"></i></div>
								<div class="timeline-panel">
									<div class="timeline-heading">
										<h4 class="timeline-title"><strong>4 - Envie-nos seu trabalho!</strong></h4>
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
									<p>Está com alguma dúvida ou dificuldade? Escreva para nós!</p>
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

			<script
			src="https://code.jquery.com/jquery-3.3.1.min.js"
			integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
			crossorigin="anonymous"></script>
			<script type="text/javascript">
				$('#alterar').click(function(){
					// return(swal({
					// 	title: 'Alterar para SEM Submissão de trabalho',
					// 	text: 'Concorda em alterar o seu cadastro para sem submissão de trabalho, sendo que o seu cadastro a partir de agora não será mais permitido a submissão do trabalho?',
					// 	buttons: ["Cancelar", "Sim, concordo."],
					// }));
					return(confirm("Concorda em alterar o seu cadastro para sem submissão de trabalho, sendo que o seu cadastro a partir de agora não será mais permitido a submissão do trabalho?"));
				});
				// swal({
				// 	title: "Are you sure?",
				// 	text: "Once deleted, you will not be able to recover this imaginary file!",
				// 	icon: "warning",
				// 	buttons: true,
				// 	dangerMode: true,
				// })
				// .then((willDelete) => {
				// 	if (willDelete) {
				// 		swal("Poof! Your imaginary file has been deleted!", {
				// 			icon: "success",
				// 		});
				// 	} else {
				// 		swal("Your imaginary file is safe!");
				// 	}
				// });
			</script>