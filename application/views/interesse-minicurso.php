<section id="main-content">
  <section class="wrapper site-min-height">
   <h2><i class="fa fa-angle-right"></i>Interesses nos Minicursos
   </h2>
   <div class="row mt">
    <div class="col-md-12">
      <div class="content-panel">

        <div class="col-sm-12 message">

          <?= $mensagens; ?>
        </div>

        <table class="table table-striped table-advance table-hover">
          <thead>


            <tr>
              <th><i class="fa fa-font"></i> Minicurso/Oficina</th>
              <th><i class="fa fa-book"></i> Interessados</th>

            </tr>

          </thead>
          <tbody>

            <?php 

            foreach ($minicursos as $minicurso) :
              ?>
              <tr>
                <td><?= $minicurso->nome ?></td>
                <td><?= $minicurso->quantidade ?></td>
              </tr>
            <?php endforeach;
            ?>
          </tbody>
        </table>

      </div>
    </div>
  </div>



</section>
</section>

