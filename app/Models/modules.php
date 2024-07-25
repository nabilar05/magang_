<?php

namespace App\Models;
use App\Http\Controllers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class modules extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public $timestamps = true;
}
