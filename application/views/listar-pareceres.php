<section id="main-content">
          <section class="wrapper site-min-height">
            <h2><i class="fa fa-angle-right"></i>Meus Pareceres
            </h2>
            <div class="row mt">
                  <div class="col-md-12">
                      <div class="content-panel">

                          <div class="col-sm-12 message">
                            <?=$mensagens;?>
                          </div>
                          <div class="col-sm-8 message">
                            <form method="POST" action="">
                              <label>Eixos: </label>
                              <select name="eixo" id="eixo" class="form-control" onchange="form.submit()">
                                <option>Todos</option>
                                <?php foreach ($eixos as $key => $eixo) : ?>
                                    <?php $leixos[$eixo['id']] = $eixo['nome'];?>
                                    <option <?=($eixo_selected == $eixo['id']) ? "selected" : ""?> value="<?=$eixo['id']?>"><?=$eixo['nome']?></option>
                                <?php endforeach; ?>
                              </select>
                            </form>
                          </div>
                          <table class="table table-striped table-advance table-hover">
                            <thead>
                              <tr>
                                  <th><i class="fa fa-font"></i> Título</th>
                                  <th class="hidden-phone"><i class="fa fa-date"></i> Data</th>
                                  <?php if($eixo_selected == 0) : ?>
                                    <th class="hidden-phone"><i class="fa fa-date"></i> Eixo</th>
                                  <?php endif;?>
                                  <th></th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php if(count($pareceres) > 0) {?>
                                <?php foreach ($pareceres as $key => $parecer) : ?>
                                  <tr>
                                      <td><?=$parecer['titulo']?></td>
                                      <td><?=date('d/m/Y', strtotime($parecer['data_registro']))?></td>
                                      <?php if($eixo_selected == 0) : ?>
                                        <td><?=$leixos[$parecer['id_eixo']]?></td>
                                      <?php endif;?>
                                      <td>

                                          <button class           ="btn btn-primary btn-xs" 
                                                  data-toggle     ="modal" 
                                                  data-target     ="#modalParecer" 
                                                  data-titulo     ="<?=$parecer['titulo']?>"
                                                  data-file       ="<?=$parecer['arquivo_sem_nome_autor']?>"
                                                  data-idtrab     ="<?=$parecer['id_trabalho']?>"
                                                  >

                                              <i class="fas fa-pencil-alt"></i>Parecer

                                          </button>
                                      </td>
                                  </tr>
                                <?php endforeach; ?>
                              <?php } else{?>
                                <tr><td colspan="2" style="text-align: center;">Nenhum parecer no momento.</td></tr>
                              <?php }?>


                            </tbody>
                          </table>
                      </div>
                  </div>
              </div>
              <?php
              $input[0]['type']  = "file_down";

              $input[0]['label'] = "Modelo de Parecer";

              $input[0]['id']    = "modelo_parecer";

              $input[0]['src']  = base_url('uploads/modelo_parecer.pdf');


              $input[1]['type']  = "file_down";

              $input[1]['id'] = "artigo";

              $input[1]['label'] = "Artigo (sem dados pessoais)";

              $input[1]['src']  = base_url('');


              $input[2]['type']   = "input_file";

              $input[2]['label']  = "Parecer";

              $input[2]['attr']   = array(
                                              'name'        => 'parecer',
                                              'id'          => 'parecer',
                                              'required'    =>  'required',
                                              'class'       => 'form-control');

              $input[3]['type']   = "input_number";

              $input[3]['label']  = "Nota (Digite a nota no formato 4.9)";

              $input[3]['attr']   = array(
                                              'name'        => 'nota',
                                              'id'          => 'nota',
                                              'type'        => 'number',
                                              'required'    =>  'required',
                                              'min'         => 0,
                                              'max'         => 10,
                                              'pattern'     => '\d*',
                                              'step'        => 0.1,
                                              'class'       => 'form-control');

              echo modalForm("modalParecer", "ParecerLabel", "", "formParecer", $input, "multipart/form-data"); 
              ?>

              <div class="modal fade in" id="modalParecerExcluir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLabel">Deletar Diretoria</h4>
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
    $('.modal-footer').before('<div id="justifica" class="form-group"><label class="form-control-label">Justificativa:</label><textarea name="justificativa" rows="10" style="resize: none" class="form-control"></textarea></div>');
    function fechaDivMessage(){
        $('#message').fadeOut('slow');
    }
  $('#nao_aceitar').click(function(event)
  {
    event.preventDefault();
    $('#justifica').show();

    $("input[name=parecer]").prop('disabled', true);
    $("input[name=parecer]").val('');

    $("input[name=nota]").prop('disabled', true);
    $("input[name=nota]").val('');

    $("select[name=status_parecer]").prop('disabled', true);

    $('#justifica textarea').focus();
  })
  $('#modalParecer').on('show.bs.modal', function (event) {

      $('#justifica').text()
      $('#justifica').hide()

      $("input[name=parecer]").prop('disabled', false)
      $("input[name=nota]").prop('disabled', false)
      $("select[name=status_parecer]").prop('disabled', false)

      var button    = $(event.relatedTarget)
      var action    = button.data('type')
      var modal     = $(this)

      modal.find('#nao_aceitar').text("Não dar Parecer")
      modal.find('#mandabala').text("Salvar")

      var id      = button.data('idtrab') // Extract info from data-* attributes
      modal.find('#id').val(id);
      modal.find('#ParecerLabel').text(button.data('titulo'))
      modal.find('#formParecer').attr("action", "<?=base_url('PainelParecerista/insert')?>")
      modal.find('#artigo').attr("href", "<?=base_url('uploads/artigo/')?>" + button.data('file'))
  })

});
</script>