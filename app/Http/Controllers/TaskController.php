<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use App\Models\User;

class TaskController extends Controller
{
    public function index(){
        $tasks = Task::with(['user'])
                    ->where('confidential', false)
                    ->orderByDesc('id')
                    ->get();
        return $tasks;
    }

    public function confidentialTasks(){
        $tasks = Task::with(['user'])
                    ->where('confidential', true)
                    ->orderByDesc('id')
                    ->get();
        return $tasks;
    }

    public function show($id){
        $task = Task::findOrFail($id);
        
        //check if can show confidentail
        if($task->confidential == true && Auth::user()->rank < 2)
            return abort(403);

        return $task->load(['user']);
    }

    public function store(Request $request){
        //check if rank > 0
        if(!Auth::user()->checkRank())
            return abort(403);

        $data = $request->validate([
            'name' => 'nullable|string|max:50',
            'content' => 'nullable|string|max:1000',
            'user_id' => [
                'required',
                Rule::in(User::query()->pluck('id')->toArray())
            ],
            'confidential' => 'nullable|boolean'
        ]);

        $task = new Task($data);

        if($task->save())
            return ['success' => true, 'message' => 'create success!', 'task' => $task];
        else
            return ['success' => false, 'message' => 'create fail!'];
    }

    public function update(Request $request, $id){
        //check if rank > 0
        if(!Auth::user()->checkRank())
            return abort(403);

        $data = $request->validate([
            'name' => 'nullable|string|max:50',
            'content' => 'nullable|string|max:1000',
            'user_id' => [
                'required',
                Rule::in(User::query()->pluck('id')->toArray())
            ],
            'confidential' => 'nullable|boolean'
        ]);

        $task = Task::findOrFail($id);
        $task->fill($data);

        if($task->save())
            return ['success' => true, 'message' => 'update success!', 'task' => $task];
        else
            return ['success' => false, 'message' => 'update fail!'];
    }

    public function delete($id){
        //check if rank > 0
        if(!Auth::user()->checkRank())
            return abort(403);

        $task = Task::findOrFail($id);
        
        if($task->delete())
            return ['success' => true, 'message' => 'delete success!'];
        else
            return ['success' => false, 'message' => 'delete fail!'];
    }
}
