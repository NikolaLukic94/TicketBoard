<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketUser extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ticket_id',
        'user_id',
        'watcher',
        'assigned',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'ticket_id' => 'integer',
        'user_id' => 'integer',
        'watcher' => 'boolean',
        'assigned' => 'boolean',
    ];


    public function ticket()
    {
        return $this->belongsTo(\App\Models\Ticket::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
