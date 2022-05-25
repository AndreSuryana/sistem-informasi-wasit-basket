<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoachClubDetail extends Model
{
    use HasFactory;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    public function coach()
    {
        return $this->belongsTo(Coach::class);
    }

    public function club()
    {
        return $this->belongsTo(Club::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
