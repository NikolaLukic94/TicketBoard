<?php

namespace App\Models;

use App\Traits\RecordsActivity;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use RecordsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function owns()
    {
        return $this->hasMany(Ticket::class, 'author_id');
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }

    public function watchingTickets()
    {
        return $this->belongsToMany(Ticket::class)->wherePivot('watcher', 1);
    }

    public function ticketProcessorTicket()
    {
        return $this->belongsToMany(Ticket::class)->wherePivot('assigned', 1);
    }

    public function involvedInTickets()
    {
        return $this->belongsToMany(Ticket::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

//    public function watchingTickets()
//    {
//        return $this->belongsToMany(Project::class);
//    }
}
