<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'status',
    ];

    public function ticket(){
        return $this->hasMany(Ticket::class,'subject_id','id')->withDefault(['name'=>'N/A']);
    }
}
