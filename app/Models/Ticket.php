<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'target_date',
        'title',
        'description',
        'urgency_level',
        'author_id',
        'project_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'target_date' => 'date',
        'author_id' => 'integer',
        'project_id' => 'integer',
    ];


    public function author()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function project()
    {
        return $this->belongsTo(\App\Models\Project::class);
    }
}
