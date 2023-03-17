<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Siswas extends Model
{
    protected $guarded = [''];
    // table name
    protected $table = 'siswas';
    
    use HasFactory;

    public function jenkels()
    {
        return $this->hasMany('App\Models\jenis_kelamin');
    }
}
