<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'category_id',
        'description',
        'amount',
        'image',
    ];

    public function category () 
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function requests () 
    {
        return $this->hasMany(Request::class);
    }

    public function lendings () 
    {
        return $this->hasMany(Lending::class);
    }

}
