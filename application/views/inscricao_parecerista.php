
<body style="background-image: url(<?php echo base_url('assets/img/background2.jpg');?>);" class="hm-gradient">

	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.mask.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/mascara.js"></script>
	<main>
		<div class="container">

			<div class="text-center darken-grey-text mb-4">
			</div>

			<div class="col-md-9 col-centered">
				<div class="card">
					<div class="card-body">
						<!-- Form -->
						<form method="POST" action="<?php echo base_url('home/cadastrar_parecerista') ?>">
							<h1 class="text-center font-bold deep-black-text py-4" align="center">Congresso:<br> Pedagogia Histórico-Crítica</h2>
								<h2 class="text-center font-bold deep-orange-text py-4">Cadastro de Parecerista</h2>
								<?=$mensagens;?>
								<?php
								if (($this->session->flashdata('dados')) != NULL){
									$dados = $this->session->flashdata('dados');
								}
								if(!isset($_SESSION['success']))
								{
								?>
								<p align="center">Use o formulário abaixo para se inscrever no congresso como parecerista!</p>
								<!-- <h3 class="text-center font-bold deep-black-text py-4">Dados Pessoais</h3> -->
								<div class="md-form">
									<i class="fa fa-user prefix grey-text"></i>
									<input type="text" id="nome" name="nome" class="form-control" value="<?php if(isset($dados['nome'])) echo $dados['nome'];  else echo ''; ?>" required="true" minlength="2" maxlength="100">
									<label for="nome">Nome Completo*</label>
								</div>

								<div class="md-form">
									<i class="fa fa-id-card prefix grey-text"></i>
									<input type="text" id="cpf" name="cpf" class="form-control" value="<?php if(isset($dados['cpf'])) echo $dados['cpf'];  else echo ''; ?>" required="true" minlength="2" maxlength="15">
									<label for="cpf">CPF*</label>
								</div>

								<div class="md-form">
									<i class="fa fa-envelope prefix grey-text"></i>
									<input type="email" id="email" name="email" class="form-control" value="<?php if(isset($dados['email'])) echo $dados['email'];  else echo ''; ?>" required="true" minlenght="5" maxlength="100">
									<label for="email">E-mail*</label>
								</div>

								<div class="md-form">
									<i class="fa fa-lock prefix grey-text"></i>
									<input type="password" id="senha" name="senha" class="form-control" required="true" minlength="6" maxlength="30">
									<label for="senha">Senha*</label>
								</div>

								<div class="md-form">
									<i class="fa fa-repeat prefix grey-text"></i>
									<input type="password" id="confirma-senha" name="confirma-senha" class="form-control" required="true" minlength="6" maxlength="30">
									<label for="confirma-senha">Confirmar Senha*</label>
								</div>

								<div class="md-form">

									<i class="fa fa-mobile prefix grey-text"></i>
									<input type="text" id="celular" name="celular" class="form-control" value="<?php if(isset($dados['celular'])) echo $dados['celular'];  else echo ''; ?>" required="true" maxlength="15" >

									<label for="celular">Celular*</label>
								</div>

								<div class="md-form">
									<i class="fa fa-phone prefix grey-text"></i>
									<input type="text" id="telefone" name="telefone" class="form-control" value="<?php if(isset($dados['telefone'])) echo $dados['telefone'];  else echo ''; ?>">
									<label for="telefone">Telefone</label>
								</div>

								<div class="md-form">
									<i class="fa fa-university prefix grey-text"></i>
									<input type="text" id="instituicao" name="instituicao" class="form-control" value="<?php if(isset($dados['instituicao'])) echo $dados['instituicao'];  else echo ''; ?>">
									<label for="instituicao">Instituição de atuação</label>
								</div>

								<ul class="list-group" style="color: #6c757d;">
									<h4 class="list-group-item-heading">Eixos de parecer:</h4>
									<?php
									foreach ($eixos as $eixo) {
										echo '<div class="list-group-item">';
										echo '<input type="checkbox" value="' . $eixo['id'] . '"id="e_' . $eixo['id'] . '" name="eixos[]"> <label for="e_' . $eixo['id'] . '">' . $eixo['nome'] . '</label><br/>';
										echo '</div>';
									}
									?>
								</ul>

									<div class="text-center">
										<button class="btn btn-deep-orange">Próximo<i class="fa fa-angle-double-right pl-2" aria-hidden="true"></i></button>
									</div>
								</form>
								<!-- Form -->
								<?php
									}
								?>
							</div>
						</div>
					</div>

					<div class="text-center darken-grey-text mb-4">
					</div>

				</div>


			</main>
