<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    protected $fillable = ['id','user_id','description','created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
