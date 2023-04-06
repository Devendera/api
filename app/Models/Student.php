<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'students';
    protected $fillable = [
        'name',
        'branch_id',
        'class',
        'section',
        'join_date'
    ];

    public function branch()
    {
        return $this->belongsTo('App\Models\Branch');
    }
}
