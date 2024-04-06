<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thesis extends Model
{
    use HasFactory;
    protected $table = 'thesis';
    protected $fillable = [
        'Thesis_No',
        'Thesis_Group',
        'Academic_Year',
        'Department',
        'Major',
        'Year',
        'Batch',
        'Session',
        'Organizaition',
        'Organization_Type',
        'Location',
        'Organization_Phone',
        'Title',
        'Title_Khmer',
        'Objective',
        'Objective_Khmer',
        'Summary',
        'Submit_Date',
        'Teacher_id',
        'Defend_Date',
        'Book_Score',
        'Defend_time',
        'Submit_book',
        'Building',
        'Room',
    ];
    public function advisor()
    {
        return $this->belongsTo(ThesisAdvisor::class, 'id', 'id');
    }
}
