<section id="main-content">
	<section class="wrapper site-min-height">
		<h2><i class="fa fa-angle-right"></i>Enviar E-mail Para TODOS OS PARECERISTAS
		</h2>
		<!-- <div class="row mt">
			<div class="col-md-12"> -->

				<div class="content-panel">
					<form method="POST" action="<?= base_url('Email/enviar_email_pareceristas') ?>" id="pesquisa" name="pesquisa">
						<h2>Enviar E-mail</h2>
						<h3><span style="color: red;">ATENÇÃO:</span> Este e-mail será enviado para TODOS os pareceristas!</h3>
						<div class="col-sm-12 message">
							<?= $mensagens; ?>
						</div>
						
					<div class="form-group">
						<div class="row">
							<div class="col-sm-12">
								<label class="col-sm-12 control-label">Título:</label>

								<input type="text" name="title" id="title" class="form-control round-form" required="true" minlength="1" maxlength="100">
							</textarea>
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

