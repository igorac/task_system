@extends('layouts.app')
@section('title', 'Home')

@section('menu')
  @component('components.menu', ['auth' => TRUE])
  @endcomponent
@endsection

@section('body')

  <section class="container my-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title display-4">Tarefas</h5>
        
        <table class="table table-hover table-bordered">
          <thead>
            <tr>
              <th>#</th>
              <th>Descrição</th>
              <th>Data de Criação</th>
              <th>Data executada</th>
              <th>Status</th>
              <th></th>
            </tr>
          </thead>
          <tbody id="tasks">
          </tbody>
        </table>

        <div class="message alert text-center" style="display:none"></div>
        <div class="message-empty alert text-center" style="display:none"></div>

      </div>
    </div>

    <div class="text-right">
      <button class="btn-custom-add btn bg-purple text-white my-3 mr-4"><i class="fa fa-plus-circle"></i></button>
    </div>
  </section>

  <div class="modal" tabindex="-1" role="dialog" id="modalAddTask">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Adicionar uma nova tarefa</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
          
          <form id="formAddTask">
            <div class="form-group">
              <label for="descricao">Descrição</label>
              <input type="text" name="descricao" id="descricao" class="form-control">
              <span class="form-text msg-descricao" style="display:none;"></span>
            </div>

            <div class="form-group">
              <label for="status">Status</label>
              <select name="status" id="status" class="form-control">
                <option value="">Selecione</option>
                <option value="1">Realizado</option>
                <option value="0">Pendente</option>
              </select>
              <span class="form-text msg-status" style="display:none;"></span>
            </div>

            <div class="form-group">
              <label for="data_executada">Data Executada</label>
              {{-- <input type="datetime-local" name="data_executada" id="data_executada" class="form-control" step="1"> --}}
              <div class="row">
                <input type="date" name="data" id="data" class="form-control col-sm-5 ml-3 mr-3">
                <input type="time" name="hora" id="hora" class="form-control col-sm-3">
              </div>
            </div>
            
          </form>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button type="button" class="btn bg-purple text-white btn-add-task">Enviar</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal" tabindex="-1" role="dialog" id="modalDeleteTask">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Deletar a tarefa</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Tem certeza que deseja excluír essa tarefa?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button type="button" class="btn bg-purple text-white btn-delete-task">Deletar</button>
        </div>
      </div>
    </div>
  </div>

@endsection


@section('javascript')
  <script src="{{ asset('js/task.js') }}"></script>
@endsection
  
