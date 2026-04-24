<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\QuizAttempt;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ModuleController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user()->load('completedModules:id');
        $modules = Module::with('quiz:id,module_id,title')->orderBy('order')->get();
        $completedModuleIds = $user->completedModules->pluck('id')->all();
        $completionRate = $modules->count() > 0
            ? (int) round((count($completedModuleIds) / $modules->count()) * 100)
            : 0;

        $validatedModuleIds = QuizAttempt::query()
            ->where('user_id', $user->id)
            ->where('passed', true)
            ->whereHas('quiz', fn ($query) => $query->whereNotNull('module_id'))
            ->with('quiz:id,module_id')
            ->get()
            ->pluck('quiz.module_id')
            ->filter()
            ->unique()
            ->values()
            ->all();

        return view('modules.index', compact('modules', 'completedModuleIds', 'completionRate', 'validatedModuleIds'));
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
        $moduleQuiz = $module->quiz()->first(['id', 'title']);

        return view('modules.show', compact('module', 'previousModule', 'nextModule', 'isCompleted', 'moduleQuiz'));
    }

    public function complete(Request $request, Module $module): RedirectResponse
    {
        $user = $request->user();

        if ($module->order > ($user->highest_unlocked_difficulty ?? 1)) {
            abort(403);
        }

        $moduleQuiz = $module->quiz()->first();
        if (! $moduleQuiz) {
            return redirect()->route('modules.show', $module)
                ->withErrors(['module' => 'Ce module ne peut pas être validé tant qu’aucun quiz ne lui est lié.']);
        }

        $hasPassedQuiz = QuizAttempt::query()
            ->where('user_id', $user->id)
            ->where('quiz_id', $moduleQuiz->id)
            ->where('passed', true)
            ->exists();

        if (! $hasPassedQuiz) {
            return redirect()->route('modules.show', $module)
                ->withErrors(['module' => 'Tu dois réussir le quiz lié à ce module avant de le valider.']);
        }

        $user->completedModules()->syncWithoutDetaching([
            $module->id => ['completed_at' => now()],
        ]);

        return redirect()->route('modules.show', $module)
            ->with('success', 'Module marque comme complete.');
    }
}
