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
    public function index()
    {
        // if (Auth::check()) {
            if (isset(Auth::user()->id)) {
                $tasks = Task::all()->where('user_id', Auth::user()->id);
                return view('task.home');
            }
        // }
        // return redirect()->route('login');
    }

    public function tasksJson()
    {
        // if (Auth::check()) {
            if (isset(Auth::user()->id)) {
                return Task::all()->where('user_id', Auth::user()->id);
            }
        // }
        // return redirect()->route('login');
    }

    public function store(StoreTask $request)
    {
        $task = new Task();
        $task->user_id = Auth::user()->id;
        $task->descricao = $request->descricao;
        $task->status = $request->status;
        $task->data_executada = Carbon::createFromFormat('d/m/Y H:i:s',$request->data_executada);

        if ($task->save()) {
            return response()->json([
                'sucesso' => TRUE
            ]);
        } else {
            return response()->json([
                'sucesso' => FALSE
            ]);
        }
    }

    public function delete(int $id)
    {
        $task = Task::findOrFail($id);

        if (is_numeric($id) || is_int($id)) {
            return ($task->delete()) ? 
            response()->json([ 'sucesso' => TRUE ]) : 
            response()->json([ 'sucesso' => FALSE ]);
        }
    }   

    public function update(int $id)
    {
        $task = Task::findOrFail($id);
        $status = (int) !$task->status;
        if (is_int($id) || is_numeric($id)) {

            if ($status === 1) {
                $task->status = $status;
                $task->data_executada = new DateTime(now());

                return ($task->save()) ?
                response()->json([ 'sucesso' => TRUE ]) :
                response()->json([ 'sucesso' => FALSE ]);
            } else {
                $task->status = $status;
                $task->data_executada = null;

                return ($task->save()) ?
                response()->json([ 'sucesso' => TRUE ]) :
                response()->json([ 'sucesso' => FALSE ]);
            }
            
        }
    }
}
