<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        return view('tags.index', compact('tags'));
    }

    public function create()
    { 
        $tags = Tag::all(); 
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
    
        Tag::create([
            'name' => $validatedData['name'],
        ]);
    
        return redirect()->route('tags.index')->with('success', 'Tag created successfully!');
    }   
    

    public function edit(string $id)
    { 
        $tags = Tag::findOrFail($id); 
        return view('tags.edit', compact( 'tags'));   
    }
    

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $tags = Tag::findOrFail($id);

        $tags->update([
            'name' => $validatedData['name'],
        ]);

        return redirect()->route('tags.index')->with('success', 'Tag updated successfully!');
    }

    public function destroy(string $id)
    {
        $tags = Tag::findOrFail($id);
        $tags->delete();
        return redirect()->route('tags.index')->with('success', 'Tag deleted successfully.');
    }
   
}
