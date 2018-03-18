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

                            <?php 
                                if ($this->session->flashdata('erroBanco') == TRUE){
                                    echo '<div class="alert alert-danger"> Ocorreu um erro ao processar o seu cadastro, tente novamente</div>';
                                }
                            ?>
                            <!-- Form -->
                            <form method="POST" action="declarar_interesse_minicursos">
                                <h2 class="text-center font-bold deep-orange-text py-4">Você tem interesse por qual(is) minicurso(s) e/ou oficina(s)?</h2>

                                <center><img src="<?= base_url('assets/img/progress3.png')?>" width="80%" margin="auto" ></center>

                                <h3 class="text-center font-bold deep-black-text py-4">Selecione abaixo o(s) minicurso(s) e oficina(s) que te interessam:</h3>
                                <p><strong>OBS:</strong> Este é somente uma pesquisa que estamos fazendo para que possamos organizar melhor o evento, isto não é uma garantia de vaga. Posteriormente será aberta a inscrição para os minicursos.  </p>

                                <div>
                                    <label for="orangeForm-name3">Selecione os Minicursos:</label><br>
                                    <?php  
                                        foreach ($minicursos as $item){
                                            echo '<input type="checkbox" name="minicursos[]" value="'.$item->id.'"><label for="minicursos[]">'.$item->nome.'</label><br>';
                                        }

                                    ?>
                                </div>

                                <!--INPUTS HIDDEN PARA O INSERT --> 

                                <?php echo '<input id="id_participante" name="id_participante" type="hidden"  value="'.$id_participante.'"' ?>>

                               <div class="text-center">
                                <button class="btn btn-deep-orange">Concluir<i class="fa fa-angle-double-right pl-2" aria-hidden="true"></i></button>
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