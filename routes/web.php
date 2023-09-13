<?php

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index', ['tasks' => Task::latest()->paginate()]);
})->name('tasks.index');

Route::view('/tasks/create', 'create')->name('tasks.create');

Route::post('/tasks', function (TaskRequest $request) {
    $task = Task::create($request->validated());
    return redirect()->route('tasks.show', ['task' => $task->id])->with('success', 'Task created successfully!');
})->name('tasks.post');

Route::put('/tasks/{task}', function (Task $task, TaskRequest $request) {
    $task->update($request->validated());
    return redirect()->route('tasks.show', ['task' => $task->id])->with('success', 'Task updated successfully!');
})->name('tasks.update');

Route::get('/task/{task}', function(Task $task) {
    return view('show', ['task' => $task]);
})->name('tasks.show');

Route::get('/task/{task}/edit', function(Task $task) {
    return view('edit', ['task' => $task]);
})->name('tasks.edit');

Route::delete('/task/{task}', function(Task $task) {
    $task->delete();
    return redirect()->route('tasks.index')->with('success', 'Task was deleted successfully');
})->name('task.destroy');

// complete route

Route::put('/task/{task}/toogle-complete', function (Task $task) {
    $task->toogleComplete();
    return redirect()->back()->with('success', 'Task updated successfully');
})->name('task.toogle');