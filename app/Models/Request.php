<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'id_item',
        'total_request',
        'type',
        'rent_id',
        'request_date',
        'status',
        'return_date',
    ];

    public function user () 
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function item () 
    {
        return $this->belongsTo(Item::class, 'id_item');
    }
    public function lending () 
    {
        return $this->belongsTo(Lending::class, 'rent_id');
    }
}
