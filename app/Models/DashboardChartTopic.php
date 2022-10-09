<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DashboardChartTopic extends Model
{
    protected $table = 'dashboard_chart_topics';
     
    protected $fillable = [
        'color',   
        'dashboard_chart_id',
        'topic_id'        
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function topic()
    {
        return $this->belongsTo(Topic::class, 'topic_id');
    }

    public function topic_values()
    {
        return $this->hasMany(TopicValue::class, 'dashboard_chart_topic_id');
    }

    public function dashboard_chart()
    {
        return $this->belongsTo(DashboardChart::class);
    }

}
