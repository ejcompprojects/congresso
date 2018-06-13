<div class="modal fade in" id="modal_parecer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="{{modal_title}}"></h4>
      </div>
      <div class="modal-body">
        <form method="POST" action="" id="form" enctype="multipart/form-data">

          <input type="hidden" id="id" name="id" readonly="readonly">
          
          <div class="form-group">
            <label class="form-control-label">Tipo:</label>
            <input type="text" name="tipo" id="tipo" class="form-control" disabled>
          </div>

          <div class="form-group">
            <label class="form-control-label">Título:</label>
            <input type="text" name="titulo" id="titulo" class="form-control" disabled>
          </div>

          <div class="form-group">
            <label class="form-control-label">Eixo:</label>
            <input type="text" name="eixo" id="eixo" class="form-control" disabled>
          </div>          

          <div class="form-group">
            <label class="form-control-label">Arquivo Parecer:</label>
            <div>
              <input type="file" name="arquivo_parecer" id="arquivo_parecer" required>              
            </div>
          </div>

          <div class="form-group">
            <label class="form-control-label">Nota:</label>
            <input type="text" name="nota" id="nota" class="form-control" required>
          </div>

          <div class="modal-footer">
            <button type="submit" class="btn btn-round btn-theme" id="mandabala" value="submit">Enviar</button>
            <button type="button" class="btn btn-round btn-secundary" data-dismiss="modal"> Fechar </button>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>