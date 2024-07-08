<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'subject_id',
        'user_id',
        'description',
        'attach_file',
        'video_link',
        'ticket_status'
    ];

    public function subject(){
        return $this->belongsTo(Subject::class,'subject_id','id')->withDefault(['name'=>'N/A']);
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id','id')->withDefault(['name'=>'N/A']);
    }
}
