$(function(){

    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } 
    });

    carregarTarefas();

    $('.btn-custom-add').on('click', function(){
        removerErrosFormValidation();
        $('#modalAddTask').modal('show');
        $('#formAddTask')[0].reset();
    });

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
})

function carregarTarefas() {
    $.ajax({
        url: '/tasks/json',
        method: 'get',
        dataType: 'json',
        success: (response) => {
            montarTable(response);
        },
        error: (error) => {
            console.log(error);
        }
    })
}

function montarTable(tasks) {

    $('#tasks').empty();
    if (tasks.length !== 0) {

        $('.message-empty').hide('');

        $.each(tasks, (key, task) => {
            let status = (task.status) ? 'Realizado' : 'Pendente';
            let classStatus = (task.status) ? 'bg-purple' : 'bg-dark';
            let data_executada = (task.data_executada === null) ? '' : formatarDataHora(task.data_executada);
            let data_criacao = formatarDataHora(task.data_criacao);

            $('#tasks').append(`
                <tr data-row=${task.id}>
                <td> ${task.id} </td>
                <td> ${task.descricao} </td>
                <td> ${data_criacao}</td>
                <td> ${data_executada}</td>
                <td><span class="badge text-white ${classStatus}"> ${status}</span></td>
                <td>
                    <button type="button" class="btn btn-sm bg-purple text-white btn-delete" data-id=${task.id}><i class="fa fa-minus-square"></i></button>
                    <button type="button" class="btn btn-sm ${classStatus} text-white btn-check"  data-id=${task.id}><i class="fa fa-check-square"></i></button>
                </td>
                </tr>
            `);
        })

    } else {
        $('.message-empty').text('Não existem tarefas registradas.').show('fast');
    }

}

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

function removerErrosFormValidation() {
    let fields = [$('#descricao'), $('#status')];

    $.each(fields, (key, value) => {
        $(value).removeClass('is-invalid is-valid');
    })
    
    $('.form-text').removeClass('valid-feedback invalid-feedback').hide().text('');
}

function formatarDataHora(dataFormat) {

    let data = new Date(dataFormat);
    let dia = data.getDate();
    let mes = data.getMonth();
    let ano = data.getFullYear();
    let hora = data.getHours();
    let minutos = data.getMinutes();
    let segundos = data.getSeconds();

    if (mes < 10) {
        mes = `0${mes}`;
    }
    if (dia < 10) {
        dia = `0${dia}`;
    }
    if (hora < 10) {
        hora = `0${hora}`;
    }
    if (minutos < 10) {
        minutos = `0${minutos}`;
    }
    if (segundos < 10) {
        segundos = `0${segundos}`;
    }

    return `${dia}/${mes}/${ano} ${hora}:${minutos}:${segundos}`;
}