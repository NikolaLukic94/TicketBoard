<?php

namespace App\Models;

use Carbon\Carbon;
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
        'uuid',
        'target_date',
        'title',
        'description',
        'urgency_level',
        'author_id',
        'category_id',
        'subcategory_id',
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
        'category_id' => 'integer',
        'subcategory_id' => 'integer',
    ];


    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function invlolvedTeamMembers()
    {
        return $this->belongsToMany(User::class);
    }

    public function scopeClosedThisWeek($query)
    {
//        return $query->where('votes', '>', 100);
    }

    public function scopeDueToday($query)
    {
        return $query->where('target_date', Carbon::now()->format('Y-m-d'));
    }

    public function scopeUnassigned($query)
    {
//        return $query->where('votes', '>', 100);
    }
}
