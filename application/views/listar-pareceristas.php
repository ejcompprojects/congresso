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
            <div class="col-sm-10">
              <br/>
              <?php
              $Search['type']  = "input_text";
              $Search['label'] = "Nome";
              $Search['attr']  = array( 'name'        => 'search_by',
                'id'          => 'search_by',
                'maxlength'   => 255,
                'class'       => 'form-control round-form',
                'placeholder' => 'Pesquisar por nome do parecerista.');
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
              <th><i class="fa fa-info"></i> ID</th>
              <th><i class="fa fa-font"></i> Nome</th>
              <th><i class="fa fa-book"></i> CPF</th>
              <th class="hidden-phone"><i class="fa fa-question-circle"></i> Instituição</th>
              <th><i class="fa fa-signal"></i> Status</th>
              <th></th>

            </tr>
          </thead>
          <tbody>

            <?php 

            foreach ($parecerista as $parecerista) :

              switch($parecerista->status_inscricao){
                case 0: $parecerista->status_inscricao = 'Pendente'; break;
                case 1: $parecerista->status_inscricao = 'Aprovado'; break;
                case 2: $parecerista->status_inscricao = 'Reprovado'; break;

              }
              ?>
              <tr>
              <td><?=$parecerista->id?></td>
              <td><?=$parecerista->nome?></td>
              <td><?=$parecerista->cpf?></td>
              <td><?=$parecerista->instituicao?></td>
              <td><?= $parecerista->status_inscricao ?></td>
              <td>
                <button class           ="btn btn-primary btn-xs" 
                data-toggle     ="modal" 
                data-target     ="#modalParecista" 
                data-type       ="update"
                <?php if($funcao == 'listar_analisar'){ ?>
                data-id         ="<?=$parecerista->id?>" 
                data-registro   = "<?=$parecerista->data_registro = date('d/m/Y', strtotime($parecerista->data_registro))?>"
                data-nome       ="<?=$parecerista->nome?>" 
                data-email      ="<?=$parecerista->email?>"
                data-cpf      ="<?=$parecerista->cpf?>"
                data-celular      ="<?=$parecerista->celular?>"
                data-telefone      ="<?=$parecerista->telefone?>"
                data-instituicao     ="<?=$parecerista->instituicao?>"
                data-eixo     ="<?=$parecerista->nome_eixo?>"

                
                <?php } ?>
                <?php if($funcao == 'listar_trabalho_analisar'){ ?>


                <?php } ?>
                >

                <i class="fa fa-eye"></i>

              </button>
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
if($funcao == 'listar_analisar'){

 $input[0]['type']  = "input_text";

 $input[0]['label'] = "Data de Registro";

 $input[0]['attr']  = array(
  'name'        => 'registro',
  'id'          => 'registro',
  'maxlength'   => 255,
  'disabled'    => true,
  'class'       => 'form-control',);

 $input[1]['type']  = "input_text";

 $input[1]['label'] = "Nome";

 $input[1]['attr']  = array(
  'name'        => 'nome',
  'id'          => 'nome',
  'maxlength'   => 255,
  'disabled'    => true,
  'class'       => 'form-control',);

 $input[2]['type']  = "input_text";

 $input[2]['label'] = "Email";

 $input[2]['attr']  = array(
  'name'        => 'email',
  'id'          => 'email',
  'maxlength'   => 255,
  'disabled'    => true,
  'class'       => 'form-control',);


 $input[3]['type']  = "input_text";

 $input[3]['label'] = "CPF";

 $input[3]['attr']  = array(
  'name'        => 'cpf',
  'id'          => 'cpf',
  'maxlength'   => 255,
  'disabled'    => true,
  'class'       => 'form-control',);

 $input[4]['type']  = "input_text";

 $input[4]['label'] = "Celular";

 $input[4]['attr']  = array(
  'name'        => 'celular',
  'id'          => 'celular',
  'maxlength'   => 255,
  'disabled'    => true,
  'class'       => 'form-control',);


 $input[5]['type']  = "input_text";

 $input[5]['label'] = "Telefone";

 $input[5]['attr']  = array(
  'name'        => 'telefone',
  'id'          => 'telefone',
  'maxlength'   => 255,
  'disabled'    => true,
  'class'       => 'form-control',);

 $input[6]['type']  = "input_text";

 $input[6]['label'] = "Instituição";

 $input[6]['attr']  = array(
  'name'        => 'instituicao',
  'id'          => 'instituicao',
  'maxlength'   => 255,
  'disabled'    => true,
  'class'       => 'form-control',); 

 $input[7]['type']  = "input_text";

 $input[7]['label'] = "Eixo";

 $input[7]['attr']  = array(
  'name'        => 'eixo',
  'id'          => 'eixo',
  'maxlength'   => 255,
  'disabled'    => true,
  'class'       => 'form-control',); 
}

