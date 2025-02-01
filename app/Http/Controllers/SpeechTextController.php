<?php

namespace App\Http\Controllers;

use App\Models\SpeechText;
use Illuminate\Http\Request;

class SpeechTextController extends Controller
{
    // List all speech texts with optional search functionality
    public function index(Request $request)
    {
        $search = $request->get('search');

        // Search speech texts by text content or language
        $speechTexts = SpeechText::when($search, function ($query, $search) {
            $query->where('text', 'like', '%' . $search . '%')
                  ->orWhere('language', 'like', '%' . $search . '%');
        })
        ->orderBy('created_at', 'desc') // Order by latest data
        ->get();

        return view('speech_texts.index', compact('speechTexts'));
    }

    // Show the form to create a new speech text
    public function create()
    {
        return view('speech_texts.create');
    }

    // Store a newly created speech text
    public function store(Request $request)
    {
        // Validate the input data
        $validated = $request->validate([
            'text' => 'required|string|max:5000',
            'language' => 'required|string|max:255',
        ]);

        // Create the speech text record
        SpeechText::create($validated);

        return redirect()->route('speech_texts.index')->with('success', 'Speech text successfully created.');
    }

    // Show the form to edit an existing speech text
    public function edit($id)
    {
        $speechText = SpeechText::findOrFail($id);
        return view('speech_texts.edit', compact('speechText'));

    }

    // Update an existing speech text
    public function update(Request $request, $id)
    {
        $speechText = SpeechText::findOrFail($id);

        // Validate the input data
        $validated = $request->validate([
            'text' => 'required|string|max:5000',
            'language' => 'required|string|max:255',
        ]);

        // Update speech text details
        $speechText->update($validated);

        return redirect()->route('speech_texts.index')->with('success', 'Speech text successfully updated.');
    }

    // Delete a speech text
    public function destroy($id)
    {
        $speechText = SpeechText::findOrFail($id);
        $speechText->delete();

        return redirect()->route('speech_texts.index')->with('success', 'Speech text successfully deleted.');
    }
}
