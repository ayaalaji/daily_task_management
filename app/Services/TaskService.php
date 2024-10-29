<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Task;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TaskService {
    public function createTask(array $data,Task $task)
    {
        return Task::create([
            'title' =>$data['title'],
            'description' =>$data['description'],
            'due_date'=>isset($data['due_date']) ? Carbon::parse($data['due_date'])->format('Y-m-d') : $task->due_date ,
            'status' => 'Pending',
            'user_id' => Auth::id(),
        ]);

    }

    public function updateTask(Task $task,array $data)
    {
        if(Auth::user()->id == $task->user_id)
        {
            $updateTask = array_filter([
                'title'=>$data['title'] ?? $task->title,
                'description' =>$data['description'] ?? $task->description,
                'due_date'=>isset($data['due_date']) ? Carbon::parse($data['due_date'])->format('Y-m-d') : $task->due_date ?? $task->due_date,
                'status' =>$data['status'] ?? $task->status,
                    
            ]);
            $task -> update($updateTask);
            return $task;
        } else {
            abort(403, 'أنت لست مخولاً لتعديل هذه المهمة.');   
        }
    }

    public function deleteTask(Task $task)
    {
        if(Auth::user()->id == $task->user_id) 
        {
            $task->delete();
        } else {
            return false;
               
        }
    }

    public function toggleTaskStatus(Task $task)
    {
        $task->status = $task->status == 'Pending' ? 'Completed' : 'Pending';
        $task->save();
    }
}