<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTask;
use App\Task;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TaskController extends Controller
{
    /**
     * Responsável por verificar se a requisição é um JSON ou não
     * em caso de TRUE -> é retornado os dados (tarefas) para requisição
     * em caso de FALSE -> é renderizado a view
     */
    public function index(Request $request)
    {
        if (isset(Auth::user()->id)) {
            if ($request->expectsJson()) {
                return Task::all()->where('user_id', Auth::user()->id);
            }
            return view('task.home');
        }
    }

    /**
     * Responsável por cadastrar as tarefas na base de dados
     * e retorna um json
     * 
     * @param StoreTask $request
     * StoreTask é um requestForm responsável pela validação de formulário
     * 
     */
    public function store(StoreTask $request)
    {
        if ($request->isMethod('post')) {

            if ($request->filled(['descricao', 'status', 'data_execucao'])) {

                $task = new Task();
                $task->user_id = Auth::user()->id;
                $task->descricao = $request->descricao;
                $task->status = $request->status;
                $task->data_execucao = Carbon::createFromFormat('d/m/Y H:i:s',$request->data_execucao);
        
                if ($task->save()) {
                    return response()->json([
                        'sucesso' => TRUE
                    ]);
                } else {
                    return  response()->json([
                        'sucesso' => FALSE
                    ]);
                }
            }
           
        }
    }

    /**
     * Responsável por deletar uma tarefa e retorna um json
     * em caso de sucesso ou falha
     * @param int $id
     */
    public function delete(int $id)
    {
        $task = Task::findOrFail($id);

        if (is_numeric($id) || is_int($id)) {
            return ($task->delete()) ? 
                response()->json([ 'sucesso' => TRUE ]) : 
                response()->json([ 'sucesso' => FALSE ]);
        }
    }   

    /**
     * Responsável por marcar a tarefa como realizada
     * Retorna um json em caso de sucesso ou falha
     * @param int $id
     */
    public function update(int $id)
    {
        $task = Task::findOrFail($id);
        if (is_int($id) || is_numeric($id)) {
            $task->status = 1;

            return ($task->save()) ? 
                response()->json([ 'sucesso' => TRUE ]) : 
                response()->json([ 'sucesso' => FALSE ]);
        }
    }
}
