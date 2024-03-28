<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThesisAdvisor extends Model
{
    use HasFactory;
    protected $table = 'thesis_advisor';
    protected $fillable = [
        'Academic_Year',
        'Advisor',
        'College',
        'Department',
    ];
    
}
