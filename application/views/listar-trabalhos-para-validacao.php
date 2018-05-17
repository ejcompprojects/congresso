
<section id="main-content">
  <section class="wrapper site-min-height">
   <h2><i class="fa fa-angle-right"></i><?= $titulo ?>
   </h2>
   <div class="row mt">
    <div class="col-md-12">
      <div class="content-panel">


        <div class="col-sm-12 message">
          <?= '<br><br><div class="alert alert-info alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> '.$quantidade.' resultado(s) encontrado(s). </div><br>' ?>
          <?php
          ?>
          <?= $mensagens; ?>
        </div>

        <table class="table table-striped table-advance table-hover">
          <thead>
            <tr>
              <?php 
              foreach($table_header as $object){
                echo '<th><i class="'.$object['icon'].'"></i> '.$object['label'].'</th>';  
              }
              ?>
            </tr>
          </thead>
          <tbody>
            <?php 
            foreach($objects as $object){
              echo '<tr>';
              for($i = 0 ; $i < count($table_body); $i++){
                echo '<td>'.$object[$table_body[$i]].'</td>';
              }
              echo '<td>
              <button class="btn btn-primary btn-xs"
              data-toggle     ="modal" 
              data-target     ="#modal" 
              data-type       ="update"
              ';
              foreach(array_keys($object) as $key){
                if(is_array($object[$key])){
                  echo 'data-'.$key.'="'.$object[$key].'" ';
                }else echo ' data-'.$key.'="'.$object[$key].'" ';
              }
              echo '> <i class="fa fa-eye"></i></button></td></tr>';
            }
            ?>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php 
//echo modal("modal", "label", "", "form", $data_input_modal); 
?>


</section>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">

  $(document).ready(function () {
    var id = $('id').val();
    $('#nao_aceitar').remove();
    $("<label class=\"form-control-label mensagem\">Mensagem para o congressista:</label>").insertBefore('#mensagem');
    $('.mensagem').fadeOut('slow');
    $('#mensagem').attr('disabled', 'disabled');
    $('.date').fadeOut('slow');
    $('#data_limite').attr('disabled', 'disabled');

    function fechaDivMessage(){
      $('#message').fadeOut('slow');
    }

    $('#modal').on('show.bs.modal', function (event) {
      var button    = $(event.relatedTarget)
      var action    = button.data('type')
      var modal = $(this)



      if(action == "update")
      {
        <?php 
        foreach($data_input_modal as $input){
         if($input['type'] != 'special_select')
           echo 'var '.$input['name'].' = button.data("'.$input['name'].'");';
       }

       foreach($data_input_modal as $input){
        if($input['type'] == 'input_file' || $input['type'] == 'special_input_file'){
          echo 'modal.find("#'.$input['name'].'").attr(\'href\', "'.base_url('uploads/artigo/').'"+'.$input['name'].');';
        }else if($input['type'] == 'input_text') {
          echo 'modal.find("#'.$input['name'].'").val('.$input['name'].');';

        }

        else if($input['type'] == 'special_select'){
          $html = '';
          $html.= 'var html = "";';
          $html.= '

          $.ajax({
            url: "'.$input['url'].'" + '.$input['id'].',
            success:function(response) {

              var json = JSON.parse(response);
              ';

              $html.= 'html+= \' <select name="'.$input['name'].'" id="'.$input['name'].'" class="form-control" >\';';
              $html.= '
              html+= \'<option selected readonly disabled>'.$input['label'].'</option> \';';
              $html.= '
              for(var i = 0; i < json.length; i++){
                ';
                $html.= ' html+= \'<option value="\' + json[i].value + \'">\' + json[i].label + \'</option> \'';
                $html.= '
              }';
              $html.=  '

              html +=\'</select>\'

              ';
              $html.= '

              modal.find("#'.$input['name'].'").html(html);';

              $html.= 'console.log(html);';
              $html.= 
              '

            }

          });';
          echo $html;
        }
        else if($input['type'] == 'special_input_file'){
          echo 'modal.find("#'.$input['name'].'").val('.$input['name'].');';          
        }
      }

      ?>
      modal.find('#label').text('<?= $titulo ?>')
      modal.find('#mandabala').text("Aprovar")
      modal.find('#nao_aceitar').html('')
      modal.find('#id').show()
      modal.find('#form').attr("action", '<?= $url['aprovar'] ?>'+id)

      <?php if(isset($url['reprovar'])){ 
        ?>
        modal.find('#nao_aceitar').text('Reprovar')
        modal.find('#nao_aceitar').attr('href', "<?= $url['reprovar'] ?>")
        <?php
      }
      ?>

      $.ajax({
        url: '<?=base_url('Trabalho/getCoautoresTrabalho/')?>'+id,
        success: function(e){
          modal.find("#coautores").html(e);
        },
        error: function(e){
          modal.find("#coautores").html("Não foi possível buscar os coautores, tente novamente!");
        }
      })
    }
  })


  });

  $("input[type=radio][name=trabalhos]" ).click(function() {
    var n = $( "input[type=radio][name=trabalhos]:checked" ).val();
    
    if(n == 'reenviar_trabalho_com_autor' || n == 'reenviar_trabalho_sem_autor' || n == 'reenviar_ambos_trabalhos')
    {
      $('.mensagem').fadeIn('slow');
      $('#mensagem').removeAttr('disabled', 'disabled');
      $('.date').fadeIn('slow');
      $('#data_limite').removeAttr('disabled', 'disabled');
      $('#form').attr("action", '<?= $url['reprovar'] ?>')
      $('#mandabala').attr('class', 'btn btn-round btn-danger');
      $('#mandabala').text('Reprovar');
      //$('#mandabala').fadeOut('slow', function (){ $('#nao_aceitar').fadeIn('slow'); });
    }
    else
    {
      var id = $('#id').val();
      $('.mensagem').fadeOut('slow');
      $('#mensagem').attr('disabled', 'disabled');
      $('.date').fadeOut('slow');
      $('#data_limite').attr('disabled', 'disabled');

      $('#form').attr("action", '<?= $url['aprovar'] ?>'+id);
      $('#mandabala').attr('class', 'btn btn-round btn-theme');
      $('#mandabala').text('Aprovar');

    }
  });

</script>