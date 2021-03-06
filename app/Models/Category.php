<?php

namespace App\Models;

use App\Traits\RecordsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, RecordsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'project_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'project_id' => 'integer',
    ];

    public $path = '/category/';

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }
}
