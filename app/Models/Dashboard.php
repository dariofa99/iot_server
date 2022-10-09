<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    protected $table = 'dashboards';
     
    protected $fillable = [
        'dashboard_name',   
        'token'      
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function charts()
    {
        return $this->hasMany(DashboardChart::class, 'dashboard_id');
    }
    
}
