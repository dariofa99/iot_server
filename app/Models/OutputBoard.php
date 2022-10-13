<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OutputBoard extends Model
{
    protected $table = 'outputs_board';
     
    protected $fillable = [
        'output_name',    
        'gpio',
        'status',
        'board_id'
    ];
  
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

}
