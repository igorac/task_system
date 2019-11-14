$(function(){

  // Responsável por deixar por default que todas requisições 
  // ajax vai utilizar o token csrf.
  $.ajaxSetup({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } 
  });

  // Responsável por carregar as tarefas na página
  carregarTarefas();

  // Responsável por abrir o modal
  $('.btn-custom-add').on('click', function(){
    removerErrosFormValidation();
    $('#modalAddTask').modal('show');
    $('#formAddTask')[0].reset();
    $('#data_executada').attr('disabled', true);
  });


  // Responsável por alternar o disabled do input de data
  $('#status').on('change', function(){
    (this.value === "1") ? $('#data_executada').attr('disabled', false) : $('#data_executada').attr('disabled', true);

  });


  // Responsável por enviar os dados do formulário para
  // o Servidor
  $('.btn-add-task').on('click', function(){
     
    $.ajax({
      url: '/task/store',
      method: 'post',
      dataType: 'json',
      data: $('#formAddTask').serialize(),
      success: response => {
        
        console.log(response);

        if (response.sucesso) {
          $('.message').text('Tarefa foi cadastrada com sucesso!')
                       .addClass('alert-success').removeClass('alert-danger')
                       .show('slow').delay(2000).hide('slow');  

          carregarTarefas();                    
        } else {
          $('.message').text('Erro ao cadastrar!')
                       .addClass('alert-danger').removeClass('alert-success')
                       .show('slow').delay(2000).hide('slow');  

        }

        $('#modalAddTask').modal('hide');    
      },
      error: err => {
        let erros = err.responseJSON;
        
        exibirErrosFormValidation(erros.errors);
        
      }
    })

  })


  // Responsável por abrir o modal e deletar a tarefa
  $('#tasks').on('click', '.btn-delete', function(){
    
    let row = $(this).parent().parent().data('row');
    let id = $(this).data('id');

    $('#modalDeleteTask').modal('show');

    $('.btn-delete-task').off().on('click', function(){
      $.ajax({
        url: `/task/delete/${id}`,
        method: 'DELETE',
        dataType: 'json',
        success: response => {
          console.log(response);

          if (response.sucesso) {
            $('.message').text('Tarefa foi deletada com sucesso!')
                        .addClass('alert-success').removeClass('alert-danger')
                        .show('slow').delay(2000).hide('slow');  
            
            $(row).remove();
            carregarTarefas(); 

          } else {
            $('.message').text('Erro ao deletar!')
                        .addClass('alert-danger').removeClass('alert-success')
                        .show('slow').delay(2000).hide('slow');  

          }

          $('#modalDeleteTask').modal('hide');
        },
        error: err => {
          console.log(err);
        }
      })
    })

  });


  // Responsável por alterar o status das tarefas
  $('#tasks').on('click', '.btn-check', function(){
    
    let id = $(this).data('id');

    $.ajax({
      url: `/task/update/${id}`,
      method: 'put',
      dataType: 'json',
      success: response => {
        console.log(response);

          if (response.sucesso) {
            $('.message').text('Status foi alterado')
                        .addClass('alert-success').removeClass('alert-danger')
                        .show('slow').delay(2000).hide('slow');  
            
            carregarTarefas(); 

          } else {
            $('.message').text('Erro ao alterar o status')
                        .addClass('alert-danger').removeClass('alert-success')
                        .show('slow').delay(2000).hide('slow');  

          }
         
      },
      error: err => {
        console.log(err);
      }
    })
  });


  // Adicionando a biblioteca do datetimepicker
  // no input
  $('#input_data_executada').datetimepicker({
    sideBySide: true,
    locale: 'pt-br',
    maxDate: new Date(), // Faz com que a data máxima para escolha seja a hora e dia atual
    format: 'DD/MM/YYYY HH:mm:ss',
  });
})


/**
 * Responsável por realizar uma consulta ao servidor
 * e retornar os dados
 */
function carregarTarefas() {
  $.ajax({
    url: '/tasks',
    method: 'get',
    dataType: 'json',
    beforeSend: function() {
      $('.loader').show();
    },  
    success: (response) => {
      setTimeout( ()=> {
        montarTable(response);
        $('.loader').hide();
      }, 2000)
    },
    error: (error) => {
        console.log(error);
    }
  })
}

/**
 * Responsável por construir o html da table (body)
 * @param {object} tasks 
 */
function montarTable(tasks) {

  $('#tasks').empty();
  if (tasks.length !== 0) {

    $('.message-empty').hide('');

    $.each(tasks, (key, task) => {
        let status = (task.status) ? 'Realizado' : 'Pendente';
        let classStatus = (task.status) ? 'bg-purple' : 'bg-dark';
        let classIcon   = (task.status) ? 'fa fa-pen-square' :'fa fa-check-square';
        let data_executada = (task.data_executada === null) ? '' : moment(task.data_executada).format("DD/MM/YYYY HH:mm:ss");
        let data_criacao = moment(task.data_criacao).format("DD/MM/YYYY HH:mm:ss");

        $('#tasks').append(`
            <tr data-row=${task.id}>
            <td> ${task.id} </td>
            <td> ${task.descricao} </td>
            <td> ${data_criacao}</td>
            <td> ${data_executada}</td>
            <td><span class="badge text-white ${classStatus}"> ${status}</span></td>
            <td>
                <button type="button" class="btn btn-sm bg-purple text-white btn-delete" data-id=${task.id}><i class="fa fa-minus-square"></i></button>
                <button type="button" class="btn btn-sm ${classStatus} text-white btn-check"  data-id=${task.id}><i class="${classIcon}"></i></button>
            </td>
            </tr>
        `);
    })

  } else {
    $('.message-empty').text('Não existem tarefas registradas.').show('fast');
  }

}


/**
 * Responsável por pegar os erros do form validation
 * do back-end e exibir para o usuário.
 * @param {object} erros 
 */
function exibirErrosFormValidation(erros) {

  if (erros.length !== 0) {

    if (erros.descricao) {
        $('#descricao').addClass('is-invalid').removeClass('is-valid');

        $('.msg-descricao').text(erros.descricao)
                            .addClass('invalid-feedback')
                            .removeClass('valid-feedback')
                            .show();
    } else {
        $('#descricao').addClass('is-valid').removeClass('is-invalid');
        $('.msg-descricao').text('')
                            .addClass('valid-feedback')
                            .removeClass('invalid-feedback')
                            .hide();
    }


    if (erros.status) {
        $('#status').addClass('is-invalid').removeClass('is-valid');

        $('.msg-status').text(erros.descricao)
                        .addClass('invalid-feedback')
                        .removeClass('valid-feedback')
                        .show();
    } else {
        $('#status').addClass('is-valid').removeClass('is-invalid');
    
        $('.msg-status').text('')
                        .addClass('valid-feedback')
                        .removeClass('invalid-feedback')
                        .hide();
    }

  }

}


/**
 * Responsável por remover as classes de validação 
 * do bootstrap
 */
function removerErrosFormValidation() {
  let fields = [$('#descricao'), $('#status')];

  $.each(fields, (key, value) => {
      $(value).removeClass('is-invalid is-valid');
  })
  
  $('.form-text').removeClass('valid-feedback invalid-feedback').hide().text('');
}