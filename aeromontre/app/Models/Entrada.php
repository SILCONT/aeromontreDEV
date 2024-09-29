<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Entrada extends Model
{

    use HasFactory;
    protected $guarded=[];
    public function componente():BelongsTo{
        return $this->belongsTo(Componente::class);
    }
    public function plane():BelongsTo{
        return $this->belongsTo(Plane::class);
    }
    public function cliente():BelongsTo{
        return $this->belongsTo(Cliente::class);
    }

    public function salidas():HasMany{
        return $this->hasMany(Salida::class);
    }

}
