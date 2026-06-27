<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $table = 'sections';
    public $timestamps = false;
    protected $fillable = ['class_id', 'name'];

    public function classModel()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'section_id');
    }
}