<?php

namespace App\Models;

use App\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Starship extends Model
{
    use HasFactory;
    use Filterable;

    public function armaments()
    {
        return $this->belongsToMany(Armament::class, 'armament_starship')->withPivot('quantity');
    }
}
