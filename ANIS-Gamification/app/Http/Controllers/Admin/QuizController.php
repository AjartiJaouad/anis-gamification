<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::withCount(['questions as questions_configured_count'])
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('admin.quizzes.index', compact('quizzes'));
    }

    public function create()
    {
        return view('admin.quizzes.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255|unique:quizzes,title',
            'description' => 'nullable|string|max:1000',
            'difficulty' => 'required|integer|min:1|max:10',
            'questions_count' => 'required|integer|min:1|max:100',
            'duration_minutes' => 'required|integer|min:1|max:240',
        ]);

        Quiz::create($data);

        return redirect()->route('admin.quizzes.index')
            ->with('success', 'Quiz créé avec succès.');
    }

    public function edit(Quiz $quiz)
    {
        return view('admin.quizzes.edit', compact('quiz'));
    }

    public function update(Request $request, Quiz $quiz)
    {
        $data = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('quizzes', 'title')->ignore($quiz->id),
            ],
            'description' => 'nullable|string|max:1000',
            'difficulty' => 'required|integer|min:1|max:10',
            'questions_count' => 'required|integer|min:1|max:100',
            'duration_minutes' => 'required|integer|min:1|max:240',
        ]);

        $quiz->update($data);

        return redirect()->route('admin.quizzes.index')
            ->with('success', 'Quiz mis à jour avec succès.');
    }

    public function destroy(Quiz $quiz)
    {
        $quiz->delete();

        return redirect()->route('admin.quizzes.index')
            ->with('success', 'Quiz supprimé avec succès.');
    }
}
