<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ListTodo extends Model
{
    use HasFactory;
    protected $table = 'applist';

    protected $fillable = ['id','name','status'];

    
}
