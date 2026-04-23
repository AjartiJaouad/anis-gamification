<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Module;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ModuleController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user()->load('completedModules:id');
        $modules = Module::orderBy('order')->get();
        $completedModuleIds = $user->completedModules->pluck('id')->all();
        $completionRate = $modules->count() > 0
            ? (int) round((count($completedModuleIds) / $modules->count()) * 100)
            : 0;

        return view('modules.index', compact('modules', 'completedModuleIds', 'completionRate'));
    }

    public function show(Request $request, Module $module): View
    {
        $user = $request->user()->load('completedModules:id');

        if ($module->order > ($user->highest_unlocked_difficulty ?? 1)) {
            abort(403);
        }

        $modules = Module::orderBy('order')->get();
        $previousModule = $modules->where('order', '<', $module->order)->last();
        $nextModule = $modules->firstWhere('order', $module->order + 1);
        $isCompleted = $user->completedModules->contains($module->id);

        return view('modules.show', compact('module', 'previousModule', 'nextModule', 'isCompleted'));
    }

    public function complete(Request $request, Module $module): RedirectResponse
    {
        $user = $request->user();

        if ($module->order > ($user->highest_unlocked_difficulty ?? 1)) {
            abort(403);
        }

        $user->completedModules()->syncWithoutDetaching([
            $module->id => ['completed_at' => now()],
        ]);

        return redirect()->route('modules.show', $module)
            ->with('success', 'Module marque comme complete.');
    }
}
