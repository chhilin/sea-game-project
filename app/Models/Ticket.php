<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable = [
        'price',
        'zone',
        'user_id',
        'event_id',
    ];
    
    public static function store($request,$id=null)
    {
        $ticket = $request->only(['price','zone','user_id','event_id']);
        $ticket = self::updateOrCreate(['id' => $id], $ticket);

        return $ticket;
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function event():BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function zones():HasMany
    {
        return $this->hasMany(Zone::class);
    }
}