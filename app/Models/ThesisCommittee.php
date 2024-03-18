<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThesisCommittee extends Model
{
    use HasFactory;
    protected $table = 'thesis_committee';
    protected $primaryKey = 'Academic_Year';
    protected $fillable = [  
        'Department',
        'Major',
        'Committee',
        'Subject',
    ];
}
