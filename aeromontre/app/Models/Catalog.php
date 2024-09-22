<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Catalog extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function licences(): HasMany{
        return $this->hasMany(Licence::class);


    }
}