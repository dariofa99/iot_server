<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TopicValue extends Model
{
    protected $table = 'topic_values';
     
    protected $fillable = [       
        'value',
        'date',
        'dashboard_chart_topic_id'        
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
