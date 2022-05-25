<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coach extends Model
{
    use HasFactory;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function licences()
    {
        return $this->hasMany(CoachLicence::class, 'coach_id');
    }

    public function coachClubDetails()
    {
        return $this->hasMany(CoachClubDetail::class, 'coach_id');
    }

    public function coachEvents()
    {
        return $this->hasMany(CoachEvent::class, 'coach_id');
    }
}
