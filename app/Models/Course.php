<?php

namespace App\Models;

use App\Observers\CourseObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    protected $table = 'courses';

    protected $fillable = ['name', 'course_type', 'status', 'release_date'];

    protected $casts = [
        'release_date' => 'date:d/m/Y H:i',
    ];

    const STATUSES = [
        1 => 'Active',
        2 => 'Passive'
    ];

    const COURSE_TYPES = [
        1 => 'Psychology',
        2 => 'Humanity',
        3 => 'Communication'
    ];
}
