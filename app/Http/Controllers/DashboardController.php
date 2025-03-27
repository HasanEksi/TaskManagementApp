<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $totalTask = Cache::remember('tasks_count_'.Auth::id(), 60, function () {
            return Task::where('user_id', Auth::id())
            ->count();
        });

        $completedTask = Cache::remember('tasks_count_completed_'.Auth::id(), 60, function () {
            return Task::where('user_id', Auth::id())
            ->where('status', 'completed')
            ->count();
        });

        $inProgressTask = Cache::remember('tasks_count_in_progress_'.Auth::id(), 60, function () {
            return Task::where('user_id', Auth::id())
            ->where('status', 'in_progress')
            ->count();
        });

        $pendingTask = Cache::remember('tasks_count_pending_'.Auth::id(), 60, function () {
            return Task::where('user_id', Auth::id())
            ->where('status', 'pending')
            ->count();
        });

        return view('dashboard', compact('totalTask', 'completedTask', 'inProgressTask', 'pendingTask'));
    }
}
