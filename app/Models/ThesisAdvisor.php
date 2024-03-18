<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThesisAdvisor extends Model
{
    use HasFactory;
    protected $table = 'thesis_advisor';
    protected $primaryKey = 'Academic_year';
    protected $fillable = [
        'n',
        'College',
        'Department',
        'Advisor',
    ];
}
