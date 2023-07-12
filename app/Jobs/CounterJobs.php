<?php

namespace App\Jobs;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CounterJobs implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
          $incrementValue = request('count', 0); // Mendapatkan nilai yang dikirim dari Vue component
    $counter = Post::firstOrNew([]); // Mendapatkan record counter atau membuat baru jika belum ada

    $counter->count += $incrementValue; // Menambahkan angka yang dikirim ke angka yang ada
    $counter->save(); // Menyimpan perubahan

    }
}
