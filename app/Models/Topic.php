<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $table = 'topics';
     
    protected $fillable = [
        'topic_name',        
        
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

}
