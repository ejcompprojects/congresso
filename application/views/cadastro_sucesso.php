<body style="background-image: url(<?php echo base_url('assets/img/background2.jpg');?>);" class="hm-gradient">
    <body class="hm-gradient">
        <script type="text/javascript" src="assets/js/preencheCep.js"></script>
        <main>
            <div class="container">

                <div class="text-center darken-grey-text mb-4">
                </div>

                <div class="col-md-9 col-centered">
                    <div class="card">
                        <div class="card-body">

                            
                            <!-- Form -->
                            <form method="POST" action="declarar_interesse_minicursos">
                                <h2 class="text-center font-bold deep-orange-text py-4">Cadastro finalizado com sucesso!</h2>
                                <?php 
                                if ($this->session->flashdata('erroBanco') == TRUE){
                                    echo '<div class="alert alert-danger"> Ocorreu um erro ao processar o seu cadastro, tente novamente</div>';
                                }

                                    if ($this->session->flashdata('cadastrado') == TRUE){
                                    echo '<div class="alert alert-success"> Você foi cadastrado com sucesso!</div>';
                                }
                            ?>
                                <center><img src="<?= base_url('assets/img/progress3.png')?>" width="80%" margin="auto" ></center>

                                <h3 class="text-center font-bold deep-black-text py-4">Entre no seu e-mail para confirmar a inscrição!</h3>
                                <p><strong>OBS:</strong> Caso não receba o e-mail de confirmação, entre em contato com a organização através do e-mail: <strong>phcprudente2018@gmail.com</strong>.</p>
                                <p>Talvez demore alguns minutinhos para cair em sua caixa e pode acontecer que seja encaminhado para a caixa de spam.</p>
                                <center><a href="<?php echo base_url('login') ?>" >Clique aqui para ser redirecionado para o login!</a></center>

                               <div class="text-center">
                                </div>
                            </form>
                        <!-- Form -->
                    </div>
                </div>
            </div>

            <div class="text-center darken-grey-text mb-4">
            </div>

        </div>

</main>