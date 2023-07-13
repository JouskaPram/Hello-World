<?php

namespace App\Http\Controllers;

use App\Jobs\CounterJobs;
use App\Models\Post;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Events\IncrementCounterEvent;
use App\Events\msgsend;

class CounterController extends Controller
{
     public function index()
    {
      
        return Inertia::render('Post/Index');
    }
  public function getCounter()
{
      $post = Post::find(1); // Ganti 1 dengan ID post yang sesuai

    return response()->json(['count' => $post->count], 200);

    // return response()->json(['counter' => $counter]);
}

   public function incrementCounter()
{
     
    
    
      $post = Post::find(1); // Ganti 1 dengan ID post yang sesuai
    $updatedCounter =request("count");
    $post->count =  $post->count + $updatedCounter;
    $post->save(); 
//    CounterJobs::dispatch()->onQueue('CounterJobs');;
      return response()->json(['message' => 'Counter incremented'], 200);
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
