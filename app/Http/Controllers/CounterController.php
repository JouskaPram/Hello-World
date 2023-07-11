<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CounterController extends Controller
{
     public function index()
    {
      
        return Inertia::render('Post/Index');
    }
      public function getCounter()
    {
        $counter = Post::get("count");
        return $counter;
        return response()->json(['counter' => $counter->count]);
    }

    public function incrementCounter()
    {
        $counter = Post::firstOrCreate([]);
        $counter->increment('count');
        return response()->json(['counter' => $counter->count]);
    }
    /**
     * Display a listing of the resource.
     */
 

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
