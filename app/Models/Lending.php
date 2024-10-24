<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lending extends Model
{
    use HasFactory;

    public $timestamps = false;


    protected $fillable = [
        'id_user', 
        'id_item',
        'total_request',
        'lend_date',
        'return_date',
        'actual_return_date',
        'status',
    ];

    public function users ()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function items ()
    {
        return $this->belongsTo(Item::class, 'id_item');
    }

    public function request () 
    {
        return $this->hasMany(Request::class);
    }
}
