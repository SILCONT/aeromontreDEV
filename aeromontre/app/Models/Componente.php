<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Componente extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function entradas(): HasMany{
        return $this->hasMany(Entrada::class);
    }




}
