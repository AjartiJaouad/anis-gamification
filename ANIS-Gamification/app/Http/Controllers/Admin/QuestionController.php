<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Level;
use App\Models\Quiz;
use App\Models\QuizOption;
use App\Models\QuizQuestion;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = QuizQuestion::with(['quiz', 'level', 'options'])
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('admin.questions.index', compact('questions'));
    }

    public function create()
    {
        $quizzes = Quiz::withCount(['questions as created_questions_count'])->orderBy('title')->get();
        $levels = Level::orderBy('difficulty')->get();

        return view('admin.questions.create', compact('quizzes', 'levels'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'quiz_id' => 'required|exists:quizzes,id',
            'level_id' => 'required|exists:levels,id',
            'question' => 'required|string|max:1000',
            'options' => 'required|array|min:2|max:6',
            'options.*' => 'required|string|max:255',
            'correct_options' => 'required|array|min:1',
            'correct_options.*' => 'integer|min:0',
        ]);

        $quiz = Quiz::findOrFail($data['quiz_id']);

        if ($quiz->questions()->count() >= $quiz->questions_count) {
            return back()
                ->withInput()
                ->withErrors(['quiz_id' => 'Ce quiz a déjà atteint le nombre maximum de questions.']);
        }

        $question = QuizQuestion::create([
            'quiz_id' => $data['quiz_id'],
            'level_id' => $data['level_id'],
            'question' => $data['question'],
        ]);

        $correctIndexes = array_map(intval(...), $data['correct_options']);

        $options = [];
        foreach ($data['options'] as $index => $text) {
            $options[] = [
                'option_text' => $text,
                'is_correct' => in_array((int) $index, $correctIndexes, true),
            ];
        }

        $question->options()->createMany($options);

        return redirect()->route('admin.questions.index')
            ->with('success', 'Question créée avec succès.');
    }

    public function edit(QuizQuestion $question)
    {
        $quizzes = Quiz::withCount(['questions as created_questions_count'])->orderBy('title')->get();
        $levels = Level::orderBy('difficulty')->get();

        $question->load('options');

        return view('admin.questions.edit', compact('question', 'quizzes', 'levels'));
    }

    public function update(Request $request, QuizQuestion $question)
    {
        $data = $request->validate([
            'quiz_id' => 'required|exists:quizzes,id',
            'level_id' => 'required|exists:levels,id',
            'question' => 'required|string|max:1000',
            'options' => 'required|array|min:2|max:6',
            'options.*' => 'required|string|max:255',
            'correct_options' => 'required|array|min:1',
            'correct_options.*' => 'integer|min:0',
        ]);

        $quiz = Quiz::findOrFail($data['quiz_id']);

        if ($quiz->id !== $question->quiz_id && $quiz->questions()->count() >= $quiz->questions_count) {
            return back()
                ->withInput()
                ->withErrors(['quiz_id' => 'Ce quiz a déjà atteint le nombre maximum de questions.']);
        }

        $question->update([
            'quiz_id' => $data['quiz_id'],
            'level_id' => $data['level_id'],
            'question' => $data['question'],
        ]);

        $question->options()->delete();

        $correctIndexes = array_map(intval(...), $data['correct_options']);

        $options = [];
        foreach ($data['options'] as $index => $text) {
            $options[] = [
                'option_text' => $text,
                'is_correct' => in_array((int) $index, $correctIndexes, true),
            ];
        }

        $question->options()->createMany($options);

        return redirect()->route('admin.questions.index')
            ->with('success', 'Question mise à jour avec succès.');
    }

    public function destroy(QuizQuestion $question)
    {
        $question->delete();

        return redirect()->route('admin.questions.index')
            ->with('success', 'Question supprimée avec succès.');
    }
}
