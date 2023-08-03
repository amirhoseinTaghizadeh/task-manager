<?php

namespace App\Http\Controllers;

use App\Models\Cards;
use Illuminate\Http\Request;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $cards = Cards::all();


        return view('cards.index', compact('cards'));
    }

    public function create()
    {

        return view('cards.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);


        $card = Cards::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);


        return redirect()->route('cards.index')->with('success', 'Card created successfully!');
    }

    public function edit(Cards $card)
    {

        return view('cards.edit', compact('card'));
    }

    public function update(Request $request, Cards $card)
    {

        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);


        $card->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('cards.index')->with('success', 'Card updated successfully!');
    }

    public function destroy(Cards $card)
    {

        $card->delete();

        return redirect()->route('cards.index')->with('success', 'Card deleted successfully!');
    }
}
