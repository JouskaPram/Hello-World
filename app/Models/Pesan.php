<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    use HasFactory;
    protected $fillable = ["pesan","user_id"]; 
public function user()
{
  return $this->belongsTo(User::class);
}
}
