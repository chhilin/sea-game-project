<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use PhpParser\Builder\Function_;
use Psy\TabCompletion\Matcher\FunctionsMatcher;

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'sportName',
        'date',
        'time',
        'description',
        'user_id',
        'location',
    ];

    public static function store($request,$id=null)
    {
        $event = $request->only(['sportName', 'date','time','description','location','user_id']);
        $event = self::updateOrCreate(['id' => $id], $event);

        $teams = request('teams');
        $event->teams()->sync($teams);
        return $event;
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(user::class);
    }

    public function tickets():HasMany
    {
        return $this->hasMany(Ticket::class);
    }

    public Function teams()
    {
        return $this->belongsToMany(Team::class, 'event_teams')->withTimestamps();
    }
    
}