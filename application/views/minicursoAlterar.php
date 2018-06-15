<section id="main-content">
          <section class="wrapper site-min-height">
            <h2><i class="fa fa-angle-right"></i>Meus Pareceres
            </h2>
            <div class="row mt" style="margin-top: 0px;">
                    <!--
                    <div class="col-sm-12 message">
                    <?=$mensagens;?>
                    </div>-->
                    <div class="form-panel">
                        <form method="POST" action="<?=base_url('Minicursos/atualizar/'.$minicurso['id'])?>">
                            <div class="form-group">
                                <label>Nome para minicurso: </label>
                                <input type="text" name="nome" class="form-control" value="<?=$minicurso['nome']?>">
                            </div>
                            <div class="form-group">
                                <label>Dia:</label>
                                <input type="date" name="dia" class="form-control" value="<?=$minicurso['dia']?>">
                            </div>
                            <div class="form-group">
                                <label>Horario de inicio:</label>
                                <input type="time" name="horario_ini" class="form-control" value="<?=$minicurso['horario_inicio']?>">
                            </div>
                            <div class="form-group">
                                <label>Horario de termino:</label>
                                <input type="time" name="horario_enc" class="form-control" value="<?=$minicurso['horario_fim']?>">
                            </div>
                            <div class="form-group">
                                <label>Vagas Normais:</label>
                                <input type="number" name="vagas_norm" class="form-control" value="<?=$minicurso['limite_vagas']?>">
                            </div>
                            <div class="form-group">
                                <label>Vagas SEDUC:</label>
                                <input type="number" name="vagas_seduc" class="form-control" value="<?=$minicurso['limite_vagas_seduc']?>">
                            </div>
                            <div class="form-group">
                                <label>Descrição:</label>
                                <input type="text" name="descricao" class="form-control" value="<?=$minicurso['descricao']?>">
                            </div>
                            <div class="form-group">
                                <label>Palestrante:</label>
                                <input type="text" name="palestrante" class="form-control" value="<?=$minicurso['convidado']?>">
                            </div>
                            <input type="submit" name="" class="btn btn-theme" value="Alterar Minicurso">
                        </form>
                    </div>
              </div>
              <?php
              $input[0]['type']  = "file_down";

              $input[0]['label'] = "Modelo de Parecer";

              $input[0]['id']    = "modelo_parecer";

              $input[0]['src']  = base_url('uploads/modelo_parecer.doc');


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