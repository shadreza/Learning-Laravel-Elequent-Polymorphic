<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = ['path'];

    public function imageable()
    {
        // "MorphTo" is used to define the relationship from a one-to-one or one-to-many polymorphic table to whichever model or models it is linked to.
        return $this->morphTo();
    }
}
