<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chart extends Model
{
    protected $table = 'charts';
     
    protected $fillable = [
        'chart_type'    
        
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

}
