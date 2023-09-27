<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class Scheduler extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'channel',
        'message',
        'time',
        'email',
        'sent_at',
        'failed_at',
    ];

    /**
     * Scope a query to only include current hour schedulers.
     *
     * @param Builder $query
     * @return mixed
     */
    public function scopeReady(Builder $query)
    {
        return $query->whereTime(DB::raw('HOUR(time)'), '=', now()->hour);
    }
}
