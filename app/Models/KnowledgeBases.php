<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KnowledgeBases extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'knowledge_bases';
    protected $fillable = [
        'question',
        'answer',
        'category',
        'metadata',
        'created_by',
        'updated_by',
        'embedding' 
    ];
}
