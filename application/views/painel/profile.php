<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="<?= base_url('Painel') ?>">
				<em class="fa fa-home"></em>
			</a></li>
			<li class="active">Alterar Meus Dados</li>
		</ol>
	</div><!--/.row-->
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Alterar Meus Dados</h1>
		</div>
	</div><!--/.row-->


	<?php if($mensagens != ''){ ?>

		<div class="col-md-12">
			<?= $mensagens; ?>
		</div>
	
	<?php } ?>
	<div class="content">
		<div class="col-lg-12">
			<div class="panel">
				<div class="panel-body">
					<form class="form-horizontal" action="<?= base_url('Painel/alterar_meus_dados') ?>" method="post" >
						<h3>Dados Pessoais:</h3>
						<div class="form-group">
							<div class="col-lg-6">
								<label for="email">E-mail:</label>
								<input disabled="true" type="email" name="email" id="email" class="form-control" required="true" value="<?= $usuario->email ?>"> 
							</div>
							<div class="col-lg-6">
								<label for="nome">Nome:</label>
								<input required="true" type="text" name="nome" id="nome" class="form-control" required="true" value="<?= $usuario->nome ?>" minlength="5" maxlength="100"> 
							</div>
							<div class="col-lg-12"><br></div>
							<div class="col-lg-6">
								<label for="celular">Celular:</label>
								<input required="true" type="text" name="celular" id="celular" class="form-control" required="true" value="<?= $usuario->celular ?>" minlength="5" maxlength="20"> 
							</div>
							<div class="col-lg-6">
								<label for="telefone">Telefone:</label>
								<input type="text" name="telefone" id="telefone" class="form-control" value="<?= $usuario->telefone ?>" minlength="5" maxlength="20"> 
							</div>
							<div class="col-lg-12"><br></div>
							<div class="col-lg-12">
								<label for="senha_atual">Senha Atual:</label>
								<input type="password" name="senha_atual" id="senha_atual" class="form-control" minlength="6" maxlength="30"> 
							</div>
							<div class="col-lg-12"><br></div>
							<div class="col-lg-6">
								<label for="senha_nova">Senha Nova:</label>
								<input  type="password" name="senha_nova" id="senha_nova" class="form-control" minlength="6" maxlength="30"> 
							</div>
							<div class="col-lg-6">
								<label for="repetir_senha">Repetir Senha:</label>
								<input type="password" name="repetir_senha" id="repetir_senha" class="form-control" minlength="6" maxlength="30"> 
							</div>

						</div>
						<h3>Dados de Endereço</h3>
						<div class="form-group">
							<div class="col-lg-6">
								<label for="endereco">Endereco:</label>
								<input  required="true" type="text" name="endereco" id="endereco" class="form-control" required="true" value="<?= $usuario->endereco ?>" minlength="5" maxlength="100"> 
							</div>
							<div class="col-lg-6">
								<label for="bairro">Bairro:</label>
								<input  required="true" type="text" name="bairro" id="bairro" class="form-control" required="true" value="<?= $usuario->bairro ?>" minlength="1" maxlength="100"> 
							</div>
							<div class="col-lg-12"><br></div>
							<div class="col-lg-4">
								<label for="cep">CEP:</label>
								<input  required="true" type="text" name="cep" id="cep" class="form-control" required="true" value="<?= $usuario->cep ?>" minlength="8" maxlength="100"> 
							</div>

							<div class="col-lg-4">
								<label for="cidade">Cidade:</label>
								<input  required="true" type="text" name="cidade" id="cidade" class="form-control" required="true" value="<?= $usuario->cidade ?>" minlength="5" maxlength="100"> 
							</div>
							<div class="col-lg-4">
								<label for="Estado">Estado:</label>
								<select required="true" class="form-control" id="estado" name="estado">


									<option value="">Selecione um Estado</option>

									<option value="AC">Acre</option> 
									<option value="AL">Alagoas</option> 
									<option value="AP">Amapá</option> 
									<option value="AM">Amazonas</option> 
									<option value="BA">Bahia</option> 
									<option value="CE">Ceará</option> 
									<option value="DF">Distrito Federal</option> 
									<option value="ES">Espírito Santo</option> 
									<option value="GO">Goiás</option> 
									<option value="MA">Maranhão</option> 
									<option value="MT">Mato Grosso</option> 
									<option value="MS">Mato Grosso do Sul</option> 
									<option value="MG">Minas Gerais</option> 
									<option value="PA">Pará</option> 
									<option value="PB">Paraíba</option> 
									<option value="PR">Paraná</option> 
									<option value="PE">Pernambuco</option> 
									<option value="PI">Piauí</option> 
									<option value="RJ">Rio de Janeiro</option> 
									<option value="RN">Rio Grande do Norte</option> 
									<option value="RS">Rio Grande do Sul</option> 
									<option value="RO">Rondônia</option> 
									<option value="RR">Roraima</option> 
									<option value="SC">Santa Catarina</option> 
									<option value="SP">São Paulo</option> 
									<option value="SE">Sergipe</option> 
									<option value="TO">Tocantins</option> 
								</select> 
							</div>
						</div>
						<h3>Dados de Inscrição</h3>
						<?php //switch($usuario->id_tipo_inscricao){ ?>

						<?php //} ?>
						<div class="form-group">
							
						</div>
						<div class="col-lg-12">
							<input type="submit" name="submit" id="submimt" class="btn btn-primary" value="Alterar Dados">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="<?= base_url('assets/js/jquery-3.3.1.js') ?>"></script>
	<script type="text/javascript">
		$( document ).ready(function() {
			$('#estado').val('<?= $usuario->estado ?>')
		});
		
	</script>