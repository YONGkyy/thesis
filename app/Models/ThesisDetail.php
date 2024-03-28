<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThesisDetail extends Model
{
    use HasFactory;
    protected $table  = 'thesis_detail';
    protected  $fillable= [
        'Thesis_No',
        'Student_ID',
        'Phone',
        'Defend',
        'Pass_State',
        'Issue_Tem_Certificate',
        'Other',
        'Hardwork',
        'Charateristic',
        'Remark',
        'Result',
    ];
}
