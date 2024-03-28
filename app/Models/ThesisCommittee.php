<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThesisCommittee extends Model
{
    use HasFactory;
    protected $table = 'thesis_committee';
    protected $fillable = [
        'Academic_Year',
        'Major',
        'Committee', 
        'Department',
        'Subject',
    ];
    
}
