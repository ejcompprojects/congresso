
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
                            <form method="POST" action="cadastro_professor_publica">
                                <h2 class="text-center font-bold deep-orange-text py-4">Cadastro Professor Escolas Publicas</h2>

                                <center><img src="<?= base_url('assets/img/progress2.png')?>" width="80%" margin="auto" ></center>

                                <h3 class="text-center font-bold deep-black-text py-4">Dados da Instituição</h3>

                                <div class="md-form">
                                    <i class="fa fa-user prefix grey-text"></i>
                                    <input type="text" id="escola" name="escola" class="form-control" required="true" minlength="3" maxlength="100">
                                    <label for="orangeForm-name3">Escola</label>
                                </div>

                                
                                <div>
                                    <label for="orangeForm-name3">Selecione os niveis:</label><br>
                                    <input type="checkbox" name="infantil" value="1">Educação Infantil<br>
                                    <input type="checkbox" name="fundamental1" value="2">Fundamental I<br>
                                    <input type="checkbox" name="fundamental2" value="3">Fundamental II<br>
                                    <input type="checkbox" name="medio" value="4">Ensino Médio<br>
                                </div>
                               

                                <!--INPUTS HIDDEN PARA O INSERT --> 

                                <?php echo '<input id="nome" name="nome" type="hidden"  value="'.$nome.'"' ?>>
                                <?php echo '<input id="email" name="email" type="hidden"  value="'.$email.'"' ?>>
                                <?php echo '<input id="celular" name="celular" type="hidden"  value="'.$celular.'"' ?>>
                                <?php echo '<input id="telefone" name="telefone" type="hidden"  value="'.$telefone.'"' ?>>
                                <?php echo '<input id="senha" name="senha" type="hidden"  value="'.$senha.'"' ?>>
                                <?php echo '<input id="cidade" name="cidade" type="hidden"  value="'.$cidade.'"' ?>>
                                <?php echo '<input id="cep" name="cep" type="hidden"  value="'.$cep.'"' ?>>
                                <?php echo '<input id="estado" name="estado" type="hidden"  value="'.$estado.'"' ?>>
                                <?php echo '<input id="id_tipo_inscricao" name="id_tipo_inscricao" type="hidden"  value="'.$id_tipo_inscricao.'"' ?>>
                                <?php echo '<input id="cpf" name="cpf" type="hidden"  value="'.$cpf.'"' ?>>
                                <?php echo '<input id="endereco" name="endereco" type="hidden"  value="'.$endereco.'"' ?>>
                                <?php echo '<input id="bairro" name="bairro" type="hidden"  value="'.$bairro.'"' ?>>
                                <?php echo '<input id="submeter_trabalho" name="submeter_trabalho" type="hidden"  value="'.$submeter_trabalho.'"' ?>>




                               <div class="text-center">
                                <button class="btn btn-deep-orange">Proximo<i class="fa fa-angle-double-right pl-2" aria-hidden="true"></i></button>
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