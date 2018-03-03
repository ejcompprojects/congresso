<section id="main-content">
	<section class="wrapper site-min-height">
		<h2><i class="fa fa-angle-right"></i>Enviar E-mail Específico
		</h2>
		<div class="row mt">
			<div class="col-md-12">
				<div class="content-panel">
					<form method="POST" action="<?= base_url('Email/enviar_email_especifico') ?>" id="pesquisa" name="pesquisa">
						<h2>Enviar E-mail</h2>
						<div class="col-sm-12 message">
							<?= $mensagens; ?>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-sm-12">
									<label class="col-sm-12 control-label">Destinatário:</label>
									
									<select class="form-control round-form" name="email" id="email" required="true">
										<option value="" selected="true" disabled="true">Selecione o destinatário</option>
										<?php 
											foreach($participantes as $participante){
												echo '<option value="'.$participante->email.'">'.$participante->nome.' - '.$participante->tipo.' - '.$participante->estado.'</option>';
											}
										
										?>
									</select>
								</div>
								
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-sm-12">
									<label class="col-sm-12 control-label">Mensagem:</label>
									<textarea class="form-control" style="resize:none;" minlength="10" name="message" id="message" required="true" rows="5">
										
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
			</div>
		</div>




	</section>
</section>

