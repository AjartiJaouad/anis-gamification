<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Level;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use Illuminate\Http\Request;

class QuizQuestionController extends Controller
{
    public function index(Quiz $quiz)
    {
        $quiz->load(['questions.options', 'questions.level']);

        return view('admin.quizzes.questions.index', compact('quiz'));
    }

    public function create(Quiz $quiz)
    {
        $levels = Level::orderBy('difficulty')->get();

        return view('admin.quizzes.questions.create', compact('quiz', 'levels'));
    }

    public function store(Request $request, Quiz $quiz)
    {
        $data = $request->validate([
            'level_id' => 'required|exists:levels,id',
            'question' => 'required|string|max:1000',
            'question_type' => 'required|in:mcq,true_false',
            'options' => 'required|array|min:2|max:6',
            'options.*' => 'required|string|max:255',
            'correct_options' => 'required|array|min:1',
            'correct_options.*' => 'integer|min:0',
        ]);

        if ($data['question_type'] === 'true_false' && count($data['options']) !== 2) {
            return back()
                ->withInput()
                ->withErrors(['options' => 'Une question Vrai/Faux doit contenir exactement 2 réponses.']);
        }

        if ($data['question_type'] === 'true_false' && count($data['correct_options']) !== 1) {
            return back()
                ->withInput()
                ->withErrors(['correct_options' => 'Une question Vrai/Faux doit avoir une seule bonne réponse.']);
        }

        $question = $quiz->questions()->create([
            'level_id' => $data['level_id'],
            'question' => $data['question'],
            'question_type' => $data['question_type'],
        ]);

        $correctIndexes = array_map(intval(...), $data['correct_options']);

        $optionPayload = [];
        foreach ($data['options'] as $index => $optionText) {
            $optionPayload[] = [
                'option_text' => $optionText,
                'is_correct' => in_array((int) $index, $correctIndexes, true),
            ];
        }

        $question->options()->createMany($optionPayload);

        return redirect()->route('admin.quizzes.questions.index', $quiz)
            ->with('success', 'Question QCM ajoutée avec succès.');
    }

    public function edit(Quiz $quiz, QuizQuestion $question)
    {
        abort_unless($quiz->id === $question->quiz_id, 404);

        $question->load('options');
        $levels = Level::orderBy('difficulty')->get();

        return view('admin.quizzes.questions.edit', compact('quiz', 'question', 'levels'));
    }

    public function update(Request $request, Quiz $quiz, QuizQuestion $question)
    {
        abort_unless($quiz->id === $question->quiz_id, 404);

        $data = $request->validate([
            'level_id' => 'required|exists:levels,id',
            'question' => 'required|string|max:1000',
            'question_type' => 'required|in:mcq,true_false',
            'options' => 'required|array|min:2|max:6',
            'options.*' => 'required|string|max:255',
            'correct_options' => 'required|array|min:1',
            'correct_options.*' => 'integer|min:0',
        ]);

        if ($data['question_type'] === 'true_false' && count($data['options']) !== 2) {
            return back()
                ->withInput()
                ->withErrors(['options' => 'Une question Vrai/Faux doit contenir exactement 2 réponses.']);
        }

        if ($data['question_type'] === 'true_false' && count($data['correct_options']) !== 1) {
            return back()
                ->withInput()
                ->withErrors(['correct_options' => 'Une question Vrai/Faux doit avoir une seule bonne réponse.']);
        }

        $question->update([
            'level_id' => $data['level_id'],
            'question' => $data['question'],
            'question_type' => $data['question_type'],
        ]);
        $question->options()->delete();

        $correctIndexes = array_map(intval(...), $data['correct_options']);

        $optionPayload = [];
        foreach ($data['options'] as $index => $optionText) {
            $optionPayload[] = [
                'option_text' => $optionText,
                'is_correct' => in_array((int) $index, $correctIndexes, true),
            ];
        }

        $question->options()->createMany($optionPayload);

        return redirect()->route('admin.quizzes.questions.index', $quiz)
            ->with('success', 'Question QCM mise à jour avec succès.');
    }

    public function destroy(Quiz $quiz, QuizQuestion $question)
    {
        abort_unless($quiz->id === $question->quiz_id, 404);

        $question->delete();

        return redirect()->route('admin.quizzes.questions.index', $quiz)
            ->with('success', 'Question QCM supprimée avec succès.');
    }
}
