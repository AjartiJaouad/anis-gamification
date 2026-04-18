<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use Illuminate\Http\Request;

class QuizQuestionController extends Controller
{
    public function index(Quiz $quiz)
    {
        $quiz->load('questions.options');

        return view('admin.quizzes.questions.index', compact('quiz'));
    }

    public function create(Quiz $quiz)
    {
        return view('admin.quizzes.questions.create', compact('quiz'));
    }

    public function store(Request $request, Quiz $quiz)
    {
        $data = $request->validate([
            'question' => 'required|string|max:1000',
            'options' => 'required|array|min:2|max:6',
            'options.*' => 'required|string|max:255',
            'correct_options' => 'required|array|min:1',
            'correct_options.*' => 'integer|min:0',
        ]);

        $question = $quiz->questions()->create([
            'question' => $data['question'],
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

        return view('admin.quizzes.questions.edit', compact('quiz', 'question'));
    }

    public function update(Request $request, Quiz $quiz, QuizQuestion $question)
    {
        abort_unless($quiz->id === $question->quiz_id, 404);

        $data = $request->validate([
            'question' => 'required|string|max:1000',
            'options' => 'required|array|min:2|max:6',
            'options.*' => 'required|string|max:255',
            'correct_options' => 'required|array|min:1',
            'correct_options.*' => 'integer|min:0',
        ]);

        $question->update(['question' => $data['question']]);
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
