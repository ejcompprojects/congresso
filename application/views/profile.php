<section id="main-content">
	<section class="wrapper site-min-height">
		<h2><i class="fa fa-angle-right"></i>Alterar Meus Dados
		</h2>
		<div class="row mt">
			<div class="col-md-12">
				<div class="content-panel">
					<form method="POST" action="<?= base_url('Admin/alterar_meus_dados') ?>" id="pesquisa" name="pesquisa">
						<h2>Meus Dados</h2>
						<div class="col-sm-12 message">
							<?= $mensagens; ?>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-sm-6">
									<label class="col-sm-12 control-label">E-mail:</label>
									<input type="email" disabled="true" class="form-control round-form" name="email" id="email" maxlength="100" required="true" value="<?= $usuario->email ?>">
								</div>
								<div class="col-sm-6">
									<label class="col-sm-12 control-label">Nome:</label>
									<input type="text" class="form-control round-form" name="nome" id="nome" maxlength="100" required="true" value="<?= $usuario->nome ?>">
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-sm-12">
									<label class="col-sm-12 control-label">Senha Atual:</label>
									<input type="password" class="form-control round-form" name="senha_atual" id="senha_atual" maxlength="100">
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
							<div class="col-sm-6">
								<label class="col-sm-12 control-label">Senha Nova:</label>
								<input type="password" class="form-control round-form" name="senha_nova" id="senha_nova" minlength="6" maxlength="30">
							</div>
							<div class="col-sm-6">
								<label class="col-sm-12 control-label">Repetir Senha:</label>
								<input type="password" class="form-control round-form" name="repetir_senha" id="repetir_senha" minlength="6" maxlength="30">
							</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<br><br>
								<input type="submit" name="submit" class="btn btn-success round-form" value="Alterar Dados">
								</div>
							</div>
						</div>





						

					</form>






				</div>
			</div>
		</div>




	</section>
</section>

