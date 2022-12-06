<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CodeName extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
    ];

    public function picked()
    {
        return $this->hasOne(CodeNameRelationship::class, 'picker_id', 'id');
    }

    public function giver()
    {
        return $this->hasOne(CodeNameRelationship::class, 'receiver_id', 'id');
    }
}
