<?php

namespace App\Http\Controllers;

use App\Models\Effect;
use Illuminate\Http\Request;

class EffectController extends Controller
{
    public function index()
    {
        $effects = Effect::all();

        return view('effects.index', [
            'effects' => $effects
        ]);
    }

    public function create()
    {
        return view('effects.create');
    }

    public function show(Effect $effect)
    {
        return view('effects.show', [
            'effect' => $effect
        ]);
    }

    public function edit(Effect $effect)
    {
        return view('effects.edit', [
            'effect' => $effect
        ]);
    }

    public function update(Effect $effect)
    {
        request()->validate([
            'name'  => ['required', 'min:1'],
            'color' => ['required', 'min:1']
        ]);

        $effect->update([
            'name'  => request('name'),
            'color' => request('color'),
        ]);

        return redirect('/effects');
    }

    public function destroy(Effect $effect)
    {
        $effect->delete();

        return redirect('/effects');
    }

    public function store()
    {
        request()->validate([
            'name'  => ['required', 'min:1'],
            'color' => ['required', 'min:1']
        ]);

        Effect::create([
            'name'  => request('name'),
            'color' => request('color'),
        ]);

        return redirect('/effects');
    }
}
