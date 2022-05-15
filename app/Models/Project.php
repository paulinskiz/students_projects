<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\Group;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'groups',
        'students_group',
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class)->withTimestamps();
    }

    public function groups()
    {
        return $this->hasMany(Group::class);
    }
}
