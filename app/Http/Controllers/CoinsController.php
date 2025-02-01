<?php

namespace App\Http\Controllers;

use App\Models\Coins;
use Illuminate\Http\Request;

class CoinsController extends Controller
{
    // List all speech texts with optional search functionality
    public function index(Request $request)
    {
        $search = $request->get('search');

        // Search speech texts by text content or language
        $coins = Coins::when($search, function ($query, $search) {
            $query->where('price', 'like', '%' . $search . '%');
        })
        ->orderBy('created_at', 'desc') // Order by latest data
        ->get();

        return view('coins.index', compact('coins'));
    }

    // Show the form to create a new speech text
    public function create()
    {
        return view('coins.create');
    }

    // Store a newly created speech text
    public function store(Request $request)
    {
        // Validate the input data
        $validated = $request->validate([
            'price' => 'required|string|max:5000',
            'coins' => 'required|string|max:255',
            'save' => 'required|string|max:255',
            'popular' => 'required|string|max:255',
        ]);

        // Create the speech text record
        Coins::create($validated);

        return redirect()->route('coins.index')->with('success', 'Coins successfully created.');
    }

    // Show the form to edit an existing speech text
    public function edit($id)
    {
        $coins = Coins::findOrFail($id);
        return view('coins.edit', compact('coins'));

    }

    // Update an existing speech text
    public function update(Request $request, $id)
    {
        $coins = Coins::findOrFail($id);

        // Validate the input data
        $validated = $request->validate([
            'price' => 'required|string|max:5000',
            'coins' => 'required|string|max:255',
            'save' => 'required|string|max:255',
            'popular' => 'required|string|max:255',
            'best_offer' => 'required|string|max:255',
        ]);

        // Update speech text details
        $coins->update($validated);

        return redirect()->route('coins.index')->with('success', 'Coins successfully updated.');
    }

    public function updateStatus(Request $request)
{
    // Validate that at least one coin is selected
    $request->validate([
        'coin_ids' => 'required|array|min:1',
        'coin_ids.*' => 'exists:coins,id', // Ensure the IDs exist in the database
    ]);

    // Check if more than one coin is selected
    if (count($request->coin_ids) > 1) {
        return redirect()->back()->with('error', 'Please select only one coin to update.');
    }

    // Get the selected coin ID
    $selectedCoinId = $request->coin_ids[0];

    // Update the best_offer field for all coins
    Coins::query()->update(['best_offer' => 0]); // Set all to 0 first
    Coins::where('id', $selectedCoinId)->update(['best_offer' => 1]); // Set selected to 1

    return redirect()->route('coins.index')->with('success', 'Coins updated successfully.');
}

public function destroy($id)
{
    $coins = Coins::findOrFail($id);
    $coins->delete();

    return redirect()->route('coins.index')->with('success', 'Speech text successfully deleted.');
}
}