echo modalForm("modalParecista", "pareceristaLabel", "", "formParticipante", $input); 

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

    $('#modalParecista').on('show.bs.modal', function (event) {
      var button    = $(event.relatedTarget)
      var action    = button.data('type')
      var modal = $(this)

      if(action == "new")
      {
        modal.find('#PareceristaLabel').text("Nova Participante")
        modal.find('#mandabala').text("Salvar")
        modal.find('#id').hide()
        modal.find('#formParticipante').attr("action", "<?=base_url('Participante/insert')?>")
        modal.find('#id').val("")
        modal.find('#nome').val("")
        modal.find('#descricao').val("")
      }
      else if(action == "update")
      {


        <?php if($funcao == 'listar_analisar'){ ?>
          var id      = button.data('id') // Extract info from data-* attributes
          modal.find('#PareceristaLabel').text("Validar Comprovante de Pagamento")
          modal.find('#mandabala').text("Aprovar")
          modal.find('#id').show()
          modal.find('#formParticipante').attr("action", "<?=base_url('Parecerista/aprovar_parecerista/')?>"+id)

          modal.find('#nao_aceitar').text('Reprovar')
          modal.find('#nao_aceitar').attr('href', "<?= base_url('Parecerista/reprovar_parecerista/')?>"+id)


          var id        = button.data('id')
          var data_registro = button.data('registro')
          var nome      = button.data('nome')
          var email     = button.data('email')
          var cpf       = button.data('cpf')
          var celular   = button.data('celular')
          var telefone  = button.data('telefone')
          var instituicao = button.data('instituicao')
          var eixo = button.data('eixo')

          modal.find('#id').val(id)
          modal.find('#registro').val(data_registro)
          modal.find('#nome').val(nome)
          modal.find('#email').val(email)
          modal.find('#cpf').val(cpf)
          modal.find('#celular').val(celular)
          modal.find('#telefone').val(telefone)
          modal.find('#instituicao').val(instituicao)
          modal.find('#eixo').val(eixo);
        <?php } ?>
        <?php if($funcao == 'listar_trabalho_analisar'){ ?>
          var id      = button.data('id') // Extract info from data-* attributes
          modal.find('#mandabala').text("Aceitar")
          modal.find('#id').show()
          modal.find('#formParticipante').attr("action", "<?=base_url('Participante/confirmar_trabalho/')?>"+id)

          modal.find('#nao_aceitar').text('Recusar')
          modal.find('#nao_aceitar').attr('href', "<?= base_url('Participante/recusar_trabalho/')?>"+id)

          var titulo    = button.data('titulo')
          var eixo        = button.data('eixo')
          var tipo_inscricao  = button.data('tipo_inscricao')
          var data_registro  = button.data('data_registro')
          var arquivo_sem_nome_autor        = button.data('arquivo_sem_nome_autor')

          console.log()
          //modal.find('#id').val(id)
          modal.find('#titulo').val(titulo)
          modal.find('#eixo').val(eixo)
          modal.find('#tipo_inscricao').val(tipo_inscricao)
          modal.find('#data_registro').val(data_registro)
          modal.find('#link').attr('href', '<?= base_url('uploads/artigo/') ?>'+arquivo_sem_nome_autor)

          <?php } ?>

          
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