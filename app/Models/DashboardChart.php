<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DashboardChart extends Model
{
    protected $table = 'dashboard_charts';
     
    protected $fillable = [
        'cols',   
        'chart_id',
        'dashboard_id'    
        
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function chart()
    {
        return $this->belongsTo(Chart::class, 'chart_id');
    }

    public function chart_topics()
    {
        return $this->hasMany(DashboardChartTopic::class, 'dashboard_chart_id');
    }

    public function dashboard()
    {
        return $this->belongsTo(Dashboard::class, 'chart_id');
    }

}
