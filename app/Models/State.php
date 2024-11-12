<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class State extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
    ];


    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
}
