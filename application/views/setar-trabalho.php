<section id="main-content">
	<section class="wrapper site-min-height">
		<h2><i class="fa fa-angle-right"></i>Enviar Trabalho para um participante
		</h2>
		<div class="row mt">
			<div class="col-md-12">
				<div class="content-panel">
					<form class="form-horizontal" action="<?= base_url('Trabalho/enviar_trabalho_participante') ?>" method="POST" enctype="multipart/form-data">
						<div class="col-sm-12 message">
							<?= $mensagens; ?>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-sm-12">
									<label class="col-sm-12 control-label">Destinatário:</label>
									
									<select class="form-control round-form" name="participante" id="participante" required="true">
										<option value="" selected="true" disabled="true">Selecione o participante</option>
										<?php 
										foreach($objects as $object){
											
											echo '<option value="'.$object->value.'" data-cpf="'.$object->cpf.'">'.$object->label.'</option>';
										}
										
										?>
									</select>
								</div>
								<div class="col-md-12">
									<div class="panel panel-default">
										<div class="panel-heading" id="duvida">
											<strong>Instruções para anexar o<strong>trabalho do participante:</strong></strong>


											<span class="pull-right"></span></div>
											<div class="panel-body">

												<fieldset>
													<p><strong>OBS:</strong> O formato válido para o arquivo dos artigos são: <strong>.pdf, .doc, .docx.</strong> com a tamanho máximo de <strong>2 MB.</strong></p>
													<p><strong>1</strong> - Escreva o título do trabalho.</p>
													<div class="form-group">
														<div class="col-md-12">

															<input required="true" placeholder="Digite aqui o Título do trabalho." type="text" name="titulo" id="titulo" class="form-control"  minlength="1" maxlength="100">
														</div>
													</div>

													<p><strong>2</strong> - Adicione os <strong>co-autores:</strong></p>

													<p>Adicione abaixo, preenchendo o CPF dos co-autores. Preste atenção, pois o co-autor deve: <strong>ter efetuado o cadastro no sistema e ter o pagamento aceito por nossa equipe.</strong> Caso informe o CPF e apareça logo abaixo o nome do co-autor,<strong> ele já foi adicionado </strong> e você pode dar seguimento na submissão do trabalho. Para retirar um co-autor, apenas apague o CPF digitado.</p>

													<div class="form-group">
														<div class="col-md-12">
															<div id="coautores"></div>
															<a id="adicionar" class="btn btn-info"><i class="fa fa-plus"></i> Adicionar</a>
														</div>
													</div>

													<p><strong>3</strong> - Escolha qual <strong>eixo temático</strong> o trabalho do participante mais se encaixa.</p>
													<ul>
														<li><p><strong>Eixo 1: Fundamentos teórico-filosóficos da Pedagogia Histórico-Crítica:</strong> contemplará trabalhos que apresentem análises e reflexões sobre os pressupostos filosóficos, políticos e epistemológicos que constituem os fundamentos da Pedagogia Histórico-Crítica enquanto uma teoria pedagógica revolucionária.</p></li>
														<li><p><strong>Eixo 2: Fundamentos Psicológicos da Pedagogia Histórico-crítica:</strong> contemplará trabalhos que apresentem produções acerca das relações entre educação escolar e desenvolvimento humano à luz da unidade teórico-metodológica entre a Pedagogia Histórico-Crítica e a Psicologia Histórico-Cultural.</p></li>
														<li><p><strong>Eixo 3: Fundamentos Didáticos, Currículo e Pedagogia Histórico-crítica:</strong> contemplará trabalhos que apresentem análises e reflexões acerca da formação de professores, da prática docente, da educação escolar na contemporaneidade e seus desdobramentos no processo de ensino e aprendizagem com base na Pedagogia Histórico-Crítica.</p></li>
														<li><p><strong>Eixo 4: Educação inclusiva e Pedagogia Histórico-crítica:</strong> contemplará trabalhos que apresentem contribuições teóricas e práticas da Pedagogia Histórico-Crítica para a promoção da educação e do desenvolvimento humano no âmbito das práticas educativas inclusivas.</p></li>
														<li><p><strong>Eixo 5: Educação do Campo, luta de classes e Pedagogia Histórico-Crítica:</strong> contemplará trabalhos que apresentem análises e reflexões teóricas e práticas acerca da educação do campo no processo de enfrentamento da luta de classes e a articulação de práticas pedagógicas voltadas ao desenvolvimento e fortalecimento dos movimentos sociais populares e a Pedagogia Histórico-Crítica.</p></li>
														<li><p><strong>Eixo 6: Educação não-formal, identidades sociais e Pedagogia Histórico-Crítica:</strong> contemplará trabalhos que apresentem análises e reflexões teóricas e práticas acerca da exploração e opressão que as relações de gênero, sexualidades e/ou étnico-raciais decorrentes do processo de divisão social do trabalho/alienação, das reformulações curriculares nacionais e suas interfaces com a função desenvolvente da educação e a Pedagogia Histórico-Crítica.</p></li>
													</ul>
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
													<p><strong>4</strong> - Selecione abaixo o trabalho <strong>com</strong> o nome do participante de autor.</p>
													<div class="form-group">
														<div class="col-md-12">
															<input required="true" type="file" name="artigo_com_autor" id="artigo_com_autor" class="form-control"  accept=".docx, .doc, .pdf">
														</div>
													</div>
													<p><strong>5</strong> - Selecione agora o trabalho <strong>sem</strong> o nome do participante de autor, somente com o conteúdo do artigo.</p>
													<div class="form-group">
														<div class="col-md-12">
															<input required="true" type="file" name="artigo_sem_autor" id="artigo_sem_autor" class="form-control"  accept=".docx, .doc, .pdf">
														</div>
													</div>

													<p><strong>6</strong> - Clique sobre o botão <strong>"Enviar Trabalho"</strong></p>
													<!-- Message body -->
													<div class="form-group">
														<div class="col-md-12">

															<input type="submit" name="submit" id="submit" class="btn btn-primary" value="Enviar Trabalho" >
														</div>

													</div>


												</fieldset>
											</div>

										</div>
									</div>
									<div class="col-md-12">
										<div class="panel <?/*= $panel*/ ?>">
											<div class="panel-heading">
												<p align="center" style="color:white;"><?/*= $title*/ ?></p>


												<span class="pull-right"></span>
											</div>
											<div class="panel-body">
												<?/*= $message*/ ?>
											</div>

										</div>
									</div>
					<!--<?php

					if($enviou_comprovante && $vai_submeter_trabalho && ($status_trabalho == 'Houve um problema com seu trabalho sem o nome de autor, portanto será preciso reenviá-lo.' || $status_trabalho == 'Houve um problema com seu trabalho com o nome de autor, portanto será preciso reenviá-lo.' || $status_trabalho == 'Houve um problema com ambos trabalho, portanto será preciso reenviá-los')  && $status_inscricao == 'Aprovado' && $dentro_do_prazo){
							
							$title = 'Status do Trabalho: reenvio solicitado';
							$panel = 'panel-warning';
							$message = '<h2>'.$status_trabalho.'</h2>';
							
							?>-->
							<div class="col-md-12">
								<div class="panel <?= $panel ?>">
									<div class="panel-heading">
										<p align="center" style="color:white;"><?= $title ?></p>


										<span class="pull-right"></span>
									</div>
									<div class="panel-body">
										<?= $message ?>
									</div>

								</div>
							</div>

							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">
										<strong>Regras para Submissão do Trabalho</strong>
										<span class="pull-right"></span>
									</div>
									<div class="panel-body">
										<p>Serão aceitos os trabalhos de cunho acadêmico conforme os Eixos Temáticos do Congresso, sob a forma de duas modalidades: <strong>Resumo Expandido e Trabalho Completo.</strong></p>
										<p>A apresentação dos trabalhos aprovados (<strong>Resumo Expandido e/ou Trabalho Completo</strong>) será no formato de <strong>comunicação oral</strong> (*não haverá modalidade de pôster).</p>
										<p>Em qualquer uma das duas modalidades, os trabalhos inscritos deverão atender aos seguintes objetivos: </p>
										<p><strong>a)</strong> ter a Pedagogia Histórico-Crítica como objeto de pesquisa e/ou fundamento teórico de investigações e de experiências que visem contribuições propositivas a ela; ou que a analisem criticamente à vista de seu aprimoramento; </p>
										<p><strong>b)</strong> adotar os fundamentos epistemológicos, filosóficos e ontológicos que fundamentam a pedagogia histórico-crítica na análise da relação entre educação e desenvolvimento humano. </p>
									</div>
								</div>

							</div>
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading" id="duvida">
										<strong>Instruções para anexar o seu <strong>trabalho:</strong></strong>


										<span class="pull-right"></span></div>
										<div class="panel-body">

											<form class="form-horizontal" action="<?= base_url('Painel/resend_article') ?>" method="POST" enctype="multipart/form-data">
												<fieldset>
													<p><strong>OBS:</strong> O formato válido para o arquivo dos artigos são: <strong>.pdf, .doc, .docx.</strong> com a tamanho máximo de <strong>2 MB.</strong></p>

													<?php 
													if($status_trabalho == 'Houve um problema com seu trabalho com o nome de autor, portanto será preciso reenviá-lo.' || $status_trabalho == 'Houve um problema com ambos trabalho, portanto será preciso reenviá-los')
													{ 
														?>										
														<p>Selecione abaixo o seu trabalho <strong>com</strong> seu nome de autor.</p>
														<div class="form-group">
															<div class="col-md-12">
																<input required="true" type="file" name="artigo_com_autor" id="artigo_com_autor" class="form-control"  accept=".docx, .doc, .pdf">
															</div>
														</div>

														<?php 
													}
													if($status_trabalho == 'Houve um problema com seu trabalho sem o nome de autor, portanto será preciso reenviá-lo.' || $status_trabalho == 'Houve um problema com ambos trabalho, portanto será preciso reenviá-los')
													{ 
														?>

														<p>Selecione abaixo o seu trabalho <strong>sem</strong> o seu nome de autor, somente com o conteúdo do artigo.</p>
														<div class="form-group">
															<div class="col-md-12">
																<input required="true" type="file" name="artigo_sem_autor" id="artigo_sem_autor" class="form-control"  accept=".docx, .doc, .pdf">
															</div>
														</div>

														<?php 
													}
													?>

													<p>Clique sobre o botão <strong>"Enviar Trabalho"</strong></p>
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
									$title = 'Status do Trabalho: Etapa de Validação';
									$panel = 'panel-info';
									$message = '<h2>Seu trabalho foi enviado com sucesso e será <strong>validado</strong> por um membro de nossa equipe.<br> Fique atento em seu e-mail e no sistema, pois o prazo para correção e reenvio do trabalho é de 3 dias úteis após o recebimento do aviso.</h2>';
								}else if($status_trabalho == 'Parabéns! Seu trabalho foi <strong>APROVADO</strong>!'){
									$title = 'Status do Trabalho: Aprovado';
									$panel = 'panel-success';
									$message = '<h2>'.$status_trabalho.'</h2>';
								}else if($status_trabalho == 'Infelimente seu trabalho não foi aprovado, mas você poderá ainda participar do Congresso.'){
									$title = 'Status do Trabalho: Reprovado';
									$panel = 'panel-danger';
									$message = '<h2>Infelizmente seu trabalho não foi aprovado, mas você poderá ainda participar do Congresso.</h2>';
								}
								?>				
								<?php if($title != ''){ ?>
									<div class="col-md-12">
										<div class="panel <?= $panel ?>">
											<div class="panel-heading">
												<p align="center" style="color:white;"><?= $title ?></p>


												<span class="pull-right"></span>
											</div>
											<div class="panel-body">
												<?= $message ?>
											</div>

										</div>
									</div>
								<?php } ?>

							<?php } ?>

							<!--scripts-->							

							<script src="<?= base_url('assets/painel/js/jquery-3.3.1.min.js') ?>"></script>
							<script src="http://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
							<script src="<?= base_url('assets/painel/js/jquery.ui.js') ?>"></script>
							<script type="text/javascript">
								$.jMaskGlobals.watchDataMask = true;
								function addCoautor(input_coautor){
									var cpf = $(input_coautor).val();
									var cpf_participante = $("#participante").find(':selected').attr('data-cpf');
									if (cpf=="") $(input_coautor).parent().remove();
									if(cpf == cpf_participante){
										$(input_coautor).css({borderColor : "red"});
										$(input_coautor).parent().append("<h5 style='color: red;'>O participante não pode ser coautor do seu próprio trabalho!</h5>");
									}	
								}
								$( document ).ready(function() {
									$( "#adicionar" ).click(function() {
										$('#coautores').append('<div><input type="text" class="ui-autocomplete-input coautor form-control" placeholder="Insira o CPF do Coautor." autocomplete="off" data-mask="000.000.000-00" data-mask-reverse="true" name="coautoresCPF[]" onFocusOut="addCoautor(this)"></input><br></div>');
									});
								});
							</script>
						<!--<div class="form-group">
							<div class="row">
								<div class="col-sm-12">
									<label class="col-sm-12 control-label">Anexar arquivo:</label>
									
									<div class="form-group">
										<p>Selecione abaixo a foto do comprovante de depósito. Os tipos de arquivos permitidos são: <strong>.pdf, .jpg, .jpeg, .gif, .bmp, .png.</strong> com o tamanho máximo de <strong>6 MB.</strong></p>
										<div class="col-md-12">
											<input type="file" name="comprovante_deposito" id="comprovante_deposito" class="form-control" required="true" accept="image/*, .pdf"> 
											<br>
										</div>

									</div>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<br><br>
									<input type="submit" name="submit" class="btn btn-success round-form" value="Enviar">
								</div>
							</div>
						</div>-->
					</div>
				</div>
			</form>
		</div>
	</div>
</section>
</section>

