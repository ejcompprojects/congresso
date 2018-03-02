
<body class="hm-gradient"> 
    <body class="hm-gradient">
        <script type="text/javascript" src="assets/js/preencheCep.js"></script>
        <main>
            <div class="container">

                <div class="text-center darken-grey-text mb-4">
                </div>

                <div class="col-md-6 col-centered">
                    <div class="card">
                        <div class="card-body">

                            <?php 
                                if ($this->session->flashdata('erroBanco') == TRUE){
                                    echo '<div class="alert alert-danger"> Ocorreu um erro ao processar o seu cadastro, tente novamente</div>';
                                }

                                    if ($this->session->flashdata('cadastrado') == TRUE){
                                    echo '<div class="alert alert-success"> Você foi cadastrado com sucesso</div>';
                                }
                            ?>
                            <!-- Form -->
                            <form method="POST" action="declarar_interesse_minicursos">
                                <h2 class="text-center font-bold deep-orange-text py-4">Cadastro finalizado</h2>

                                <center><img src="<?= base_url('assets/img/progress3.png')?>" width="80%" margin="auto" ></center>

                                <h3 class="text-center font-bold deep-black-text py-4">Entre no seu e-mail para confirmar a inscrição!</h3>

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