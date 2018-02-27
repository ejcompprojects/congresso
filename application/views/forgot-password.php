 <body>

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

      <div id="login-page">
      	<div class="container">

      		<form class="form-login" action="<?= base_url('Login/esqueci_senha') ?>" method="POST">
      			<h2 class="form-login-heading">congresso <br>pedagogia histórico-crítica</h2>
      			<div class="login-wrap">
      				<h3 align="center">ESQUECI MINHA SENHA</h3>
      				<input type="email" class="form-control" name="email" id="email" placeholder="Digite seu e-mail" autofocus minlength="1" maxlength="100" required="true">
      				<br>
      				<input type="text" class="form-control" name="cpf" id="cpf" placeholder="Digite seu CPF" minlength="14" maxlength="14" required="true">
      				<br>
                            
      				<div class="message">
      				  <?= $mensagens; ?>
      				</div>
      				<br>


      				<button class="btn btn-theme btn-block" type="submit">RECUPERAR SENHA <i class="fa fa-chevron-right"></i></button>
      				
                              <a href="<?= base_url('Login') ?>">Voltar</a>
      			</div>

      			

      		</form>	  	

      	</div>
      </div>



  </body>