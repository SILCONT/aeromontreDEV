<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Licence extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function catalog():BelongsTo{
        return $this->belongsTo(Catalog::class);
    }

    public function user() :BelongsTo{
        return $this->belongsTo(User::class);
    }
}
