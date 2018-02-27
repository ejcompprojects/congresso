 <body>

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

      <div id="login-page">
      	<div class="container">

      		<form class="form-login" action="<?= base_url('Login/authenticate') ?>" method="POST">
      			<h2 class="form-login-heading">congresso <br>pedagogia histórico-crítica</h2>
      			<div class="login-wrap">
      				<input type="email" class="form-control" name="email" id="email" placeholder="E-mail" autofocus minlength="0" maxlength="100" >
      				<br>
      				<input type="password" class="form-control" name="senha" id="senha" placeholder="Senha" minlength="0" maxlength="50" >
      				<br>
                            
      				<div class="message">
      				  <?= $mensagens; ?>
      				</div>
      				<br>


      				<button class="btn btn-theme btn-block" type="submit"><i class="fa fa-lock"></i> ENTRAR</button>

                                <div class="">
                                    <a href="<?= base_url('Login/forgot_password') ?>">Esqueci minha senha</a>
                              </div>
      				
      			</div>

      			

      		</form>	  	

      	</div>
      </div>



  </body>