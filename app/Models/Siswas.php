<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswas extends Model
{
    protected $guarded = [''];
    // table name
    protected $table = 'siswas';
    
    use HasFactory;
}
