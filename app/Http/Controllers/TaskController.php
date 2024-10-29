<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Services\TaskService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\Task\StoreRequest;
use App\Http\Requests\Task\UpdateRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
        $this->middleware('auth');
        $this->middleware('security');
    }

    /**
     * Display a listing of Tasks.
     * using Caching.
     * @return view (task.index)
     */
    public function index()
    {
        $tasks = Cache::remember('tasks', 60, function () {
            return Task::latest()->get();
        });
        return view('task.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new task.
     * @return view (task.create)
     */
    public function create()
    {
        return view('task.create');
    }

    /**
     * Store a newly created task.
     * after we added task successfully redirect to the view (task.index)
     */
    public function store(StoreRequest $request,Task $task)
    {
        try {
            $validatedData = $request->validated();
            $this->taskService->createTask($validatedData,$task);
            session()->flash('success', 'تم اضافة المهمة بنجاح');
            return redirect()->route('task.index');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to store task: ' . $th->getMessage());
        } catch (ModelNotFoundException $th){
            return redirect()->back()->with('error', 'Failed to update task: ' . $th->getMessage());
        }
    }

    

    /**
     * Show the form for editing the specified task.
     * @return view (task.edit)
     */
    public function edit(Task $task)
    {
        return view('task.edit', compact('task'));
    }

    /**
     * Update the specified task in storage.
     * the user who add task is the only user can edit it.
     * after we update task successfully ... redirect to the view (task.index)
     */
    public function update(UpdateRequest $request, Task $task)
    {
        try {
            $validatedData = $request->validated();
            $this->taskService->updateTask($task, $validatedData);
            session()->flash('success', 'تم تحديث المهمة بنجاح');
            return redirect()->route('task.index');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to update task: ' . $th->getMessage());
        } catch (ModelNotFoundException $th){
            return redirect()->back()->with('error', 'Failed to update task: ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        try {
            $task = $this->taskService->deleteTask($task);
            if($task == false)
            {
                session()->flash('delete', 'لست مخولا لحذف هذه المهمة.');
                return redirect()->route('task.index');
            }
            session()->flash('success', 'تم حذف المهمة بنجاح');
            return redirect()->route('task.index');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to delete task: ' . $th->getMessage());
        } catch (ModelNotFoundException $th){
            return redirect()->back()->with('error', 'Failed to update task: ' . $th->getMessage());
        }
    }

}
