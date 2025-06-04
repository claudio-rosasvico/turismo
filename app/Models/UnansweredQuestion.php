<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UnansweredQuestion extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'unanswered_questions';
    protected $fillable = [
        'question',
        'metadata',
        'reviewed',
        'user_id',
    ];

}
