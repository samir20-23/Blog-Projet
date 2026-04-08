<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TodoList;


class TodoListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todolist = TodoList::all();
        return view('todolist.index',compact('todolist'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    TodoList::create([
        'content' => $request->content
    ]);

    return redirect()->back();
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
 public function update(Request $request, string $id)
{
    $todolist = TodoList::findOrFail($id);

    $todolist->update([
        'content' => $request->content
    ]);

    return redirect()->back();
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
