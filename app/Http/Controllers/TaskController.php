<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Görevlerin listesini görüntüle
     */
    public function index(Request $request)
    {
        $tasks = Task::query()
            ->filterByUser(Auth::id())
            ->filterByStatus($request->get('status'))
            ->filterByPriority($request->get('priority'))
            ->latest()
            ->paginate(10);

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Yeni görev oluşturma formunu göster
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Yeni görevi kaydet
     */
    public function store(StoreTaskRequest $request)
    {
        $task = new Task($request->validated());
        $task->user_id = Auth::id();
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Görev başarıyla oluşturuldu.');
    }

    /**
     * Belirli bir görevi görüntüle
     */
    public function show(Task $task)
    {
        $this->authorize('view', $task);
        return view('tasks.show', compact('task'));
    }

    /**
     * Görev düzenleme formunu göster
     */
    public function edit(Task $task)
    {
        $this->authorize('update', $task);
        return view('tasks.edit', compact('task'));
    }

    /**
     * Görevi güncelle
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $this->authorize('update', $task);

        $task->update($request->validated());

        return redirect()->route('tasks.index')->with('success', 'Görev başarıyla güncellendi.');
    }

    /**
     * Görevi sil
     */
    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Görev başarıyla silindi.');
    }

    /**
     * Görevi tamamlandı olarak işaretle
     */
    public function complete(Task $task)
    {
        $this->authorize('update', $task);

        $task->update([
            'status' => 'completed',
            'completed_at' => now()
        ]);

        return redirect()->route('tasks.index')->with('success', 'Görev başarıyla tamamlandı olarak işaretlendi.');
    }
}
