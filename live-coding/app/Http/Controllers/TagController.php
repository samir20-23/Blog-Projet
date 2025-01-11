<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function checkRole()
    {
        // return   $this->checkRole();
        if (!auth()->check()) {
            session()->flash('error', 'You must be logged in to view this page.');
            redirect()->route('login');
        } else if (auth()->user()->role == 'user') {
            return redirect()->route('home')->with('error', 'You must be an admin to view this page.');
        }
        return null;
    } 
    public function index()
    {
         return   $this->checkRole();

        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to create an tags.');
        } else {
            $role = auth()->user()->role;
            $tags = Tag::all();
            return view('tags.index', compact('tags', 'role'));
        }
    }

    public function create()
    {
         return   $this->checkRole();
        $tags = Tag::all();
        return view('tags.create', compact('tags'));
    }

    public function store(Request $request)
    {
         return   $this->checkRole();
        // Check if user is logged in


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
         return   $this->checkRole();
        $tags = Tag::findOrFail($id);
        return view('tags.edit', compact('tags'));
    }


    public function update(Request $request, string $id)
    {
         return   $this->checkRole();
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
         return   $this->checkRole();
        $tags = Tag::findOrFail($id);
        $tags->delete();
        return redirect()->route('tags.index')->with('success', 'Tag deleted successfully.');
    }
}
