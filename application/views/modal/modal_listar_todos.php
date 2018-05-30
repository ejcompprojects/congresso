<div class="modal fade in" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="{{modal_title}}"></h4>
      </div>
      <div class="modal-body">
        <form method="POST" action="" id="form">

          <input type="hidden" id="id" name="id" readonly="readonly">
          
          <div class="form-group">
            <label class="form-control-label">Nome:</label>
            <input type="text" name="nome" id="nome" class="form-control" disabled>
          </div>
          
          <div class="form-group">
            <label class="form-control-label">E-mail:</label>
            <input type="text" name="email" id="email" class="form-control" disabled>            
          </div>

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
            <label class="form-control-label">Data:</label>
            <input type="text" name="data" id="data" class="form-control" disabled>
          </div>

          <div class="form-group">
            <label class="form-control-label">Coautores:</label>
            <ul id="coautores">
              <li style="list-style: initial">Não há coautores</li>
            </ul>
          </div>

          <div class="form-group">
            <label class="form-control-label">Arquivo Sem Nome Autor:</label>
            <div>
              <a href="" target="_blank" id="arquivo_sem_nome_autor" class="btn btn-primary">CLIQUE AQUI PARA ABRIR O TRABALHO</a>
            </div>
          </div>

          <div class="form-group">
            <label class="form-control-label">Arquivo Com Nome Autor:</label>
            <div>
              <a href="" target="_blank" id="arquivo_com_nome_autor" class="btn btn-primary">CLIQUE AQUI PARA ABRIR O TRABALHO</a>
            </div>
          </div>

          <div class="form-group">
            <label class="form-control-label">Status:</label>
            <input type="text" name="status" id="status" class="form-control" disabled>
          </div>


          <div class="modal-footer">
            <button type="submit" class="btn btn-round btn-theme" id="mandabala" value="submit"></button>
            <a href="" class="btn btn-round btn-danger" id="nao_aceitar" value="submit"></a>
            <button type="button" class="btn btn-round btn-secundary" data-dismiss="modal"> Fechar </button>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>