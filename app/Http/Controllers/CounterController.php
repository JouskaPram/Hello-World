<?php

namespace App\Http\Controllers;

use App\Jobs\CounterJobs;
use App\Models\Post;
use Countable;
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
    $counter = Post::get("*");
    $count = count($counter);
    return $count;

    // return response()->json(['counter' => $counter]);
}

   public function incrementCounter()
{
    // Mendapatkan record counter atau membuat baru jika belum ada
   CounterJobs::dispatch(request('count'));
    return response()->json(['message' => 'Data sent to queue']);
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
