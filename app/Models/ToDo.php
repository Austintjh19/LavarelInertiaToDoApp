<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToDo extends Model
{
    use HasFactory;

    protected $table = 'todos';
    protected $fillable = ['user_id','TaskName', 'Deadline'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
