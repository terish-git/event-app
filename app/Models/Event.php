<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'start_date',
        'end_date',
    ];

    protected $dates = [
        'start_date',
        'end_date',
    ];

    protected function startDate(): Attribute
    {
        return new Attribute(
            // get: fn ($value) =>  Carbon::parse($value)->format('d M Y'),
            set: fn ($value) =>  Carbon::parse($value)->format('Y-m-d'),
        );
    }

    protected function endDate(): Attribute
    {
        return new Attribute(
            // get: fn ($value) =>  Carbon::parse($value)->format('d M Y'),
            set: fn ($value) =>  Carbon::parse($value)->format('Y-m-d'),
        );
    }

    /**
     * Get the user that created the event.
     *       
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user that created the event.
     *       
     */
    public function invited()
    {
        return $this->hasMany(Invitation::class);
    }

}
