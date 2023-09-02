<?php

namespace App\Http\Controllers;

use App\Enums\TaskStatusEnum;
use App\Http\Requests\CreateTaskRequest;
use App\Models\Task;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $data = Task::query()->myTask()->filter(\request('filter'))->get();

        return view('tasks.index',compact('data'));
    }


    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('tasks.form.create');
    }


    public function store(CreateTaskRequest $request): RedirectResponse
    {
       Task::query()->create($request->all());

       return back()->with('success','Congratulations, You success to create new task');
    }


    public function edit(Task $task)
    {
        return view('tasks.form.edit');
    }


    public function update(CreateTaskRequest $request, Task $task): RedirectResponse
    {
        $task->update($request->all());

        return back()->with('warning','Congratulations, You success to update task');
    }


    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();

        return back()->with('warning','Congratulations, You success to update task');
    }
}
