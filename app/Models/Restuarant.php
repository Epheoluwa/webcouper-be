<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restuarant extends Model
{
    use HasFactory;
    protected $table = 'restuarants'; 
    protected $fillable = [
        'queryParams',
        'name',
    ];
}
