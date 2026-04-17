<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LevelController extends Controller
{
    public function index()
    {
        $levels = Level::orderBy('created_at', 'desc')->paginate(12);

        return view('admin.levels.index', compact('levels'));
    }

    public function create()
    {
        return view('admin.levels.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:levels,name',
            'description' => 'nullable|string|max:1000',
            'difficulty' => 'required|integer|min:1|max:10',
        ]);

        Level::create($data);

        return redirect()->route('admin.levels.index')
            ->with('success', 'Niveau créé avec succès.');
    }

    public function edit(Level $level)
    {
        return view('admin.levels.edit', compact('level'));
    }

    public function update(Request $request, Level $level)
    {
        $data = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('levels', 'name')->ignore($level->id),
            ],
            'description' => 'nullable|string|max:1000',
            'difficulty' => 'required|integer|min:1|max:10',
        ]);

        $level->update($data);

        return redirect()->route('admin.levels.index')
            ->with('success', 'Niveau mis à jour avec succès.');
    }

    public function destroy(Level $level)
    {
        $level->delete();

        return redirect()->route('admin.levels.index')
            ->with('success', 'Niveau supprimé avec succès.');
    }
}
