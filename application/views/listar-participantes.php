<section id="main-content">
          <section class="wrapper site-min-height">
          	<h2><i class="fa fa-angle-right"></i>Listagem de Participantes
                <button class       ="btn btn-primary btn-xs" 
                        data-toggle ="modal" 
                        data-target ="#modalParticipante" 
                        data-type   ="new"
                >
                  <i class="fa fa-new"></i>Novo
                </button>
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
                                                                'descricao' => "Descrição",);

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
                            if($this->session->flashdata('success') == TRUE){
                              echo '<br><br><div class="alert alert-success alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <strong>Sucesso!</strong> Operação realizada com sucesso! </div><br>'; 
                            }
                            ?>
                          </div>

                          <table class="table table-striped table-advance table-hover">
                            <thead>
                              <tr>
                                  <th><i class="fa fa-font"></i> Nome</th>
                                  <th><i class="fa fa-book"></i> Tipo Inscrição</th>
                                  <th class="hidden-phone"><i class="fa fa-question-circle"></i> Estado</th>
                                  <th><i class="fa fa-signal"></i> Status</th>
                                  <th></th>

                              </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($participantes as $participante) : ?>
                                  <?php 
                                    switch($participante->status_inscricao){
                                      case 0: $participante->status_inscricao = 'Pendente'; break;
                                      case 1: $participante->status_inscricao = 'Aprovado'; break;
                                      case 2: $participante->status_inscricao = 'Reprovado'; break;
                                     
                                    }
                                  ?>
                                  <tr>
                                      <td><?=$participante->nome ?></td>
                                      <td><?=$participante->tipo ?></td>
                                      <td><?=$participante->estado ?></td>
                                      <td><?= $participante->status_inscricao ?></td>
                                      <td>

                                          <button class           ="btn btn-primary btn-xs" 
                                                  data-toggle     ="modal" 
                                                  data-target     ="#modalParticipante" 
                                                  data-type       ="update"
                                                  data-id         ="<?=$participante->id?>" 
                                                  data-nome       ="<?=$participante->nome?>" 
                                                  data-estado     ="<?=$participante->estado?>"
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
                                <?php endforeach; ?>
                            </tbody>
                          </table>
                          <?php echo $paginacao; ?>
                      </div>
                  </div>
              </div>
              <?php
              $input[0]['type']  = "input_text";

              $input[0]['label'] = "Nome";

              $input[0]['attr']  = array(
                                        'name'        => 'nome',
                                        'id'          => 'nome',
                                        'maxlength'   => 255,
                                        'class'       => 'form-control',);


              $input[1]['type']   = "input_textarea";

              $input[1]['label']  = "Descrição";

              $input[1]['attr']   = array(
                                              'name'        => 'descricao',
                                              'id'          => 'descricao',
                                              'maxlength'   =>  255,
                                              'row'         =>  12,
                                              'class'       => 'form-control',
                                              'style'       => 'resize: none;');


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
        modal.find('#ParticipanteLabel').text("Validar Comprovante de Pagamento")
        modal.find('#mandabala').text("Confirmar")
        modal.find('#id').show()
        modal.find('#formParticipante').attr("action", "<?=base_url('Participante/confirmar_comprovante_pagamento')?>")

        var id        = button.data('id')
        var nome      = button.data('nome')
        var email     = button.data('email')
        var cpf       = button.data('cpf')
        var celular   = button.data('celular')
        var telefone  = button.data('telefone')
        var endereco  = button.data('endereco')
        var bairro    = button.data('bairro')
        var complemento = button.data('complemento')
        var cidade    = button.data('cidade')
        var estado    = button.data('estado')
        var cep       = button.data('cep')
        var submeter_trabalho = button.data('submeter_trabalho')
        var foto_comprovante = button.data('foto_comprovante')
        var tipo_inscricao = button.data('tipo_inscricao')
        var status_inscricao = button.data('status_inscricao')


        modal.find('#id').val(id)
        modal.find('#nome').val(nome)
        modal.find('#email').val(email)
        modal.find('#cpf').val(cpf)
        modal.find('#celular').val(celular)
        modal.find('#telefone').val(telefone)
        modal.find('#endereco').val(endereco)
        modal.find('#bairro').val(bairro)
        modal.find('#complemento').val(complemento)
        modal.find('#cidade').val(cidade)
        modal.find('#estado').val(estado)
        modal.find('#cep').val(cep)
        modal.find('#submeter_trabalho').val(submeter_trabalho)
        modal.find('#foto_comprovante').val(foto_comprovante)
        modal.find('#tipo_inscricao').val(tipo_inscricao)
        modal.find('#status_inscricao').val(status_inscricao)
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