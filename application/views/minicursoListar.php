<section id="main-content">
  <section class="wrapper site-min-height">
    <h2><i class="fa fa-angle-right"></i>Meus Pareceres
    </h2>
    <div class="row mt">
      <div class="col-md-12">
        <div class="content-panel">
          <div class="col-sm-8 message">
            <form method="POST" action="">              
            </form>
          </div>
          <table class="table table-striped table-advance table-hover">
            <thead>
              <tr>
                <th><i class="fa fa-font"></i> Título</th>
                <th class="hidden-phone"><i class="fa fa-date"></i> Data</th>
                <th>Horário</th>
                <th>Vagas Normal/Vagas SEDUC</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              <?php if(count($minicursos) > 0) {?>
              <?php foreach ($minicursos as $key => $minicurso) : ?>
                <tr>
                  <td><?=$minicurso['nome']?></td>
                  <td><?=date('d/m/Y', strtotime($minicurso['dia']))?></td>
                  <td><?=$minicurso['horario_inicio']. " - ". $minicurso['horario_fim']?></td>
                  <td><?=$minicurso['limite_vagas']. "/". $minicurso['limite_vagas_seduc']?></td>
                  <td>
                    <a class="btn btn-primary btn-xs" href="<?=base_url('Minicursos/alterar/'.$minicurso['id'])?>">EDITAR</a>
                  </button>
                </td>
              </tr>
            <?php endforeach; ?>
            <?php } else{?>
            <tr><td colspan="5" style="text-align: center;">Nenhum minicurso no momento.</td></tr>
            <?php }?>


          </tbody>
        </table>
      </div>
    </div>
  </div>              
</section>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>