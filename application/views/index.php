
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
                            <!-- Form -->
                            <form method="POST" action="">
                                <h2 class="text-center font-bold deep-orange-text py-4">Cadastro participante</h2>

                                <h3 class="text-center font-bold deep-black-text py-4">Dados Pessoais</h3>

                                <div class="md-form">
                                    <i class="fa fa-user prefix grey-text"></i>
                                    <input type="text" id="nome" name="nome" class="form-control" required="true" minlength="10" maxlength="100">
                                    <label for="orangeForm-name3">Nome</label>
                                </div>

                                <div class="md-form">
                                    <i class="fa fa-envelope prefix grey-text"></i>
                                    <input type="email" id="email" name="email" class="form-control"  required="true" minlength="10" maxlength="100">
                                    <label for="orangeForm-email3">E-mail</label>
                                </div>

                                <div class="md-form">
                                    <i class="fa fa-lock prefix grey-text"></i>
                                    <input type="password" id="senha" name="senha" class="form-control"  required="true" minlength="6" maxlength="20">
                                    <label for="orangeForm-pass3">Senha</label>
                                </div>

                                <div class="md-form">
                                    <i class="fa fa-repeat prefix grey-text"></i>
                                    <input type="password" id="confirma-senha" name="confirma-senha" class="form-control" required="true" minlength="6" maxlength="20">
                                    <label for="orangeForm-pass3">Confirmar Senha</label>
                                </div>

                                <div class="md-form">
                                    <i class="fa fa-phone-square prefix grey-text"></i>
                                    <input type="text" id="celular" name="celular" class="form-control" required="true" minlength="6" maxlength="20">
                                    <label for="orangeForm-pass3">Celular</label>
                                </div>

                                <div class="md-form">
                                    <i class="fa fa-phone prefix grey-text"></i>
                                    <input type="text" id="telefone" name="telefone" class="form-control">
                                    <label for="orangeForm-pass3">Telefone</label>
                                </div>

                                <h3 class="text-center font-bold deep-black-text py-4">Dados de Endereço</h3>

                                <div class="" role="alert" id="erroCep">
                                </div>
                                <div class="md-form">
                                    <i class="fa fa-map-o prefix grey-text"></i>
                                    <input type="text" id="cep" name="cep" class="form-control" required="true" minlength="9" maxlength="9" onblur="pesquisacep(this.value);">
                                    <label for="orangeForm-pass3">CEP</label>
                                </div>
                                <div id="div_escondida" hidden="true">
                                    <div class="md-form">
                                        <i class="fa fa-home prefix grey-text"></i>
                                        <input type="text" id="rua" name="rua" class="form-control" required="true" minlength="10" maxlength="100">
                                        <label for="orangeForm-pass3">Endereço</label>
                                    </div>

                                    <div class="md-form">
                                        <i class="fa fa-home prefix grey-text"></i>
                                        <input type="text" id="bairro" name="bairro" class="form-control" required="true" minlength="10" maxlength="100">
                                        <label for="orangeForm-pass3">Bairro</label>
                                    </div>

                                    <div class="md-form">
                                        <i class="fa fa-map-marker prefix grey-text"></i>
                                        <input type="text" id="cidade" name="cidade" class="form-control" required="true" minlength="1" maxlength="100" readonly="true">
                                        <label for="orangeForm-pass3">Cidade</label>
                                    </div>
                                    <div class="md-form">
                                        <i class="fa fa-map-marker prefix grey-text"></i>
                                        <input name="uf" type="text" class="form-control" id="uf" size="2" readonly="true"/> 
                                        <label class="mr-sm-2" for="estado">Estado</label><br>
                                    </div>

                                    <div class="md-form">
                                        <i class="fa fa-info prefix grey-text"></i>
                                        <input type="text" id="numero" name="numero" class="form-control" required="true" minlength="1" maxlength="20">
                                        <label for="orangeForm-pass3">Numero</label>
                                    </div>

                                    <div class="md-form">
                                        <i class="fa fa-home prefix grey-text"></i>
                                        <input type="text" id="complemento" name="complemento" class="form-control" required="true" minlength="10" maxlength="100">
                                        <label for="orangeForm-pass3">Complemento</label>
                                    </div>
                                </div>





                                <label class="mr-sm-2" for="tipo"></label>
                                <select class="form-control" id="tipo" name="tipo">
                                 <option selected>Tipo da Inscrição</option>
                                 <option value="1">Aluno Graduação</option>
                                 <option value="2">Aluno Pós-Graduação</option>
                                 <option value="3">Professor Universitário</option>
                                 <option value="4">Professor Ensino Público</option>
                                 <option value="5">Demais Profissionais</option>
                             </select>


                             <div class="text-center">
                                <button class="btn btn-deep-orange">Próximo<i class="fa fa-angle-double-right pl-2" aria-hidden="true"></i></button>
                            </div>
                        </form>
                        <!-- Form -->
                    </div>
                </div>
            </div>

            <div class="text-center darken-grey-text mb-4">
            </div>

        </div>
        <!--modalCep-->
        <div class="modal" id="modalCep" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Loading</h5>

                </div>
                <div class="modal-body">
                    <p style="text-align: center;"><img src="assets/img/loading.gif"></p>
                </div>
            </div>
        </div>
    </div>


</main>
