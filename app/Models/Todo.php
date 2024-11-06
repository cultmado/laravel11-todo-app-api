<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Todo extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'description', 'status'];

    protected function casts(): array
{
    return [
        'created_at' => 'datetime:M. d, Y h:i:s A',
        'updated_at' => 'datetime:M. d, Y h:i:s A',
    ];
}
}
