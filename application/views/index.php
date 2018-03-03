
<body class="hm-gradient"> 
    <body class="hm-gradient">
        <script type="text/javascript" src="assets/js/preencheCep.js"></script>
         <script type="text/javascript" src="assets/js/jquery.mask.js"></script>
          <script type="text/javascript" src="assets/js/mascara.js"></script>
        <main>
            <div class="container">

                <div class="text-center darken-grey-text mb-4">
                </div>

                <div class="col-md-6 col-centered">
                    <div class="card">
                        <div class="card-body">
                            <?php 
                                if ($this->session->flashdata('senhasDiferentes') == TRUE){
                                    echo '<div class="alert alert-danger"> Senhas digitadas são diferentes!</div>';
                                }
                                if ($this->session->flashdata('cadastrado') == TRUE){
                                    echo '<div class="alert alert-success"> Você foi cadastrado com sucesso</div>';
                                }
                                if ($this->session->flashdata('emailCadastrado') == TRUE){
                                    echo '<div class="alert alert-danger">Este e-mail ja foi cadastrado!</div>';
                                }
                                if ($this->session->flashdata('cpfCadastrado') == TRUE){
                                    echo '<div class="alert alert-danger">Este CPF ja foi cadastrado!</div>';
                                }

                            ?>
                            <!-- Form -->
                            <form method="POST" action="home/cadastrar">
                                <h2 class="text-center font-bold deep-orange-text py-4">Cadastro participante</h2>

                                <center><img src="<?= base_url('assets/img/progress1.png')?>" width="80%" margin="auto" ></center>

                                <h3 class="text-center font-bold deep-black-text py-4">Dados Pessoais</h3>

                                <div class="md-form">
                                    <i class="fa fa-user prefix grey-text"></i>
                                    <input type="text" id="nome" name="nome" class="form-control" required="true" minlength="2" maxlength="100">
                                    <label for="orangeForm-name3">Nome Completo</label>
                                </div>

                                <div class="md-form">
                                    <i class="fa fa-id-card prefix grey-text"></i>
                                    <input type="text" id="cpf" name="cpf" class="form-control" required="true" minlength="2" maxlength="15">
                                    <label for="orangeForm-name3">CPF</label>
                                </div>

                                <div class="md-form">
                                    <i class="fa fa-envelope prefix grey-text"></i>
                                    <input type="email" id="email" name="email" class="form-control"  required="true" minlenght="5" maxlength="100">
                                    <label for="orangeForm-email3">E-mail</label>
                                </div>

                                <div class="md-form">
                                    <i class="fa fa-lock prefix grey-text"></i>
                                    <input type="password" id="senha" name="senha" class="form-control"  required="true" minlength="6" maxlength="30">
                                    <label for="orangeForm-pass3">Senha</label>
                                </div>

                                <div class="md-form">
                                    <i class="fa fa-repeat prefix grey-text"></i>
                                    <input type="password" id="confirma-senha" name="confirma-senha" class="form-control" required="true" minlength="6" maxlength="30">
                                    <label for="orangeForm-pass3">Confirmar Senha</label>
                                </div>

                                <div class="md-form">
                                    <i class="fa fa-mobile prefix grey-text"></i>
                                    <input type="text" id="celular" name="celular" class="form-control" required="true" maxlength="15">
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
                                    <input type="text" id="cep" name="cep" class="form-control" required="true" minlength="8" maxlength="9" onblur="pesquisacep(this.value);">
                                    <label for="orangeForm-pass3">CEP</label>
                                </div>
                                <div id="div_escondida" hidden="true">
                                    <div class="md-form">
                                        <i class="fa fa-home prefix grey-text"></i>
                                        <input type="text" id="rua" name="rua" class="form-control" required="true" minlength="3" maxlength="50">
                                        <label for="orangeForm-pass3">Endereço</label>
                                    </div>

                                    <div class="md-form">
                                        <i class="fa fa-home prefix grey-text"></i>
                                        <input type="text" id="bairro" name="bairro" class="form-control" required="true" minlength="3" maxlength="50">
                                        <label for="orangeForm-pass3">Bairro</label>
                                    </div>

                                    <div class="md-form">
                                        <i class="fa fa-map-marker prefix grey-text"></i>


                                        <input type="text" id="cidade" name="cidade" class="form-control" required="true" minlength="1" maxlength="100">
                                        <label for="orangeForm-pass3">Cidade</label>
                                    </div>
                                    <select class="form-control" id="estado" name="estado">
                                    

                                        <option value="">Selecione um Estado</option>

                                        <option value="AC">Acre</option> 
                                        <option value="AL">Alagoas</option> 
                                        <option value="AP">Amapá</option> 
                                        <option value="AM">Amazonas</option> 
                                        <option value="BA">Bahia</option> 
                                        <option value="CE">Ceará</option> 
                                        <option value="DF">Distrito Federal</option> 
                                        <option value="ES">Espírito Santo</option> 
                                        <option value="GO">Goiás</option> 
                                        <option value="MA">Maranhão</option> 
                                        <option value="MT">Mato Grosso</option> 
                                        <option value="MS">Mato Grosso do Sul</option> 
                                        <option value="MG">Minas Gerais</option> 
                                        <option value="PA">Pará</option> 
                                        <option value="PB">Paraíba</option> 
                                        <option value="PR">Paraná</option> 
                                        <option value="PE">Pernambuco</option> 
                                        <option value="PI">Piauí</option> 
                                        <option value="RJ">Rio de Janeiro</option> 
                                        <option value="RN">Rio Grande do Norte</option> 
                                        <option value="RS">Rio Grande do Sul</option> 
                                        <option value="RO">Rondônia</option> 
                                        <option value="RR">Roraima</option> 
                                        <option value="SC">Santa Catarina</option> 
                                        <option value="SP">São Paulo</option> 
                                        <option value="SE">Sergipe</option> 
                                        <option value="TO">Tocantins</option> 
                                    </select> 


                                    
                                    <label class="mr-sm-2" for="tipo"></label>
                                        <select class="form-control" id="submeter_trabalho" name="submeter_trabalho" required="">
                                            <option value="">Ira submeter Trabalhos/Artigos?</option>
                                            <option value="1">Sim</option>
                                            <option value="0">Não</option>
                                        </select>
                                    


                                    <label class="mr-sm-2" for="tipo"></label>
                                    <select class="form-control" id="tipo" name="tipo" required="">
                                       <option value="">Tipo da Inscrição</option>
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
