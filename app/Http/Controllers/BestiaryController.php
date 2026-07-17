<?php

namespace App\Http\Controllers;

use App\Models\BestiaryTemplate;
use Illuminate\Http\Request;

class BestiaryController extends Controller
{
    public function index()
    {
        $templates = BestiaryTemplate::all();

        return view('bestiary/templates.index', [
            'templates' => $templates
        ]);
    }

    public function create()
    {
        return view('bestiary/templates.create');
    }

    public function show(BestiaryTemplate $template)
    {
        return view('bestiary/templates.show', [
            'template' => $template
        ]);
    }

    public function edit(BestiaryTemplate $template)
    {
        return view('bestiary/templates.edit', [
            'template' => $template
        ]);
    }

    public function update(BestiaryTemplate $template)
    {
        request()->validate([
            // 'name'  => ['required', 'min:1'],
            // 'color' => ['required', 'min:1']
        ]);

        $template->update([
            // 'name'  => request('name'),
            // 'color' => request('color'),
        ]);

        return redirect('/bestiary/templates');
    }

    public function destroy(BestiaryTemplate $template)
    {
        $template->delete();

        return redirect('/bestiary/templates');
    }

    public function store()
    {
        request()->validate([
            // 'name'  => ['required', 'min:1'],
            // 'color' => ['required', 'min:1']
        ]);

        BestiaryTemplate::create([
            // 'name'  => request('name'),
            // 'color' => request('color'),
        ]);

        return redirect('/bestiary/templates');
    }
}
