<section id="main-content">
	<section class="wrapper site-min-height">
		<h2><i class="fa fa-angle-right"></i>Enviar E-mail Para Grupos
		</h2>
		<!-- <div class="row mt">
			<div class="col-md-12"> -->
				<div class="content-panel">
					<form method="POST" action="<?= base_url('Email/enviar_email_grupo') ?>" id="pesquisa" name="pesquisa">
						<h2>Enviar E-mail</h2>
						<div class="col-sm-12 message">
							<?= $mensagens; ?>
						</div>
						<div class="form-group">
							<h3><strong>OBS:</strong>Caso você não selecione nenhuma das opções, será enviado o e-mail para <strong>Todos</strong> os participantes.</h3>
							<div class="row">
								<div class="col-sm-4">
									<label class="col-sm-12 control-label">Pagamento:</label>
									
									<select class="form-control round-form" name="pagamento" id="pagamento">
										<option value="" selected="true">Selecione</option>
										<option value="nao_anexou">Não anexaram comprovante</option>
										<option value="0">Em Análise</option>
										<option value="1">Aprovado</option>
										<option value="2">Reprovado</option>
										<option value="3">Isento</option>
									</select>
								</div>


								<div class="col-sm-4">
									<label class="col-sm-12 control-label">Trabalho:</label>
									
									<select class="form-control round-form" name="trabalho" id="trabalho">
										<option value="" selected="true">Selecione</option>
										<option value="nao_anexou">Não anexaram o trabalho</option>
										<option value="0">Em Análise</option>
										<option value="1">Aprovado</option>
										<option value="2">Reprovado</option>
										<option value="nao_submetera_trabalho">Não submeterá o trabalho</option>
									</select>
								</div>

								<div class="col-sm-4">
									<label class="col-sm-12 control-label">Tipo Inscrição:</label>
									
									<select class="form-control round-form" name="tipo_inscricao" id="tipo_inscricao">
										<option value="" selected="true">Selecione</option>
										<option value="">Todos</option>
										<?php 
											foreach($tipos as $tipo){
												echo '<option value="'.$tipo->id.'">'.$tipo->tipo.'</option>';
											}
										 ?>
									</select>
								</div>
								
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-sm-12">
									<label class="col-sm-12 control-label">Título:</label>
									
									<input type="text" name="title" id="title" class="form-control round-form" required="true" minlength="1" maxlength="100">
									</textarea>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-sm-12">
									<label class="col-sm-12 control-label">Mensagem:</label>
									<textarea class="form-control" style="resize:none;" name="message" minlength="10" id="message" required="true" rows="5">
										
									</textarea>
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
						</div>





						

					</form>






				</div>
		<!-- 	</div>
		</div> -->




	</section>
</section>

