<?php

namespace App\Http\Controllers;

use App\Models\Tags;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function index()
    {
        $tags = Tags::all();
        return view('tags.index', compact('tags'));
    }

    public function create()
    { 
        $tags = Tags::all(); 
        return view('tags.create', compact( 'tags'));
    }

    public function store(Request $request)
    {
        // Check if user is logged in
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to create an tags.');
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);
    
        Tags::create([
            'name' => $validatedData['name'],
        ]);
    
        return redirect()->route('tags.index')->with('success', 'Tags created successfully!');
    }   
    

    public function edit(string $id)
    { 
        $tags = Tags::findOrFail($id); 
        return view('tags.edit', compact( 'tags'));   
    }
    

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $tags = Tags::findOrFail($id);

        $tags->update([
            'name' => $validatedData['name'],
        ]);

        return redirect()->route('tags.index')->with('success', 'Tags updated successfully!');
    }

    public function destroy(string $id)
    {
        $tags = Tags::findOrFail($id);
        $tags->delete();
        return redirect()->route('tags.index')->with('success', 'Tags deleted successfully.');
    }
   
}
