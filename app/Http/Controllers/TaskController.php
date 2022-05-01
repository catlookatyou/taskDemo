<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Task;
use App\Models\User;

class TaskController extends Controller
{
    public function index(){
        $tasks = Task::with(['user'])
                    ->orderByDesc('id')
                    ->get();
        return $tasks;
    }

    public function show($id){
        $task = Task::findOrFail($id);
        return $task->load(['user']);
    }

    public function store(Request $request){
        $data = $request->validate([
            'name' => 'nullable|string|max:50',
            'content' => 'nullable|string|max:1000',
            'user_id' => [
                'required',
                Rule::in(User::query()->pluck('id')->toArray())
            ]
        ]);

        $task = new Task($data);

        if($task->save())
            return ['success' => true, 'message' => 'create success!', 'task' => $task];
        else
            return ['success' => false, 'message' => 'create fail!'];
    }

    public function update(Request $request, $id){
        $data = $request->validate([
            'name' => 'nullable|string|max:50',
            'content' => 'nullable|string|max:1000',
            'user_id' => [
                'required',
                Rule::in(User::query()->pluck('id')->toArray())
            ]
        ]);

        $task = Task::findOrFail($id);
        $task->fill($data);

        if($task->save())
            return ['success' => true, 'message' => 'update success!', 'task' => $task];
        else
            return ['success' => false, 'message' => 'update fail!'];
    }

    public function delete($id){
        $task = Task::findOrFail($id);
        
        if($task->delete())
            return ['success' => true, 'message' => 'delete success!'];
        else
            return ['success' => false, 'message' => 'delete fail!'];
    }
}
