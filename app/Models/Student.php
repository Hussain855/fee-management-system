<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';
    public $timestamps = false;
    protected $fillable = [
        'name', 'roll_number', 'class_id', 'section_id',
        'guardian_name', 'phone', 'address', 'date_of_admission'
    ];

    public function classModel()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function feeDues()
    {
        return $this->hasMany(FeeDue::class, 'student_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'student_id');
    }

    public function receipts()
    {
        return $this->hasMany(Receipt::class, 'student_id');
    }

    public function discounts()
    {
        return $this->hasMany(Discount::class, 'student_id');
    }

    public function fines()
    {
        return $this->hasMany(Fine::class, 'student_id');
    }
}