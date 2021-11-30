<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hobby extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'description',
        'user_id',
        
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function tags() {
        return $this->belongsToMany('App\Models\Tag');
    }

    // public function filteredTags() {
    //     return $this->belongsToMany('App\Models\Tag')
    //     ->wherePivot('hobby_id', $this->id)
    //     ->orderBy('updated_at', 'DESC');
    // }

    
}
