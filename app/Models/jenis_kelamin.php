<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jenis_kelamin extends Model
{
    protected $guarded = [''];
    // table name
    protected $table = 'jenis_kelamin';
    public function jenkel()
    {
        return $this->belongsTo('App\Models\Siswas');
    }
    use HasFactory;
}
