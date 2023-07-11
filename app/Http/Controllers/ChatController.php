<?php

namespace App\Http\Controllers;

use App\Events\msgsend;
use App\Models\Pesan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
class ChatController extends Controller
{

    public function index()
    {
      
        return Inertia::render('Chat/Chatting');
    }
    public function getMsg()  {
         return Pesan::with('user')->get();
    }
    public function getUserLogin()  {
         return Auth::user();
    }
     public function sendPesan(Request $request)
    {
    $id = Auth::user()->getAuthIdentifier();
    $user = Auth::user();

    $pesan = $user->pesan()->create([
        "user_id" => $id,
        "pesan" => $request->input("pesan"),
    ]);

    event(new msgsend($pesan,$user));

}
}
