<section id="main-content">
	<section class="wrapper site-min-height">
		<h2><i class="fa fa-angle-right"></i>Anexar Comprovante de Pagamento 
		</h2>
		<div class="row mt">
			<div class="col-md-12">
				<div class="content-panel">
					
					<form method="POST" action="<?= base_url('Participante/anexar_comprovante_pagamento') ?>" id="pesquisa" name="pesquisa" enctype="multipart/form-data">
						<h2>Anexar Comprovante de Pagamento</h2>
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
											
											echo '<option value="'.$object->value.'">'.$object->label.'</option>';
										}
										
										?>
									</select>
								</div>
								
							</div>
						</div>
						<div class="form-group">
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
						</div>





						

					</form>






				</div>
			</div>
		</div>




	</section>
</section>

