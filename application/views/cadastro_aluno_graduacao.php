
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

                                if ($this->session->flashdata('Cadastrado') == TRUE){
                                    echo '<div class="alert alert-success"> Você foi cadastrado com sucesso</div>';
                                }
                            ?>
                            <!-- Form -->
                            <form method="POST" action="cadastro_aluno_graduacao">
                                <h2 class="text-center font-bold deep-orange-text py-4">Cadastro Aluno Graduação</h2>

                                <center><img src="<?= base_url('assets/img/progress2.png')?>" width="80%" margin="auto" ></center>

                                <h3 class="text-center font-bold deep-black-text py-4">Dados da Graduação</h3>

                                <div class="md-form">
                                    <i class="fa fa-user prefix grey-text"></i>
                                    <input type="text" id="instituicao" name="instituicao" class="form-control" required="true" minlength="3" maxlength="100">
                                    <label for="instituicao">Instituição</label>
                                </div>

                                <div class="md-form">
                                    <i class="fa fa-envelope prefix grey-text"></i>
                                    <input type="text" id="cidade_instituicao" name="cidade_instituicao" class="form-control"  required="true" minlength="3" maxlength="100">
                                    <label for="cidade_instituicao">Cidade da Instituição</label>
                                </div>

                                <div class="md-form">
                                <label class="mr-sm-2" for="tipo"></label>
                                <select class="form-control" id="uf" name="uf" required="">
                                   <option value="">Estado da Instituição</option>
                                    <option>AC</option>
                                    <option>AL</option>
                                    <option>AP</option>
                                    <option>AM</option>
                                    <option>BA</option>
                                    <option>CE</option>
                                    <option>DF</option>
                                    <option>ES</option>
                                    <option>GO</option>
                                    <option>MA</option>
                                    <option>MT</option>
                                    <option>MS</option>
                                    <option>MG</option>
                                    <option>PA</option>
                                    <option>PB</option>
                                    <option>PR</option>
                                    <option>PE</option>
                                    <option>PI</option>
                                    <option>RJ</option>
                                    <option>RN</option>
                                    <option>RS</option>
                                    <option>RO</option>
                                    <option>RR</option>
                                    <option>SC</option>
                                    <option>SP</option>
                                    <option>SE</option>
                                    <option>TO</option>
                               </select>
                               </div>

                                <div class="md-form">
                                    <i class="fa fa-envelope prefix grey-text"></i>
                                    <input type="text" id="curso" name="curso" class="form-control"  required="true" minlength="3" maxlength="100">
                                    <label for="curso">Curso</label>
                                </div>

                                 <div class="md-form">
                                    <i class="fa fa-envelope prefix grey-text"></i>
                                    <input type="text" id="semestre" name="semestre" class="form-control"  required="true" minlength="3" maxlength="100">
                                    <label for="semestre">Semestre</label>
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
                        <form method="POST" action="voltar_cadastro"> 
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
                                <button class="btn btn-deep-orange"><i class="fa fa-angle-double-left pl-2" aria-hidden="true"></i> Voltar</button>
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