<?php
namespace App\Listeners;

use App\Events\msgsend;
use App\Models\Post;

class IncrementCounterListener
{
    public function handle(msgsend $event)
    {
        // Lakukan pembaruan nilai counter di sini (misalnya, menyimpannya di database)
           

        // Simpan nilai counter ke dalam database menggunakan model Post
      



        // Mengirimkan pembaruan nilai counter ke Pusher
  
    }
}
