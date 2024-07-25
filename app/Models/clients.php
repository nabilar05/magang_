<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers;;
class clients extends Model
{
    use HasFactory;
    protected $fillable = ['company', 'contact_person'];

    public $timestamps = true;
}