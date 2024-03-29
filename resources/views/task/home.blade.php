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
              <th>Dt. criação do lembrete</th>
              <th>Dt. execução da tarefa</th>
              <th>Status</th>
              <th></th>
            </tr>
          </thead>
          <tbody id="tasks">
          </tbody>
        </table>

        <div class="message-empty alert text-center" style="display:none"></div>
        <div class="loader"></div>
        
      </div>
    </div>

    <div class="text-right">
      <button class="btn-custom-add bg-purple text-white my-3 mr-4"><i class="fa fa-plus"></i></button>
    </div>

    <div class="message alert text-center" style="display:none"></div>
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
              <label for="data_executada">Data Execução</label>
              <div class="row">
                <div class="input-group date col-8 input_data_execucao" id="input_data_execucao" data-target-input="nearest">
                  <input type="text" class="form-control datetimepicker-input" name="data_execucao" id="data_execucao" data-target="#input_data_execucao"/>
                  <div class="input-group-append" data-target="#input_data_execucao" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
                  <span class="form-text msg-data_execucao" style="display:none;"></span>
                </div>
                
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
  
