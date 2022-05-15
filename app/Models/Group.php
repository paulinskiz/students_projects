<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project;
use App\Models\Student;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }
}
