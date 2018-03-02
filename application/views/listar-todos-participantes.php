<section id="main-content">
  <section class="wrapper site-min-height">
   <h2><i class="fa fa-angle-right"></i><?= $titulo ?>
    
</h2>
<div class="row mt">
  <div class="col-md-12">
    <div class="content-panel">
      <form method="POST" action="" id="pesquisa" name="pesquisa">
        <div class="form-group">
          <div class="col-sm-4">
            <label class="col-sm-12 col-sm-12 control-label">Organizar por</label>
            <?php
            $Attr['type']    = "input_select";

            $Attr['attr']    = array( 'name'      => 'attribute',
              'id'        => 'attribute',
              'class'     =>'form-control round-form',);
            $Attr['options'] = array( 'nome'      => "Nome",
                                      'vai_submeter_trabalho' => "Vai Submeter Trabalho",
                                      'nao_vai_submeter_trabalho' => "Não Submeter Trabalho",
                                      'data_registro'    => 'Data Registro',
                                      'estado' => 'Estado',
                                      
          );

            $Attr['selected']= $filtros['attribute'];

            echo getInput($Attr);
            ?>
          </div>

          <div class="col-sm-4">
            <label class="col-sm-12 col-sm-12 control-label">Tipo de ordenação</label>
            <?php
            $Order['type']    = "input_select";

            $Order['attr']    = array( 'name'   => 'order_by',
             'id'     => 'order_by',
             'class'  =>'form-control round-form',);

            $Order['options'] = array( 'ASC'    => "Alfabética crescente",
             'DESC'   => "Alfabética decrescente",);

            $Order['selected']= $filtros['order_by'];

            echo getInput($Order);
            ?>
          </div>

          <div class="col-sm-4">
            <label class="col-sm-12 col-sm-12 control-label">Quantidade</label>
            <?php
            $Qntd['type']    = "input_select";

            $Qntd['attr']    = array( 'name'  => 'quantidade',
              'id'    => 'quantidade',
              'class' =>'form-control round-form',);

            $Qntd['options'] = array(10 => 10, 20 => 20, 50 => 50, 100 => 100);

            $Qntd['selected']= $filtros['quantidade'];

            echo getInput($Qntd);
            ?>
          </div>

        </div>
        <div class="form-group">

          <div class="col-sm-4">
            <label class="col-sm-12 col-sm-12 control-label">Tipo de Inscrição</label>
            <select class="form-control round-form" name="tipo_inscricao">
              <option value="">Todos</option>
              <option value="1">Aluno Graduação</option>
              <option value="2">Aluno Pós-Graduação</option>
              <option value="3">Professor Universitário</option>
              <option value="4">Professor Ensino Público</option>
              <option value="5">Demais Profissionais</option>
            </select>
          </div>

          <div class="col-sm-4">
            <label class="col-sm-12 col-sm-12 control-label">Pagamento</label>
            <select class="form-control round-form" name="status_inscricao">
              <option value="">Todos</option>
              <option value="0">Em Análise</option>
              <option value="1">Pagamento Aprovado</option>
              <option value="2">Pagamento Recusado</option>
              <option value="3">Não Enviou Comprovante</option>
            </select>
          </div>
          <div class="col-sm-4">
            <label class="col-sm-12 col-sm-12 control-label">Trabalho</label>
            <select class="form-control round-form" name="status_trabalho">
              <option value="">Não usar esse filtro</option>
              <option value="0">Em Análise</option>
              <option value="1">Trabalho Aprovado</option>
              <option value="2">Trabalho Recusado</option>
            </select>
          </div>

        </div>
        <div class="form-group">
          <div class="col-sm-10">
            <br/>
            <?php
            $Search['type']  = "input_text";
            $Search['label'] = "Nome";
            $Search['attr']  = array( 'name'        => 'search_by',
              'id'          => 'search_by',
              'maxlength'   => 255,
              'class'       => 'form-control round-form',
              'placeholder' => 'Pesquisar por nome do participante.');
            echo getInput($Search);
            ?>
          </div>
          <div class="col-sm-2">
            <br/>
            <button type="submit" class="btn col-sm-12 btn-round btn-theme" value="Pesquisar">Pesquisar </button>
          </div>
        </div>
      </form>

      <br><br><br>

      <div class="col-sm-12 message">
        <?= '<br><br><div class="alert alert-info alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> '.$quantidade.' resultado(s) encontrado(s). </div><br>' ?>
        <?php
        ?>
        <?= $mensagens; ?>
      </div>

      <table class="table table-striped table-advance table-hover">
        <thead>

 
          <tr>
            <th><i class="fa fa-font"></i> Nome</th>
            <th><i class="fa fa-book"></i> Tipo Inscrição</th>
            <th><i class="fa fa-file"></i> Enviou Comprovante</th>
            <th><i class="fa fa-file"></i> Status Pagamento</th>
            <th><i class="fa fa-file"></i> Submeter Trabalho</th>
            <th class="hidden-phone"><i class="fa fa-question-circle"></i> Estado</th>
            <th></th>

          </tr>
        
        </thead>
        <tbody>

          <?php 

          foreach ($participantes as $participante) :

            switch($participante->status_inscricao){
              case 0: $participante->status_inscricao = 'Pendente'; break;
              case 1: $participante->status_inscricao = 'Aprovado'; break;
              case 2: $participante->status_inscricao = 'Reprovado'; break;

            }

             switch($participante->status){
              case 0: $participante->status = 'Em Análise'; break;
              case 1: $participante->status = 'Aprovado'; break;
              case 2: $participante->status = 'Reprovado'; break;

            }

            if($participante->foto_comprovante == '') $participante->enviou_comprovante = 'Não';
            else $participante->enviou_comprovante = 'Sim';

            if($participante->submeter_trabalho == 0) $participante->submeter_trabalho = 'Não';
            else $participante->submeter_trabalho = 'Sim'; 
            ?>
            <tr>

              <td><?=$participante->nome ?></td>
              <td><?=$participante->tipo_inscricao ?></td>
              <td><?=$participante->enviou_comprovante ?></td>
              <td><?= $participante->status_inscricao ?></td>
              <td><?= $participante->submeter_trabalho ?></td>
              <td><?= $participante->estado ?></td>

             
              <td>
                <button class           ="btn btn-primary btn-xs" 
                data-toggle     ="modal" 
                data-target     ="#modalParticipante" 
                data-type       ="update"
               
                data-id         ="<?=$participante->id?>" 
                data-nome       ="<?=$participante->nome?>" 
                data-email      ="<?=$participante->email?>"
                data-cpf      ="<?=$participante->cpf?>"
                data-celular      ="<?=$participante->celular?>"
                data-telefone      ="<?=$participante->telefone?>"
                data-endereco      ="<?=$participante->endereco?>"
                data-bairro      ="<?=$participante->bairro?>"
                data-cidade      ="<?=$participante->cidade?>"
                data-estado      ="<?=$participante->estado?>"
                data-cep      ="<?=$participante->cep?>"
                data-submeter_trabalho     ="<?=$participante->submeter_trabalho?>"
                data-enviou_comprovante      ="<?=$participante->enviou_comprovante?>"
                data-foto_comprovante      ="<?=$participante->foto_comprovante?>"
                data-tipo_inscricao      ="<?=$participante->tipo_inscricao?>"
                data-status_inscricao      ="<?=$participante->status_inscricao?>"
                data-data_registro      ="<?=$participante->data_registro?>"
                data-titulo      ="<?=$participante->titulo?>"
                data-eixo      ="<?=$participante->eixo?>"
                data-status      ="<?=$participante->status?>"
                data-arquivo_sem_nome_autor ="<?=$participante->arquivo_sem_nome_autor ?>"
                data-arquivo_com_nome_autor ="<?=$participante->arquivo_com_nome_autor ?>"
                
                >

                <i class="fa fa-eye"></i>

              </button>

                                        <!--   <button class="btn btn-danger btn-xs"
                                                  data-toggle ="modal"
                                                  data-target ="#modalPiretoriaExcluir"
                                                  data-id     ="<?=$participante->id?>"  >
                                              <i class="fa fa-trash-o "></i>
                                            </button> -->

                                          </td>
                                        </tr>
                                      <?php endforeach;
                                      ?>
                                    </tbody>
                                  </table>
                                  <?php echo $paginacao; ?>
                                </div>
                              </div>
                            </div>
                            <?php
                            //if($funcao == 'listar_pagamento_analisar'){
                              $input[0]['type']  = "input_text";

                              $input[0]['label'] = "Nome";

                              $input[0]['attr']  = array(
                                'name'        => 'nome',
                                'id'          => 'nome',
                                'maxlength'   => 255,
                                'disabled'    => true,
                                'class'       => 'form-control',);

                              $input[1]['type']  = "input_text";

                              $input[1]['label'] = "E-mail";

                              $input[1]['attr']  = array(
                                'name'        => 'email',
                                'id'          => 'email',
                                'maxlength'   => 255,
                                'disabled'    => true,
                                'class'       => 'form-control',);


                              $input[2]['type']  = "input_text";

                              $input[2]['label'] = "CPF";

                              $input[2]['attr']  = array(
                                'name'        => 'cpf',
                                'id'          => 'cpf',
                                'maxlength'   => 255,
                                'disabled'    => true,
                                'class'       => 'form-control',);

                              $input[3]['type']  = "input_text";

                              $input[3]['label'] = "Celular";

                              $input[3]['attr']  = array(
                                'name'        => 'celular',
                                'id'          => 'celular',
                                'maxlength'   => 255,
                                'disabled'    => true,
                                'class'       => 'form-control',);


                              $input[4]['type']  = "input_text";

                              $input[4]['label'] = "Telefone";

                              $input[4]['attr']  = array(
                                'name'        => 'telefone',
                                'id'          => 'telefone',
                                'maxlength'   => 255,
                                'disabled'    => true,
                                'class'       => 'form-control',);

                              $input[5]['type']  = "input_text";

                              $input[5]['label'] = "endereco";

                              $input[5]['attr']  = array(
                                'name'        => 'endereco',
                                'id'          => 'endereco',
                                'maxlength'   => 255,
                                'disabled'    => true,
                                'class'       => 'form-control',);

                              $input[6]['type']  = "input_text";

                              $input[6]['label'] = "Bairro";

                              $input[6]['attr']  = array(
                                'name'        => 'bairro',
                                'id'          => 'bairro',
                                'maxlength'   => 255,
                                'disabled'    => true,
                                'class'       => 'form-control',);

                              $input[7]['type']  = "input_text";

                              $input[7]['label'] = "cidade";

                              $input[7]['attr']  = array(
                                'name'        => 'cidade',
                                'id'          => 'cidade',
                                'maxlength'   => 255,
                                'disabled'    => true,
                                'class'       => 'form-control',);


                              $input[8]['type']  = "input_text";

                              $input[8]['label'] = "estado";

                              $input[8]['attr']  = array(
                                'name'        => 'estado',
                                'id'          => 'estado',
                                'maxlength'   => 255,
                                'disabled'    => true,
                                'class'       => 'form-control',);

                              $input[9]['type']  = "input_text";

                              $input[9]['label'] = "cep";

                              $input[9]['attr']  = array(
                                'name'        => 'cep',
                                'id'          => 'cep',
                                'maxlength'   => 255,
                                'disabled'    => true,
                                'class'       => 'form-control',);



                             


                              $input[10]['type']  = "input_text";

                              $input[10]['label'] = "Tipo Inscrição";

                              $input[10]['attr']  = array(
                                'name'        => 'tipo_inscricao',
                                'id'          => 'tipo_inscricao',
                                'maxlength'   => 255,
                                'disabled'    => true,
                                'class'       => 'form-control',);

                              $input[11]['type']  = "input_text";

                              $input[11]['label'] = "Enviou Comprovante";

                              $input[11]['attr']  = array(
                                'name'        => 'enviou_comprovante',
                                'id'          => 'enviou_comprovante',
                                'maxlength'   => 255,
                                'disabled'    => true,
                                'class'       => 'form-control',);

                              $input[12]['type']  = "image";

                              $input[12]['label'] = "Foto Comprovante";

                              $input[12]['attr']  = array(
                                'name'        => 'foto_comprovante',
                                'id'          => 'foto_comprovante',
                                'maxlength'   => 255,
                                'class'       => 'form-control',);
                            
                               $input[13]['type']  = "input_text";

                              $input[13]['label'] = "Status Inscrição";

                              $input[13]['attr']  = array(
                                'name'        => 'status_inscricao',
                                'id'          => 'status_inscricao',
                                'maxlength'   => 255,
                                'disabled'    => true,
                                'class'       => 'form-control',);

                             $input[14]['type']  = "input_text";

                              $input[14]['label'] = "Submeter Trabalho";

                              $input[14]['attr']  = array(
                                'name'        => 'submeter_trabalho',
                                'id'          => 'submeter_trabalho',
                                'maxlength'   => 255,
                                'disabled'    => true,
                                'class'       => 'form-control',);

                           
                              $input[15]['type']  = "input_text";

                              $input[15]['label'] = "Titulo";
                              $input[15]['attr']  = array(
                                'name'        => 'titulo',
                                'id'          => 'titulo',
                                'maxlength'   => 255,
                                'disabled'    => true,
                                'class'       => 'form-control',);

                              $input[16]['type']  = "input_text";

                              $input[16]['label'] = "Eixo";
                              $input[16]['attr']  = array(
                                'name'        => 'eixo',
                                'id'          => 'eixo',
                                'maxlength'   => 255,
                                'disabled'   => true,
                                'class'       => 'form-control',);

                              

                              $input[17]['type']  = "input_text";

                              $input[17]['label'] = "Data de Anexo do Trabalho";
                              $input[17]['attr']  = array(
                                'name'        => 'data_registro',
                                'id'          => 'data_registro',
                                'maxlength'   => 255,
                                'disabled'    => true,
                                'class'       => 'form-control',);

                              $input[18]['type']  = "input_text";

                              $input[18]['label'] = "Status do Trabalho";
                              $input[18]['attr']  = array(
                                'name'        => 'status',
                                'id'          => 'status',
                                'maxlength'   => 255,
                                'disabled'    => true,
                                'class'       => 'form-control',);

                              $input[19]['type'] = 'link';

                              $input[19]['label'] = 'Trabalho SEM o autor';
                              $input[19]['attr']  = array(
                                'name'        => 'arquivo_sem_nome_autor',
                                'id'          => 'arquivo_sem_nome_autor',
                              );

                              $input[20]['type'] = 'link';

                              $input[20]['label'] = 'Trabalho COM o autor';
                              $input[20]['attr']  = array(
                                'name'        => 'arquivo_com_nome_autor',
                                'id'          => 'arquivo_com_nome_autor',
                              );
                            



                            echo modalForm("modalParticipante", "participanteLabel", "", "formParticipante", $input); 

                            ?>

                            <div class="modal fade in" id="modalParticipanteExcluir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h4 class="modal-title" id="exampleModalLabel">Deletar Participante</h4>
                                  </div>
                                  <div class="modal-body">
                                    <div class="form-group">
                                      <p>Tem certeza que desaja excluir o registro?</p>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <a href="" id="linkdelete" class="btn btn-round btn-theme">Excluir </a>
                                    <button type="button" class="btn btn-round btn-secundary" data-dismiss="modal"> Fechar </button>
                                  </div>
                                </div>
                              </div>
                            </div>

                          </section>
                        </section>

                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                        <script type="text/javascript">
                          $(document).ready(function () {
                            function fechaDivMessage(){
                              $('#message').fadeOut('slow');
                            }

                            $('#modalParticipante').on('show.bs.modal', function (event) {
                              var button    = $(event.relatedTarget)
                              var action    = button.data('type')
                              var modal = $(this)

                              if(action == "new")
                              {
                                modal.find('#ParticipanteLabel').text("Nova Participante")
                                modal.find('#mandabala').text("Salvar")
                                modal.find('#id').hide()
                                modal.find('#formParticipante').attr("action", "<?=base_url('Participante/insert')?>")
                                modal.find('#id').val("")
                                modal.find('#nome').val("")
                                modal.find('#descricao').val("")
                              }
                              else if(action == "update")
                              {


                             
          var id      = button.data('id') // Extract info from data-* attributes
          //modal.find('#ParticipanteLabel').text("Validar Comprovante de Pagamento")
          modal.find('#mandabala').text("Aceitar")
          modal.find('#id').show()
          modal.find('#formParticipante').attr("action", "<?=base_url('Participante/confirmar_comprovante_pagamento/')?>"+id)

          modal.find('#nao_aceitar').text('Recusar')
          modal.find('#nao_aceitar').attr('href', "<?= base_url('Participante/recusar_comprovante_pagamento/')?>"+id)


          var id        = button.data('id')
          var nome      = button.data('nome')
          var email     = button.data('email')
          var cpf       = button.data('cpf')
          var celular   = button.data('celular')
          var telefone  = button.data('telefone')
          var endereco  = button.data('endereco')
          var bairro    = button.data('bairro')
          var cidade    = button.data('cidade')
          var estado    = button.data('estado')
          var cep       = button.data('cep')
          var submeter_trabalho = button.data('submeter_trabalho')
          var foto_comprovante = button.data('foto_comprovante')
          var enviou_comprovante = button.data('enviou_comprovante')
          var tipo_inscricao = button.data('tipo_inscricao')
          var status_inscricao = button.data('status_inscricao')


          var titulo    = button.data('titulo')
          var arquivo_sem_nome_autor        = button.data('arquivo_sem_nome_autor')
          var arquivo_com_nome_autor        = button.data('arquivo_com_nome_autor')
          var eixo        = button.data('eixo')
          var status = button.data('status')
          var data_registro  = button.data('data_registro')

         

          modal.find('#id').val(id)
          modal.find('#nome').val(nome)
          modal.find('#email').val(email)
          modal.find('#cpf').val(cpf)
          modal.find('#celular').val(celular)
          modal.find('#telefone').val(telefone)
          modal.find('#endereco').val(endereco)
          modal.find('#bairro').val(bairro)
          modal.find('#cidade').val(cidade)
          modal.find('#estado').val(estado)
          modal.find('#cep').val(cep)
          modal.find('#submeter_trabalho').val(submeter_trabalho)
          modal.find('#tipo_inscricao').val(tipo_inscricao)
          modal.find('#status_inscricao').val(status_inscricao)
          modal.find('#enviou_comprovante').val(enviou_comprovante)
          modal.find('#foto_comprovante').attr('src', '<?=base_url('uploads/comprovante/') ?>' + foto_comprovante)


          if(titulo == ''){ //quer dizer que o usu´rio não submeteu o artigo
            
            modal.find('#titulo').parent().hide();
            modal.find('#arquivo_sem_nome_autor').parent().parent().hide();
            modal.find('#arquivo_com_nome_autor').parent().parent().hide();
            modal.find('#eixo').parent().hide();
            modal.find('#status').parent().hide();
            modal.find('#data_registro').parent().hide();

          }else{
            modal.find('#titulo').val(titulo)
            modal.find('#arquivo_sem_nome_autor').attr('href', '<?= base_url('uploads/artigo/') ?>'+arquivo_sem_nome_autor)
            modal.find('#arquivo_com_nome_autor').attr('href', '<?= base_url('uploads/artigo/') ?>'+arquivo_com_nome_autor)
            modal.find('#eixo').val(eixo)
            modal.find('#status').val(status)
            modal.find('#data_registro').val(data_registro)
            
          }


          <?php //} ?>

          
        }
      })

$('#modalParticipanteExcluir').on('show.bs.modal', function (event) {
      var button  = $(event.relatedTarget) // Button that triggered the modal
      var id      = button.data('id') // Extract info from data-* attributes
      var link    = "<?=base_url('Participante/delete/')?>" + id
      var modal = $(this)
      modal.find('#linkdelete').attr("href", link);
      modal.find('#nome').val(nome)
      modal.find('#descricao').val(descricao)
    })

});
</script>