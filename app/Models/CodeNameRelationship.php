<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CodeNameRelationship extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'picker_id',
        'receiver_id',
    ];

    public function picker()
    {
        return $this->belongsTo(CodeName::class, 'picker_id', 'id');
    }

    public function receiver()
    {
        return $this->belongsTo(CodeName::class, 'receiver_id', 'id');
    }
}
