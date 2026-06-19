<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $table = 'discounts';
    public $timestamps = false;
    protected $fillable = [
        'student_id', 'type', 'percentage', 'amount', 'description'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}