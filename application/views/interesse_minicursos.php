
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
                            ?>
                            <!-- Form -->
                            <form method="POST" action="declarar_interesse_minicursos">
                                <h2 class="text-center font-bold deep-orange-text py-4">Declarar Interesse por minicursos</h2>

                                <center><img src="<?= base_url('assets/img/progress3.png')?>" width="80%" margin="auto" ></center>

                                <h3 class="text-center font-bold deep-black-text py-4">Utilizado para fins organizacionais, Nâo garante vaga!</h3>

                                <div>
                                    <label for="orangeForm-name3">Selecione os Minicursos:</label><br>
                                    <?php  
                                        foreach ($minicursos as $item){
                                            echo '<input type="checkbox" name="minicursos[]" value="'.$item->id.'">'.$item->nome.'<br>';
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