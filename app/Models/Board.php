<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    protected $table = 'boards';
     
    protected $fillable = [
        'board_name',        
        
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function outputs()
    {
        return $this->hasMany(OutputBoard::class, 'board_id');
    }

}
