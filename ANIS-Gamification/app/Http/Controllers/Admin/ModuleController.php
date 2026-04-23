<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function index()
    {
        $modules = Module::orderBy('order')->get();

        return view('admin.modules.index', compact('modules'));
    }

    public function create()
    {
        return view('admin.modules.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'order' => 'nullable|integer|min:1',
        ]);

        Module::create([
            'title' => $data['title'],
            'content' => $data['content'],
            'order' => $data['order'] ?? 1,
        ]);

        return redirect()->route('admin.modules.index')
            ->with('success', 'Module cree avec succes.');
    }
}
