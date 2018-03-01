<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="<?= base_url('Painel') ?>">
				<em class="fa fa-home"></em>
			</a></li>
			<li class="active">Enviar Arquivos</li>
		</ol>
	</div><!--/.row-->
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Esta é a área para enviar o comprovante de depósito e o seu trabalho</h1>
		</div>
	</div><!--/.row-->
	
	<?php if($mensagens != ''){ ?>
	<div class="row">
		<div class="col-md-12">
			<?= $mensagens; ?>
		</div>
	</div>
	<?php } ?>



	<?php if(!$enviou_comprovante){ ?>
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading" id="duvida">
				<strong>Instruções para anexar o <strong>comprovante de depósito:</strong></strong>


				<span class="pull-right"></span></div>
				<div class="panel-body">
					
					<form class="form-horizontal" action="<?= base_url('Painel/send_photo') ?>" method="post" enctype="multipart/form-data">
						<fieldset>
							<p><strong>1</strong> - Tire a foto do comprovante de depósito via câmera (celular ou câmera digital) de maneira que seja legível as informações contidas no mesmo.</p>
							<p><strong>2</strong> - Passe para o computador.</p>
							<p><strong>3</strong> - Selecione abaixo a foto do comprovante de depósito. Os tipos de imagens permitidos são: <strong>.jpg, .jpeg, .gif, .bmp, .png.</strong></p>
							<p><strong>4</strong> - Clique sobre o botão <strong>"Enviar Comprovante"</strong></p>
							<!-- Message body -->
							<div class="form-group">

								<div class="col-md-12">
									<input type="file" name="comprovante_deposito" id="comprovante_deposito" class="form-control" required="true" accept="image/*"> 
									<br>
									<input type="submit" name="submit" id="submimt" class="btn btn-primary" value="Enviar Comprovante">
								</div>

							</div>

							
						</fieldset>
					</form>
				</div>

			</div>
		</div>

		<?php } 
		else { 
			$panel = '';
			$message = '';
			if($status_inscricao == 'Em análise'){
				$title = 'Status: Em Análise';
				$panel = 'panel-info';
				$message = '<h2>Seu comprovante de pagamento está em <strong>análise.</strong></h2>';
			}else if($status_inscricao == 'Aprovado'){
				$title = 'Status: Aprovado';
				$panel = 'panel-success';
				$message = '<h2>Seu comprovante de depósito foi <strong>aprovado!</strong></h2>';
			}else if($status_inscricao == 'Reprovado'){
				$title = 'Status: Reprovado';
				$panel = 'panel-danger';
				$message = '<h2>Seu comprovante de pagamento foi <strong>reprovado.</strong></h2><br><p>Isto pode acontecer por você ter pago o valor que não corresponde à sua inscrição no respectivo mês.</p><p>O Comprovante de depósito pode não estar claro (estar embaçado).</p>Entre em contato com a nossa equipe para saber o que ocorreu.';
			}
			?>
			<div class="col-md-12">
				<div class="panel <?= $panel ?>">
					<div class="panel-heading">
						<p align="center" style="color:white;"><?= $title ?></p>


						<span class="pull-right"></span></div>
						<div class="panel-body">
							<?= $message ?>
						</div>

					</div>
				</div>

				<?php } ?>
				<?php if(($vai_submeter_trabalho && $status_trabalho == '') || ($vai_submeter_trabalho && $status_trabalho == 'Você deve enviar seu artigo até fim do mês!')){ ?>
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading" id="duvida">
							<strong>Instruções para anexar o seu <strong>trabalho:</strong></strong>


							<span class="pull-right"></span></div>
							<div class="panel-body">

								<form class="form-horizontal" action="<?= base_url('Painel/send_article') ?>" method="post" enctype="multipart/form-data">
									<fieldset>
										<p><strong>OBS:</strong> O formato válido para o arquivo dos artigos são: <strong>.pdf, .doc, .docx.</strong> com a tamanho máximo de <strong>8 MB.</strong></p>
										<p><strong>1</strong> - Escreva o título de seu trabalho.</p>
										<div class="form-group">
											<div class="col-md-12">

												<input required="true" placeholder="Digite aqui o Título do trabalho." type="text" name="titulo" id="titulo" class="form-control"  minlength="1" maxlength="100">
											</div>
										</div>
										<p><strong>2</strong> - Escolha qual <strong>eixo temático</strong> seu trabalho mais se encaixa.</p>
										<div class="form-group">
											<div class="col-md-12">
												<select class="form-control" required="true" name="eixo" id="eixo">
													<option value="" selected="true" readonly="true" disabled="">Selecione um eixo</option>
													<?php foreach($eixos as $eixo){
														echo '<option value="'.$eixo->id.'">'.$eixo->nome.'</option>';
													} ?>
												</select>
											</div>
										</div>
										<p><strong>3</strong> - Selecione abaixo o seu trabalho <strong>com</strong> seu nome de autor.</p>
										<div class="form-group">
											<div class="col-md-12">
												<input required="true" type="file" name="artigo_com_autor" id="artigo_com_autor" class="form-control"  accept=".docx, .doc, .pdf">
											</div>
										</div>
										<p><strong>4</strong> - Selecione agora o seu trabalho <strong>sem</strong> o seu nome de autor, somente com o conteúdo do artigo.</p>
										<div class="form-group">
											<div class="col-md-12">
												<input required="true" type="file" name="artigo_sem_autor" id="artigo_sem_autor" class="form-control"  accept=".docx, .doc, .pdf">
											</div>
										</div>

										<p><strong>5</strong> - Clique sobre o botão <strong>"Enviar Trabalho"</strong></p>
										<!-- Message body -->
										<div class="form-group">
											<div class="col-md-12">

												<input type="submit" name="submit" id="submit" class="btn btn-primary" value="Enviar Trabalho" >
											</div>

										</div>

										
									</fieldset>
								</form>
							</div>

						</div>
					</div>
					<?php } 
					else{

						$panel = '';
						$message = '';
						$title = '';
						if($status_trabalho == 'Seu trabalho está em <strong>análise</strong>.'){
							$title = 'Status: Em Análise';
							$panel = 'panel-info';
							$message = '<h2>'.$status_trabalho.'</h2>';
						}else if($status_trabalho == 'Parabéns! Seu trabalho foi <strong>APROVADO</strong>!'){
							$title = 'Status: Aprovado';
							$panel = 'panel-success';
							$message = '<h2>'.$status_trabalho.'</h2>';
						}else if($status_trabalho == 'Infelimente seu trabalho não foi aprovado, mas você poderá ainda participar do Congresso.'){
							$title = 'Status: Reprovado';
							$panel = 'panel-danger';
							$message = '<h2>Infelizmente seu trabalho não foi aprovado, mas você poderá ainda participar do Congresso.</h2>';
						}
						?>				
						<div class="col-md-12">
							<div class="panel <?= $panel ?>">
								<div class="panel-heading">
									<p align="center" style="color:white;"><?= $title ?></p>


									<span class="pull-right"></span></div>
									<div class="panel-body">
										<?= $message ?>
									</div>

								</div>
							</div>

							<?php } ?>



							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading" id="duvida">
										<strong>Entre em contato conosco</strong>


										<span class="pull-right"></span></div>
										<div class="panel-body">

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